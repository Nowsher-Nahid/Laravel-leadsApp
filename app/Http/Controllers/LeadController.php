<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\User;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Stripe\Stripe;
use Stripe\Charge;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeadPublishedNotification;

class LeadController extends Controller {

    public function index(Request $request){
        if ($request->ajax()) {

            if(Auth::user()->type === 0){
                $data = Lead::query()->get();
            }else{
                $data = Lead::query()->where('status',1)->get();
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('lead_info', function($row){
                        // services
                        $servicesArray = json_decode($row->services, true);
                        if (is_array($servicesArray)) {
                            $all_services = implode(', ', $servicesArray);
                        }else{
                            $all_services = "";
                        }
                        // sold count
                        if($row->sold_count === '0'){
                            $sold = '<span class="text-success">New</span>';
                        }else if($row->sold_count === 'Full'){
                            $sold = '<span class="text-danger">Full</span>';
                        }else if($row->sold_count === '1'){
                            $sold = $row->sold_count.' person';
                        }else{
                            $sold = $row->sold_count.' persons';
                        }
                        
                        $lead_info = '
                            <p class="mb-2"><b>Job Type :</b> '.$row->job_type.'</p>
                            <p class="mb-2"><b>Services :</b> '.$all_services.'</p>
                            <p class="mb-2"><b>Budget :</b> '.$row->budget.'</p>
                            <p class="badge bg-light-danger rounded-pill f-12 mb-0">'.$sold.'</p>
                        ';
                        return $lead_info;
                    })
                    ->addColumn('published_date', function($row){
                        if ($row->status_changed_at) {
                            $statusChangedDate = Carbon::parse($row->status_changed_at);
                            return $statusChangedDate->diffForHumans();
                        }
                    })
                    ->addColumn('status', function($row){
                        $lead = Lead::findOrFail($row->id);
                        if($lead->status === 0){
                            return "<span class='badge bg-light-danger rounded-pill f-12'>Pending</span>";
                        }else{
                            return "<span class='badge bg-light-success rounded-pill f-12'>Published</span>";
                        }
                    })
                    ->addColumn('sold', function($row){
                        if($row->sold_count === '0'){
                            $new_text = '<span class="text-success">New</span>';
                            return $new_text;
                        }else if($row->sold_count === 'Full'){
                            $full_text = '<span class="text-danger">Full</span>';
                            return $full_text;
                        }else if($row->sold_count === '1'){
                            return $row->sold_count.' person';
                        }else{
                            return $row->sold_count.' persons';
                        }
                    })
                    ->addColumn('services', function($row) {
                        $servicesArray = json_decode($row->services, true);
                        if (is_array($servicesArray)) {
                            return implode(', ', $servicesArray);
                        }
                        return '';
                    })
                    ->addColumn('action', function($row){
                            $btn = '<div class="d-flex">';
                            $userHasPurchased = $row->transactions()->where('user_id', Auth::id())->exists();
                            if(Auth::user()->type === 1 && !$userHasPurchased) {
                                $btn .= '
                                    <button class="pay me-1 btn btn-warning btn-sm open-payment-modal" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                        <i class="fas fa-euro-sign"></i>
                                    </button>
                                ';
                            }
                            $btn .= '
                                <a href="'.route('lead.show', $row->id).'" class="view btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                            ';
                            if(Auth::user()->type === 0){
                                $btn .= '
                                <a href="'.route('lead.edit', $row->id).'" class="edit btn btn-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>
                                <button class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><i class="fas fa-trash"></i></button>
                                ';
                            }
                            $btn .= '</div>';
                            return $btn;
                    })
                    ->rawColumns(['lead_info','published_date','status','sold','action'])
                    ->make(true);
        }
        return view('lead-list');
    }

    public function show(string $id){
        $lead = Lead::findOrFail($id);
        $userHasPurchased = $lead->transactions()->where('user_id', auth()->id())->exists();
        $isSoldOut = $lead->sold_count === 'Full';
        return view('lead-details', compact('lead','userHasPurchased','isSoldOut'));
    }

    public function edit(string $id){
        $lead = Lead::findOrFail($id);
        $settings = Setting::first();
        return view('edit-lead', compact('lead','settings'));
    }

    public function update(Request $request, string $id){
        // Validate the incoming request data
        $request->validate([
            'job_type' => 'required|string|max:255',
            'services' => 'nullable|array',
            'budget' => 'required|string|max:255',
            'price' => 'nullable|numeric|between:0,99999999.99',
            'deadline' => 'required|date',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'website_url' => 'nullable|string|max:255',
            'status' => 'required|integer',
            'description' => 'nullable|string',
            'sold_count' => 'required|string'
        ]);

        // Fetch the lead instance
        $lead = Lead::findOrFail($id);

        // Determine if the status is changing from pending (0) to published (1)
        $statusChangedToPublished = ($lead->status === 0 && $request->input('status') === '1');

        // Prepare data for update
        $data = $request->all();
        $data['services'] = json_encode($request['services'] ?? []);
        
        // Update the lead attributes
        $lead->fill($data);

        // Update status_changed_at only if changing from pending to published
        if ($statusChangedToPublished) {
            $lead->status_changed_at = now();
        } elseif ($request->input('status') !== 1) {
            // Set status_changed_at to null if status is not changing to published
            $lead->status_changed_at = null;
        }

        // Check if status is now published
        if ($statusChangedToPublished) {
            // Fetch users whose email settings match the lead's job type and budget
            $leadJobType = $lead->job_type;
            $leadBudget = $lead->budget; // Single value for budget

            $users = User::whereHas('emailSettings', function ($query) use ($leadJobType, $leadBudget) {
                $query->where(function ($query) use ($leadJobType) {
                    $query->whereJsonContains('job_type', $leadJobType);
                })->where(function ($query) use ($leadBudget) {
                    $query->whereJsonContains('budget', $leadBudget);
                });
            })->get();

            // Send email notifications to matched users
            foreach ($users as $user) {
                Mail::to($user->email)->send(new LeadPublishedNotification($lead));
            }
        }

        $lead->save();
        return redirect()->back()->with('success', 'Lead updated successfully.');
    }


    public function destroy(string $id){
        $lead = Lead::findOrFail($id);
        $lead->delete();
        return response()->json(['success' => true]);
    }

    public function buyLead(Request $request, $id){
        $lead = Lead::findOrFail($id);
        $settings = Setting::first();
        $maxSold = $settings->max_sold;

        if ($lead->sold_count >= $maxSold) {
            return redirect()->back()->with('error', 'This lead is fully sold.');
        }

        // Set the Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create the charge on Stripe's servers - this will charge the user's card
            $charge = Charge::create([
                'amount' => $lead->price * 100, // Stripe accepts amounts in cents
                'currency' => 'eur',
                'source' => $request->stripeToken,
                'description' => 'Lead purchase',
            ]);

            // After successful payment, create a transaction
            Transaction::create([
                'lead_id' => $lead->id,
                'user_id' => auth()->id(),
                'amount' => $lead->price,
                'payment_id' => $charge->id,
            ]);

            // Update the sold count for the lead
            $lead->increment('sold_count');

            // Check if the lead has reached the maximum sold count
            if ($lead->sold_count >= $maxSold) {
                $lead->sold_count = 'Full';
                $lead->save();
            }

            return redirect()->back()->with('success', 'Lead purchased successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}

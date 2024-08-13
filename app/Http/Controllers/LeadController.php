<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use DataTables;

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
                    ->addColumn('status', function($row){
                        $lead = Lead::findOrFail($row->id);
                        if($lead->status === 0){
                            return "<span class='badge bg-light-danger rounded-pill f-12'>Pending</span>";
                        }else{
                            return "<span class='badge bg-light-success rounded-pill f-12'>Published</span>";
                        }
                    })
                    ->addColumn('action', function($row){
                            $btn = '
                            <div class="d-flex">
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
                    ->rawColumns(['status','action'])
                    ->make(true);
        }
        return view('lead-list');
    }

    public function show(string $id){
        $lead = Lead::findOrFail($id);
        return view('lead-details', compact('lead'));
    }

    public function edit(string $id){
        $lead = Lead::findOrFail($id);
        $settings = Setting::first();
        return view('edit-lead', compact('lead','settings'));
    }

    public function update(Request $request, string $id){
        $request->validate([
            'job_type' => 'required|string|max:255',
            'services' => 'required|string|max:255',
            'budget' => 'required|string|max:255',
            'price' => 'nullable|numeric|between:0,99999999.99',
            'deadline' => 'required|date',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'website_url' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        $data = $request->all();
        $lead = Lead::findOrFail($id);

        $lead->update($data);
        return redirect()->back()->with('success', 'Lead updated successfully.');
    }

    public function destroy(string $id){
        $lead = Lead::findOrFail($id);
        $lead->delete();
        return response()->json(['success' => true]);
    }
}

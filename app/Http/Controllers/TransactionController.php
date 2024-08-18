<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions');
    }

    public function getData()
    {
        $user = auth()->user();
        $userType = $user->type;

        // Fetch transactions based on user type
        if ($userType === 0) {
            $transactions = Transaction::with('lead.user')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $transactions = Transaction::with('lead.user')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return DataTables::of($transactions)
            ->addColumn('job_type', function($transaction) {
                return $transaction->lead->job_type;
            })
            // ->addColumn('services', function($transaction) {
            //     return $transaction->lead->services;
            // })
            ->addColumn('services', function($transaction) {
                $servicesArray = json_decode($transaction->lead->services, true);
                if (is_array($servicesArray)) {
                    return implode(', ', $servicesArray);
                }
                return '';
            })
            ->addColumn('budget', function($transaction) {
                return $transaction->lead->budget;
            })
            ->addColumn('name', function($transaction) {
                return $transaction->lead->name;
            })
            ->addColumn('purchased_date', function($transaction) {
                return $transaction->created_at->format('M d, Y');
            })
            ->addColumn('purchased_by', function($transaction) {
                return $transaction->user->first_name.' '.$transaction->user->last_name;
            })
            // ->addColumn('email', function($transaction) {
            //     return $transaction->user->email;
            // })
            ->addColumn('action', function($transaction){
                $btn = '
                    <a href="'.route('lead.show', $transaction->lead->id).'" class="view btn btn-success btn-sm">Lead Details</a>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}

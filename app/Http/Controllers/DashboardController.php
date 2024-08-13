<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;

class DashboardController extends Controller
{
    public function index()
    {
        $total_users = User::where('type', 1)->count();
        $total_pedning_leads = Lead::where('status', 0)->count();
        $total_published_leads = Lead::where('status', 1)->count();

        return view('dashboard', compact('total_users', 'total_pedning_leads', 'total_published_leads'));
    }
}

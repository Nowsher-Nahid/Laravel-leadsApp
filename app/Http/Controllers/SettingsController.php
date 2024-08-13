<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Budget;

class SettingsController extends Controller {

    public function index(){
        $settings = Setting::firstOrFail();
        return view('settings', compact('settings'));
    }

    public function max_sold_update(Request $request){
        $request->validate([
            'max_sold' => 'required|integer|between:0,255'
        ]);
        $settings = Setting::first(); 
        $settings->max_sold = $request->input('max_sold');
        $settings->save();

        return redirect()->back()->with('success', 'Data updated successfully.');
    }

    public function budget_update(Request $request){
        $request->validate([
            'budget_price_1' => 'nullable|numeric|between:0,99999999.99',
            'budget_price_2' => 'nullable|numeric|between:0,99999999.99',
            'budget_price_3' => 'nullable|numeric|between:0,99999999.99',
            'budget_price_4' => 'nullable|numeric|between:0,99999999.99',
        ]);
        $settings = Setting::first();
        $data = $request->all();
        $settings->update($data);

        return redirect()->back()->with('success', 'Prices updated successfully.');
    }

}

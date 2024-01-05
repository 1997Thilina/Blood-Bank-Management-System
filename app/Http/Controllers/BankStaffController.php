<?php

namespace App\Http\Controllers;

use App\Models\BloodStock;
use App\Models\BloodType;
use App\Models\Hospital;
use Illuminate\Http\Request;

class BankStaffController extends Controller
{
    public function viewAddBloodStock(){
        $bloodTypes=BloodType::all();
 
        $hospitals=Hospital::select('id', 'hospital_name')->get();
        return view('bankStaff.AddBloodStock',compact('hospitals','bloodTypes'));
    }

    public function storeBloodStock(Request $request){

        //return $request;
        $bloodStock_add = new BloodStock();
        $bloodStock_add->bloodType = $request->bloodType;
        $bloodStock_add->units = $request->units;
        $bloodStock_add->status = "good";
        $bloodStock_add->expireDate = $request->expireDate;
        $bloodStock_add->hospital_id = $request->from;
        $bloodStock_add->save();
        return redirect()->route('viewAddBloodStock')->with('success', 'stock was added successfully');
    
    }
    
    public function viewBloodStockDetails(){
        $bloodStock_details_1 = BloodStock::all();

        $bloodStock_details_2 = BloodStock::where('expireDate', '>=', now())
        ->where('expireDate', '<=', now()->addDays(10))
        ->get();

        $bloodStock_details_3 = BloodStock::where('expireDate', '<=', now())
        ->get();

        return view('bankStaff.viewBloodStock',compact('bloodStock_details_1','bloodStock_details_2','bloodStock_details_3'));
    }
}

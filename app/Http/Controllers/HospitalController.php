<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function viewHospitals(){
        $hospitals=Hospital::all();
        //return $users;
        // return view('addSKU',compact('sku'));
        // return view('donordashboard');
         return view('admin.addHospital',compact('hospitals'));
    }

    public function storeHospitals(Request $request){
    
        //return $request;
        $hospital_add = new Hospital();
        $hospital_add-> hospital_name =$request-> hospital_name;
        $hospital_add-> hospital_address =$request-> hospital_address;
        $hospital_add-> hospital_email =$request-> hospital_email;
        $hospital_add-> coordinator_name =$request-> coordinator_name;
        $hospital_add-> coordinator_phone =$request-> coordinator_phone;
        $hospital_add->save();
        return redirect()->route('viewHospitals')->with('success', 'Hospital details were added successfully');

    }
}

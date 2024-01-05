<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use Illuminate\Http\Request;

class BloodTypeController extends Controller
{
    public function viewAddBloodTypes(){
        $bloodTypes=BloodType::all();
        //return $users;
        // return view('addSKU',compact('sku'));
        // return view('donordashboard');
         return view('admin.addBloodTypeInfo',compact('bloodTypes'));
    }

    public function storeBloodTypes(Request $request){
    
        //return $request;
        $bloodType_add = new BloodType();
        $bloodType_add-> BloodType =$request-> BloodType;
        $bloodType_add-> Description =$request-> Description;
        $bloodType_add-> TotalUnits =$request-> TotalUnits;
        $bloodType_add->save();
        return redirect()->route('viewAddBloodTypes')->with('success', 'Blood Type details were added successfully');

    }

    public function deleteBloodTypes(Request $request){
        //return $request;
        $type = BloodType::find($request->bloodType);
            if ($type) {
                $type->delete();
               
                return redirect()->route('viewAddBloodTypes')->with('success', 'deleted');
            } 
    }
}

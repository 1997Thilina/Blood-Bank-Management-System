<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\BloodType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BloodRequestController extends Controller
{
    ///////////////////////////////// request blood /////////////////////////////////
    public function viewRequestBloodUnits()
    {
        $bloodTypes = BloodType::all();
        $request_history = BloodRequest::where('userEmail', '=', Auth::user()->email)->get();

        return view('requestBlood', compact('bloodTypes', 'request_history'));
    }

    public function storeRequestBloodUnits(Request $request)
    {
        //return $request;
        $request->validate([
            'bloodType' => 'required|max:255',
            'units' => 'required|integer|min:1',
            'message' => 'required|string|max:400'
        ]);

        $hcStaff_add = new BloodRequest();
        $hcStaff_add->userEmail = Auth::user()->email;
        $hcStaff_add->bloodType = $request->bloodType;
        $hcStaff_add->units = $request->units;
        $hcStaff_add->userType = Auth::user()->userType;
        $hcStaff_add->message = $request->message;
        $hcStaff_add->status = 'Pending';
        $hcStaff_add->save();
        return redirect()->route('viewRequestBloodUnits')->with('success', 'your request was sent to the blood bank');
    }

    //////////////////////////// make reservation /////////////////////////////
    public function viewMakeReservation()
    {
        //$bloodTypes=BloodType::all();
        $request_history = BloodRequest::all();

        return view('bankStaff.makeReservations', compact('request_history'));
    }


    ////////////////////////////////// change blood request status/////////////////////////////
    public function changeBloodRequestStatus(Request $request)
    {

        if (Auth::user()->userType == "admin" || Auth::user()->userType == "Blood_Bank_Staff") {

            if ($request->status) {
                BloodRequest::where('id', $request->cancel)->update([
                    'status' => $request->status,
                ]);
                return redirect()->route('viewMakeReservation')->with('success', 'Blood Reqquest status was updated to ' . $request->status);
            }
            return redirect()->route('viewMakeReservation');
        } else {

            if ($request->status) {
                BloodRequest::where('id', $request->cancel)->update([
                    'status' => $request->status,
                ]);
                return redirect()->route('viewRequestBloodUnits')->with('success', 'your Blood Reqquest was ' . $request->status);
            }
            return redirect()->route('viewRequestBloodUnits');
        }
    }
}

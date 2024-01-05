<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Donor;
use App\Models\WorkingHours;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{
    public function viewMakeAppointment()
    {

        $hours_data = WorkingHours::all();
        $my_appointments = Appointments::where('donorEmail', '=', Auth::user()->email)
            ->get();

        $currentDate = Carbon::now()->toDateString();
        $stored_appointment = Appointments::select('donorId', 'date', 'time', 'appointmentStatus', 'NearestHospital')
            ->where('donorEmail', '=', Auth::user()->email)
            // ->where('date', '>=', $currentDate )
            ->get();

        $NearestHospital = Donor::select('hospital')
            ->where('userEmail', '=', Auth::user()->email)
            ->get();
        //return $NearestHospital;

        //return $stored_appointment;
        return view('makeAppointment', compact(['hours_data', 'stored_appointment', 'my_appointments', 'NearestHospital']));
    }

    public function storeAppointment(Request $request)
    {

        //return $request;
        $appointment_add = new Appointments();
        $appointment_add->donorEmail = $request->donorEmail;
        $appointment_add->donorId = $request->donorId;
        $appointment_add->date = $request->date;
        $appointment_add->time = $request->time;
        $appointment_add->appointmentStatus = $request->appointmentStatus;
        $appointment_add->NearestHospital = $request->NearestHospital;
        $appointment_add->save();
        return redirect()->route('viewMakeAppointment')->with('success', 'your appoinment was submitted, you will recieve confirmation email soon.');
    }

    public function changeAppointmentStatus(Request $request)
    {
        if (Auth::user()->userType == "admin") {

            Appointments::where('id', $request->cancel)->update([
                'appointmentStatus' => $request->status,
            ]);
            return redirect()->route('ViewControlAppointment')->with('success', 'appoinment status was updated');
        } else {


            Appointments::where('id', $request->cancel)->update([
                'appointmentStatus' => $request->status,
            ]);
            return redirect()->route('viewMakeAppointment')->with('success', 'your appoinment was Cancelled');
        }
        
    }

    public function changeAvailabilityStatus(Request $request)
    {
        //return $request->availability;
        if (Auth::user()->userType == "donor") {
            if($request->availability){

                Donor::where('userEmail', Auth::user()->email)->update([
                    'availability' => "true",
                ]);
                return redirect()->route('dashboard')->with('success', 'appoinment status was updated');
            }
            else {
                Donor::where('userEmail', Auth::user()->email)->update([
                    'availability' => "false",
                ]);
                return redirect()->route('dashboard')->with('success', 'appoinment status was updated');
            }

            
        }

        
    }
}

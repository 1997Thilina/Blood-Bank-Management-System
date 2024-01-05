<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\BankStaff;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewUserManagement(){
        $users=User::paginate(2);
         return view('admin.usersManagement',compact('users'));
    }

    public function ViewControlAppointment(){
 
        $stored_appointments = Appointments::all();
         return view('admin.controlAppointments',compact('stored_appointments'));
    }


    public function viewAddStaff(){
 
        // $stored_appointments = Appointments::all();
         return view('admin.addStaff');
    }

    public function storeStaffMember(Request $request)
    {

        //return $request;
        $add_bankStaff = new BankStaff();
        $add_bankStaff->full_name = $request->full_name;
        $add_bankStaff->email = $request->email;
        $add_bankStaff->gender = $request->gender;
        $add_bankStaff->age = $request->age;
        $add_bankStaff->phone = $request->phone;
        $add_bankStaff->nic = $request->nic;
        $add_bankStaff->possition = $request->possition;
        $add_bankStaff->save();

        $add_bankStaff_user = new User();
        $add_bankStaff_user->name = $request->full_name;
        $add_bankStaff_user->email = $request->email;
        $add_bankStaff_user->password = $request->password;
        $add_bankStaff_user->userType = $request->possition;
        $add_bankStaff_user->save();

        
        return redirect()->route('viewAddStaff')->with('success', 'staff member was successfully added.');
    }

    
}

<?php

namespace App\Http\Controllers;

use App\Models\BankStaff;
use App\Models\BloodRequest;
use App\Models\BloodStock;
use App\Models\BloodType;
use App\Models\Donor;
use App\Models\HcStaff;
use App\Models\Hospital;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /////////////////////////////////// view dashboard /////////////////////////////////


    public function viewDashboard()
    {
        $hospitals = Hospital::select('id', 'hospital_name')->get();
        $bloodTypes = BloodType::all();
        $total_users  = User::all()->max('id');
        $total_donors  = Donor::all()->max('id');
        $total_staff  = BankStaff::all()->max('id');
        $total_hospitals  = Hospital::all()->max('id');
        $total_hospitals  = Hospital::all()->max('id');

        $availability = 'false';
        if (Auth::user()->userType == 'donor') {
            $donor_availability  = Donor::select('availability')->where('userEmail', '=', Auth::user()->email)->get();

            $availability = $donor_availability[0]->availability;
        }



        $currentDate = Carbon::now()->toDateString();
        $blood_stocks = BloodStock::where('expireDate', '>=', $currentDate)
            ->where('status', '=', 'good')->get();

        $reserved_stocks = BloodRequest::where('status', '=', 'Reserved')->get();
        //return $reserved_stocks;

        //$blood_stocks = BloodStock::all();

        $a_m_stock = 0;
        $b_m_stock = 0;
        $ab_m_stock = 0;
        $o_m_stock = 0;
        $a_p_stock = 0;
        $b_p_stock = 0;
        $ab_p_stock = 0;
        $o_p_stock = 0;

        $a_m_res = 0;
        $b_m_res = 0;
        $ab_m_res = 0;
        $o_m_res = 0;
        $a_p_res = 0;
        $b_p_res = 0;
        $ab_p_res = 0;
        $o_p_res = 0;

        foreach ($blood_stocks as $stockItem) {

            switch ($stockItem->bloodType) {
                case 'A-':
                    $a_m_stock += $stockItem->units;
                    break;
                case 'B-':
                    $b_m_stock += $stockItem->units;
                    break;
                case 'AB-':
                    $ab_m_stock += $stockItem->units;
                    break;
                case 'O-':
                    $o_m_stock += $stockItem->units;
                    break;
                case 'A+':
                    $a_p_stock += $stockItem->units;
                    break;
                case 'B+':
                    $b_p_stock += $stockItem->units;
                    break;
                case 'AB+':
                    $ab_p_stock += $stockItem->units;
                    break;
                case 'O+':
                    $o_p_stock += $stockItem->units;
                    break;
            }
        }

        foreach ($reserved_stocks as $requestItem) {

            switch ($requestItem->bloodType) {
                case 'A-':
                    $a_m_res += $requestItem->units;
                    break;
                case 'B-':
                    $b_m_res += $requestItem->units;
                    break;
                case 'AB-':
                    $ab_m_res += $requestItem->units;
                    break;
                case 'O-':
                    $o_m_res += $requestItem->units;
                    break;
                case 'A+':
                    $a_p_res += $requestItem->units;
                    break;
                case 'B+':
                    $b_p_res += $requestItem->units;
                    break;
                case 'AB+':
                    $ab_p_res += $requestItem->units;
                    break;
                case 'O+':
                    $o_p_res += $requestItem->units;
                    break;
            }
        }

        $a_m = max($a_m_stock - $a_m_res, 0);
        $b_m = max($b_m_stock - $b_m_res, 0);
        $ab_m = max($ab_m_stock - $ab_m_res, 0);
        $o_m = max($o_m_stock - $o_m_res, 0);
        $a_p = max($a_p_stock - $a_p_res, 0);
        $b_p = max($b_p_stock - $b_p_res, 0);
        $ab_p = max($ab_p_stock - $ab_p_res, 0);
        $o_p = max($o_p_stock - $o_p_res, 0);

        return view('dashboard', compact(
            'hospitals',
            'bloodTypes',
            'total_users',
            'total_donors',
            'total_staff',
            'total_hospitals',
            'a_m',
            'b_m',
            'ab_m',
            'o_m',
            'a_p',
            'b_p',
            'ab_p',
            'o_p',
            'availability'
        ));

        // return view('dashboard', compact('hospitals', 'bloodTypes', 'total_users', 'total_donors', 'total_staff', 'total_hospitals'));
    }

    /////////////////////////////////// become doner /////////////////////////////////////
    public function viewBecomeDonor()
    {
        $hospitals = Hospital::select('id', 'hospital_name')->get();
        $bloodTypes = BloodType::all();

        return view('becomeDonor', compact('hospitals', 'bloodTypes'));
    }

    public function StoreDonor(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'userEmail' => 'required|string|max:255',
            'userId' => 'required|max:255',
            'bloodType' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'age' => 'required|integer|min:1',
            'phone' => 'required|string|max:15',
            'nic' => 'required|string|max:20',
            'hospital' => 'required|string',
            'bio' => 'required|string|max:400',
        ]);
        //return $request;
        $donor_add = new Donor();
        $donor_add->full_name = $request->full_name;
        $donor_add->userEmail = $request->userEmail;
        $donor_add->userId = $request->userId;
        $donor_add->bloodType = $request->bloodType;
        $donor_add->gender = $request->gender;
        $donor_add->age = $request->age;
        $donor_add->phone = $request->phone;
        $donor_add->nic = $request->nic;
        $donor_add->availability = 'true';
        $donor_add->hospital = $request->hospital;
        $donor_add->bio = $request->bio;
        $donor_add->save();

        User::where('id', Auth::user()->id)->update([
            'userType' => 'donor',
        ]);
        return redirect()->route('viewBecomeDonor')->with('success', 'you were registered Successfully as a donor.');
    }

    ///////////// become HcStaff /////////////////////////////////////// 
    public function viewBecomeHcStaff()
    {
        //$hospitals=Hospital::select('id', 'hospital_name')->get();
        //$arrayData = json_decode($hospitals, true);
        //return $arrayData;
        return view('becomeHcStaff');
    }

    public function storeHcStaff(Request $request)
    {
        //return $request;
        $request->validate([
            'full_name' => 'required|string|max:255',
            'userEmail' => 'required|string|max:255',
            'userId' => 'required|max:255',
            'gender' => 'required|string|in:male,female',
            'age' => 'required|integer|min:1',
            'phone' => 'required|string|max:15',
            'nic' => 'required|string|max:20',
            'possition' => 'required|string',
            'workPlace' => 'required|string',
            'bio' => 'required|string|max:400',
        ]);
        //return $request;
        $hcStaff_add = new HcStaff();
        $hcStaff_add->full_name = $request->full_name;
        $hcStaff_add->userEmail = $request->userEmail;
        $hcStaff_add->userId = $request->userId;
        $hcStaff_add->gender = $request->gender;
        $hcStaff_add->age = $request->age;
        $hcStaff_add->phone = $request->phone;
        $hcStaff_add->nic = $request->nic;
        $hcStaff_add->possition = $request->possition;
        $hcStaff_add->workPlace = $request->workPlace;
        $hcStaff_add->bio = $request->bio;
        $hcStaff_add->save();

        User::where('id', Auth::user()->id)->update([
            'userType' => 'HcStaff',
        ]);
        return redirect()->route('viewBecomeHcStaff')->with('success', 'you were registered Successfully as a Hospital/Clinic member.');
    }

    ///////////////////// delete users /////////////////////////////////////////////
    public function deleteUsers(Request $request)
    {

        return $request;
        
        if ($request->userType == 'donor') {
            $user = Donor::find($request->userEmail);
            if ($user) {
                $user->delete();
                User::where('email', $request->userEmail)->update([
                    'userType' => 'user',
                ]);
                return redirect()->route('viewUserManagement')->with('success', 'y');
            } else {

                return redirect()->route('viewUserManagement');
            }
        }


        if ($request->userType == 'Blood_Bank_Staff' || $request->userType == 'Lab_Technician'||$request->userType == 'Auditor') {
            $user = BankStaff::find($request->userEmail);
            if ($user) {
                $user->delete();
                User::where('email', $request->userEmail)->update([
                    'userType' => 'user',
                ]);
                return redirect()->route('viewUserManagement')->with('success', 'y');
            } else {

                return redirect()->route('viewUserManagement');
            }
        }


        if ($request->userType == 'HcStaff') {
            $user = HcStaff::find($request->userEmail);
            if ($user) {
                $user->delete();
                User::where('email', $request->userEmail)->update([
                    'userType' => 'user',
                ]);
                return redirect()->route('viewUserManagement')->with('success', 'y');
            } else {

                return redirect()->route('viewUserManagement');
            }
        }

        if ($request->tableType == 'users') {

            $user = User::find($request->userEmail);
            if ($user) {
                $user->delete();
                return redirect()->route('viewUserManagement')->with('success', 'y');
            } else {

                return redirect()->route('viewUserManagement');
            }
        }
    }
}

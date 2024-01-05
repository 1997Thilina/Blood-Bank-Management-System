<?php

namespace App\Http\Controllers;

use App\Mail\DonationRequestMail;
use App\Models\BankStaff;
use App\Models\BloodType;
use App\Models\Donor;
use App\Models\Hospital;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailSettingsController extends Controller
{

    public function viewManageEmails()
    {

        $bloodTypes = BloodType::all();
        $hospitals = Hospital::all();
        return view('BankStaff.manageEmails', compact('bloodTypes', 'hospitals'));
    }

    public function sendMails(Request $request)
    {


        //return $request;
        $content = $request->content;
        $users = Donor::select('full_name', 'userEmail', 'bloodType')->get();
        //return $users;
        $i = 0;
        try {
            foreach ($users as $donor) {

                if (in_array($donor->bloodType, $request->bloodType)) {

                    $i += 1;
                    Mail::to($donor->userEmail)->send(new DonationRequestMail($donor, $content));
                }
            }
        } catch (Exception $e) {
            return redirect()->route('viewManageEmails')->with('error', $e->getMessage());
        }

        return redirect()->route('viewManageEmails')->with('success', "$i emails were sent successfully");
    }
}

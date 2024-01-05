<?php

namespace App\Http\Controllers;

use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    public function viewRatings(){
       $ratings=Ratings::select('id','userName','userType','rating','message','created_at')->latest()->take(5)->get();
        //return $users;
        // return view('addSKU',compact('sku'));
        // return view('donordashboard');
         return view('feedbacksAndRatings',compact('ratings'));
    }

    public function storeRatings(Request $request){
    
        //return $request;
        $rating_add = new Ratings();
        $rating_add-> userName =Auth::user()->name;
        $rating_add-> email =Auth::user()->email;
        $rating_add-> userType =Auth::user()->userType;
        $rating_add-> rating =6-$request->ratings;
        $rating_add-> message =$request-> message;
        $rating_add->save();
        return redirect()->route('viewRatings')->with('success', 'feedback was sent..');

    }
}

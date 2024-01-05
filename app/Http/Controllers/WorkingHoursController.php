<?php

namespace App\Http\Controllers;

use App\Models\WorkingHours;
use Illuminate\Http\Request;

class WorkingHoursController extends Controller
{
    public function viewAddWorkingHours()
    {
         $hours_data=WorkingHours::all();
        return view('admin.addWorkingTime',compact('hours_data'));
    }

    public function storeWorkingHours(Request $request)
    {
        //return $request;
        $data = $request->all();

        $days = $data['day'];
        $isOpen = $data['isOpen'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];

        foreach ($days as $key => $day) {

            if ($day !== null) {
                $condition = ['day' => $days[$key]];
                $exists = WorkingHours::where($condition)->exists();
                if ($exists) {
            
                        WorkingHours::where('day', $days[$key])->update([
                            'isOpen' => $isOpen[$key] =="true" ? 1 : 0,
                            
                        ]);
                    
                    if ($start_time[$key]) {
                        WorkingHours::where('day', $days[$key])->update([     
                            'startTime' => $start_time[$key],
                        ]);
                    }
                    if ($end_time[$key]) {
                        WorkingHours::where('day', $days[$key])->update([
                            'endTime' => $end_time[$key]
                        ]);
                    }
                } else {
                    $add_hours = new WorkingHours();
                    $add_hours->day = $days[$key];
                    $add_hours->isOpen = $isOpen[$key] ? 1 : 0;
                    $add_hours->startTime = $start_time[$key];
                    $add_hours->endTime = $end_time[$key];
                    $add_hours->save();
                }
            }
        }
        return redirect()->route('viewAddWorkingHours')->with('success', 'working hours status Successfully updated.');

    }
}

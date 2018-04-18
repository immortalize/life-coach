<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Effort;
use App\Goal;
use App\EffortTime;

class EffortController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($goal_id)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($goal_id)
    {
        $user_id = Auth::id();

        $goal = Goal::where('user_id', $user_id)->find($goal_id);

        return view('create_effort_form', [
                'goal' => $goal
            ]
        );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $effort = new Effort();
        $effort->goal_id = $request->goal_id;
        $effort->desc = $request->effort_desc;
        $effort->save();

        return redirect('/goals/'.$request->goal_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $effort = Effort::findOrFail($id);
        $effort_times = $effort->effott_times_of_week()->get();
        $effort_times_lastweek = $effort->effott_times_of_last_week()->get();
/*
        //this weeks sum
        $sum = 0;
        if(count($effort_times)>0){
            foreach ($effort_times as $effort_time){
                $time = strtotime($effort_time->duration) - strtotime('00:00:00');
                $sum += $time;
            }
            //$sum = $sum + strtotime('00:00:00');
            $sum = date("Y-m-d H:i:s", $sum);        
            $parsed = date_parse($sum);
            $sum = ($parsed['hour'] + (($parsed['day'] - 1)*24)) . ':' . $parsed['minute'];
        }
/*
        //last weeks sum
        $sum2 = 0;
        if(count($effort_times_lastweek)>0){
            $time = 0;
            foreach ($effort_times_lastweek as $effort_time){
                $time = strtotime($effort_time->duration) - strtotime('00:00:00');
                $debug = strtotime($effort_time->duration);
                $sum2 += $time;
            }
            $sum2 = date("Y-m-d H:i:s", $sum2);
            $debug = $sum2;

            $parsed2 = date_parse($sum2);
            $sum2 = ($parsed2['hour'] + (($parsed2['day'] - 1)*24)) . ':' . $parsed2['minute'];        
        }
*/
        //this weeks sum
        $sum_this_week = 0;
        if(count($effort_times)>0){
            foreach ($effort_times as $effort_time){
                $parsed = date_parse($effort_time->duration);
                $sum_this_week += $parsed['hour']*60 + $parsed['minute'];
            }
        }
        $sum_this_week = floor($sum_this_week/60) . ':' . $sum_this_week % 60;

        //last weeks sum
        $sum_last_week = 0;
        if(count($effort_times_lastweek)>0){
            foreach ($effort_times_lastweek as $effort_time){
                $parsed = date_parse($effort_time->duration);
                $sum_last_week += $parsed['hour']*60 + $parsed['minute'];
            }
        }
        $sum_last_week = floor($sum_last_week/60) . ':' . $sum_last_week % 60;
        
        //get the goal (parent of effort) of the effort
        $goal = $effort->goal()->get();

        //we'll use this to check if the status of last effort
        $ef = new EffortTimeController();

        return view('an_effort', [
                'goal'   => $goal[0],
                'effort' => $effort,
                'effort_times' => $effort_times_lastweek,
                'effort_status' => $ef->is_in_effort($id),
                'week_sum' => $sum_this_week,
                'last_week_sum' => $sum_last_week,
            ]
        );        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        /* work on mass destroy of child entities. this didn't work!

        $effort_time_controller = new EffortController();
        $effort_times = $effort_time_controller->index($request->id);

        foreach ($effort_times as $effort_time) {
            # code...
            EffortTimeController::destroy($effort_time->id);
        }
        */

        Effort::findOrFail($request->id)->delete();
        return redirect('/goals/'.$request->goal_id);

    }
}
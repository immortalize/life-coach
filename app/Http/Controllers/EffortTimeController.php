<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\EffortTime;

class EffortTimeController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($effort_id)
    {
	    $effort_time = new EffortTime();

	    $effort_times = $effort_time->where('user_id', Auth::id(), 'effort_id', $effort_id)->orderBy('begin_date')->get();

//	    $effort_time_status = $effort_time->select('end_date')->where('user_id', Auth::id())->latest('begin_date')->first();

/*
	    return view('effort_time', [
	        'effort_times' => $effort_times,
	        'effort_status' => $this->is_in_effort()
	    ]);
*/
	    return $effort_times;
    }

    /**
     * return in effort/idle state by checking end of effort date/time 
     *  0 -- idle
     *  1 -- in effort
     *
     * @return boolean
     */
    public function is_in_effort($effort_id){
        $effort = new EffortTime();
        $effort_end = $effort->select('end_date')->where(['user_id' => Auth::id(), 'effort_id' => $effort_id])->latest('begin_date')->first();

        if(EffortTime::where(['user_id' => Auth::id(), 'effort_id' => $effort_id])->exists())
            return is_null($effort_end['end_date']);
        else
            return false;
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_effort_form',
            ['effort_status' => $this->is_in_effort()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        if($this->is_in_effort($request->effort_id))
        {
            EffortTime::where(['user_id' => Auth::id(), 'effort_id' => $request->effort_id])->whereNull('end_date')->update(['end_date' => Carbon::now()]);
        }
        else
        {
            $effort = new EffortTime;
            $effort->user_id = Auth::id();
            $effort->effort_id = $request->effort_id;
            $effort->begin_date = Carbon::now();
            $effort->save();
        }

        return redirect('/efforts/' . $request->effort_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $effort = EffortTime::findOrFail($id);
        return view('edit_effort_time_form', [
            'effort_time' => $effort
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        EffortTime::findOrFail($request->id)->update([
            'begin_date'=> $request->begin_date,
            'end_date'  => $request->end_date
        ]);
        return redirect('/efforts/' . $request->effort_id);
    }    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        EffortTime::findOrFail($request->id)->delete();

        return redirect('/efforts/' . $request->effort_id);    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Sleep;

class SleepController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $sleep = new Sleep();

	    $sleeps = $sleep->where('user_id', Auth::id())->orderBy('begin_date')->get();

//	    $sleep_status = $sleep->select('end_date')->where('user_id', Auth::id())->latest('begin_date')->first();

	    return view('sleep', [
	        'sleeps' => $sleeps,
	        'sleep_status' => $this->is_asleep()
	    ]);

    }

    /**
     * return asleep/awake state by checking end of sleep date/time 
     *  0 -- awake
     *  1 -- asleep
     *
     * @return boolean
     */
    public function is_asleep(){
        $sleep = new Sleep();
        $sleep_end = $sleep->select('end_date')->where('user_id', Auth::id())->latest('begin_date')->first();

        if(Sleep::where('user_id', Auth::id())->exists())
            return is_null($sleep_end['end_date']);
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
        return view('create_sleep_form',
            ['sleep_status' => $this->is_asleep()
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
            
        if($this->is_asleep())
        {
            Sleep::where('user_id', Auth::id())->whereNull('end_date')->update(['end_date' => Carbon::now()]);
        }
        else
        {        
            $sleep = new Sleep;
            $sleep->user_id = Auth::id();
            $sleep->begin_date = Carbon::now();
            $sleep->save();
        }

        return redirect('/sleep');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sleep = Sleep::findOrFail($id);
        return view('edit_sleep_form', [
            'sleep' => $sleep
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
        Sleep::findOrFail($request->id)->update([
            'begin_date'=> $request->begin_date,
            'end_date'  => $request->end_date
        ]);
        return redirect('/sleep');
    }    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sleep::findOrFail($id)->delete();

        return redirect('/sleep');
    }

}

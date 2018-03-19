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
//        $effort = Effort::where('id', $id, 'user_id', Auth::id())->get();
        $effort = Effort::where('id', $id)->get();
//        $goal_id = $effort[0]->goal_id;

        $effort_times = EffortTime::where(['user_id' => Auth::id(), 'effort_id' => $id])->orderBy('begin_date')->get();
        
        $goal   = Goal::where(['id' => $effort[0]->goal_id])->get();

        $ef = new EffortTimeController();

        return view('an_effort', [
                'goal'   => $goal[0],
                'effort' => $effort[0],
                'effort_times' => $effort_times,
                'effort_status' => $ef->is_in_effort($id)
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

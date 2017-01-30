<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Goal;
use App\Step;

class StepController extends Controller
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
    public function index()
    {
        //
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

        return view('create_step_form', [
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
        $step = new Step();
        $step->goal_id = $request->goal_id;
        $step->desc = $request->step_desc;
        $step->state = 'pending';
        $step->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $step = Step::where('id', $request->id)
            ->update(['state' => $request->state]);

        return redirect('/goals/'.$request->goal_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $goal_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $goal_id)
    {
        Step::findOrFail($id)->delete();

        return redirect('/goals/'.$goal_id);

    }
}

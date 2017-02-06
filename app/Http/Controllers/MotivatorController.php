<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Goal;
use App\Motivator;
use App\MotivatorRelation;

class MotivatorController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = Auth::id();

        $goal = Goal::where('user_id', $user_id)->find($request->goal_id);

        return view('create_motivator_form', [
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
        $motivator = new Motivator();
        $motivator_id = $motivator->insertGetId(
            [
                'type'=> $request->motivator_type,
                'name'=> $request->motivator_name,
                'desc'=> $request->motivator_desc
            ]
        );

        $motivator_relation = new MotivatorRelation();
        $motivator_relation->goal_id = $request->goal_id;
        $motivator_relation->motivator_id = $motivator_id;
        $motivator_relation->save();

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
        //$user_id = Auth::id();

        /*
        $motivators = Motivator::join('motivator_relations', 'motivator_id', '=', 'motivators.id')
            ->select('motivators.id')
            ->where('motivator_relations.goal_id', $id)
            ->get();
        */

        $motivator = Motivator::find($id);

        return view('a_motivator', [
                'motivator' => $motivator
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
     * @param  int  $goal_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $goal_id)
    {
        Motivator::findOrFail($id)->delete();

        return redirect('/goals/'.$goal_id);
    }
}

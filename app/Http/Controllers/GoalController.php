<?php

namespace App\Http\Controllers;

use App\Goal;
use App\GoalRelation;

use App\Reason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
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
        $user_id = Auth::id();

        $goals = Goal::where('user_id', $user_id)->orderBy('created_at', 'asc')->get();

        return view('list_goals', [
            'goals' => $goals
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_goal_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $goal = new Goal;
        $user_id = Auth::id();
        $goal->user_id = $user_id;
        $goal->name = $request->goal_name;
        $goal->desc = $request->goal_desc;
        $goal->save();

        return redirect('/goals');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = Auth::id();

        //$goal = Goal::where('id', $id)->get();

        $goal = Goal::where('user_id', $user_id)->find($id);
        $sub_goals = DB::table('goals')
            ->join('goal_relations', 'goals.id', '=', 'goal_relations.child_goal_id')
            ->select('goals.id', 'goals.name', 'goals.desc')
            ->where('goal_relations.goal_id', $id)
            ->get();
        //$rc = new ReasonController();
        //$reasons = $rc->show($id);
        $reasons = Reason::where('goal_id', $id)->get();

        return view('a_goal', [
            'goal' => $goal,
            'sub_goals' => $sub_goals,
            'reasons' => $reasons
        ]);
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
    public function destroy($id)
    {
        Goal::findOrFail($id)->delete();

        return redirect('/goals');
    }

    /**
     * select a goal for adding as a sub-goal
     *resources/views/list_goals_for_select_sub.blade.php
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select_sub($parent_goal_id)
    {
        $user_id = Auth::id();

        $goals = Goal::where('user_id', $user_id)->where('id', '!=', $parent_goal_id)->orderBy('created_at', 'asc')->get();

        $parent_goal = Goal::where('user_id', $user_id)->find($parent_goal_id);

        return view('list_goals_for_select_sub', [
            'goals' => $goals,
            'parent_goal' => $parent_goal
        ]);

    }

    /**
     * Store selected goal as a sub-goal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function associate_sub($parent_goal_id, $sub_goal_id)
    {
        $relation = new GoalRelation;
        $relation->goal_id = $parent_goal_id;
        $relation->child_goal_id = $sub_goal_id;
        $relation->save();

        return redirect('/goals/'.$parent_goal_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_sub($parent_goal_id)
    {
        $user_id = Auth::id();
        $parent_goal = Goal::where('user_id', $user_id)->find($parent_goal_id);

        return view('create_subgoal_form', [
            'parent_goal' => $parent_goal
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_sub(Request $request, $parent_goal_id)
    {
        /*
        $goal = new Goal;
        $user_id = Auth::id();
        $goal->user_id = $user_id;
        $goal->name = $request->goal_name;
        $goal->desc = $request->goal_desc;
        $goal->save();
        */

        $user_id = Auth::id();

        $sub_goal_id = DB::table('goals')->insertGetId([
                'user_id' => $user_id,
                'name' => $request->goal_name,
                'desc' => $request->goal_desc,
            ]);


        return $this->associate_sub($parent_goal_id, $sub_goal_id);
    }


}

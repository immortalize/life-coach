<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    //
    /**
     * The sub-goals that belong to the goal.
     */
    public function sub_goals()
    {
        return $this->belongsToMany('App\Goal', 'goal_relations', 'goal_id', 'child_goal_id');
    }

    /**
     * The parent goals of the goal.
     */
    public function parent_goals()
    {
        return $this->belongsToMany('App\Goal', 'goal_relations', 'child_goal_id', 'goal_id');
    }

    /**
     * The reasons of the goal.
     */
    public function reasons()
    {
        return $this->hasMany('App\Reason');
    }    

    /**
     * The sub-goals that does not belong to the goal.
     *
    public function potential_sub_goals()
    {
        return $this->belongsToMany('App\Goal', 'goal_relations', 'goal_id', 'child_goal_id')
        			->wherePivot('goal_id', '<>' {$this->id});
    } 
    */ 
}

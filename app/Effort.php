<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Effort extends Model
{
    //

    /**
     * The effort times of the effort.
     */
    public function effort_times()
    {
        return $this->hasMany('App\EffortTime');
    }

    /**
     * The goal that has the effort.
     */
    public function goal()
    {
        return $this->belongsTo('App\Goal');
    }

    /**
     * effort times of this week
     */
    public function effott_times_of_week()
    {
		$start_date = Carbon::now()->startOfWeek();//->format('Y/m/d');
		$end_date 	= Carbon::now()->endOfWeek();//->format('Y/m/d');

        return $this->hasMany('App\EffortTime')
        	->whereBetween('begin_date', [$start_date, $end_date]);
    }

    /**
     * effort times of this week
     */
    public function effott_times_of_last_week()
    {
		$start_date = Carbon::now()->startOfWeek()->subWeek();//->format('Y/m/d');
		$end_date 	= Carbon::now()->endOfWeek()->subWeek();//->format('Y/m/d');

        return $this->hasMany('App\EffortTime')
        	->whereBetween('begin_date', [$start_date, $end_date]);
    }

    /**
     * effort times of this month
     */
    public function effott_times_of_month()
    {
		$start_date = Carbon::now()->startOfMonth();//->format('Y/m/d');
		$end_date 	= Carbon::now()->endOfMonth();//->format('Y/m/d');

        return $this->hasMany('App\EffortTime')
        	->whereBetween('begin_date', [$start_date, $end_date]);
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EffortTime extends Model
{
    public $timestamps = false;
    protected $fillable = ['begin_date', 'end_date'];
    protected $appends = ['duration'];	
    //
    public function getDurationAttribute()
	{
    	return Carbon::parse($this->end_date)->diff(Carbon::parse($this->begin_date))->format('%H:%I:%S');

	}    
}

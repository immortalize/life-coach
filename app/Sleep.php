<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
    public $timestamps = false;
    protected $fillable = ['begin_date', 'end_date'];
}

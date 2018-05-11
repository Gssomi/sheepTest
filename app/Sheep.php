<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheep extends Model
{
    protected $fillable = ['name', 'corral_id', 'status'];
}

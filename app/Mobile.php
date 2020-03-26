<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    public $timestamps=false;
    protected $table='mobile';
    protected $fillable = ['user_id','number_phone','type'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addr extends Model
{
    public $timestamps=false;
    protected $table='addr';
    protected $fillable = ['address','user_id'];
}

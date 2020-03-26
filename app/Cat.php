<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    public $timestamps=false;
    protected $table='cat';
    protected $fillable = ['title','num_file','parent'];
}

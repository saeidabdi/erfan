<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    public $timestamps=false;
    protected $table='email';
    protected $fillable = ['mail','user_id'];
}

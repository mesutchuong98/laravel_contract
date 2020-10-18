<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User_Ct extends Authenticatable 
{
    // use Notifiable;

    protected $table='users';
    protected $primaryKey= 'Id';
    public $timestamps = false;
    // protected $fillable = [
    //     'username', 'password',
    // ];
}

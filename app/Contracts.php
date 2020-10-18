<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    protected $table='contract';
    protected $primaryKey= 'Id';
    public $timestamps = false;
}

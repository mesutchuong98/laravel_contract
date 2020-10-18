<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogContract extends Model
{
    protected $table='log_contract';
    protected $primaryKey= 'id';
    public $timestamps = false;
}

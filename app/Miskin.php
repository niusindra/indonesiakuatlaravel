<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miskin extends Model
{
    public $timestamps = false;
    protected $table = 'miskin';
    protected $primaryKey = 'id_miskin';
}

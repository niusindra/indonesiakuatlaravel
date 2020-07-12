<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PHK extends Model
{
    public $timestamps = false;
    protected $table = 'phk';
    protected $primaryKey = 'id_phk';
}

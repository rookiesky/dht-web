<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotdht extends Model
{
    public $table = 'hot_dhts';

    protected $fillable = ['content'];
}

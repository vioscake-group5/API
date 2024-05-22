<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kue extends Model
{
    use HasFactory;

    protected $table = 'kue';

    protected $guarded = ['id_kue'];

}

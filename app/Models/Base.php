<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use HasFactory;

    protected $table = 'base';

    protected $guarded = ['id_base'];

    // protected $fillable = [''];

    // protected $guarded = ['id_base'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Akun extends Model
{
    use HasFactory;

    protected $guarded = ['id_akun'];

    protected $hidden = [
        'password',
        'remember_token',
        'token'
    ];

    // protected $casts = [
    //     'password' => 'hashed',
    // ];
}

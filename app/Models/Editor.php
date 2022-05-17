<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Editor extends Authenticatable
{
    use HasFactory;

    protected $fillable=[
        'name',
        'email',
        'phone_number',
        'email_verified_at',
        'password',
        'admin_id',
        'image',
    ];
}

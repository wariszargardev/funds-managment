<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable=[
        'received_from',
        'company_name',
        'address',
        'bank_name',
        'amount',
        'deposited_by',
        'amount_type',
        'date',
        'user_id',
    ];
}

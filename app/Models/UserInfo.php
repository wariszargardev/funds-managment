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
        'user_id',
        'image',
        'date',
        'email',
        'cheque_pay_order_no',
        'payment_in',
        'reference_by',
        'street',
        'province_id',
        'city_id',
        'country_id',
        'land_line_number',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getProvinceAttribute($value){
        return Province::find($this->province_id)->name??'';
    }

    public function getCityAttribute($value){
        return City::find($this->city_id)->name??'';
    }

    public function getCountryAttribute($value){
        return Country::find($this->country_id)->name??'';
    }
}

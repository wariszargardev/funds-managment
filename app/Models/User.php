<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'editor_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userInfos(){
        return $this->hasMany(UserInfo::class);
    }

    public function getTotalAmountInPkrAttribute(){
        return $this->userInfos->where('payment_in','PKR')->sum('amount')??'';
    }

    public function getTotalAmountInDollarAttribute(){
        return $this->userInfos->where('payment_in','$')->sum('amount')??'';
    }

    public function getTotalEntryAttribute(){
        return $this->userInfos->count('amount')??'';
    }

    public function getAccountStatusAttribute(){
        $date = Carbon::parse($this->last_entry_date);
        $current_date = Carbon::parse(Carbon::now()->subYear()->format('Y-m-d'));
        if($date->lte($current_date)){
            return 'In-active';
        }
        $current_date = Carbon::now()->subMonth(6)->format('Y-m-d');
        if($date->lte($current_date)){
            return 'Dormant';
        }
        return 'Active';
    }

    public function getLastEntryDateAttribute(){
        return Carbon::parse($this->userInfos->last()['date'])->format('Y-m-d')??'';
    }
}

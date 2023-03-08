<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Affiliate extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $guard = "affiliate";

    protected $fillable = [
        'name',
        'email',
        'password',
        'commission_money',
        'promo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
}

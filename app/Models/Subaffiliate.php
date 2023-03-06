<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subaffiliate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'commission_money',
        'promo',
        'affiliate_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

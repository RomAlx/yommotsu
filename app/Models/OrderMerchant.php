<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMerchant extends Model
{
    use HasFactory;
    protected $fillable = [
        'telegram_id',
        'name',
        'phone',
        'isCorrect',
        'status',
        'name',
        'email',
    ];
}

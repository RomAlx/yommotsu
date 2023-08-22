<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name',
        'order_id',
        'amount',
        'status',
        'name',
        'email',
        'bank',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'access_token',
    ];
    protected $table = 'tokens';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function account()
    {
        return $this->belongsTo(AccountWeb::class, 'account_id');
    }
}
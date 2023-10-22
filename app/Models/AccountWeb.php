<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountWeb extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'token_id',
    ];
    protected $table = 'accounts_web';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function token()
    {
        return $this->hasOne(Token::class, 'account_id');
    }

    public function info()
    {
        return $this->hasOne(AccountInfo::class);
    }
}
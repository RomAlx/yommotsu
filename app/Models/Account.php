<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property mixed $telegram_id
 * @property mixed|string $current_action
 */
class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'telegram_id',
        'first_name',
        'last_name',
        'username',
        'current_action',
    ];

    /**
     * Получаем доступ по аккаунту
     *
     * @return HasOne
     */
    public function access(): HasOne
    {
        return $this->hasOne(OrderExchange::class);
    }
}

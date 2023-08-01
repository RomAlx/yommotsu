<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderExchange extends Model
{
    use HasFactory;
    protected $fillable = [
        'telegram_id',
        'buy',
        'sell',
        'amount',
        'location',
        'name',
        'phone',
        'status',
        'isCorrect',
    ];
    /**
     * Получаем доступ по аккаунту
     *
     * @return BelongsTo
     */
    public function access(): BelongsTo
    {
        return $this->BelongsTo(Account::class);
    }
}

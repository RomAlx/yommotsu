<?php

namespace App\Repositories;

use App\Models\Merchant;
use Illuminate\Support\Facades\Log;

class MerchantRepository
{
    public function getCurrent(): array
    {
        return Merchant::query()
            ->where('isCurrent', "=", "1")
            ->get()
            ->first()
            ->toArray();
    }

    public function setNextMerchant(): void
    {
        if (Merchant::query()->count() != 1) {
            $currentMerchant = Merchant::query()
                ->where('isCurrent', "=", "1")
                ->get()
                ->first();
            Log::info('Current merchant: ' . json_encode($currentMerchant));
            $flag = false;
            foreach (Merchant::all() as $merchant) {
                if ($flag) {
                    $newCurrentMerchant = $merchant;
                }
                if ($currentMerchant->id == $merchant->id) {
                    $flag = true;
                }
            }
            if (!isset($newCurrentMerchant)) {
                $newCurrentMerchant = Merchant::query()->orderBy('id')->first();
            }
            $currentMerchant->isCurrent = 0;
            $newCurrentMerchant->isCurrent = 1;
            $currentMerchant->save();
            $newCurrentMerchant->save();
            Log::info('New current merchant: ' . json_encode($newCurrentMerchant));
        } else {
            Log::info('Only one merchant');
        }
    }
}

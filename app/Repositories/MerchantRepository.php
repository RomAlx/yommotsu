<?php

namespace App\Repositories;

use App\Models\Merchant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isNull;

class MerchantRepository
{
    public function getCurrent(): array
    {
        $merchants = Merchant::query()
            ->where('isCurrent', "=", "1")
            ->get();
        $data = [];
        foreach($merchants as $merchant) {
            $data[$merchant->bank] = $merchant;
        }
        return $data;
    }

    public function setNextMerchant(): void
    {
        $currentMerchants = Merchant::query()
            ->where('isCurrent', "=", "1")
            ->get();
        Log::info('Current merchants: ' . json_encode($currentMerchants));
        foreach($currentMerchants as $currentMerchant){
            Log::info('Current merchant: ' . json_encode($currentMerchant));
            $merchantsWithBank = Merchant::query()->where('bank', '=', $currentMerchant->bank)->get()->diff($currentMerchants);
            Log::info('Diffs: ' . json_encode($merchantsWithBank));
            if(count($merchantsWithBank) > 0){
                $newMerchant = null;
                foreach($merchantsWithBank as $merchant){
                    if($merchant->id > $currentMerchant->id){
                        $newMerchant = $merchant;
                        break;
                    }
                }
                if(is_null($newMerchant)){
                    $newMerchant = $merchantsWithBank[0];
                }
                $newMerchant->isCurrent = 1;
                $currentMerchant->isCurrent = 0;
                $newMerchant->save();
                $currentMerchant->save();
                Log::info('New merchant: ' . json_encode($newMerchant));
            }
            
        }
    }
}

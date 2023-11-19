<?php

namespace App\Dto;

use Illuminate\Contracts\Support\Arrayable;

class MoneyDto implements Arrayable
{
    public float $tokensAmt;
    public float $initialAmt;
    public float $usdAmt;
    public float $conversionRate;

    public function toArray()
    {
        return [
            'initial_amount' => $this->initialAmt,
            'usd_amount' => $this->usdAmt,
            'tokens_amount' => $this->tokensAmt,
            'usd_conversion_rate' => $this->conversionRate,
        ];
    }
}
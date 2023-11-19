<?php

namespace App\Service;

use App\Dto\ConvertedCurrencyDto;
use App\Dto\MoneyDto;
use GuzzleHttp\Client;
use \Cache;
use GuzzleHttp\Exception\GuzzleException;

class MoneyConverter
{
    public const API_KEY = 'cur_live_lJ1B3ROUfpJFH7fWpLP0f99YKXnlMpSB0sMXMhVN';

    /**
     * @param  string  $base
     * @param  array   $to
     * @throws GuzzleException
     * @return ConvertedCurrencyDto
     */
    public function getCurrencyRates(string $base, array $to): ConvertedCurrencyDto
    {
        $client = new Client([
            'base_uri' => 'https://min-api.cryptocompare.com/data/',
        ]);

        $response = $client->get('price?fsym=usdt&tsyms=rub');
        $response = json_decode($response->getBody(), true);

        if (!isset($response['RUB'])) {
            throw new \RuntimeException("Can't get currency exchange rates");
        }

        $result = new ConvertedCurrencyDto();
        $result->apiResponseData = $response;
        $result->rubToUsdt = $response['RUB'];

        return $result;
    }

    /**
     * @param  float  $amt
     * @throws GuzzleException
     * @return float
     */
    public function convert(float $amt): float
    {
        $rates = $this->getCurrencyRates('RUB', ['USDT']);
        $rubAmt = $amt * $rates->rubToUsdt;

        return $rubAmt * 1.069;
    }
}
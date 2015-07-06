<?php

/**
 * Fetch the currency exchange rates for the requested currency combination.
 * Use CBR.ru as provider.
 *
 * Return an array with the array(target_currency_code => rate) combination.
 *
 * @param string $currency_code
 *   Source currency code.
 * @param array $target_currencies
 *   Array with the target currency codes.
 *
 * @return array
 *   Array with the array(target_currency_code => rate) combination.
 */
function commerce_multicurrency_rub_exchange_rate_sync_provider_cbr($currency_code, $target_currencies) {
  $data = cache_get(__FUNCTION__, 'cache');

  if (!$data) {
    $cbr_rates = array();
    if (($xml = @simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp')) && @count($xml->Valute)) {
      foreach ($xml->Valute as $valute) {
        $rate = (float) str_replace(',', '.', (string) $valute->Value);
        $cbr_rates[(string) $valute->CharCode] = empty($rate) ? 0 : $valute->Nominal / $rate;
      }
      cache_set(__FUNCTION__, $cbr_rates, 'cache', time() + 3600);
    }
    else {
      watchdog(
        'commerce_multicurrency', 'Rate provider CBR: Unable to fetch / process the currency data of @url',
        array('@url' => 'http://www.cbr.ru/scripts/XML_daily.asp'),
        WATCHDOG_ERROR
      );
    }
  }
  else {
    $cbr_rates = $data->data;
  }

  $rates = array();
  foreach ($target_currencies as $target_currency_code) {
    if ($currency_code == 'RUB' && isset($cbr_rates[$target_currency_code])) {
      $rates[$target_currency_code] = $cbr_rates[$target_currency_code];
    }
    elseif (isset($cbr_rates[$currency_code]) && $target_currency_code == 'RUB') {
      $rates[$target_currency_code] = 1 / $cbr_rates[$currency_code];
    }
    elseif (isset($cbr_rates[$currency_code]) && isset($cbr_rates[$target_currency_code])) {
      $rates[$target_currency_code] = $cbr_rates[$target_currency_code] / $cbr_rates[$currency_code];
    }
  }

  return $rates;
}

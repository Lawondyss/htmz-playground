<?php

namespace App\Latte;

use NumberFormatter;

class LatteFilters
{

  private function __construct() {}


  public static function money(float $price): string
  {
    return NumberFormatter::create('cs_CZ', NumberFormatter::CURRENCY)->formatCurrency($price, 'CZK');
  }
}
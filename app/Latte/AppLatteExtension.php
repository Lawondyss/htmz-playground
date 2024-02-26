<?php

namespace App\Latte;

use Latte\Extension;
use function array_combine;
use function get_class_methods;

class AppLatteExtension extends Extension
{
  public function getFilters(): array
  {
    $filters = get_class_methods(LatteFilters::class);

    return array_combine(
      $filters,
      array_map(static fn(string $filter) => LatteFilters::$filter(...), $filters)
    );
  }
}
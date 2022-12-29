<?php

declare(strict_types=1);

namespace App;

class Helper {
  public static function formatDollarAmount(float $amount): string {
    $isNegative = $amount < 0;

    return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
  }
  public static function formatDate(string $date): string {
    return date('M j, Y', strtotime($date));
  }
}

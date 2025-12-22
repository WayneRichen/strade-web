<?php

namespace App\Support;

class NumberId
{
    public static function generateNumberId($userId = null): string
    {
        $date = now()->format('ymd');

        $random = '';
        for ($i = 0; $i < 4; $i++) {
            $random .= (string) random_int(0, 9);
        }

        return $date . $userId . $random;
    }
}

<?php

namespace App\Models;

class Math
{
    /**
     * Calculate the percentage per total
     * @param int $total
     * @param array $items
     * @return array
     */
    public static function calcPercentage(int $total, array $items): array
    {
        $res = [];
        foreach ($items as $key => $val) {
            $res[$key] = floor(((100 / $total) * $val) * 100) / 100;
        }
        return $res;
    }
}
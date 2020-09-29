<?php
namespace Swango\Math;
class NormalRand {
    public const M_PI_DOUBLE = M_PI * 2;
    public const SQRT_12 = 3.4641016151378;
    public static function getNormalRand(float $av, float $sd): float {
        $x = mt_rand(0, 0x7FFFFFFF) / 0x7FFFFFFF;
        $y = mt_rand(0, 0x7FFFFFFF) / 0x7FFFFFFF;
        return sqrt(-2 * log($x)) * cos(self::M_PI_DOUBLE * $y) * $sd + $av;
    }
    public static function getRandSumUsingNormalRand(int $min, int $max, int $times): int {
        $av = ($min + $max) / 2 * $times;
        $st = sqrt($times) * ($max - $min) / self::SQRT_12;
        return round(self::getNormalRand($av, $st));
    }
}
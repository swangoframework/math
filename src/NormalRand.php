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
        if ($min === $max) {
            return $min * $times;
        }
        $av = ($min + $max) / 2 * $times;
        $sd = sqrt($times) * ($max - $min) / self::SQRT_12;
        $result_min = $min * $times;
        $result_max = $max * $times;
        do {
            $result = intval(round(self::getNormalRand($av, $sd)));
        } while ($result < $result_min || $result > $result_max);
        return $result;
    }
    /**
     * Random integer with binomial distribution
     * @param float $probability (0,1)
     * @param int $times
     * @return int
     */
    public static function getAppearCountUsingNormalRand(float $probability, int $times): int {
        $av = $times * $probability; // np
        $sd = sqrt($times * $probability * (1 - $probability)); // √np(1-p)
        $result_min = 0;
        $result_max = $times;
        do {
            $result = intval(round(self::getNormalRand($av, $sd)));
        } while ($result < $result_min || $result > $result_max);
        return $result;
    }
}
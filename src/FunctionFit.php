<?php
namespace Swango\Math;
class FunctionFit {
    /**
     * Fit Linear. 线性拟合
     * y = ax + b
     * r is the Goodness(优度) of fit
     *
     * @param array ...$points
     *            (x,y)Coordinate group 坐标组
     * @return array a,b,r
     */
    public static function lineFit(array ...$point): array {
        $avgX = $avgY = $lxx = $lyy = $lxy = 0;
        $size = count($point);
        foreach ($point as [$x, $y]) {
            $avgX += $x;
            $avgY += $y;
        }
        $avgX /= $size;
        $avgY /= $size;
        foreach ($point as [$x, $y]) {
            $lxx += ($x - $avgX) * ($x - $avgX);
            $lyy += ($y - $avgY) * ($y - $avgX);
            $lxy += ($x - $avgX) * ($y - $avgY);
        }
        return [
            $lxy / $lxx,
            $avgY - $lxy * $avgX / $lxx,
            ($lxx == 0 || $lyy == 0) ? 0.0 : abs($lxy) / sqrt($lxx * $lyy)
        ];
    }
    /**
     * Fit Power Function. 幂函数拟合
     * y = ax^b
     * r is the Goodness(优度) of fit
     *
     * @param array ...$points
     *            (x,y)Coordinate group 坐标组
     * @return array a,b,r
     */
    public static function powerFit(array ...$point): array {
        $points = [];
        foreach ($point as [$x, $y])
            $points[] = [
                log($x),
                log($y)
            ];
        [
            $la,
            $lb,
            $r
        ] = self::lineFit(...$points);
        return [
            exp($lb),
            $la,
            $r
        ];
    }
}
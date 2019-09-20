<?php
namespace Math;
class FunctionFit {
    /**
     * Fit Linear.
     * y = ax + b
     * r is the Goodness of fit
     *
     * @param array ...$points
     *            (x,y)Coordinate group
     * @return array a,b,r
     */
    public static function lineFit(array ...$point): array {
        $avgX = $avgY = $lxx = $lyy = $lxy = 0;
        $size = count($point);
        foreach ($point as [
            $x,
            $y
        ]) {
            $avgX += $x;
            $avgY += $y;
        }
        $avgX /= $size;
        $avgY /= $size;
        foreach ($point as [
            $x,
            $y
        ]) {
            $lxx += ($x - $avgX) * ($x - $avgX);
            $lyy += ($y - $avgY) * ($y - $avgX);
            $lxy += ($x - $avgX) * ($y - $avgY);
        }
        return [
            round($lxy / $lxx, 6),
            round($avgY - $lxy * $avgX / $lxx, 6),
            ($lxx == 0 || $lyy == 0) ? 0.0 : round(abs($lxy) / sqrt($lxx * $lyy), 6)
        ];
    }
    /**
     * Fit Power Function.
     * y = ax^b
     * r is the Goodness of fit
     *
     * @param array ...$points
     *            (x,y)Coordinate group
     * @return array a,b,r
     */
    public static function powerFit(array ...$point): array {
        $points = [];
        foreach ($point as [
            $x,
            $y
        ])
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
            round(exp($lb), 6),
            $la,
            $r
        ];
    }
}
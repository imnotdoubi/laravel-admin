<?php
namespace App\Helpers\Web;
/**
 * Created by PhpStorm.
 * User: bigpang
 * Date: 2017/2/23
 * Time: 10:46
 */
class Base{
    /**
     * 生成缓存过期时间
     * @param int $min
     * @param int $max
     * @return int
     */
    protected static function getCacheMinutes($min = 30, $max = 60)
    {
        if (env('APP_DEBUG')) {
            return false;
        } else {
            return mt_rand($min, $max);
        }
    }

}
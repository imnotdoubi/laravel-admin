<?php

namespace App\Http\Controllers\Web;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * 生成缓存过期时间
     * @param int $min
     * @param int $max
     * @return int
     */
    protected function getCacheMinutes($min = 10, $max = 20)
    {
        if (env('APP_DEBUG')) {
            return false;
        } else {
            return mt_rand($min, $max);
        }
    }



    protected function genMsg()
    {
        $telsH   = [131, 134, 135, 136, 137, 138, 139, 147, 150, 152, 156, 170, 177, 180, 181, 186, 189];
        $name    = ['张', '王', '李', '赵', '黄', '吴', '罗', '陆', '杨', '余', '侯'];
        $ms      = ['先生', '女士'];
        $content = [
            '想要加盟,请尽快联系.',
            '加盟流程怎样的?',
            '加盟费是多少钱?',
            '有哪些扶持政策?',
            '能实地考察吗?',
        ];
        $msgs  = [];
        $start = time() - 172800;
        for ($i = 0; $i < 10; $i++) {
            $msg          = collect();
            $msg->region  = $this->getRegionName(rand(35, 394));
            $msg->date    = date('m-d h:i', rand($start, $start + 2160));
            $sex          = rand(0, 1);
            $msg->name    = $name[rand(0, count($name) - 1)] . $ms[$sex];
            $msg->avatar  = $sex ? '/web/images/portrait_girl.jpg' : '/web/images/portrait_boy.jpg';
            $msg->tel     = $telsH[rand(0, count($telsH) - 1)] . '******' . rand(10, 99);
            $msg->content = $content[rand(0, count($content) - 1)];
            $time         = date('m-d h:i', rand($start, $start + 2160));
            $msgs[]       = $msg;
            $start += 16000;
        }
        return $msgs;
    }

}

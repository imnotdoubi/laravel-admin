<?php

namespace App\Admin\Forms\Settings;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use App\Models\Setting;

class Basic extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '基本设置';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        Setting::where('id',1)->update($request->all());

        admin_success('更新成功');


        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('title', '站点标题');
        $this->text('slogan', '站点标语');
        $this->image('logo', '站点LOGO');
        $this->textarea('description', '站点描述');
        $this->text('keyword', '站点关键词');
        $this->text('copyright', '版权信息');
        $this->text('icp', '备案信息');
        $this->textarea('statistic', '网站统计代码');

        $this->clear();
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
       $sett  = Setting::first();
        return [
            'title'           => $sett->title,
            'slogan'          => $sett->slogan,
            'logo'            => $sett->logo,
            'description'     => $sett->description,
            'keyword'         => $sett->keyword,
            'copyright'       => $sett->copyright,
            'icp'             => $sett->icp,
            'statistic'       => $sett->statistic,
        ];
    }
}

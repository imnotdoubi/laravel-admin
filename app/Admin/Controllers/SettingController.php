<?php

namespace App\Admin\Controllers;

use App\Models\Setting;

use Encore\Admin\Controllers\AdminController;
use App\Admin\Forms\Settings;
use Encore\Admin\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\MultipleSteps;
use Encore\Admin\Widgets;



class SettingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '系统设置';

    public function settings(Content $content)
    {
        return $content
            ->title('基本设置')
            ->body(Widgets\Tab::forms([
                'basic'    => Settings\Basic::class,
            ]));
    }


}

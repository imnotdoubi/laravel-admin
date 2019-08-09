<?php

namespace Jxlwqq\WangEditor2;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;

class WangEditor2ServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(WangEditor2 $extension)
    {
        if (! WangEditor2::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-wang-editor2');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/wang-editor2')],
                'laravel-admin-wang-editor2'
            );
        }

        Admin::booting(function () {
            Form::extend('editor', Editor::class);
        });

    }
}

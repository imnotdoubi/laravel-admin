<?php

namespace Encore\WangEditor;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;

class WangEditorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(WangEditor $extension)
    {
        if (! WangEditor::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-wangEditor');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/wang-editor')],
                'laravel-admin-wangEditor'
            );
        }

        Admin::booting(function () {
            Form::extend('editor', Editor::class);
        });
    }
}

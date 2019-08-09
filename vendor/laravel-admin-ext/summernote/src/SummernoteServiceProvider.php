<?php

namespace Encore\Summernote;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;

class SummernoteServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Summernote $extension)
    {
        if (! Summernote::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-summernote');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/summernote')],
                'laravel-admin-summernote'
            );
        }

        Admin::booting(function () {
            $name = Summernote::config('field_name', 'summernote');
            Form::extend($name, Editor::class);
        });

        Admin::booted(function () {
            if ($lang = Summernote::config('config.lang')) {
                Admin::js("vendor/laravel-admin-ext/summernote/dist/lang/summernote-{$lang}.js");
            }
        });
    }
}
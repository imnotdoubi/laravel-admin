<?php

namespace Encore\Summernote;

use Encore\Admin\Form\Field;

class Editor extends Field
{
    protected $view = 'laravel-admin-summernote::editor';

    protected static $css = [
        'vendor/laravel-admin-ext/summernote/dist/summernote.css',
    ];

    protected static $js = [
        'vendor/laravel-admin-ext/summernote/dist/summernote.min.js',
    ];

    public function render()
    {
        $name = $this->formatName($this->column);

        $config = (array) Summernote::config('config');

        $config = json_encode(array_merge([
            'height' => 300,
        ], $config));

        $this->script = <<<EOT

$('#{$this->id}').summernote($config);

$('#{$this->id}').on("summernote.change", function (e) {
    var html = $('#{$this->id}').summernote('code');
    $('input[name="{$name}"]').val(html);
});

EOT;
        return parent::render();
    }
}

wangEditor v2 extension for laravel-admin
======

这是一个`laravel-admin`扩展，用来将`wangEditor v2`集成进`laravel-admin`的表单中

## 截图

![editor](https://user-images.githubusercontent.com/2421068/49418548-abeb3c00-f7bd-11e8-9746-14916f8d8fa4.png)
## 安装

```bash
composer require jxlwqq/wang-editor2
```

然后
```bash
php artisan vendor:publish --tag=laravel-admin-wang-editor2
```

## 配置

在`config/admin.php`文件的`extensions`，加上属于这个扩展的一些配置
```php

'extensions' => [
    'wang-editor2' => [
        // 如果要关掉这个扩展，设置为false
        'enable' => true,
        // 编辑器的配置
        'config' => [
            'uploadImgFileName' => 'upload',
            'uploadImgUrl' => '/admin/upload',
            'menus' => [
                'source',
                '|',
                'bold',
                'underline',
                'italic',
                'strikethrough',
                'eraser',
                'forecolor',
                'bgcolor',
                '|',
                'quote',
                'fontfamily',
                'fontsize',
                'head',
                'unorderlist',
                'orderlist',
                'alignleft',
                'aligncenter',
                'alignright',
                '|',
                'link',
                'unlink',
                'table',
                '|',
                'img',
                'video',
                'insertcode',
                '|',
                'undo',
                'redo',
                'fullscreen'
            ],
        ]
    ]
]

```

编辑器的配置可以到[wangEditor v2 文档](https://www.kancloud.cn/wangfupeng/wangeditor2/113961)找到。


## 使用

在form表单中使用它：
```php
$form->editor('content');
```

## License
Licensed under [The MIT License (MIT)](LICENSE).

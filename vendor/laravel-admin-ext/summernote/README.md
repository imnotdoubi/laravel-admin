Summernote editor extension for laravel-admin
======

This is a `laravel-admin` extension that integrates `Summernote` into the `laravel-admin` form.

## Screenshot

![wx20180905-132310](https://user-images.githubusercontent.com/1479100/45072743-f1d92b00-b10e-11e8-9a51-9397fa4fb24e.png)

## Installation

```bash
composer require laravel-admin-ext/summernote
```

Then
```bash
php artisan vendor:publish --tag=laravel-admin-summernote
```

## Configuration

In the `extensions` section of the `config/admin.php` file, add some configuration that belongs to this extension.
```php

    'extensions' => [

        'summernote' => [
        
            //Set to false if you want to disable this extension
            'enable' => true,
            
            // Editor configuration
            'config' => [
                
            ]
        ]
    ]

```
The configuration of the editor can be found in [Summernote Documentation](https://summernote.org/getting-started/), such as configuration language and height.
```php
    'config' => [
        'lang'   => 'zh-CN',
        'height' => 500,
    ]
```

## Usage

Use it in the form:
```php
$form->summernote('content');
```

## Donate

> Help keeping the project development going, by donating a little. Thanks in advance.

[![PayPal Me](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/zousong)

![-1](https://cloud.githubusercontent.com/assets/1479100/23287423/45c68202-fa78-11e6-8125-3e365101a313.jpg)

License
------------
Licensed under [The MIT License (MIT)](LICENSE).

# TinyMCE widget for Yii 2

This extension renders a [TinyMCE](https://www.tiny.cloud/tinymce/) widget for [Yii framework 2.0](http://www.yiiframework.com).

[![Latest Stable Version](https://img.shields.io/packagist/v/alexantr/yii2-tinymce.svg)](https://packagist.org/packages/alexantr/yii2-tinymce)
[![Total Downloads](https://img.shields.io/packagist/dt/alexantr/yii2-tinymce.svg)](https://packagist.org/packages/alexantr/yii2-tinymce)
[![License](https://img.shields.io/github/license/alexantr/yii2-tinymce.svg)](https://raw.githubusercontent.com/alexantr/yii2-tinymce/master/LICENSE)

## Installation

Install extension through [composer](http://getcomposer.org/):

```
composer require alexantr/yii2-tinymce
```

_Note:_ By default, the latest TinyMCE 5 will be installed. But you can install 4.x version manually:

```
composer require "tinymce/tinymce:^4.8"
```

## Usage

The following code in a view file would render a TinyMCE widget:

```php
<?= alexantr\tinymce\TinyMCE::widget(['name' => 'attributeName']) ?>
```

Configuring the [TinyMCE options](https://www.tiny.cloud/docs/configure/) should be done
using the `clientOptions` attribute:

```php
<?= alexantr\tinymce\TinyMCE::widget([
    'name' => 'attributeName',
    'clientOptions' => [
        'plugins' => [
            'anchor', 'charmap', 'code', 'help', 'hr',
            'image', 'link', 'lists', 'media', 'paste',
            'searchreplace', 'table',
        ],
        'height' => 500,
        'convert_urls' => false,
        'element_format' => 'html',
        // ...
    ],
]) ?>
```

If you want to use the TinyMCE widget in an ActiveForm, it can be done like this:

```php
<?= $form->field($model, 'attributeName')->widget(alexantr\tinymce\TinyMCE::className(), [
    'clientOptions' => [
        // ...
    ],
]) ?>
```

## Using presets

To avoid repeating identical configuration in every widget you can create preset in `@app/config/tinymce.php`.
Options from widget's `clientOptions` will be merged with this configuration.

Preset example:

```php
<?php
return [
    'plugins' => [
        'anchor', 'charmap', 'code', 'help', 'hr',
        'image', 'link', 'lists', 'media', 'paste',
        'searchreplace', 'table',
    ],
    'height' => 500,
    'convert_urls' => false,
    'element_format' => 'html',
    'image_caption' => true,
    'keep_styles' => false,
    'paste_block_drop' => true,
    'table_default_attributes' => new yii\web\JsExpression('{}'),
    'table_default_styles' => new yii\web\JsExpression('{}'),
    'invalid_elements' => 'acronym,font,center,nobr,strike,noembed,script,noscript',
    'extended_valid_elements' => 'strong/b,em/i,table[style]',
    // elFinder file manager https://github.com/alexantr/yii2-elfinder
    'file_picker_callback' => alexantr\elfinder\TinyMCE::getFilePickerCallback(['elfinder/tinymce']),
];
```

You can change default path with `presetPath` attribute:

```php
<?= alexantr\tinymce\TinyMCE::widget([
    'name' => 'attributeName',
    'presetPath' => '@backend/config/my-tinymce-config.php',
    'clientOptions' => [
        'height' => 1000,
    ],
]) ?>
```

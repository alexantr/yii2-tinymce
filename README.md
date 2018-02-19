# TinyMCE widget for Yii 2

This extension renders a [TinyMCE](https://www.tinymce.com/) widget for [Yii framework 2.0](http://www.yiiframework.com).

[![Latest Stable Version](https://img.shields.io/packagist/v/alexantr/yii2-tinymce.svg)](https://packagist.org/packages/alexantr/yii2-tinymce)
[![Total Downloads](https://img.shields.io/packagist/dt/alexantr/yii2-tinymce.svg)](https://packagist.org/packages/alexantr/yii2-tinymce)
[![License](https://img.shields.io/github/license/alexantr/yii2-tinymce.svg)](https://raw.githubusercontent.com/alexantr/yii2-tinymce/master/LICENSE)

## Installation

Install extension through [composer](http://getcomposer.org/):

```
composer require alexantr/yii2-tinymce
```

## Usage

The following code in a view file would render a TinyMCE widget:

```php
<?= alexantr\tinymce\TinyMCE::widget(['name' => 'attributeName']) ?>
```

Configuring the [TinyMCE options](https://www.tinymce.com/docs/configure/) should be done
using the `clientOptions` attribute:

```php
<?= alexantr\tinymce\TinyMCE::widget([
    'name' => 'attributeName',
    'clientOptions' => [
        'plugins' => ['advlist', 'anchor', 'charmap', 'image', 'hr', 'imagetools', 'link', 'lists', 'media', 'paste', 'table'],
        'height' => 500,
        'convert_urls' => false,
        'invalid_elements' => 'acronym,font,center,nobr,strike,noembed,script,noscript',
    ],
]) ?>
```

If you want to use the TinyMCE widget in an ActiveForm, it can be done like this:

```php
<?= $form->field($model, 'attributeName')->widget(alexantr\tinymce\TinyMCE::className()) ?>
```

## Using global configuration (presets)

To avoid repeating identical configuration in every widget you can set global configuration in
`@app/config/tinymce.php`. Options from widget's `clientOptions` will be merged with this configuration.

You can change default path with `presetPath` attribute:

```php
<?= alexantr\tinymce\TinyMCE::widget([
    'name' => 'attributeName',
    'presetPath' => '@backend/config/my-tinymce-config.php',
]) ?>
```

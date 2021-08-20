<?php

namespace alexantr\tinymce;

use yii\web\AssetBundle;

class TinyMCEAsset extends AssetBundle
{
    public $sourcePath = '@vendor/tinymce/tinymce';
    public $js = [
        'tinymce.min.js',
    ];
    public $publishOptions = [
        'only' => [
            '*.min.js',
            '*.min.css',
            '*.woff',
        ],
        'caseSensitive' => false,
    ];
}

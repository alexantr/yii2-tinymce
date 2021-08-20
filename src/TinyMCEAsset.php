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
            '*.css',
            '*.gif',
            '*.png',
            '*.eot',
            '*.svg',
            '*.ttf',
            '*.woff',
        ],
        'caseSensitive' => false,
    ];
}

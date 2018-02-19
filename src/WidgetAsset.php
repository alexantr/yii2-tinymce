<?php

namespace alexantr\tinymce;

use yii\web\AssetBundle;

class WidgetAsset extends AssetBundle
{
    public $sourcePath = '@alexantr/tinymce/assets';
    public $js = [
        'widget.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

<?php

namespace tests;

use alexantr\tinymce\WidgetAsset;
use yii\web\AssetBundle;

class WidgetAssetTest extends TestCase
{
    public function testRegister(): void
    {
        $view = $this->mockView();

        $this->assertEmpty($view->assetBundles);

        WidgetAsset::register($view);

        // JqueryAsset,TinyMCEAsset
        $this->assertCount(2, $view->assetBundles);

        $this->assertArrayHasKey('alexantr\\tinymce\\WidgetAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['alexantr\\tinymce\\WidgetAsset'] instanceof AssetBundle);

        $out = $view->renderFile('@tests/data/views/layout.php');

        $this->assertRegExp('%"/assets/[0-9a-z]+/widget.js"%', $out);
    }
}

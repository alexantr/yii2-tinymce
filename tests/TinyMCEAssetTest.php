<?php

namespace tests;

use alexantr\tinymce\TinyMCEAsset;
use yii\web\AssetBundle;

class TinyMCEAssetTest extends TestCase
{
    public function testRegister(): void
    {
        $view = $this->mockView();

        $this->assertEmpty($view->assetBundles);

        TinyMCEAsset::register($view);

        // TinyMCEAsset
        $this->assertCount(1, $view->assetBundles);

        $this->assertArrayHasKey('alexantr\\tinymce\\TinyMCEAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['alexantr\\tinymce\\TinyMCEAsset'] instanceof AssetBundle);

        $out = $view->renderFile('@tests/data/views/layout.php');

        $this->assertRegExp('%"/assets/[0-9a-z]+/tinymce.min.js"%', $out);
    }
}

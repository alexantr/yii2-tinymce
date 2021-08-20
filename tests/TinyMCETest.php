<?php

namespace tests;

use alexantr\tinymce\TinyMCE;
use tests\data\models\Post;
use Yii;
use yii\helpers\Json;

class TinyMCETest extends TestCase
{
    public function testRenderWithModel(): void
    {
        $view = $this->mockView();

        $out = TinyMCE::widget([
            'view' => $view,
            'model' => new Post(),
            'attribute' => 'message',
        ]);
        $expected = '<textarea id="post-message" name="Post[message]"></textarea>';

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testRenderWithNameAndValue(): void
    {
        $view = $this->mockView();

        $out = TinyMCE::widget([
            'view' => $view,
            'id' => 'test',
            'name' => 'test-editor-name',
            'value' => 'test-editor-value',
        ]);
        $expected = '<textarea id="test" name="test-editor-name">test-editor-value</textarea>';

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testRegisterHandlersAndClientOptions(): void
    {
        $view = $this->mockView();

        $widget = TinyMCE::widget([
            'view' => $view,
            'model' => new Post(),
            'attribute' => 'message',
            'clientOptions' => [
                'file_picker_callback' => '/',
            ],
        ]);

        $out = $view->renderFile('@tests/data/views/layout.php', [
            'content' => $widget,
        ]);

        $expected = 'alexantr.tinyMceWidget(\'post-message\', {"file_picker_callback":"\/"});';
        $this->assertStringContainsString($expected, $out);
    }

    public function testDefaultPresetPathWithOverride(): void
    {
        Yii::setAlias('@app/config', __DIR__ . '/data/config');

        $view = $this->mockView();

        $widget = TinyMCE::widget([
            'view' => $view,
            'model' => new Post(),
            'attribute' => 'message',
            'clientOptions' => [
                'convert_urls' => true,
            ],
        ]);

        $out = $view->renderFile('@tests/data/views/layout.php', [
            'content' => $widget,
        ]);

        $expected_options = [
            'plugins' => ['image'],
            'convert_urls' => true,
        ];
        $expected = 'alexantr.tinyMceWidget(\'post-message\', ' . Json::htmlEncode($expected_options) . ');';
        $this->assertStringContainsString($expected, $out);
    }

    public function testCustomPresetPath(): void
    {
        if (isset(Yii::$aliases['@app/config'])) {
            unset(Yii::$aliases['@app/config']);
        }

        $view = $this->mockView();

        $widget = TinyMCE::widget([
            'view' => $view,
            'model' => new Post(),
            'attribute' => 'message',
            'presetPath' => '@app/data/config/other.php',
        ]);

        $out = $view->renderFile('@tests/data/views/layout.php', [
            'content' => $widget,
        ]);

        $expected_options = [
            'plugins' => ['image', 'lists'],
            'height' => 500,
            'convert_urls' => false,
        ];
        $expected = 'alexantr.tinyMceWidget(\'post-message\', ' . Json::htmlEncode($expected_options) . ');';
        $this->assertStringContainsString($expected, $out);
    }
}

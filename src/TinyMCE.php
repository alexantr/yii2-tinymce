<?php

namespace alexantr\tinymce;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\InputWidget;

/**
 * TinyMCE input widget
 * @link https://www.tinymce.com/
 */
class TinyMCE extends InputWidget
{
    /**
     * @var string TinyMCE CDN base URL
     */
    public static $cdnBaseUrl = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.8.1/';

    /**
     * @var array TinyMCE options
     * @see https://www.tinymce.com/docs/configure/
     */
    public $clientOptions = [];
    /**
     * @var string Path to preset with TinyMCE options. Will be merged with $clientOptions.
     */
    public $presetPath = '@app/config/tinymce.php';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = ArrayHelper::merge($this->getPresetConfig(), $this->clientOptions);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $input = $this->hasModel()
            ? Html::activeTextarea($this->model, $this->attribute, $this->options)
            : Html::textarea($this->name, $this->value, $this->options);
        $this->registerPlugin();
        return $input;
    }

    /**
     * Registers script
     */
    protected function registerPlugin()
    {
        $id = $this->options['id'];

        $view = $this->getView();
        WidgetAsset::register($view);

        $cdnBaseUrl = self::$cdnBaseUrl;
        $encodedOptions = !empty($this->clientOptions) ? Json::htmlEncode($this->clientOptions) : '{}';

        $view->registerJs("alexantr.tinyMceWidget.setBaseUrl('$cdnBaseUrl');", View::POS_END);
        $view->registerJs("alexantr.tinyMceWidget.register('$id', $encodedOptions);", View::POS_END);
    }

    /**
     * Get options config from preset
     * @return array
     */
    protected function getPresetConfig()
    {
        if (!empty($this->presetPath)) {
            $configPath = Yii::getAlias($this->presetPath);
            if (is_file($configPath)) {
                $config = include $configPath;
                return is_array($config) ? $config : [];
            }
        }
        return [];
    }
}

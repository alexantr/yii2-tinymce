<?php

namespace alexantr\tinymce;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\InputWidget;

/**
 * TinyMCE input widget uses TinyMCE 5
 * @link https://www.tiny.cloud/tinymce/
 */
class TinyMCE extends InputWidget
{
    /**
     * @var array TinyMCE options
     * @see https://www.tiny.cloud/docs/configure/
     */
    public $clientOptions = [];
    /**
     * @var string Path to preset with TinyMCE options. Will be merged with $clientOptions.
     */
    public $presetPath = '@app/config/tinymce.php';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->applyPreset();
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->registerScripts();
        if ($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            return Html::textarea($this->name, $this->value, $this->options);
        }
    }

    /**
     * Registers widget scripts
     */
    protected function registerScripts()
    {
        $view = $this->getView();
        TinyMCEAsset::register($view);
        WidgetAsset::register($view);

        $id = $this->options['id'];
        $encodedOptions = !empty($this->clientOptions) ? Json::htmlEncode($this->clientOptions) : '{}';

        $view->registerJs("alexantr.tinyMceWidget('$id', $encodedOptions);", View::POS_END);
    }

    /**
     * Applies widget preset
     */
    protected function applyPreset()
    {
        if (!empty($this->presetPath)) {
            $configPath = Yii::getAlias($this->presetPath);
            if (is_file($configPath)) {
                $config = include $configPath;
                if (is_array($config)) {
                    $this->clientOptions = ArrayHelper::merge($config, $this->clientOptions);
                }
            }
        }
    }
}

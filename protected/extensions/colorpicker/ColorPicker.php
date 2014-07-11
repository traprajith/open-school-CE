<?php

/**
 * ColorPicker class file.
 *
 * The color picker widget is implemented based this jQuery plugin:
 * (see {@link https://github.com/laktek/really-simple-color-picker}).
 *
 * This widget is more useful as a textfield (the default mode)
 *
 * @author Tonin De Rosso Bolzan <admin@tonybolzan.com>
 * @package ext.colorpicker
 * @version 1.0
 */
class ColorPicker extends CInputWidget {

    public $assets = 'assets';
    public $options = array();

    public function run() {
        list($name, $id) = $this->resolveNameID();

        $this->htmlOptions['id'] = $id;
        $this->htmlOptions['name'] = $name;
        $this->htmlOptions['size'] = !isset($this->htmlOptions['size']) ? 6 : $this->htmlOptions['size'];
        $this->htmlOptions['maxlength'] = !isset($this->htmlOptions['maxlength']) ? 6 : $this->htmlOptions['maxlength'];

        $jsOptions = CJavaScript::encode($this->options);

        if ($this->hasModel()) {
            echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
        } else {
            echo CHtml::textField($name, $this->value, $this->htmlOptions);
        }

        $id = __CLASS__ . '#' . $this->htmlOptions['id'];
        $this->registerScripts($id, $jsOptions);
    }

    protected function registerScripts($id, $js) {
        $registerJs[] = YII_DEBUG ? 'jquery.colorPicker.js' : 'jquery.colorPicker.min.js';
        $registerCss[] = YII_DEBUG ? 'colorPicker.css' : 'colorPicker.min.css';

        $script[] = "$('#{$this->htmlOptions['id']}').colorPicker($js);";

        $basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->assets . DIRECTORY_SEPARATOR;
        $baseUrl = Yii::app()->assetManager->publish($basePath, false, 1, YII_DEBUG);

        $cs = Yii::app()->clientScript;

        foreach ($registerJs as $file) {
            $cs->registerScriptFile("$baseUrl/$file");
        }
        foreach ($registerCss as $file) {
            $cs->registerCssFile("$baseUrl/$file");
        }

        if (Yii::app()->request->isAjaxRequest) {
            $cs->registerScript($id, implode('', $script), CClientScript::POS_END);
        } else {
            $cs->registerCoreScript('jquery');
            $cs->registerScript($id, implode('', $script), CClientScript::POS_LOAD);
        }
    }
}
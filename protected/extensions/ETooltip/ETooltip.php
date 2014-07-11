<?php
class ETooltip extends CWidget
{
    /**
     * Tooltip options
     * 
     * @var array
     **/
    public $tooltip;
    /**
     * The selector that contains the tooltip.
     * 
     * @var sting
     **/
    public $selector;
    /**
     * The image for the tooltip background
     * 
     * @var string
     **/
    public $image = "black_arrow.png";


    private $options;
    private $init;
    private $cssFile = "tooltip.css.php";
    private $jsFiles = array("jquery.tools.min.js");
    
    private $cssPath = "css";
    private $jsPath = "js";

    private $css;
    private $js;

    private function registerScripts()
    {
        $cs = Yii::app()->clientScript;
        //Publish only one pic
        $imagesPath = dirname(__FILE__).DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR;
        $image= Yii::app()->getAssetManager()->publish($imagesPath.$this->image);
        
        if($this->css===null) {
            $cssScript  = require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.$this->cssPath.DIRECTORY_SEPARATOR.$this->cssFile);
            $this->css = $cs->registerCss($this->id."_css", $cssScript, "screen");
        }
        if($this->js===null) {
            $jsPath = dirname(__FILE__).DIRECTORY_SEPARATOR.$this->jsPath.DIRECTORY_SEPARATOR;

            if(!$cs->isScriptRegistered('jquery')) {
                $cs->registerCoreScript('jquery');
            }
            $jsAssetPath = Yii::app()->getAssetManager()->publish($jsPath);
            foreach($this->jsFiles as $file)
            {
                $cs->registerScriptFile($jsAssetPath.DIRECTORY_SEPARATOR.$file, CClientScript::POS_BEGIN);
            }
        }
    }
    public function init()
    {    
        $this->registerScripts();
        $this->options = require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'tooltip.options.php');
        $this->initTooltip();

        
        parent::init();
    }
    public function run()
    {
        if(isset($this->selector)) {
            $options = (empty($this->init)) ? '{}' : $this->init;
            $script = "var jsn = eval(".CJSON::encode($options)."); $('".$this->selector."').tooltip(jsn);";
            Yii::app()->clientScript->registerScript($this->id, $script, CClientScript::POS_READY);
        }
    }
    private function initTooltip()
    {
        $initialize = array();
        if(is_array($this->tooltip)) {
            foreach($this->tooltip as $option => $value ){
                if(in_array($option, $this->options))
                    $initialize[$option] = $value;
            }
        }
        $this->init = $initialize;
    }    
}

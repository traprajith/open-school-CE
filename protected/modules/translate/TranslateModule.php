<?php

class TranslateModule extends CWebModule
{
    /**
     * the name of the translate component
     * change this in case you dont use the default name
     * */
	 	
    static $translateComponentId='translate';
	 public $acceptedLanguages=array('en_us'=>'English',
               'vi_vn'=>'Tiếng Việt',
			   'spain'=>'Espanol',
			   'chi'=>'Chinese',
			   'arab'=>'Arabic' );
	
	/**
	 * TranslateModule::init()
	 * 
	 * @return
	 */
	public function init(){
        $this->defaultController='default';
		$this->setImport(array(
            'translate.models.*',
            'translate.controllers.*',
            'translate.components.*',
        ));
        return parent::init();
	}
    /**
     * get the translate component
     * 
     * @return MPTranslate
     */
    static function translator(){
        $component=Yii::app()->getComponent(self::$translateComponentId);
        if($component===null)
            throw new CException('Translate component must be defined');
        return $component;
    }
    static function __callStatic($method,$args){
        return call_user_func_array(array(self::getTranslateComponent(),$method),$args);
    }
    static function missingTranslation($event){
        return self::translator()->missingTranslation($event);
    }
	
    /**
     * translate some message using the module configuration
     * 
     * @param string $message
     * @param array $params
     * @return string translated message
     */
    static function t($message,$params=array()){
        $translator=self::translator();
        return Yii::t($translator::ID,$message,$params,'en','en');
    }
}
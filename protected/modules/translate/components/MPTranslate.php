<?php
class MPTranslate extends CApplicationComponent{
    /**
     * @staticvar array $messages contains the untranslated messages found
     * */
    static $messages=array();
    /**
     * @var string $defaultLanguage defaults language to use if none is set
     * */
    public $defaultLanguage=null;
    /**
     * @var $dialogOptions options of the dialog
     * */
    public $dialogOptions=array(
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    );
    /**
     * @var string $googleTranslateApiKey your google translate api key
     * set this if you wish to use googles translate service to translate the messages
     * if empty it will not use the service 
     * */
    public $googleApiKey=null;
    /**
     * @const string ID an unique key to be used in many situations 
     * */
    const ID='mp-translate';
    /**
     * @var array $acceptedLanguages contains the languages accepted by your application 
     * */
    public $acceptedLanguages=array();
    /**
     * @var boolean wheter to auto translate the missing messages found on the page
     * needs google api key to set
     * */
    public $autoTranslate=false;
    /**
     * @var boolean wheter to automatically set the language on the initialization of the component 
     * */
    public $autoSetLanguage=true;
    /**
     * @var array $_cache will contain variables
     * */
    private $_cache=array();
	/**
	 * handles the initialization parameters of the components
	 */
	function init(){
        if(empty($this->defaultLanguage))
            $this->defaultLanguage=Yii::app()->getLanguage();
        if($this->autoSetLanguage)
            $this->setLanguage($this->getLanguage());
        if(!count($this->acceptedLanguages)){
            if(($sourceLanguage=Yii::app()->sourceLanguage)!==null)
                $this->acceptedLanguages[$sourceLanguage]=$sourceLanguage;
            if(($targetLanguage=Yii::app()->getLanguage())!=null)
                $this->acceptedLanguages[$targetLanguage]=$targetLanguage;
        }
        return parent::init();
	}
    /**
     * method that handles the on missing translation event
     * 
     * @param CMissingTranslationEvent $event
     * @return string the message to translate or the translated message if option autoTranslate is set to true
     */
    function missingTranslation($event){
        Yii::import('translate.models.MessageSource');
        $attributes=array('category'=>$event->category,'message'=>$event->message);
        if(($model=MessageSource::model()->find('message=:message AND category=:category',$attributes))===null){
            $model=new MessageSource();
            $model->attributes=$attributes;
            if(!$model->save())
                return Yii::log(TranslateModule::t('Message '.$event->message.' could not be added to messageSource table'));;
        }
        if($model->id){
            if($this->autoTranslate && substr($event->language,0,2)!==substr(Yii::app()->sourceLanguage,0,2)){//&& key_exists($event->language,$this->getGoogleAcceptedLanguages($event->language))
                Yii::import('translate.models.Message');
                $translation=$this->googleTranslate($event->message,$event->language,Yii::app()->sourceLanguage);
                if($translation===false)
                    return false;
                $messageModel=new Message;
                $messageModel->attributes=array('id'=>$model->id,'language'=>$event->language,'translation'=>$translation);
                if($messageModel->save())
                    $event->message=$translation;
                else
                    return Yii::log(TranslateModule::t('Message '.$event->message.' could not be translated with auto-translate'));
            }elseif(substr($event->language,0,2)!==substr(Yii::app()->sourceLanguage,0,2) || Yii::app()->getMessages()->forceTranslation){
                self::$messages[$model->id]=array('language'=>$event->language,'message'=>$event->message,'category'=>$event->category);
            }
        }
        return $event;
    }
    /**
     * generates a link or button to the page where you translate the missing translations found in this page
     * 
     * @param string $label label of the link
     * @param string $type accepted types are : link and button
     * @return string
     */
    function translateLink($label='Translate',$type='link'){
        $form=CHtml::form(Yii::app()->getController()->createUrl('/translate/translate/index'));
        if(count(self::$messages))
            foreach(self::$messages as $index=>$message)
                foreach($message as $name=>$value)
                    $form.=CHtml::hiddenField(self::ID."-missing[$index][$name]",$value);
        if($type==='button')
            $form.=CHtml::submitButton($label);
        else
            $form.=CHtml::linkButton($label);
        $form.=CHtml::endForm();
        return $form;
    }
    function hasMessages(){
        return count(self::$messages)>0;
    }
    /**
     * generates a link or button that generates a dialog to the page where you translate the missing translations found in this page
     * 
     * @param string $label label of the link
     * @param mixed $title title of the popup
     * @param string $type accepted types are : link and button
     * @return string
     */
    function translateDialogLink($label='Translate',$title=null,$type='link'){
        return $this->ajaxDialog($label,'translate/translate/index',$title,$type,array('data'=>array(self::ID.'-missing'=>self::$messages)));
    }
    /**
     * creates a link to the page where you edit the translations
     * 
     * @param string $label
     * @param string $type accepted types are button and link
     * @return string
     */
    function editLink($label='Edit translations',$type='link'){
        $url=Yii::app()->getController()->createUrl('/translate/edit/admin');
        if($type==='button')
            return CHtml::button($label,$url);
        else
            return CHtml::link($label,$url);
    }
    /**
     * creates a link to the page where you check all missing translations
     * 
     * @param string $label
     * @param string $type accepted types are button and link
     * @return string
     */
    function missingLink($label='Missing translations',$type='link'){
        $url=Yii::app()->getController()->createUrl('/translate/edit/missing');
        if($type==='button')
            return CHtml::button($label,$url);
        else
            return CHtml::link($label,$url);
    }
    private function ajaxDialog($label,$url,$title=null,$type='link',$ajaxOptions=array()){
        
        $id=self::ID.'-dialog';
        
        $ajaxOptions=array_merge(array(
            'update'=>'#'.$id,
            'type'=>'post',
            'complete'=>"function(){ $('#{$id}').dialog('option', 'position', 'center').dialog('open');}",
        ),$ajaxOptions);
        
        $url=Yii::app()->getController()->createUrl($url);
        
        if($type==='button')
            $content=CHtml::ajaxButton($label,$url,$ajaxOptions);
        else
            $content=CHtml::ajaxLink($label,$url,$ajaxOptions);
        
        $content.=Yii::app()->getController()->widget('zii.widgets.jui.CJuiDialog',array(
            'options'=>array_merge($this->dialogOptions,array('title'=>$title)),
            'id'=>$id
        ),true);
        return $content;
    }
    /**
     * returns the language in use
     * the language is determined by many variables: session, post, get, header in this order
     * it will filter the language by using accepted languages 
     * 
     * @return string
     */
    function getLanguage(){
        $key=self::ID;
        if(($language=@$this->_cache['language'])!==null)
            return $language;
        elseif(Yii::app()->getSession()->contains($key))
            $language=Yii::app()->getSession()->get($key);
        elseif(isset($_POST[$key]) && !empty($_POST[$key]))
            $language=$_POST[$key];
        elseif(isset($_GET[$key]) && !empty($_GET[$key]))
            $language=$_GET[$key];
        else
            $language=Yii::app()->getRequest()->getPreferredLanguage();
        
        if(!key_exists($language,$this->acceptedLanguages)){
            if($language===Yii::app()->sourceLanguage)
                $language=$this->defaultLanguage;
            elseif(strpos($language,"_")!==false){
                $language=substr($language,0,2);
                if(!key_exists($language,$this->acceptedLanguages))
                    $language=$this->defaultLanguage;
            }
        }
        return $language;
    }
    /**
     * 
     * set the language that the application will use
     * if $language is null then if you use getLanguage to determine the target language 
     * 
     * it doesn't check if the language is in the accepted languages 
     * 
     * @param string | null $language language to set
     * @return string the language setted
     */
    function setLanguage($language=null){
        if($language===null)
            $language=$this->getLanguage();
        
        $this->_cache['language']=$language;
        
        Yii::app()->getSession()->add(self::ID,$language);
        Yii::app()->setLanguage($language);
        return $language;
    }
    /**
     * generates a dropdown containing all accepted languages
     * 
     * @return string
     */
    function dropdown(){
        Yii::app()->getClientScript()->registerScript(self::ID.'-dropdown','
           $("#'.self::ID.'").change(function(){
                $.post(
                    "'.Yii::app()->getController()->createUrl("/translate/translate/set").'",
                    {"'.self::ID.'":$(this).val()},
                    function(){window.top.location.reload();}
            )});
        ');
        return CHtml::dropDownList(self::ID,$this->getLanguage(),
            $this->acceptedLanguages,
            array('id'=>self::ID)
        );
    }
    /**
     * translate some message from $sourceLanguage to $targetLanguage using google translate api
     * googleApiKey must be defined to use this service
     * @param string $message to be translated
     * @param string $targetLanguage language to translate the message to, if null it will use the current language in use
     * @param mixed $sourceLanguage language that the message is written in, if null it will use the application source language
     * @return string translated message
     */
    function googleTranslate($message,$targetLanguage=null,$sourceLanguage=null) {
        if($targetLanguage===null)
            $targetLanguage=Yii::app()->getLanguage();
        if($sourceLanguage===null)
            $sourceLanguage=Yii::app()->sourceLanguage;
        if(empty($sourceLanguage))
            throw new CException(TranslateModule::t('Source language must be defined'));
        if($targetLanguage===$sourceLanguage)
            throw new CException(TranslateModule::t('targetLanguage must be different than sourceLanguage'));
        $query=$this->queryGoogle(array('q'=>$message,'source'=>$sourceLanguage,'target'=>$targetLanguage));
        if($query===false)
            return false;
        if(is_array($message)){
            foreach($query->translations as $translation)
                $translated[]=$translation->translatedText;
            return $translated;
        }
        return $query->translations[0]->translatedText;
    }
	
    /**
     * returns an array containing all languages accepted by google translate 
     * 
     * @param string $targetLanguage 
     * @return array
     */
    function getGoogleAcceptedLanguages($targetLanguage=null){
        $cacheKey=self::ID.'-cache-google-languages-'.$targetLanguage;
        if(!isset($this->_cache[$cacheKey])){
            if(($cache=Yii::app()->getCache())===null || ($languages=$cache->get($cacheKey))===false){
                $queryLanguages=$this->queryGoogle($targetLanguage!==null ? array('target'=>$targetLanguage) : array(),'languages');
                if($queryLanguages===false)
                    return false;
                foreach($queryLanguages->languages as $language){
                    $languages[$language->language]=isset($language->name) ? $language->name : $language->language;
                }
                if($cache!==null)
                    $cache->set($cacheKey,$languages);
                $this->_cache[$cacheKey]=$languages;
            }
        }else
            $languages=$this->_cache[$cacheKey];
        return $languages;
    }
    /**
     * query google translate api 
     * 
     * @param array $args
     * @param string $method the method to use, use null to translate
     * accepted values are null(translate), "languages" and "detect"
     * @return stdClass the google response object
     */
    protected function queryGoogle($args=array(),$method=null){
        if(empty($this->googleApiKey))
            throw new CException(TranslateModule::t('You must provide your google api key in option googleApiKey'));
        if($method!==null)
            $method="/{$method}";
        $url=preg_replace('/%5B\d+%5D/','',"https://www.googleapis.com/language/translate/v2{$method}?".http_build_query(array_merge($args,array('key'=>$this->googleApiKey))));

        if(in_array('curl',get_loaded_extensions())){//curl has much better performance
            $curl=curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//to speed up the query
            $trans = curl_exec($curl);
            curl_close($curl);
        }else
            $trans=file_get_contents($url);
        
        if(!$trans)
            return false;
        $trans=json_decode($trans);
        
        if(isset($trans->error)){
            Yii::log('Google translate error:'.$trans->error->code.'. '.$trans->error->message,CLogger::LEVEL_ERROR,'translate');
            return false;
        }elseif(!isset($trans->data)){
            Yii::log('Google translate error:'.print_r($trans,true),CLogger::LEVEL_ERROR,'translate');
            return false;
        }else
            return $trans->data;
    }
    /**
     * helper so you can use MPTransalate::someMethod($args) 
     * 
     * php 5.3 only
     * 
     * @param mixed $method
     * @param mixed $args
     * @return mixed
     */
    static function __callStatic($method,$args){
        return call_user_func_array(array(TranslateModule::translator(),$method),$args);
    }
}
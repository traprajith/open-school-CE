<?php
class TranslateController extends TranslateBaseController{
	public function actionIndex(){
        if(isset($_POST['Message'])){
            foreach($_POST['Message'] as $id=>$message){
                if(empty($message['translation']))
                    continue;
                $model=new Message();
                $message['id']=$id;
                $model->setAttributes($message);
                $model->save();
            }
            $this->redirect(Yii::app()->getUser()->getReturnUrl());
        }
        if(($referer=Yii::app()->getRequest()->getUrlReferrer()) && $referer!==$this->createUrl('index'))
            Yii::app()->getUser()->setReturnUrl($referer);
        $translator=TranslateModule::translator();
        $key=$translator::ID."-missing";
        if(isset($_POST[$key]))
            $postMissing=$_POST[$key];
        elseif(Yii::app()->getUser()->hasState($key))
            $postMissing=Yii::app()->getUser()->getState($key);
        
        if(count($postMissing)){
            Yii::app()->getUser()->setState($key,$postMissing); 
            $cont=0;
            foreach($postMissing as $id=>$message){
                $models[$cont]=new Message;
                $models[$cont]->setAttributes(array('id'=>$id,'language'=>$message['language']));
                $cont++;
            }
        }else{
            $this->renderText(Yii::t('app','All messages translated'));
            Yii::app()->end();
        }
        
        $data=array('messages'=>$postMissing,'models'=>$models);
        
        $this->render('index',$data);
	}
    function actionSet(){
        $translator=TranslateModule::translator();
        if(Yii::app()->getRequest()->getIsPostRequest()){
            TranslateModule::translator()->setLanguage($_POST[$translator::ID]);
            $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
        }else
            throw new CHttpException(400);
    }
    function actionGoogletranslate(){
        if(Yii::app()->getRequest()->getIsPostRequest()){
            $translation=TranslateModule::translator()->googleTranslate($_POST['message'],$_POST['language'],$_POST['sourceLanguage']);
            if(is_array($translation))
                echo CJSON::encode($translation);
            else
                echo $translation;
        }else
            throw new CHttpException(400);
    }
    
}
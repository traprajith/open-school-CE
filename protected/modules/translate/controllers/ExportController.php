<?php
class ExportController extends TranslateBaseController
{
    public function actionIndex()
    {
        //get langauage if passed
        $language	= TranslateModule::translator()->getLanguage();
        if(isset($_GET['lang']) and $_GET['lang']!=NULL)
        {
            TranslateModule::translator()->setLanguage($_GET['lang']);			//set langaue session
            $language	= $_GET['lang'];
        }                
        if(isset($_POST['export-database']))
        {            
            if(isset($_POST['lang']) and $_POST['lang']!='')
            {                
                $language   =   $_POST['lang'];
                $type       =   $_POST['type'];
                $format     =   $_POST['format'];
                
                $criteria               =   new CDbCriteria;
                $criteria->join         =   'LEFT JOIN `os_translated` `tr` ON `tr`.id= `t`.id ';
                $criteria->select       =   't.id, t.message, tr.translation, tr.language';                
                if($type==1){// all                
                    $criteria->condition    =   'tr.language=:lang OR tr.language IS NULL';
                    $criteria->params       =   array(':lang'=>$language);
                }
                else if($type==2){ //completed                
                    $criteria->condition    =   'tr.language=:lang OR tr.language IS NULL';
                    $criteria->params       =   array(':lang'=>$language);
                    $criteria->condition.=' AND `tr`.id <> NULL';
                }
                else if($type==3){//missing                
                    $criteria->condition    =   'tr.language IS NULL';                    
                }                                
                $data   = MessageSource::model()->findAll($criteria);                                                                
                /*if($format=='csv') // export as csv file
                {
                    $message_source	=	new MessageSource;
                    if(!$message_source->exportcsvdb($language,$format, $data))                        
                    $this->redirect(array('index'));
                }
                else */
                if($format=='xls')
                {
                    $message_source	=	new MessageSource;
                    if(!$message_source->exportxlsdb($language,$format, $data))                        
                    $this->redirect(array('index'));
                }
                else{
                        Yii::app()->user->setFlash('exporterror',Yii::t('app','Cannot export translation data !!'));
                        $this->redirect(array('index'));
                }                                                
            }
            else{
                    Yii::app()->user->setFlash('exporterror',Yii::t('app','Cannot export translation data !!'));
                    $this->redirect(array('index'));
            }
        }
        $this->render('index');
    }
}
?>
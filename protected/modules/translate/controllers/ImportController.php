<?php
class ImportController extends TranslateBaseController
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
        if(isset($_POST['import-translation']))
        {   
            $response	= array("status"=>"failed");
            $language   =   $_POST['lang'];
            $type       =   $_POST['type'];
            $filename	= explode(".", $_FILES['translate_file']['name']);             
            $fname		= current( $filename );
            $extension	= end( $filename );
            $data= array();
            $insert_count=0; 
            
            if($extension=="xls")
            {
                Yii::import('application.extensions.ExcelReader.*');
                require_once('excel_reader.php');     // include the class
                $path	= $_FILES['translate_file']['tmp_name'];                                
                // creates an object instance of the class, and read the excel file data
                $excel = new PhpExcelReader;
                $excel->setUTFEncoder('iconv');
                $excel->setOutputEncoding('UTF-8');
                $excel->read($path);
                $nr_sheets 	= count($excel->sheets);       // gets the number of sheets
                if($nr_sheets>0)
                {                            
                    // traverses the number of sheets and sets html table with each sheet data in $excel_data
                    $sheet	= $excel->sheets[0];				
                    $rows	= $sheet['numRows'];
                    $cols	= $sheet['numCols'];
                    if($rows>1)
                    {
                        $fields	= array();
                        $x 	= 1;
                        $y	= 1;
                        while( $y<=$cols ){
                                $fields[$y - 1]	= isset($sheet['cells'][$x][$y]) ? str_replace("\s","",$sheet['cells'][$x][$y]) : '';
                                $y++;
                        }
                        $word_index		= $this->array_search2d("Word", $fields);
                        $word_index		= ( $word_index === false )?false:( $word_index + 1 );                        
                        $translation_index	= $this->array_search2d("Translation", $fields);
                        $translation_index	= ( $translation_index === false )?false:( $translation_index + 1 );                                                                       
                        if($word_index === false or $translation_index === false){                                
                                Yii::app()->user->setFlash('importerror',Yii::t('app','Excel file must have the following fields - Word, Translation, Language'));
                                $this->redirect(array('index'));
                        }
                        else
                        {      
                                                       					
                            while($x <= $rows) 
                            {					
                                if( $word_index !== false && $translation_index!== false )
                                {
                                    $message        =   isset($sheet['cells'][$x][$word_index]) ? $sheet['cells'][$x][$word_index] : '';
                                    $translated_data    =   isset($sheet['cells'][$x][$translation_index]) ? $sheet['cells'][$x][$translation_index] : '';
                                    $model      =   MessageSource::model()->findByAttributes(array('message'=>$message));
                                    if($model!=NULL)
                                    {
                                        if($type==1){ //full replace                                        
                                            $trans_model    = Message::model()->findByAttributes(array('id'=>$model->id,'language'=>$language));
                                            if($trans_model!=NULL){
                                                $trans_model->translation   =   $translated_data;
                                                if($trans_model->save()){
                                                    $insert_count++;
                                                }
                                            }else{
                                                $trans_model            =   new Message;
                                                $trans_model->id        =   $model->id;
                                                $trans_model->language  =   $language;
                                                $trans_model->translation   =   $translated_data;
                                                if($trans_model->save()){
                                                    $insert_count++;
                                                }
                                            }
                                        }
                                        else if($type==2)
                                        { //missing translations                                        
                                            $trans_model    = Message::model()->findByAttributes(array('id'=>$model->id,'language'=>$language));
                                            if($trans_model!=NULL && ($trans_model->translation==NULL)){
                                                $trans_model->translation   =   $translated_data;
                                                if($trans_model->save()){
                                                    $insert_count++;
                                                }
                                            }
                                            if($trans_model==NULL)
                                            {
                                                $trans_model            =   new Message;
                                                $trans_model->id        =   $model->id;
                                                $trans_model->language  =   $language;
                                                $trans_model->translation   =   $translated_data;
                                                if($trans_model->save()){
                                                    $insert_count++;
                                                }
                                            }
                                        }                                        
                                    }
                                }$x++;                                                                                                                                                                                       
                            }	                                                       
                            Yii::app()->user->setFlash('import_success',$insert_count." ".Yii::t('app','rows inserted'));
                            $this->redirect(array('index'));                                
                        }
                    }                   
                }
                else
                {
                    Yii::app()->user->setFlash('importerror',Yii::t('app','Data not found in file'));
                    $this->redirect(array('index'));
                }                                
            }
            /*
            else if($extension=="csv")
            {
               
                
                $contents	= file_get_contents( $_FILES['translate_file']['tmp_name'] );	
               $datas 		= array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $contents));
                
                $start		= 0;
                if(isset($datas[$start])){
                    
                    var_dump($datas[$start]); exit;
                    
                        $word_index		= $this->array_search2d("Word", $datas[$start]);
                        $translation_index      = $this->array_search2d("Translation", $datas[$start]);
                        if($word_index === false or $translation_index === false){   
                            
                                Yii::app()->user->setFlash('importerror',Yii::t('app','Excel file must have the following fields - Word, Translation, Language'));
                                $this->redirect(array('index'));				
                        }else{                        
                                $start++;
                                while( $start < count( $datas ) )
                                {
                                        if($word_index)
                                        {
                                            $message    =   $datas[$start][$word_index];
                                            $translated_data    =   $datas[$start][$translation_index];
                                            $model      =   MessageSource::model()->findByAttributes(array('message'=>$message));
                                            if($model!=NULL)
                                            {
                                                if($type==1){ //full replace                                        
                                                    $trans_model    = Message::model()->findByAttributes(array('id'=>$model->id,'language'=>$language));
                                                    if($trans_model!=NULL){
                                                        $trans_model->translation   =   $translated_data;
                                                        if($trans_model->save()){
                                                            $insert_count++;
                                                        }
                                                    }else{
                                                        $trans_model            =   new Message;
                                                        $trans_model->id        =   $model->id;
                                                        $trans_model->language  =   $language;
                                                        $trans_model->translation   =   $translated_data;
                                                        if($trans_model->save()){
                                                            $insert_count++;
                                                        }
                                                    }
                                                }
                                                else if($type==2){ //missing translations                                        
                                                    $trans_model    = Message::model()->findByAttributes(array('id'=>$model->id,'language'=>$language));
                                                    if($trans_model!=NULL && $trans_model->translation==''){
                                                        $trans_model->translation   =   $translated_data;
                                                        if($trans_model->save()){
                                                            $insert_count++;
                                                        }
                                                    }
                                                }                                        
                                            }
                                        }                                      
                                        $start++;
                                }
                                Yii::app()->user->setFlash('import_success',$insert_count." ".Yii::t('app','rows inserted'));
                                $this->redirect(array('index'));  
                                
                        }
                }
                else{
                        Yii::app()->user->setFlash('importerror',Yii::t('app','Data not found in file'));
                        $this->redirect(array('index'));
                }
            }
             * 
             */
            else
            {
                Yii::app()->user->setFlash('importerror',Yii::t('app','Select xls file'));
                $this->redirect(array('index'));
            }
           
        }
        $this->render('index');
    }
    
     protected function array_search2d($needle, $haystack) {
		for ($i = 0, $l = count($haystack); $i < $l; ++$i) {
			if ($needle==$haystack[$i]) return $i;
		}
		return false;
	}
}
?>
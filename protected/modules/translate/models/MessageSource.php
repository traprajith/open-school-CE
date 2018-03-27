<?php
class MessageSource extends CActiveRecord{
    
    public $language;
    
    public $lang;


    static function model($className=__CLASS__){return parent::model($className);}
	function tableName(){return Yii::app()->getMessages()->sourceMessageTable;}

	function rules(){
		return array(
            array('category,message','required'),
			array('category', 'length', 'max'=>32),
			array('message', 'safe'),
			array('id, category, message,language', 'safe', 'on'=>'search'),
		);
	}
    
	function relations(){
		return array(
            'mt'=>array(self::HAS_MANY,'Message','id','joinType'=>'inner join'),
		);
	}
	function attributeLabels(){
		return array(
			'id'=> Yii::t('app','ID'),
			'category'=> Yii::t('app','Category'),
			'message'=> Yii::t('app','Message'),
		);
	}

	function search(){
		$criteria=new CDbCriteria;
        
        //$criteria->with=array('mt');
        
        $criteria->addCondition('not exists (select `id` from `'.Message::model()->tableName().'` `m` where `m`.`language`=:lang and `m`.id=`t`.`id`)');
      
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.category',$this->category);
		$criteria->compare('t.message',$this->message);
        
        $criteria->params[':lang']=$this->language;
        
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	function getTranslation(){
		$criteria=new CDbCriteria;
		$criteria->compare('language', $this->language);
		$criteria->compare('id', $this->id);
		$translation	= Message::model()->find($criteria);
		if($translation)
			return $translation->translation;
		return "";
	}
        
        public function exportcsvdb($lang, $format, $data)
        {
            $file= "Source Message.".$format;
            $filename= DocumentUploads::model()->getFileName($file);
            header('Content-Type: text/csv');
            header("Content-Disposition: attachment; filename={$filename}");  
            header('Expires: 0');  
            header('Cache-Control: no-cache'); 		              
            echo $this->set_csvdata($filename, $data, $lang);
            die();
        }
        
        public function set_csvdata($filename, $data, $lang)
        {
            $output = fopen('php://output', 'w');
            //UTF-16LE BOM
            fputs($output, chr(0xFF) . chr(0xFE));
            //set headers for csv
            $headers = array(array('Id', 'Word', 'Translation','Language'));            
            foreach ($headers as $fields) 
            {
                $out = '';
                foreach ($fields as $head => $head_data){
                    $fields[$head] = mb_convert_encoding($head_data, 'UTF-16LE', 'UTF-8');          
                }
                // UTF-16LE tab
                $out = implode(chr(0x09).chr(0x00), $fields);
                // UTF-16LE new line
                fputs($output, $out.chr(0x0A).chr(0x00));
            }
            //set data to csv
            if($data!=NULL)
            {
                $trans_data= array();
                foreach ($data as $word)
                {
                    $row[1]= $word->id;
                    $row[2]= $word->message;
                    $row[3]= $word->translation;
                    $row[4]= $word->language;
                    $trans_data[]= $row;
                }                
                foreach ($trans_data as $fields) 
                {
                    $out = '';
                    foreach ($fields as $trans_key => $trans_data){
                        $fields[$trans_key] = mb_convert_encoding($trans_data, 'UTF-16LE', 'UTF-8');          
                    }
                    // UTF-16LE tab
                    $out = implode(chr(0x09).chr(0x00), $fields);
                    // UTF-16LE new line
                    fputs($output, $out.chr(0x0A).chr(0x00));
                }                
            }                                                    
            fclose($output);
           
        }
        
        public function exportxlsdb($lang, $format, $data)
        {      
            $file= "Source Message.".$format;
            $filename= DocumentUploads::model()->getFileName($file);
            Yii::import('ext.phpexcel.XPHPExcel');    
            $objPHPExcel= XPHPExcel::createPHPExcel();
           
                // Add Heading
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A1', 'Id')
                            ->setCellValue('B1', 'Word')
                            ->setCellValue('C1', 'Translation')
                            ->setCellValue('D1', 'Language');
                if($data!=NULL)
                {
                    $i = 1; 
                    $j = 2;
                    foreach($data as $word)
                    {                           
                        $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue('A'.$j, $word->id)
                                    ->setCellValue('B'.$j, $word->message)
                                    ->setCellValue('C'.$j, $word->translation)
                                    ->setCellValue('D'.$j, $word->language);                                                    
                        $i++;
                        $j++;			
                    }
                }
                
                
                // Rename sheet
                $objPHPExcel->getActiveSheet()->setTitle('Translation Words');
                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);
                // Redirect output to a clientâ€™s web browser (Excel2007)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename='.$filename.'');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                exit;
        }
}
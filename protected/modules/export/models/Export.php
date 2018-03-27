<?php
class Export extends CFormModel
{
   	public function exportdb($format='csv', $model='Students', $attributes, $compares=NULL){
		$method	= 'export2'.$format;		//here is the method name ex: export2csv
		if(method_exists($this, $method)){
			$file	= $model;
			$filename = DocumentUploads::model()->getFileName($file);
			$almodels	= Yii::app()->controller->module->allowedModels;			
			$crmodel	= isset($almodels[$model])?$almodels[$model]:array();			
			$criteria	= new CDbCriteria;
			/*if($compares!=NULL){
				if(isset($crmodel['compare'])){
					foreach($crmodel['compare'] as $compare){
						if(isset($compares[$compare]) and $compares[$compare]!=NULL){
							$filename	.= "_".str_replace(" ", "_"$model::model()->getAttributeLabel($compare));
						}
					}
				}
			}*/
			$filename	.= ".".$format;
			//$filename = DocumentUploads::model()->getFileName($filename);
			$this->download_send_headers($filename);
			echo $this->$method($model, $attributes, $compares);
			die();
		}
		else{
			Yii::app()->user->setFlash('exporterror',Yii::t('app','You are not allowed to access this model !!'));
			return NULL;
		}
	}
	
	protected function export2csv($model, $attributes, $compares=NULL){
		$headers	= array();
		foreach($attributes as $attribute){
			$headers[]	=	$model::model()->getAttributeLabel($attribute);			
		}
		
		if(count($headers) > 0){
			$handle		= fopen("php://output", 'w');
			fputcsv($handle, $headers, ',', '"');
			
			$almodels	= Yii::app()->controller->module->allowedModels;			
			$crmodel	= isset($almodels[$model])?$almodels[$model]:array();			
			$criteria	= new CDbCriteria;
			if($compares!=NULL){
				if(isset($crmodel['compare'])){
					foreach($crmodel['compare'] as $compare){
						if(isset($compares[$compare]) and $compares[$compare]!=NULL){
							$criteria->compare('t.'.$compare, $compares[$compare]);
						}
					}
				}
			}
			
			if($model == 'Students'){
				//custom
				if(isset($compares['course_id']) and $compares['course_id']!=NULL and (!isset($compares['batch_id']) or $compares['batch_id']==NULL)){
					$criteria->join	= 'JOIN `batches` `b` ON `t`.`batch_id`=`b`.`id`';
					$criteria->compare('`b`.`course_id`', $compares['course_id']);
				}
				$criteria->compare('`t`.`is_deleted`', 0);
				$criteria->compare('`t`.`is_active`', 1);
			}
			else if($model == 'Employees'){
				$criteria->compare('`t`.`is_deleted`', 0);
			}
			$datas		= $model::model()->findAll($criteria);
			foreach($datas as $data){
				$row	= array();
				foreach($attributes as $attribute){
					$currentValue	= "";
					
					//foriegn key values if any
					$foreignKeys	= isset($almodels[$model]['foreignKeys'])?$almodels[$model]['foreignKeys']:array();
					if(array_key_exists($attribute, $foreignKeys)){
						$foreignModel	= (isset($foreignKeys[$attribute]['model']))?$foreignKeys[$attribute]['model']:NULL;
						$defaultValue	= (isset($foreignKeys[$attribute]['defaultValue']))?$foreignKeys[$attribute]['defaultValue']:'-';
						if($foreignModel!=NULL){
							$compareWith	= (isset($foreignKeys[$attribute]['compareWith']))?$foreignKeys[$attribute]['compareWith']:'id';
							$foreignData	= $foreignModel::model()->findByAttributes(array($compareWith=>$data->$attribute));
							if($foreignData!=NULL){
								$foreignAttributes	= (isset($foreignKeys[$attribute]['attributes']))?$foreignKeys[$attribute]['attributes']:NULL;
								if($foreignAttributes!=NULL){
									if(is_array($foreignAttributes)){
										$returnValue	= "";
										foreach($foreignAttributes as $fkey=>$foreignAttribute){
											if(isset($foreignData->$foreignAttribute) and $foreignData->$foreignAttribute!=NULL)
												$returnValue	.= $foreignData->$foreignAttribute;
											
											if(($fkey+1)<count($foreignAttributes))
												$returnValue	.= " ";
										}
										
										if($returnValue!="")
											$currentValue	= $returnValue;
										else
											$currentValue	= $defaultValue;
									}
									else{
										if(isset($foreignData->$foreignAttributes) and $foreignData->$foreignAttributes!=NULL)
											$currentValue	= $foreignData->$foreignAttributes;
										else
											$currentValue	= $defaultValue;
									}
								}
								else
									$currentValue	= $defaultValue;
							}
							else
								$currentValue	= $defaultValue;
						}
						else
							$currentValue	= $defaultValue;
					}
					else
						$currentValue	= $data->$attribute;
					
					//format data
					$dataFormats	= isset($almodels[$model]['dataFormats'])?$almodels[$model]['dataFormats']:array();
					if(array_key_exists($attribute, $dataFormats)){
						$currentValue	= $dataFormats[$attribute]($currentValue);
					}
					//set value to the row
					$row[]	= $currentValue;
				}
				if(implode('', $row)!=""){
					fputcsv($handle, $row, ',', '"');
				}
			}
			
			fclose($handle);
			return chr(255) . chr(254) . mb_convert_encoding(ob_get_clean(), 'UTF-16LE', 'UTF-8');
		}
		return;
	}
	
	protected function download_send_headers($filename) {
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
	
		// force download  
		//header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		//header("Content-Type: application/download");
	
		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
	}
}

?>

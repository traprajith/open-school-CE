<?php

class DocumentUploadsController extends RController
{	
	public $layout='//layouts/column2';
	
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
        
	public function actionIndex()
	{		
		$model = new DocumentUploads;
		$flag = 0;				
		$criteria = new CDbCriteria;
		
		if(isset($_REQUEST['DocumentUploads']['identifier']) and $_REQUEST['DocumentUploads']['identifier']!=NULL){
			$criteria->condition = 'identifier=:identifier';
			$criteria->params[':identifier'] = $_REQUEST['DocumentUploads']['identifier'];
			$flag = 1;
		}
		if(isset($_REQUEST['DocumentUploads']['status']) and $_REQUEST['DocumentUploads']['status']!=NULL){
			if($flag == 1){
				$criteria->condition = $criteria->condition.' AND (status=:status)';
			}
			else{
				$criteria->condition = 'status=:status';
			}
			$criteria->params[':status'] = $_REQUEST['DocumentUploads']['status'];
		}
		
		$criteria->order = 'id DESC';
				
		$total = DocumentUploads::model()->count($criteria);
		$pages = new CPagination($total);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);
		 
		$document_list = DocumentUploads::model()->findAll($criteria);
		
		Yii::app()->clientScript->scriptMap['menu.js'] = false;
		$this->render('index',array(
			'model'=>$model,
			'list'=>$document_list,
			'pages' => $pages,
			'item_count'=>$total,
			'page_size'=>Yii::app()->params['listPerPage']
		));		
	}
	
	//for approve upload file
	public function actionApprove($id)
	{
		if(Yii::app()->request->isPostRequest){
			$model = DocumentUploads::model()->findByPk($id);
			if($model!=NULL)
			{
				$model->status	= 1;
				if($model->save()){
					if($model->identifier == 6){ //In case of Student Profile Image
						$student = Students::model()->findByAttributes(array('id'=>$model->file_id));
						if($student){
							$student->saveAttributes(array('photo_file_name'=>$model->file_name));
						}
					}
					
					if($model->identifier == 4){ //In case of Employee Profile Image
						$employees = Employees::model()->findByAttributes(array('id'=>$model->file_id));
						if($employees){
							$employees->saveAttributes(array('photo_file_name'=>$model->file_name));
						}
					}
									
					if($model->model_id == 3){ //In case of Student Document 
						$doc_model	= StudentDocument::model()->findByPk($model->file_id);
						if($doc_model!=NULL){
							$doc_model->is_approved	= 1;
							$doc_model->save();
						}
					}
					
					if($model->model_id == 4){ //In case of Employee Document 
						$doc_model	= EmployeeDocument::model()->findByPk($model->file_id);
						if($doc_model!=NULL){
							$doc_model->is_approved	= 1;
							$doc_model->save();
						}
					}
					
					if($model->model_id	== 5){ //In case of file upload
						Yii::app()->getModule('downloads');
						$file_upload	= FileUploads::model()->findByPk($model->file_id);
						if($file_upload != NULL and $file_upload->placeholder == 'student'){
							FileUploads::model()->sendNotification($file_upload->id);
						}
					}
				}
				
				$this->redirect(array('index'));
			}
		}
		else{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}
	
//Disapprove
	public function actionDisapprove()
	{
		$model = DocumentUploads::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$model->scenario = 'for_reason_required';
		
		if(isset($_POST['DocumentUploads'])){
			$model->attributes	= $_POST['DocumentUploads'];
			$model->reason	   	= $_POST['DocumentUploads']['reason'];
			$model->status     	= 2;			
			if($model->save()){
				if($model->model_id == 3){ //In case of Student Document 
					$doc_model	= StudentDocument::model()->findByPk($model->file_id);
					if($doc_model!=NULL){
						$doc_model->is_approved	= -1;
						$doc_model->save();
					}
				}
				
				if($model->model_id == 4){ //In case of Employee Document 
					$doc_model	= EmployeeDocument::model()->findByPk($model->file_id);
					if($doc_model!=NULL){
						$doc_model->is_approved	= -1;
						$doc_model->save();
					}
				}
				
				//Send Message 
				$identifier = DocumentUploads::model()->getIdentifierData($model->identifier);
				$subject = Yii::t('app','Request Disapproved');
				$message = Yii::t('app','Your request for').' '.$identifier.' '.Yii::t('app','has been disapproved due to:').' '.$model->reason;
				NotificationSettings::model()->sendMessage($model->created_by,$subject,$message);
				
				echo CJSON::encode(array(
					'status'=>'success',
					'flag'=>true,				
				));
				exit;
			}
			else{
				echo CJSON::encode(array(
					'status'=>'error',
					'errors'=>CActiveForm::validate($model),
				));
				exit;    
			}
		}
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
		$this->renderPartial('disapprove',array('id'=>$_REQUEST['id'], 'model'=>$model),false,true);		
	}	
	
//Download Documents
	public function actionDownload($id)
	{
		if(Yii::app()->request->isPostRequest){
			$model = DocumentUploads::model()->findByPk($id);
			if($model){
				$path = DocumentUploads::model()->getFilePath($model->identifier, $model->file_id, $model->file_name);											
				if($path){
					$file_type = mime_content_type($path);
					$file_content = file_get_contents($path);					
					header("Content-Type: ".$file_type);
					header("Content-disposition: attachment; filename=".$model->file_name);
					header("Pragma: no-cache");
					echo $file_content;
					exit;
				}
			}
		}
		else{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}
	
//View Image In Popup
	public function actionViewImage()
	{
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
		$this->renderPartial('viewImage',array('id'=>$_REQUEST['id']),false,true);		
	}	
        
}
?>
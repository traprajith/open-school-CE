<?php

class SubjectsCommonPoolController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','addnew','addupdate','remove','displaysubjectpool'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	 public function actionAddnew() {
		 
        //$model=$this->loadModel(3);
			$model=new SubjectsCommonPool;
        // Ajax Validation enabled
        $this->performAjaxValidation($model);
        // Flag to know if we will render the form or try to add 
        // new jon.
		$flag=true;
	   	if(isset($_POST['SubjectsCommonPool']))
        {
			$flag=false;
			$model->attributes=$_POST['SubjectsCommonPool'];
			$sub_name	=	$_POST['SubjectsCommonPool']['subject_name'];
			
			$model->subject_name	=	htmlspecialchars_decode($sub_name);

			$model->save();		
			//$this->redirect(array('view','id'=>$model->id));	              
		}
		
		if($flag) 
                {
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
			$this->renderPartial('create',array('model'=>$model,'val1'=>$_GET['val1']),false,true);
		}
   }
  public function actionAddupdate(){ 
		  $flag=true;
		  
		  $this->performAjaxValidation($model);
		  if(isset($_POST['SubjectsCommonPool'])){ 
		   
				$flag=false;
				$model=SubjectsCommonPool::model()->findByPk($_REQUEST['sub_id']);								
				$model->attributes=$_POST['SubjectsCommonPool']; 
				if($model->save()){
					
					echo CJSON::encode(array('status'=>'success',));
					exit;
				}else{					
					echo CJSON::encode(array(
                        'status'=>'error',
						'errors'=>CActiveForm::validate($model),
                        ));
                 exit;    
			    }				
		 }
		if($flag){
			$model=SubjectsCommonPool::model()->findByPk($_REQUEST['sub_id']);
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
			$this->renderPartial('update',array('model'=>$model,'sub_id'=>$_GET['sub_id'],'course_id'=>$_GET['course_id']),false,true);
		}
	}
	public function actionCreate()
	{
		$model			=	new SubjectsCommonPool;
		$subjects_cp	=	new SubjectCommonpoolSplit;
		$scp_count		=	2;
		$is_new			=	1;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['SubjectsCommonPool']))
		{			
			if($_POST['SubjectsCommonPool']['id']){
				$model	=	SubjectsCommonPool::model()->findByPk($_POST['SubjectsCommonPool']['id']);
				$old_name = $model->subject_name;
				$old_code = $model->subject_code;
				
				$old_max_weekly_classes = $model->max_weekly_classes;	
				$common_cps	=	SubjectCommonpoolSplit::model()->findAllByAttributes(array('subject_id'=>$batch_subject->id));
				$old_sub_code	=array();
				$k=0;
				foreach($common_cps as $common_cp){
					
					$old_sub_code[$k]=	$common_cp->split_name; 
					$k++;
				}	 
				$scp_count		=	count($subjects_cp);
				$is_new			=	0;	
			}
			
			$model->course_id			=	$_POST['SubjectsCommonPool']['course_id'];
			$model->subject_name		=	$_POST['SubjectsCommonPool']['subject_name'];
			$model->subject_code		=	$_POST['SubjectsCommonPool']['subject_code'];
			$model->max_weekly_classes	=	$_POST['SubjectsCommonPool']['max_weekly_classes'];
			$sub1						=	htmlspecialchars_decode($_POST['SubjectsCommonPool']['subject_tilte1']);
			$sub2						=	htmlspecialchars_decode($_POST['SubjectsCommonPool']['subject_tilte2']); 
			$split	=	array('0'=>$sub1,'1'=>$sub2);
			$model->split_subject		=	$_POST['SubjectsCommonPool']['split_subject'];
			$model->subject_tilte1		=	htmlspecialchars_decode($sub1);
			$model->subject_tilte2		=	htmlspecialchars_decode($sub2);

			$model->validate();			
			if($model->save()){
				if($is_new==1){
					if($model->split_subject==1){
						for($i=0;$i<2;$i++){						
							$subjects_cp				=	new SubjectCommonpoolSplit;
							$subjects_cp->subject_id	=	$model->id;
							$subjects_cp->split_name	=	$split[$i];
							$subjects_cp->save();
						}
					}
				}else{
					
					$common_cps	=	SubjectCommonpoolSplit::model()->findAllByAttributes(array('subject_id'=>$model->id));
					if($common_cps!=NULL)
					{
						if($model->split_subject==1){
							$k=0;
							foreach($common_cps as $common_cp){
								$common_cp->split_name	=	$split[$k];
								$k++;
								$common_cp->save();
							}
						}else{
							foreach($common_cps as $common_cp){ 
								$common_cp->delete();
							}
						}
					}else{
						if($model->split_subject==1){
							for($j=0;$j<2;$j++){						
								$subjects_cp				=	new SubjectCommonpoolSplit;
								$subjects_cp->subject_id	=	$model->id;
								$subjects_cp->split_name	=	$split[$j];
								$subjects_cp->save();
							}
						}
					}
				}
				if(isset($_POST['SubjectsCommonPool']['id']) and $_POST['SubjectsCommonPool']['id']!=NULL){
				//if any change occur in the subject, reflect it to the all the non edited subjects in the batches
					if($old_sub_code[0] != $split[0] or $old_sub_code[1] != $split[1] or $old_name != $model->subject_name or $old_code != $model->subject_code or $old_max_weekly_classes != $model->max_weekly_classes){
						$batch_subjects = Subjects::model()->findAllByAttributes(array('admin_id'=>$model->id,'is_edit'=>0));	
						if($batch_subjects){ 
							foreach($batch_subjects as $batch_subject){ 
								$batch_subject->name 				= $model->subject_name;
								$batch_subject->code 				= $model->subject_code;
								$batch_subject->split_subject 		= $model->split_subject;
								$batch_subject->max_weekly_classes	= $model->max_weekly_classes;
								$batch_subject->subject_tilte1		=	htmlspecialchars_decode($sub1);
								$batch_subject->subject_tilte2		=	htmlspecialchars_decode($sub2);
								if($batch_subject->save()){		
														
										$subject_spits	=	SubjectSplit::model()->findAllByAttributes(array('subject_id'=>$batch_subject->id));
										$k=0; 	
										if($subject_spits!=NULL){ 	
											if($batch_subject->split_subject==1){
												
												foreach($subject_spits as $subject_spit){
													$subject_spit->split_name	=	$split[$k];
													$k++;
													$subject_spit->save();
												}
											}else{
												foreach($subject_spits as $subject_spit){
													$subject_spit->delete();
												}
											}
										}else{
											if($batch_subject->split_subject==1){
												for($i=0;$i<2;$i++){
													$subjects_spt				=	new SubjectSplit;
													$subjects_spt->subject_id	=	$batch_subject->id;
													$subjects_spt->split_name	=	$split[$i];
													$subjects_spt->save();
												}
											}
										}
								}
							}
						}
					}
				}else{
					if(isset($_POST['SubjectsCommonPool']['all_batches']) and $_POST['SubjectsCommonPool']['all_batches'] == 1){
						$batches = Batches::model()->findAllByAttributes(array('course_id'=>$model->course_id,'is_deleted'=>0,'is_active'=>1));
						if($batches){
							foreach($batches as $batch){
								$model_1 = new Subjects;
								$model_1->name = $model->subject_name;
								$model_1->code = $model->subject_code;
								$model_1->batch_id = $batch->id;
								$model_1->max_weekly_classes = $model->max_weekly_classes;
								$model_1->admin_id = $model->id;  
								$model_1->split_subject			=	$model->split_subject;
								$model_1->subject_tilte1		=	$model->subject_tilte1;
								$model_1->subject_tilte2		=	$model->subject_tilte2;
								if($model_1->save()){
									if($model_1->split_subject==1){
										for($i=0;$i<2;$i++){
											$subjects_spt				=	new SubjectSplit;
											$subjects_spt->subject_id	=	$model_1->id;
											$subjects_spt->split_name	=	$split[$i];
											$subjects_spt->save();
										}
									}
								}
							}
						}
					}
					
				}
				Yii::app()->user->setFlash('successMessage', Yii::t('app','Action performed successfully'));
				echo CJSON::encode(array(
				'status'=>'success',
				'flag'=>true,
				'subject_id'=>$model->id
				));
				exit;    
				
			}else{
				echo CJSON::encode(array(
				'status'=>'error',
				'errors'=>CActiveForm::validate($model),
				));
				exit;    
			}
		}
		
		$this->render('create',array(
		'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SubjectsCommonPool']))
		{
			$model->attributes=$_POST['SubjectsCommonPool'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionRemove(){
		if(Yii::app()->request->isPostRequest){
			$val = $_POST['sub_id'];
			$model=SubjectsCommonPool::model()->findByPk($val);
			if($model->delete()){
				//delete all the non edited common subjects from batches
				$batch_subjects = Subjects::model()->findAllByAttributes(array('admin_id'=>$val,'is_edit'=>0));
				if($batch_subjects){
					foreach($batch_subjects as $batch_subject){
						if($batch_subject){
							 TimetableEntries::model()->deleteAllByAttributes(array('subject_id'=>$batch_subject->id,'is_elective'=>0));
							$batch_subject->delete();
							$Exams = Exams::model()->findAllByAttributes(array('subject_id'=>$batch_subject->id));
							
							if($Exams){
								foreach($Exams as $Exam){
									if($Exam){
										$Exam->delete();
										$ExamScores = ExamScores::model()->findAllByAttributes(array('exam_id'=>$Exam->id));
										if($ExamScores){
											foreach($ExamScores as $ExamScore){
												if($ExamScore){
													$ExamScore->delete();
													
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		else
		{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SubjectsCommonPool');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SubjectsCommonPool('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SubjectsCommonPool']))
			$model->attributes=$_GET['SubjectsCommonPool'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=SubjectsCommonPool::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='subjects-common-pool-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionDisplaysubjectpool()
	{
		echo $_REQUEST['course'];exit;
		/*$criteria=new CDbCriteria;
		$criteria->condition = "is_deleted =:x AND is_active=:y AND course_id=:course_id";
		$criteria->params = array(':x'=>'0',':y'=>'1',':course_id'=>$_REQUEST['course']);				
		//$criteria->order = 'last_name ASC';
		$batches = Batches::model()->findAll($criteria);
		$batches=CHtml::listData($batches,'id','name');
 
	   echo "<option value=''>".Yii::t('app','Select Batch')."</option>";
	   foreach($batches as $value=>$batcheName)
	   echo CHtml::tag('option', array('value'=>$value),CHtml::encode($batcheName),true);*/
		
	}
}

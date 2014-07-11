<?php

class CoursesController extends RController
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
			'rights', // perform access control for CRUD operations
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
				'actions'=>array('index','view','Managecourse','ReqTest01','Edit'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','deactivate'),
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
	public function actionCreate()
	{
		$model=new Courses;
		$model_1=new Batches;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Courses']))
		{
			
			$model_1->attributes=$_POST['Batches'];
			$model->attributes=$_POST['Courses'];
			$model->validate();
			
			if($model_1->validate())
			{
				if($model->save())
				{
					
					$list = $_POST['Batches'];
					if(!$list['start_date']){
						$s_d="";
					}
					else{
						$s_d=date('Y-m-d',strtotime($list['start_date']));
					}
					if(!$list['end_date']){
						$e_d="";
					}
					else{
						$e_d=date('Y-m-d',strtotime($list['end_date']));
					}
					$model_1->course_id = Yii::app()->db->getLastInsertId();
					$model_1->start_date = $s_d;
					$model_1->end_date = $e_d;
					$model_1->save();
					$this->redirect(array('/courses'));
				}
			}
			
		}

		$this->render('create',array(
			'model'=>$model,'model_1'=>$model_1
		));
	}
	public function actionEdit() {
       // $model= Batches::model()->findByAttributes(array('id'=>$_GET['val1']));
		$model=$this->loadModel($_GET['val1']);
		//$model=new Batches;
        // Ajax Validation enabled
       $this->performAjaxValidation($model);
        // Flag to know if we will render the form or try to add 
        // new jon.
                $flag=true;
	   	if(isset($_POST['Courses']))
        {       $flag=false;
		    	$model=$this->loadModel($_GET['val1']);
				$model->attributes=$_POST['Courses'];
				$model->save();
				
              	
                }
                if($flag) {
                    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                    $this->renderPartial('update',array('model'=>$model,'val1'=>$_GET['val1']),false,true);
                }
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

		if(isset($_POST['Courses']))
		{
			$model->attributes=$_POST['Courses'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionReqTest01()
	{
		$val = $_GET['val1'];
		//echo $val;
		$this->renderPartial('batchestocourses', array('val'=>$val));
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
			$this->loadModel($id);
			//$this->is_deleted =1;
			$id = Yii::app()->request->getQuery('id');
			$model = Courses::model()->findByPk($id);
			$model->is_deleted = 1;
			$model->save(false);
 
                                

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionDeactivate($id)
	{
		
			$model = Courses::model()->findByPk($id);
			$model->is_deleted = 1; 
			if($model->save()) // Course Deleted
			{
				// Batch Deletion
				$batches = Batches::model()->findAllByAttributes(array('course_id'=>$id)); //Selecting all batches under the course with id = $id
				foreach($batches as $batch){
					
					// Student Deletion
					$students = Students::model()->findAllByAttributes(array('batch_id'=>$batch->id));
					
					foreach($students as $student){
						
						//Making student user inactive
						if($student->uid!=NULL and $student->uid!=0){
							$student_user = User::model()->findByAttributes(array('id'=>$student->uid));
							if($student_user!=NULL){

								$student_user->saveAttributes(array('status'=>'0'));
							}
						}
						
						//Making parent user inactive
						$parent = Guardians::model()->findByAttributes(array('ward_id'=>$student->id));
						if($parent->uid!=NULL and $parent->uid!=0){
							$parent_user = User::model()->findByAttributes(array('id'=>$parent->uid));
							if($parent_user!=NULL){

								$parent_user->saveAttributes(array('status'=>'0'));
							}
						}

						$student->saveAttributes(array('is_active'=>'0','is_deleted'=>'1')); // Student Deleted
						
						
					}
					
					// Subject Association Deletion
					$subjects = Subjects::model()->findAllByAttributes(array('batch_id'=>$batch->id));
					foreach($subjects as $subject){
						EmployeesSubjects::model()->DeleteAllByAttributes(array('subject_id'=>$subject->id));
						 $subject->delete();
					}
					
					
					
					// Exam Group Deletion
					
					$examgroups = ExamGroups::model()->findAllByAttributes(array('batch_id'=>$batch->id));
					
					foreach($examgroups as $examgroup){
						
						// Exams Deletion
						$exams = Exams::model()->findAllByAttributes(array('exam_group_id'=>$examgroup->id));
						foreach($exams as $exam){
							
							//Exam Score Deletion
							$examscores = ExamScores::model()->DeleteAllByAttributes(array('exam_id'=>$exam->id));
							$exam->delete(); //Exam Deleted
							
						}
						
						$examgroup->delete(); //Exam Group Deleted
						
					}
					
					//Fee Collection Deletion
					
					$collections = FinanceFeeCollections::model()->findAllByAttributes(array('batch_id'=>$batch->id));
					foreach($collections as $collection){
						
						// Finance Fees Deletion
						$student_fees = FinanceFees::model()->DeleteAllByAttributes(array('fee_collection_id'=>$collection->id)); 
								
						$collection->delete(); // Fee Collection Deleted
						
					}
					
					//Fee Category Deletion
					
					$categories = FinanceFeeCategories::model()->findAllByAttributes(array('batch_id'=>$batch->id));
					
					foreach($categories as $category){
						
						// Fee Particular Deletion	
						$particulars = FinanceFeeParticulars::model()->DeleteAllByAttributes(array('finance_fee_category_id'=>$category->id)); 
						
						
						$category->delete(); // Fee Category Deleted
					
					}
					
					//Timetable Entry Deletion
					$periods = TimetableEntries::model()->DeleteAllByAttributes(array('batch_id'=>$batch->id)); 
					
					//Class Timings Deletion
					$class_timings = ClassTimings::model()->DeleteAllByAttributes(array('batch_id'=>$batch->id)); 
					
					//Delete Weekdays
					$weekdays = Weekdays::model()->DeleteAllByAttributes(array('batch_id'=>$batch->id));
					
					$batch->is_active = 0;
					$batch->is_deleted = 1;
					$batch->employee_id = ' ';
					$batch->save(); // Batch Deleted
					
				}
				
				Yii::app()->user->setFlash('success', "Selected Profile is deleted!");
            	$this->redirect(array('managecourse'));
			}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Courses');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Courses('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Courses']))
			$model->attributes=$_GET['Courses'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionManagecourse()
	{
		

		$this->render('managecourse');
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Courses::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='courses-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

<?php

class TeacherSubjectAttendanceController extends RController
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if(Configurations::model()->teacherAttendanceMode() != 1){
			$this->render('index');
		}
		else{
			$this->redirect(array('/employees/employees/attendance', 'id'=>$_REQUEST['id']));
		}
	}	
	
	public function actionMark() { 
		if($_REQUEST['id']){ 
			$model 	=  TeacherSubjectwiseAttentance::model()->findByAttributes(array('id'=>$_REQUEST['id']));			
		}
		else{
			$model	= new TeacherSubjectwiseAttentance;	
		}
		
		if(isset($_POST['TeacherSubjectwiseAttentance'])){
			$model->attributes		= $_POST['TeacherSubjectwiseAttentance'];
			$model->reason			= $_POST['TeacherSubjectwiseAttentance']['reason'];
			$model->leavetype_id	= $_POST['TeacherSubjectwiseAttentance']['leavetype_id'];
			$model->date			= date('Y-m-d',strtotime($_POST['TeacherSubjectwiseAttentance']['date']));	
			if($model->save()){
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
		
		Yii::app()->clientScript->scriptMap	= array(
			'jquery.js'=>false,				
			'jquery.min.js'=>false					
		);						
		$this->renderPartial('mark-attendance',array('model'=>$model),false,true);		
	}
	
	public function actionView(){
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
		$this->renderPartial('view-attendance',array('id'=>$_REQUEST['id']),false,true);		
	}
	
	public function actionRemove($id, $emp, $date){
		if(Yii::app()->request->isPostRequest){			
			$entry 	= TeacherSubjectwiseAttentance::model()->findByPk($id);
			if($entry!=NULL){
				$entry->delete();
			}			
			$this->redirect(array('index', 'id'=>$emp, 'date'=>$date));
		}
		else{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}
	
	public function actionPdf(){
		$employee = Employees::model()->findByAttributes(array('id'=>$_REQUEST['emp']));
        $employee = strtolower($employee->first_name).'-subjectwise-attentance.pdf';		
        Yii::app()->osPdf->generate("application.modules.employees.views.teacherSubjectAttendance.pdf", $employee, array(), 1);
	}
}

<?php

class LogcommentController extends RController
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	public function actionCreate()
	{
		
		if(isset($_POST['LogComment']['id']) && $_POST['LogComment']['id']!= NULL)
		$comment=LogComment::model()->findByAttributes(array('id'=>$_POST['LogComment']['id']));
		else
		$comment=new LogComment;		
	
		$comment->user_id=$_POST['LogComment']['user_id'];
		$comment->user_type= 2;
		$comment->created_by=Yii::app()->user->id;
		$comment->comment=$_POST['LogComment']['comment'];
		$comment->category_id=$_POST['LogComment']['category_id'];
		//$comment->notice=$_POST['LogComment']['notice'];
		//$comment->notice_p1=$_POST['LogComment']['notice_p1'];
		//$comment->notice_p2=$_POST['LogComment']['notice_p2'];
		//$comment->visible_p=$_POST['LogComment']['visible_p'];
		//$comment->visible_t=$_POST['LogComment']['visible_t'];
		//$comment->visible_s=$_POST['LogComment']['visible_s'];
		
		
		//var_dump($_POST['LogComment']);exit;
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		$timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));
       	date_default_timezone_set($timezone->timezone);
		
		$comment->date=date('Y-m-d H:i:s');
		if($comment->validate())
		{
			$comment->save();
			$id=$comment->id;
			$arr['status']='success';
			$arr['content']=$this->renderPartial('ajax_comment_submit', array('comment'=>$comment,'id'=>$id),true,true);
			echo json_encode($arr);
			Yii::app()->end();  
		}
		else
		{
				 $error = CActiveForm::validate($comment);
                                if($error!='[]'){
									$er_array	= array();
									$er_array	= json_decode($error, true);
									
									//extra errors here
									//$er_array['test_erro'][0]	= 'testing...';
									//extra errors here
									
									$error	= json_encode(array(
									'status'=>'error',
									'error'=>$er_array,
								));
                                   	echo $error;
									
									
									
								}
                                Yii::app()->end();  
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

		if(isset($_POST['LogComment']))
		{
			$model->attributes=$_POST['LogComment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('LogComment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LogComment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LogComment']))
			$model->attributes=$_GET['LogComment'];

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
		$model=LogComment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('app','The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='log-comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionEditcomment() 
	{
		
		$model=LogComment::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$id=$_REQUEST['id'];
		
		$this->renderPartial('ajax_comment_edit', array('model1'=>$model,'id'=>$id),false,true);
		
		
		
						
		
	}
	
	
	public function actionDeletecomment() 
	{
		
		$comment=LogComment::model()->deleteAllByAttributes(array('id'=>$_REQUEST['id']));
		if($comment)
		{
			echo 'true';
		}
		else
		{
			echo 'false';
		}
		
	}
}

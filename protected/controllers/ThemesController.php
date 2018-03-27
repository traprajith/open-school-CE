<?php

class ThemesController extends Controller
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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete'),
				'users'=>array('@'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	

	public function actionCreate()
	{
		$model=new Themes;
                $model->user_id= Yii::app()->user->id;	
		if(isset($_POST['Themes']))
		{
			$model->attributes=$_POST['Themes'];
                        
			if($model->save())
				$this->redirect(array('/themes'));
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}
        
	public function actionUpdate()
	{
                
                $themes_model= Themes::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                if($themes_model)
                {
                    $id= $themes_model->id;
                }
		$model=$this->loadModel($id);
		if(isset($_POST['Themes']))
		{
			$model->attributes=$_POST['Themes'];
			if($model->save())
				$this->redirect(array('/themes'));
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$model= Themes::model()->findByPk($id);
                if($model)
                {
                    if($model->delete())
                    {
                        $this->redirect(array('/themes'));
                    }
                    else 
                        throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            
            $this->render('index');                    
	}

	
	public function loadModel($id)
	{
		$model=Themes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}

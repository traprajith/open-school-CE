<?php

class BuyProductController extends Controller
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','autocomplete','studentdetails'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array('@'),
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),*/
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
		$model=new BuyProduct;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BuyProduct']))
		{
			/*$model->attributes=$_POST['BuyProduct'];
			$model->student_id=$_POST['student_id'];
			$product=StoreProduct::model()->findByAttributes(array('id'=>$_POST['store_product']));
			if($model->issued_date)
			$currdate=$model->issued_date;
			$model->issued_date=date('Y-m-d',strtotime($model->issued_date));
			$model->product_id=$_POST['store_product'];
			$model->pr_name=$product->product_name;
			$model->pr_brand=$product->product_brand;*/
			if($model->save())
			{
			    $product->save();
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionStudentdetails()
	{
		$model=new BuyProduct;
		
		$this->render('studentdetails',array('model'=>$model));
		
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

		if(isset($_POST['BuyProduct']))
		{
			$model->attributes=$_POST['BuyProduct'];
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
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('BuyProduct');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BuyProduct('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BuyProduct']))
			$model->attributes=$_GET['BuyProduct'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionAutocomplete() 
	 {
	    if (isset($_GET['term'])) {
		$criteria=new CDbCriteria;
		$criteria->alias = "first_name";
		//$criteria->condition = "title   like '%" . $_GET['term'] . "%'";
		$criteria->condition='first_name LIKE :match';
		 $criteria->params = array(':match' => $_GET['term'].'%');
		 $userArray = Students::model()->findAll($criteria);
		
		$hotels = Students::model()->findAll($criteria);
	
		$return_array = array();
		foreach($hotels as $hotel) {
		  $return_array[] = array(
						'label'=>$hotel->last_name.' '.$hotel->first_name  ,
						'id'=>$hotel->id,
						);
		}
		echo CJSON::encode($return_array);
	  }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=BuyProduct::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='buy-product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

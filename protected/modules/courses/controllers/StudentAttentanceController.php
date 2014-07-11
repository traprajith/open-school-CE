<?php

class StudentAttentanceController extends RController
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
				'actions'=>array('index','view','Addnew','Attentancepdf','Pdf','Attentstud','Pdf1','studentattendancepdf'),
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
		$model=new StudentAttentance;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StudentAttentance']))
		{
			$model->attributes=$_POST['StudentAttentance'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['StudentAttentance']))
		{
			$model->attributes=$_POST['StudentAttentance'];
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
		
		$dataProvider=new CActiveDataProvider('StudentAttentance');
		/*$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	 public function actionStudentpdf()
    {
        
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();

        $html2pdf->WriteHTML($this->renderPartial('studpdf', array('model'=>$this->loadModel($_REQUEST['id'])), true));
        $html2pdf->Output();
 
        ////////////////////////////////////////////////////////////////////////////////////
	}
	 public function actionAssessmentpdf()
    {
        
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();

        $html2pdf->WriteHTML($this->renderPartial('assesspdf', array('model'=>$this->loadModel($_REQUEST['examid'])), true));
        $html2pdf->Output();
 
        ////////////////////////////////////////////////////////////////////////////////////
	}
	public function actionAddnew() {
                $model=new StudentAttentance;
        // Ajax Validation enabled
        $this->performAjaxValidation($model);
        // Flag to know if we will render the form or try to add 
        // new jon.
                $flag=true;
        if(isset($_POST['StudentAttentance']))
        {       $flag=false;
            $model->attributes=$_POST['StudentAttentance'];
 
            if($model->save()) {
                //Return an <option> and select it
                           // echo CHtml::tag('option',array ( 'value'=>$model->jid,'selected'=>true),CHtml::encode($model->jdescr),true);
						   //echo CHtml::tag('button', array('type'=>'submit'), '<div><div>Button</div></div>');
						   //echo CHtml::tag('td',array ('id'=>'jobDialog123'.$_GET['day'].$_GET['emp_id']),CHtml::encode('Yes'),true);
						  // echo "sssssssssssss";
						//  exit;
  								
                        }
                }
                if($flag) {
                    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                    $this->renderPartial('create',array('model'=>$model,'day'=>$_GET['day'],'month'=>$_GET['month'],'year'=>$_GET['year'],'emp_id'=>$_GET['emp_id']),false,true);
                }
        }
	public function actionEditLeave()
			 {
                $model=StudentAttentance::model()->findByAttributes(array('id'=>$_REQUEST['id']));
        // Ajax Validation enabled
        //$this->performAjaxValidation($model);
        // Flag to know if we will render the form or try to add 
        // new jon.
                $flag=true;
        if(isset($_POST['StudentAttentance']))
       {      
	    $flag=false;
            $model->attributes=$_POST['StudentAttentance'];
                  
            if($model->save()) {
              
                        }
               }
			  // var_dump($model->geterrors());
                if($flag) {
                    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				  
				   
                    $this->renderPartial('update',array('model'=>$model,'day'=>$_GET['day'],'month'=>$_GET['month'],'year'=>$_GET['year'],'emp_id'=>$_GET['emp_id']),false,true);
                }
        }
		/* Delete the marked leave
		*/
	public function actionDeleteLeave()
	{
		 $flag=true;
		$model=StudentAttentance::model()->DeleteAllByAttributes(array('id'=>$_REQUEST['id']));
		
		 if($flag) {
                   
				Yii::app()->clientScript->scriptMap['jquery.js'] = false;
				$this->renderPartial('update',array('model'=>$model,'day'=>$_GET['day'],'month'=>$_GET['month'],'year'=>$_GET['year'],'emp_id'=>$_GET['emp_id']),false,true);
					
		}			  
	
	}
	public function actionAttentancepdf()
	{
		//$this->layout='';
		//header("Content-type: image/jpeg");
		//echo $model->photo_data;
		$this->render('printpdf',array(
			'model'=>$this->loadModel($_REQUEST['id']),
		));
	}
	 public function actionPdf()
    {
		
		$batch_name = Batches::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$batch_name = $batch_name->name.' Student Attendance.pdf';
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();

        $html2pdf->WriteHTML($this->renderPartial('attentancepdf', array(), true));
        $html2pdf->Output($batch_name);
 
        ////////////////////////////////////////////////////////////////////////////////////
	}
	public function actionAttentstud()
	{
		//$this->layout='';
		//header("Content-type: image/jpeg");
		//echo $model->photo_data;
		$this->render('printpdf',array(
			'model'=>$this->loadModel($_REQUEST['id']),
		));
	}
	 public function actionPdf1()
    {
        
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();

        $html2pdf->WriteHTML($this->renderPartial('attentstud', array('model'=>StudentAttentance::model()->findByAttributes(array('student_id'=>$_REQUEST['id']))), true));
        $html2pdf->Output();
 
        ////////////////////////////////////////////////////////////////////////////////////
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StudentAttentance('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentAttentance']))
			$model->attributes=$_GET['StudentAttentance'];

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
		$model=StudentAttentance::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-attentance-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionStudentattendancepdf()
	 {
		 $data=Students::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));
		 
		 
         

	 Yii::import('application.extensions.fpdf.*');
     require('fpdf.php');$pdf = new FPDF();
     $pdf->AddPage();
     $pdf->SetFont('Arial','BU',15);
	 $pdf->Cell(75,10,'Employee Attendance Report',0,0,'C');
	 $pdf->Ln();
	 $pdf->Ln();
	 $pdf->SetFont('Arial','BU',10);
	 
	 $w= array(40,40,60);

	 $header = array('Name','Leaves','Remarks');
	 
    //Header
    for($i=0;$i<count($header);$i++)
	{
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',false);
    
	}
     $pdf->Ln();
	 $pdf->SetFont('Arial','',10);

	 $fill=false;
	 $i=40;
	 foreach($data as $data1)
	 {
	 $pdf->Cell($i,6,$data1->first_name,1,0,'L',$fill);
	 
	 $fullday=count(StudentAttentance::model()->findAllByAttributes(array('student_id'=>$data1->id)));
	 $total=$fullday;
	 
	 $pdf->Cell($i,6,$total,1,0,'C',$fill);
	 $pdf->Cell($i+20,6,'',1,0,'C',$fill);
	 
	 $pdf->Ln();
	 }
	 
     $pdf->Output();
	 Yii::app()->end();
	 }
	
}

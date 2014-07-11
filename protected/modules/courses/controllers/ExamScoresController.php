<?php

class ExamScoresController extends RController
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
				'actions'=>array('index','view','pdf'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','deleteall'),
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
		$model=new ExamScores;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ExamScores']))
		{
			
			
			$list = $_POST['ExamScores'];
			
			$count = count($list['student_id']);
			
			for($i=0;$i<$count;$i++)
			{
				if($list['marks'][$i]!=NULL or $list['remarks'][$i]!=NULL)
				{
					$exam=Exams::model()->findByAttributes(array('id'=>$_REQUEST['examid']));
					
				$model=new ExamScores;
					
				$model->exam_id = $list['exam_id']; 
				$model->student_id = $list['student_id'][$i];
				$model->marks = $list['marks'][$i];
				$model->remarks = $list['remarks'][$i];
				$model->grading_level_id = $list['grading_level_id'];
				if(($list['marks'][$i])< ($exam->minimum_marks)) 
				{
				$model->is_failed = 1;
				}
				else
				{
					$model->is_failed = '';
				}
				$model->created_at = $list['created_at'];
				$model->updated_at = $list['updated_at'];
				$model->save();
				}
			}
				$this->redirect(array('examScores/create','id'=>$_REQUEST['id'],'examid'=>$_REQUEST['examid']));
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
	public function actionUpdate($sid)
	{
		$model=$this->loadModel($sid);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ExamScores']))
		{
			$model->attributes=$_POST['ExamScores'];
			if($model->save())
				$this->redirect(array('examScores/create','id'=>$_REQUEST['id'],'examid'=>$_REQUEST['examid']));
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
		$dataProvider=new CActiveDataProvider('ExamScores');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ExamScores('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ExamScores']))
			$model->attributes=$_GET['ExamScores'];

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
		$model=ExamScores::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='exam-scores-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionDeleteall()
	{
		$delete = ExamScores::model()->findAllByAttributes(array('exam_id'=>$_REQUEST['examid']));
		foreach($delete as $delete1)
		{
			$delete1->delete();
		}
		
		
		$this->redirect(array('create','id'=>$_REQUEST['id'],'examid'=>$_REQUEST['examid']));
	}
	
	 public function actionPdf()
    { 
	   //echo $_REQUEST['id'];
	  // echo $_REQUEST['examid']; exit;
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();

        $html2pdf->WriteHTML($this->renderPartial('printpdf',array('model'=>ExamScores::model()->findByAttributes(array('exam_id'=>$_REQUEST['examid']))), true)); 
        $html2pdf->Output();
 
        ////////////////////////////////////////////////////////////////////////////////////
	}
	 
	// public function actionPdf()
	// {
//		 $college=Configurations::model()->findByPk(1);
//		 $logo=Logo::model()->findAll();
//         $data = ExamScores::model()->findAllByAttributes(array('exam_id'=>$_REQUEST['examid']));
//
//	 Yii::import('application.extensions.fpdf.*');
//     require('fpdf.php');$pdf = new FPDF();
//	 
//	 
//     $pdf->AddPage();
//     $pdf->SetFont('Arial','B',15);
//	 $pdf->SetTextColor(0,0,0);
//	 $pdf->SetFillColor(250,100,100);
//	 //$pdf->Image(Yii::app()->baseUrl.'/uploadedfiles/',0,0,100,20);
//	 $pdf->Cell(180,5,$college->config_value,0,0,'C');
//	 $pdf->Cell(180,5,$logo->photo_file_name,0,0,'C');
//	
//	 $pdf->Ln();
//	 $college=Configurations::model()->findByPk(2);
//	 $pdf->SetFont('Arial','B',8);
//	 $pdf->Cell(180,5,$college->config_value,0,0,'C');
//	 $pdf->Ln();
//	 $pdf->SetFont('Arial','BU',15);
//	 $pdf->Cell(20,10,'Exam Scores',0,0,'C');
//	 $pdf->Ln();
//	 $pdf->Ln();
//	 $pdf->SetFont('Arial','BU',10);
//	 
//	 $w= array(40,40,60,40);
//
//	 $header = array('Name','Score','Remarks','Result');
//	  $pdf->SetTextColor(255,255,255);
//    //Header
//    for($i=0;$i<count($header);$i++)
//	{
//        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
//    
//	}
//    $pdf->Ln();
//	$pdf->SetTextColor(0,0,0);
//	$pdf->SetFont('Arial','',10);
//
//	 $fill=false;
//	 $i=40;
//	 foreach($data as $data1)
//	 {
//	 $pdf->Cell($i,6,Students::model()->findByAttributes(array('id'=>$data1->student_id))->first_name,1,0,'L',$fill);
//	 
//	 $pdf->Cell($i,6,$data1->marks,1,0,'C',$fill);
//	 $pdf->Cell($i+20,6,$data1->remarks,1,0,'C',$fill);
//	 if($data1->is_failed=='1')
//	 {
//		 $pdf->Cell($i,6,'Failed',1,0,'C',$fill);
//	 }
//	 else
//	 {
//		 $pdf->Cell($i,6,'Passed',1,0,'C',$fill);
//	 }
//	 $pdf->Ln();
//	 }
//	 
//     $pdf->Output();
//	 Yii::app()->end();
//	 }
	 
	
}

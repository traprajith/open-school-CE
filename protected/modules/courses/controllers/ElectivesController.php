<?php
/**
 * Ajax Crud Administration
 * ElectivesController *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 * @license The MIT License
 */

class ElectivesController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

public function   init() {
             $this->registerAssets();
              parent::init();
 }

  private function registerAssets(){

            Yii::app()->clientScript->registerCoreScript('jquery');

         //IMPORTANT about Fancybox.You can use the newest 2.0 version or the old one
        //If you use the new one,as below,you can use it for free only for your personal non-commercial site.For more info see
		//If you decide to switch back to fancybox 1 you must do a search and replace in index view file for "beforeClose" and replace with 
		//"onClosed"
        // http://fancyapps.com/fancybox/#license
          // FancyBox2
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js_plugins/fancybox2/jquery.fancybox.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/js_plugins/fancybox2/jquery.fancybox.css', 'screen');
         // FancyBox
         //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/fancybox/jquery.fancybox-1.3.4.js', CClientScript::POS_HEAD);
         // Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/fancybox/jquery.fancybox-1.3.4.css','screen');
        //JQueryUI (for delete confirmation  dialog)
         Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/jqui1812/js/jquery-ui-1.8.12.custom.min.js', CClientScript::POS_HEAD);
         Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/jqui1812/css/dark-hive/jquery-ui-1.8.12.custom.css','screen');
          ///JSON2JS
         Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/json2/json2.js');
       

           //jqueryform js
               Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/jquery.form.js', CClientScript::POS_HEAD);
              Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/form_ajax_binding.js', CClientScript::POS_HEAD);
              Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/client_val_form.css','screen');

 }


	/**
	 * @return array action filters
	 */

     /**
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	 */
        
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('returnView'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('ajax_create','ajax_update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','returnForm','ajax_delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Electives::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='electives-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

        //AJAX CRUD

         public function actionReturnView(){

               //don't reload these scripts or they will mess up the page
                //yiiactiveform.js still needs to be loaded that's why we don't use
                // Yii::app()->clientScript->scriptMap['*.js'] = false;
                $cs=Yii::app()->clientScript;
                $cs->scriptMap=array(
                                                 'jquery.min.js'=>false,
                                                 'jquery.js'=>false,
                                                 'jquery.fancybox-1.3.4.js'=>false,
                                                 'jquery.fancybox.js'=>false,
                                                 'jquery-ui-1.8.12.custom.min.js'=>false,
                                                 'json2.js'=>false,
                                                 'jquery.form.js'=>false,
                                                'form_ajax_binding.js'=>false
        );

        $model=$this->loadModel($_POST['id']);
        $this->renderPartial('view',array('model'=>$model),false, true);
      }

             public function actionReturnForm(){

              //Figure out if we are updating a Model or creating a new one.
             if(isset($_POST['update_id']))$model= $this->loadModel($_POST['update_id']);else $model=new Electives;
            //  Comment out the following line if you want to perform ajax validation instead of client validation.
            //  You should also set  'enableAjaxValidation'=>true and
            //  comment  'enableClientValidation'=>true  in CActiveForm instantiation ( _ajax_form  file).


             //$this->performAjaxValidation($model);

               //don't reload these scripts or they will mess up the page
                //yiiactiveform.js still needs to be loaded that's why we don't use
                // Yii::app()->clientScript->scriptMap['*.js'] = false;
                $cs=Yii::app()->clientScript;
                $cs->scriptMap=array(
                                                 'jquery.min.js'=>false,
                                                 'jquery.js'=>false,
                                                 'jquery.fancybox-1.3.4.js'=>false,
                                                 'jquery.fancybox.js'=>false,
                                                 'jquery-ui-1.8.12.custom.min.js'=>false,
                                                 'json2.js'=>false,
                                                 'jquery.form.js'=>false,
                                                 'form_ajax_binding.js'=>false
        );


         if(isset($_POST['batch_id']) and $_POST['batch_id']==0)
		{
			$this->renderPartial('_ajax_form', array('model'=>$model,'batch_id'=>$_POST['batch_id']), false, true);
		}
		else
		{
        	$this->renderPartial('_ajax_form', array('model'=>$model), false, true);
		}
      }

        	public function actionIndex(){

			$model=new Electives('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['id']))
		$model->batch_id=$_GET['id'];
		$this->render('index',array('model'=>$model));
		
	}


        public function actionAjax_Update(){
		if(isset($_POST['Electives']))
		{
			
           $model=$this->loadModel($_POST['update_id']);
			$model->attributes=$_POST['Electives'];
			if( $model->save(false)){
                         echo json_encode(array('success'=>true));
		             }else
                     echo json_encode(array('success'=>false));
                }

}


  public function actionAjax_Create(){

               if(isset($_POST['Electives']))
		{
                       $model=new Electives;
                      //set the submitted values
                        $model->attributes=$_POST['Electives'];
                       //return the JSON result to provide feedback.
			            if($model->save(false)){
                                echo json_encode(array('success'=>true,'id'=>$model->primaryKey) );
                                exit;
                        } else
                        {
                            echo json_encode(array('success'=>false));
                            exit;
                        }
		}
  }

     public function actionAjax_delete(){
		 
                 $id=$_POST['id'];				
				 EmployeeElectiveSubjects::model()->deleteAllByAttributes(array('elective_id'=>$id));
				  TimetableEntries::model()->deleteAllByAttributes(array('subject_id'=>$id,'is_elective'=>2));
				// @@ StudentElectives::model()->deleteAllByAttributes(array('elective_id'=>$id));
				
				//$timetable = TimetableEntries::model()->deleteAllByAttributes(array('subject_id'=>$subject->id));
                 $deleted=$this->loadModel($id);
				 $ele_gup_id	=	$deleted->elective_group_id;
				if ($deleted->delete() ){
					
					//meenu 
					$student_electives	=	StudentElectives::model()->findAllByAttributes(array('elective_id'=>$id));
					if($student_electives!=NULL){						
						$k=0;
						foreach($student_electives as $student_elective){
							
							$stud_id[$k]	=	$student_elective->student_id;
							$k++;
							$e_gup		=	$student_elective->elective_group_id;
							$student_elective->delete();
						}
						if(isset($e_gup) and $e_gup!=NULL)
						
							$Subject	=	Subjects::model()->findByAttributes(array('elective_group_id'=>$e_gup));
						if($Subject !=NULL)
						{
							$Exams		=	Exams::model()->findAllByAttributes(array('subject_id'=>$Subject->id));
							
							$i=0;
							foreach($Exams as $Exam)
							{
								$exm_id[$i]		=	$Exam->id;
								$i++;
							}
							if($exm_id!=NULL)
							{//student_id
								$criteria= new CDbCriteria();
								$criteria->addInCondition('exam_id',$exm_id);
								$criteria->addInCondition('student_id',$stud_id);
								ExamScores::model()->deleteAll($criteria);		
						
							}
						}	
						 
					}
					
					
					
					echo json_encode (array('success'=>true));
					exit;
				
				}
				else{
                  echo json_encode (array('success'=>false));
                  exit;
               }
      }
	public function actionElectivename()
	{
		
		if(isset($_POST['elective_group_id']))
		{
			
			$data=Electives::model()->findAll('elective_group_id=:x',array(':x'=>$_POST['elective_group_id']));
		}
		echo CHtml::tag('option', array('value' => 0), CHtml::encode(Yii::t('app','Select')), true);
		$data=CHtml::listData($data,'id','name');
		  foreach($data as $value=>$title)
		  {
			  echo CHtml::tag('option',
						 array('value'=>$value),CHtml::encode($title),true);
		  }
	}

}

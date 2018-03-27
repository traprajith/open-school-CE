<?php
/**
 * Ajax Crud Administration
 * SubjectController *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 * @license The MIT License
 */

class SubjectController extends RController
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
		$model=Subjects::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='subjects-form')
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
             if(isset($_POST['update_id']))$model= $this->loadModel($_POST['update_id']);
			 else $model=new Subjects;
			 
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

		$model=new Subjects('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['id']))
			$model->batch_id=$_GET['id'];
			$model->elective_group_id=0;
		$this->render('index',array('model'=>$model));
		
	}


        public function actionAjax_Update(){
		if(isset($_POST['Subjects']))
		{
           $model=$this->loadModel($_POST['update_id']);
		   $old_name = $model->name;
		   $old_code = $model->code;
		   $old_max_weekly_classes = $model->max_weekly_classes;
			$model->attributes=$_POST['Subjects'];
			$sub1						=	$_POST['Subjects']['subject_tilte1'];
			$sub2						=	$_POST['Subjects']['subject_tilte2']; 
			$split	=	array('0'=>$sub1,'1'=>$sub2); 
			$model->split_subject		=	$_POST['Subjects']['split_subject'];
			$model->no_exams = 0;
				$subjects_cps	=	SubjectSplit::model()->findAllByAttributes(array('subject_id'=>$model->id));
				$old_sub_code	=array();
				$k=0;
				foreach($subjects_cps as $subjects_cp){
					
					$old_sub_code[$k]=	$subjects_cp->split_name; 
					$k++;
				}
			//$model->elective_group_id = 0;
			$this->performAjaxValidation($model);
			/*$data=SubjectName::model()->findByAttributes(array('id'=>$model->name));
						if($data!=NULL)
						{
							$model->name=$data->name;
							$model->code=$data->code;
							
						}*/
				if( $model->save(false)){
					//check whether any change occur in the common subjects
					if($model->admin_id!=0 and ($old_sub_code[0] != $split[0] or $old_sub_code[1] != $split[1] or $old_name != $model->name or $old_code != $model->code or $old_max_weekly_classes != $model->max_weekly_classes)){
						$model->saveAttributes(array('is_edit'=>1));
					}
					$subject_spits	=	SubjectSplit::model()->findAllByAttributes(array('subject_id'=>$model->id));
					$k=0;
					if($subject_spits!=NULL){
						if($model->split_subject==1){
							foreach($subject_spits as $subject_spit){
								$subject_spit->split_name	=	$split[$k];
								$subject_spit->save();
								$k++;
							}
						}else{
							foreach($subject_spits as $subject_spit){
								$subject_spit->delete();
							}
						}
					}else{
						if($model->split_subject==1){
							for($i=0;$i<2;$i++){
								$subjects_spt				=	new SubjectSplit;
								$subjects_spt->subject_id	=	$model->id;
								$subjects_spt->split_name	=	$split[$i];
								$subjects_spt->save();
							}
						}
					}
					echo json_encode(array('success'=>true));
				}else
						
                     echo json_encode(array('success'=>false));
                }

}


  public function actionAjax_Create(){

         if(isset($_POST['Subjects']))
		{
		   $model=new Subjects;
		   
		  //set the submitted values
			$model->attributes=$_POST['Subjects']; 
			$sub1						=	$_POST['Subjects']['subject_tilte1'];
			$sub2						=	$_POST['Subjects']['subject_tilte2'];
			$split	=	array('0'=>$sub1,'1'=>$sub2); 
			$model->split_subject		=	$_POST['Subjects']['split_subject'];
			$model->no_exams = 0;
			$model->elective_group_id = 0;
		   //return the JSON result to provide feedback.
		   $this->performAjaxValidation($model);
			if($model->save(false)){
				if($model->split_subject==1){
					for($i=0;$i<2;$i++){
						$subjects_spt				=	new SubjectSplit;
						$subjects_spt->subject_id	=	$model->id;
						$subjects_spt->split_name	=	$split[$i];
						$subjects_spt->save();
					}
				}
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
				
                 $deleted=$this->loadModel($id);
                if ($deleted->delete() ){
               echo json_encode (array('success'=>true,'msg'=>deleted));
               exit;
                }else{
                  echo json_encode (array('success'=>false));
                  exit;
                           }
      }


}

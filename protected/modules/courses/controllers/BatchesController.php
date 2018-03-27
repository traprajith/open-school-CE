<?php

class BatchesController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';


	public function   init() {
             //$this->registerAssets();
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
				'actions'=>array('index','view','manage','Batchstudents','Addnew','settings','Addupdate','remove','promote','deactivate','activate','elective','studentelectives','Removeelective','generateRoll'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update,actionname'),
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
	       public function actionAssignteacher(){

              //Figure out if we are updating a Model or creating a new one.
             if(isset($_POST['batch_id']))
			 {
			 	$model= $this->loadModel($_POST['batch_id']);
				$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
				if($settings!=NULL)
				{	
					$model->start_date=date($settings->displaydate,strtotime($model->start_date));
					$model->end_date=date($settings->displaydate,strtotime($model->end_date));							
				}				
			 }			 
			 else 
			 {
				$model=new Batches;
			 }
			 
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
	 
	  public function actionAjax_Update(){
		if(isset($_POST['Batches']))
		{
           $model=$this->loadModel($_POST['update_id']);
			$model->attributes=$_POST['Batches'];
			$model->start_date=date('Y-m-d',strtotime($model->start_date));
			$model->end_date=date('Y-m-d',strtotime($model->end_date));
			
			/*$data=SubjectName::model()->findByAttributes(array('id'=>$model->name));
						if($data!=NULL)
						{
							$model->name=$data->name;
							$model->code=$data->code;
							
						}*/
			if( $model->save(false)){
                         echo json_encode(array('success'=>true));
		             }else
                     echo json_encode(array('success'=>false));
                }

	}


  		public function actionAjax_Create(){

       if(isset($_POST['Batches']))
		{
                       $model=new Batches;
					   
                      //set the submitted values
                        $model->attributes=$_POST['Batches'];
						
						/*$data=SubjectName::model()->findByAttributes(array('id'=>$model->name));
						if($data!=NULL)
						{
							$model->name=$data->name;
							$model->code=$data->code;
							
						}*/
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
		$model=new Batches;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);		
		$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
		if(Yii::app()->user->year)
		{
                    $year = Yii::app()->user->year;
		}
		else
		{
                    $year = $current_academic_yr->config_value;
		}
		
		if(isset($_POST['Batches']))
		{	
					$old_timetable_format	= $model->timetable_format;
					
                    $model->attributes=$_POST['Batches'];
					
										
                    //check semester enabled for course
                    $sem_enabled= Configurations::model()->isSemesterEnabledForCourse($model->course_id);
                    if($sem_enabled==1){
                        $model->setScenario('sem_enabled');
                    }
			
			$configuration = Configurations::model()->findByAttributes(array('id'=>41));
			$course = Courses::model()->findbyAttributes(array('id'=>$model->course_id));
		
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
			$model->start_date  =   $s_d;
			$model->end_date    =   $e_d;
                        $sem_enabled= Configurations::model()->isSemesterEnabledForCourse($model->course_id);
                        if($sem_enabled==1){
                            $model->semester_id =   $list['semester_id'];
                        }
                        else{
                            $model->semester_id =  NULL;
                        }
			$model->academic_yr_id	= $course->academic_yr_id;			
			if($model->save()){ 
			$batch_id = $model->id;									
				
		//In case of non duplicate feature
				if(!isset($_POST['Batches']['duplicate']) or (isset($_POST['Batches']['duplicate']) and $_POST['Batches']['duplicate'] == 0)){ 
										
					//Add common subject
					$common_subjects = SubjectsCommonPool::model()->findAllByAttributes(array('course_id'=>$model->course_id));
					if($common_subjects){
						foreach($common_subjects as $common_subject){
							$model_2 = new Subjects;
							$model_2->name = $common_subject->subject_name;
							$model_2->code = $common_subject->subject_code;
							$model_2->batch_id = $model->id;
							$model_2->max_weekly_classes = $common_subject->max_weekly_classes;
							$model_2->admin_id = $common_subject->id;
							if($model_2->save())
							{
								//duplicate commen subject
								$all_comsubjects_splits = SubjectCommonpoolSplit::model()->findAllByAttributes(array('subject_id'=>$common_subject->id));
								foreach($all_comsubjects_splits as $all_comsubjects_split){
									$new_comsubjects_split 				= 	new SubjectCommonpoolSplit;
									$new_comsubjects_split->subject_id  =	$model_2->id;
									$new_comsubjects_split->split_name  =	$all_comsubjects_split->split_name;
									$new_comsubjects_split->save();
									
								}
							}
						}
					}
				}
				
		//In case of duplicate batch 
		if(isset($_POST['Batches']['duplicate']) and $_POST['Batches']['duplicate'] == 1){					
			$duplicate_batch_details = Batches::model()->findByAttributes(array('id'=>$_POST['Batches']['batch_list']));
			if($model->employee_id == NULL and $duplicate_batch_details->employee_id !=NULL){
				$model->saveAttributes(array('employee_id'=>$duplicate_batch_details->employee_id));
			}
			
			//duplicate batch
			
			if($_POST['Batches']['subject']==1 or $_POST['Batches']['all']==1){	//duplicate subject					
					$all_subjects = Subjects::model()->findAllByAttributes(array('batch_id'=>$_POST['Batches']['batch_list'],'elective_group_id'=>0,'is_deleted'=>0));
					if($all_subjects){
						$normal_subject=array();
						foreach($all_subjects as $all_subject){
							//Duplicate Subjects details
							$new_sub_entry = new Subjects;
							$new_sub_entry->attributes = $all_subject->attributes;
							$new_sub_entry->batch_id = $model->id;
							$new_sub_entry->no_exams = 0;
							$new_sub_entry->created_at = date('Y-m-d H:i:s');
							$new_sub_entry->updated_at = NULL;
							$new_sub_entry->admin_id = $all_subject->admin_id;
							$new_sub_entry->is_edit = $all_subject->is_edit;
							if($new_sub_entry->save()){	
								//duplicate split subject
								
								$all_subjects_splits = SubjectSplit::model()->findAllByAttributes(array('subject_id'=>$all_subject->id));
								foreach($all_subjects_splits as $all_subjects_split){
									$new_subjects_split 			= 	new SubjectSplit;
									$new_subjects_split->subject_id =	$new_sub_entry->id;
									$new_subjects_split->split_name =	$all_subjects_split->split_name;
									$new_subjects_split->save();
									
								}
								$normal_subject[$all_subject->id] =	$new_sub_entry->id;	
								if($_POST['Batches']['subject_ass']==1 or $_POST['Batches']['all']==1){	//duplicate  Subject Association						
									//Duplicate subject association details								
									$sub_associations = EmployeesSubjects::model()->findAllByAttributes(array('subject_id'=>$all_subject->id));
									if($sub_associations){
										foreach($sub_associations as $sub_association){
											$new_sub_association = new EmployeesSubjects;
											$new_sub_association->employee_id = $sub_association->employee_id;
											$new_sub_association->subject_id = $new_sub_entry->id;
											$new_sub_association->save();
										}
									}
								}
							}
						}
					}						
			}
			//subject end
			if($_POST['Batches']['electives']==1 or $_POST['Batches']['all']==1){	//duplicate electives subject							
				$all_elective_groups = ElectiveGroups::model()->findAllByAttributes(array('batch_id'=>$_POST['Batches']['batch_list'],'is_deleted'=>0));						
				if($all_elective_groups){
					$elective_subject=array();
					foreach($all_elective_groups as $all_elective_group){
						//Add elective group to elective group table
						$new_elective_group = new ElectiveGroups;
						$new_elective_group->attributes = $all_elective_group->attributes;								
						$new_elective_group->batch_id = $model->id;
						$new_elective_group->max_weekly_classes = 1;//This field is not in the elective group table. To aviod validation  given in this model 
						$new_elective_group->created_at = date('Y-m-d H:i:s');
						$new_elective_group->updated_at = NULL;									
						
						if($new_elective_group->save()){
							//Add elective group to subject table
							$sub_elective_group = Subjects::model()->findByAttributes(array('elective_group_id'=>$all_elective_group->id,'is_deleted'=>0,'batch_id'=>$_POST['Batches']['batch_list']));
							if($sub_elective_group){
								$new_sub_elective_group = new Subjects;
								$new_sub_elective_group->attributes = $sub_elective_group->attributes;
								$new_sub_elective_group->batch_id = $model->id;
								$new_sub_elective_group->elective_group_id = $new_elective_group->id;
								$new_sub_elective_group->created_at = date('Y-m-d H:i:s');
								$new_sub_elective_group->updated_at = NULL;
								$new_sub_elective_group->save();
							}
							
							//Add Electives
						
							$electives = Electives::model()->findAllByAttributes(array('elective_group_id'=>$all_elective_group->id,'batch_id'=>$_POST['Batches']['batch_list'],'is_deleted'=>0));
							if($electives){
								foreach($electives as $elective){
									$new_elective = new Electives;
									$new_elective->attributes = $elective->attributes;
									$new_elective->elective_group_id = $new_elective_group->id;
									$new_elective->batch_id = $model->id;
									$new_elective->created_at = date('Y-m-d H:i:s');
									$new_elective->updated_at = NULL;
								
									if($new_elective->save()){ 
										$elective_subject[$elective->id] =	$new_elective->id;
										if($_POST['Batches']['subject_ass']==1 or $_POST['Batches']['all']==1){	//duplicate Elective Subject Association	
											//Elective subject Association
											$elective_sub_associations = EmployeeElectiveSubjects::model()->findAllByAttributes(array('elective_id'=>$elective->id,'subject_id'=>$sub_elective_group->id));
											if($elective_sub_associations){
												foreach($elective_sub_associations as $elective_sub_association){
													$new_elective_sub_association = new EmployeeElectiveSubjects;
													$new_elective_sub_association->employee_id = $elective_sub_association->employee_id;
													$new_elective_sub_association->elective_id = $new_elective->id;
													$new_elective_sub_association->subject_id = $new_sub_elective_group->id;
													$new_elective_sub_association->save();
												}
											}
										}
									}else{
										var_dump($new_elective->getErros());exit;
									}
								}
							}
						}
					}
				}						
			}
		//endbatch duplication
		}
				
				echo CJSON::encode(array(
                        'status'=>'success',						
						'batchid'=>$model->id
                        ));
                 exit;    
  								
            }
			else
			{				
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
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		if($settings!=NULL){	
			$date1=date($settings->displaydate,strtotime($model->start_date));
			$date2=date($settings->displaydate,strtotime($model->end_date));
		}
		$model->start_date=$date1;
		$model->end_date=$date2;
		
		if(isset($_POST['Batches'])){
			$model->attributes=$_POST['Batches'];		
			$model->start_date=date('Y-m-d', strtotime($model->start_date)); 
			$model->end_date=date('Y-m-d', strtotime($model->end_date)); 
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionManage() 
	{                                    
		 
		 $this->render('manage'); 
	}
	public function actionBatchstudents()
	{                                    
		 
		 $this->render('batchstudents'); 
	}
	public function actionStudentelectives() 
	{                                    
		 $this->render('studentelectives'); 
	}
	
	public function actionAcademicbatches()
	{
		if(isset($_POST['year']))
		{
			$data = Batches::model()->findAll('academic_yr_id=:x AND is_deleted=:y AND id<>:z AND is_active=1',array(':x'=>$_POST['year'],':y'=>0,':z'=>$_POST['id']));
		}
		
		echo CHtml::tag('option', array('value' => 0), CHtml::encode(Yii::t('app','Select').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")), true);
		$data=CHtml::listData($data,'id','coursename');
		foreach($data as $value=>$title)
		{
			echo CHtml::tag('option',array('value'=>$value),CHtml::encode($title),true);
		}
	}
        
        public function actionCourses()
        {
             echo CHtml::tag('option', array('value' => ''), CHtml::encode(Yii::t('app','Select')), true);
            if(isset($_POST['year']) and $_POST['year']!=NULL){
                    $criteria	= new CDbCriteria;
                    $criteria->distinct		= true;
                   // $criteria->join			= 'JOIN `batches` `b` ON `b`.`course_id`=`t`.`id`';
                    $criteria->condition            = '`t`.`academic_yr_id`=:year AND `t`.`is_deleted`=:is_deleted';
                    $criteria->params		= array(':year'=>$_POST['year'], ':is_deleted'=>0);
                    $criteria->order		= '`t`.`course_name` ASC';
                    $data	= Courses::model()->findAll($criteria);
                   
                    $data		= CHtml::listData($data, 'id', 'course_name');		
                    foreach($data as $value=>$name){
                        echo CHtml::tag('option', array('value'=>$value), CHtml::encode(html_entity_decode($name)),true);
                    }
            }		
        }
       
        
        public function actionSemesters()
        {
            $sem_status=0;
            $semesters      = CHtml::tag('option', array('value' => ''), CHtml::encode(Yii::t('app','Select')), true);
            $batches        = CHtml::tag('option', array('value' => ''), CHtml::encode(Yii::t('app','Select')), true);
            if(isset($_REQUEST['course_id']) and $_REQUEST['course_id']!=NULL and isset($_REQUEST['year']) and $_REQUEST['year']!=NULL)
            {     
                $criteria=new CDbCriteria;
                $criteria->join= 'JOIN semester_courses `sc` ON t.id = `sc`.semester_id';
                $criteria->condition='`sc`.course_id =:course_id';
                $criteria->params=array(':course_id'=>$_REQUEST['course_id']);
                $data	= Semester::model()->findAll($criteria);			
                $data	= CHtml::listData($data, 'id', 'name');		
                foreach($data as $value=>$name){
                        $semesters .= CHtml::tag('option', array('value'=>$value), CHtml::encode(html_entity_decode($name)),true);
                }

                $criteria=new CDbCriteria;
               // $criteria->join= 'JOIN semester_courses `sc` ON t.id = `sc`.semester_id';
                $criteria->condition='course_id =:course_id AND is_deleted=0 AND is_active=1';
                $criteria->params=array(':course_id'=>$_REQUEST['course_id']);               
                $criteria->addCondition('semester_id IS NULL');                
                $data	= Batches::model()->findAll($criteria);
                $data	= CHtml::listData($data, 'id', 'name');		
                foreach($data as $value=>$name){
                        $batches	.= CHtml::tag('option', array('value'=>$value), CHtml::encode(html_entity_decode($name)),true);
                }
                
                $sem_enabled= Configurations::model()->isSemesterEnabledForCourse($_REQUEST['course_id']);
                if($sem_enabled==1){
                    $sem_status=1;
                }
            }

            echo CJSON::encode(array('status'=>'success', 'semester'=>$semesters, 'batch'=>$batches,'sem_status'=>$sem_status));
            Yii::app()->end();
        }
        
        public function actionBatches()
	{
		if(isset($_POST['semester_id']) && $_POST['semester_id']!=NULL)
		{
                    $year= $_POST['year'];
                    $course_id= $_POST['course_id'];
                    $data = Batches::model()->findAll('academic_yr_id=:x AND is_deleted=:y AND is_active=1 AND semester_id=:sem_id AND course_id=:course_id',array(':x'=>$_POST['year'],':y'=>0,':sem_id'=>$_POST['semester_id'],':course_id'=>$course_id));				
                    echo CHtml::tag('option', array('value' => 0), CHtml::encode(Yii::t('app','Select')), true);
                    $data=CHtml::listData($data,'id','coursename');
                    foreach($data as $value=>$title)
                    {
                            echo CHtml::tag('option',array('value'=>$value),CHtml::encode($title),true);
                    }
                }
                else if(isset($_POST['semester_id']) && $_POST['semester_id']=='')
                {
                    echo CHtml::tag('option', array('value' => 0), CHtml::encode(Yii::t('app','Select')), true);
                    $criteria=new CDbCriteria;
                    // $criteria->join= 'JOIN semester_courses `sc` ON t.id = `sc`.semester_id';
                     $criteria->condition='course_id =:course_id AND is_deleted=0 AND is_active=1 AND academic_yr_id=:year';
                     $criteria->params=array(':course_id'=>$_POST['course_id'],':year'=>$_POST['year']);
                     $criteria->addCondition('semester_id IS NULL');
                     $data	= Batches::model()->findAll($criteria);
                     $data	= CHtml::listData($data, 'id', 'name');		
                     foreach($data as $value=>$name){
                             echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
                     }
                }
	}

        public function actionActionname()
	{
		$actions = PromoteOptions::model()->findAll(array('condition'=>'option_value <> "In Progress"'));
		$options = CHtml::listData($actions,'option_value','option_name');
		//echo CHtml::dropDownList('action', '', $options,array('prompt'=>Yii::t('app','Select'))); 
		echo CHtml::tag('option', array('value' => 0), CHtml::encode(Yii::t('app','Select Action')), true);
		foreach($options as $value=>$title)
		{
			echo CHtml::tag('option',array('value'=>$value),CHtml::encode($title),true);
		}
	}
	
	public function actionPromote() 
	{
		$err_flag = 0;
		if(isset($_POST['promote'])){
                    
                   
			$err_msg = Yii::t('app','Please fix the following input errors:').'<br/>';
			if(isset($_POST['sid'])){
				if($_POST['action']==NULL){
					$err_flag 	= 1;
					$err_msg 	= $err_msg.'- '.Yii::t('app','Select an action').'<br/>'; 
				}
				else if($_POST['action']!=2){                                     
					if($_POST['year']==NULL){
						$err_flag 	= 1;
						$err_msg 	= $err_msg.'- '.Yii::t('app','Select an academic year').'<br/>'; 
					}
                                        if($_POST['course_id']==''){
						$err_flag 	= 1;
						$err_msg 	= $err_msg.'- '.Yii::t('app','Select a Course').'<br/>'; 
					}                                        
					if($_POST['batch_id']==NULL or $_POST['batch_id']==0){
						$err_flag 	= 1;
						$err_msg 	= $err_msg.'- '.Yii::t('app','Select a batch').'<br/>';  
					}
				}
				
				//check for error
				if($err_flag == 0){
					$premot_succes	=	0;
					foreach($_POST['sid'] as $sid){
						$Student	= Students::model()->findByAttributes(array('id'=>$sid));
						$old_bid	=	$Student->batch_id;
						if($Student){
							$batch_student 			= BatchStudents::model()->findByAttributes(array('student_id'=>$Student->id,'batch_id'=>$Student->batch_id));
							if($batch_student){		// if already there is an entry in batch_studetns, change the status to 0
								$batch_student->status			= 0;
								$batch_student->result_status 	= $_POST['action'];
								$batch_student->save();
							}
													
							if($_POST['action'] == 2){	// make as an alumni
								$Student->saveAttributes(array('batch_id'=>0));
							}
							else{	// not an alumni, move the student to new bacth with status 1								
								$already_exists				= BatchStudents::model()->findByAttributes(array('student_id'=>$Student->id,'batch_id'=>$_POST['batch_id']));
								if($already_exists){
									$already_exists->result_status 	= 0;
									$already_exists->status 		= 1;
									if($already_exists->save()){									
										$Student->saveAttributes(array('batch_id'=>$already_exists->batch_id));	//set new batch_id in students table
										$premot_succes	=	1;
										$new_batch_id	=	$already_exists->batch_id;
									}
								}
								else{
									$new_batch 					= new BatchStudents;
									$new_batch->student_id 		= $Student->id;
									$new_batch->batch_id 		= $_POST['batch_id'];
									$new_batch->academic_yr_id 	= $_POST['year'];
									$new_batch->status 			= 1;
									if($new_batch->save()){				
										$Student->saveAttributes(array('batch_id'=>$new_batch->batch_id));	//set new batch_id in students table
										$premot_succes	=	1;
										$new_batch_id	=	$new_batch->batch_id;
									}
								}
							}
						}
						//elective assign
						if(isset($_POST['elective_premote']) and $_POST['elective_premote'] == 1){
							if($premot_succes	==	1){
								$elective_std	=	StudentElectives::model()->findByAttributes(array('student_id'=>$sid,'batch_id'=>$old_bid));
								if(isset($elective_std->elective_id) and  $elective_std->elective_id!=NULL)
									$elective		=	Electives::model()->findByAttributes(array('id'=>$elective_std->elective_id));
								if(isset($elective->name) and  $elective->name!=NULL)
									$elective_new	=	Electives::model()->findByAttributes(array('name'=>$elective->name,'batch_id'=>$new_batch_id));
								if(isset($elective_new->id) and $elective_new->id!=NULL){
									$alreday_ex		=	StudentElectives::model()->findByAttributes(array('elective_id'=>$elective_new->id,'student_id'=>$sid,'batch_id'=>$new_batch_id));
									
									
									if(!isset($alreday_ex) or $alreday_ex == NULL){
										$new_std_elective						=	new StudentElectives;
										$new_std_elective->student_id			=	$sid;
										$new_std_elective->batch_id				=	$new_batch_id;
										$new_std_elective->elective_id			=	$elective_new->id;
										$new_std_elective->elective_group_id	=	$elective_new->elective_group_id;
										$new_std_elective->status				=	1;
										$new_std_elective->created				=	date('Y-m-d H:i:s');
										$new_std_elective->save();
									}
								}
							}
						}
					} 
					
					Yii::app()->user->setFlash('success',Yii::t('app','Action performed successfully'));	
					$this->redirect(array('promote', 'id' =>$_REQUEST['id']));	
				}
			}
			else{
				$err_flag = 1;	
				if($_POST['action']==NULL or $_POST['action']==0){					
					$err_msg = $err_msg.'- '.Yii::t('app','Select an action').'<br/>';					
				}
				elseif($_POST['action'] != 2){
					if($_POST['year']==NULL or $_POST['year']==0){
						$err_msg 	= $err_msg.'- '.Yii::t('app','Select an academic year').'<br/>';
					}
                                        if($_POST['course_id']==''){
						$err_flag 	= 1;
						$err_msg 	= $err_msg.'- '.Yii::t('app','Select a Course').'<br/>'; 
					}  
					if($_POST['batch_id']==NULL or $_POST['batch_id']==0){					
						$err_msg 	= $err_msg.'- '.Yii::t('app','Select a batch').'<br/>';					
					}	
				}
				$err_msg = $err_msg.'- '.Yii::t('app','Select at least one student').'<br/>';
			}
			if($err_flag==1){
				Yii::app()->user->setFlash('errorMessage',$err_msg);
			} 
		}
		$this->render('promote'); 
	}

	public function actionElective() 
	{
		if(isset($_POST['elective']))
		{
		
			if(isset($_POST['sid']))
        	 {
				
				  if(isset($_POST['elective_id']) and $_POST['elective_id']!=NULL)
					{ 
					  foreach($_POST['sid'] as $sid)
				 		{
							
							$Student=Students::model()->findByAttributes(array('id'=>$sid));
							
							$student_elective = StudentElectives::model()->findByAttributes(array('student_id'=>$sid,'elective_group_id'=>$_POST['elective_group_id']));
							if($_POST['elective_id']!=NULL and $_POST['elective_id']!=0)
							{
								
								// new record
								if($student_elective==NULL)
								{
									$electives  = new StudentElectives;
									$electives->student_id = $sid;
									$electives->batch_id = $_REQUEST['id'];
									$electives->elective_id = $_POST['elective_id'];
									$electives->elective_group_id = $_POST['elective_group_id'];
									$electives->status = 1;
									$electives->created = date('Y-m-d h:i:s');
									$electives->save();
									Yii::app()->user->setFlash('success',Yii::t('app','Elective added to the student'));
							
								}
								else
								{
								
									Yii::app()->user->setFlash('error',Yii::t('app','Elective is already assigned'));
									$this->redirect(array('elective', 'id' =>$_REQUEST['id']));
								}
							}
							else
							{
								Yii::app()->user->setFlash('error',Yii::t('app','Select  a subject'));
								$this->redirect(array('elective', 'id' =>$_REQUEST['id']));
							}
						}
						
					 
					 $this->redirect(array('elective', 'id' =>$_REQUEST['id']));
					 }
					 else
					 {
						 Yii::app()->user->setFlash('bid',Yii::t('app','Select a Subject!'));
             			$this->redirect(array('elective', 'id' =>$_REQUEST['id']));
			 		  }
				 
				 }
				 else
				 {
					 if(isset($_POST['elective_id']) and $_POST['elective_id']!=NULL)
					 {
						 Yii::app()->user->setFlash('sid',Yii::t('app','Select atleast one student!'));
					 }
					 else
					 {
			
						 Yii::app()->user->setFlash('sid', Yii::t('app','* Select atleast one student!'));
						 Yii::app()->user->setFlash('bid', Yii::t('app','* Select a subject!'));
					 }
             		$this->redirect(array('elective', 'id' =>$_REQUEST['id']));
			 
		 	}
		}
		 $this->render('elective'); 
	}
	public function actionSettings() 
	{                                    
		 
		 $this->render('settings'); 
	}
	
	public function actionDeactivate() 
	{  
	
	     $model=Batches::model()->findByPk($_REQUEST['id']);   
		 $model->saveAttributes(array('is_active'=>'0'));                               
		 
		 $this->redirect(array('courses/deactivatedbatches'));
	}
	public function actionActivate() 
	{  	
	     $model=Batches::model()->findByPk($_REQUEST['id']);   
		 if($model->saveAttributes(array('is_active'=>'1'))){
		 	Yii::app()->user->setFlash('successMessage', Yii::t('app','Action performed successfully'));
		 }		 
		 $this->redirect(array('/courses/courses/deactivatedbatches'));
	}
	public function actionRemoveelective() 
	{
		if(Yii::app()->request->isPostRequest){
			$student_elective	= StudentElectives::model()->findByPk($_REQUEST['eid']);
			if($student_elective){			
				$student_id			= $student_elective->student_id;
				$elective_group_id	= $student_elective->elective_group_id;
				$student_elective->delete();			
				//find subject with elective_group_id as $elective_group_id
				$subject		= Subjects::model()->findByAttributes(array('elective_group_id'=>$elective_group_id));
				if($subject){
					//get all exams related to this $subject->id
					$exams			= Exams::model()->findAllByAttributes(array('subject_id'=>$subject->id));
					if(count($exams)>0){					
						$exams		= CHtml::listData($exams, 'id', 'id');
						$criteria	= new CDbCriteria;
						$criteria->compare('student_id', $student_id);
						$criteria->addInCondition('exam_id', $exams);
						//get exam scores for this $exam->id and $student_id
						$exam_scores	= ExamScores::model()->findAll($criteria);
						if(count($exam_scores)>0){
							//setup a warning flash message if there is examscores added for this student
							Yii::app()->user->setFlash('warning', Yii::t("app", "You have to remove exam scores for this student if needed !"));
						}
					}
				}			
			}
			else{
				Yii::app()->user->setFlash('warning', Yii::t("app", "Such a relation not found !"));
			}
			$this->redirect(array('studentelectives', 'id' =>$_REQUEST['id']));
			}
	else
		{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}
	public function actionAddnew() {
        //$model=$this->loadModel(3);
                $model=new Batches;                
                //check semester enabled for course
                $sem_enabled= Configurations::model()->isSemesterEnabledForCourse($_GET['val1']);
                if($sem_enabled==1){
                    $model->setScenario('sem_enabled');
                }
                $level = Configurations::model()->findByPk(41);  
        // Ajax Validation enabled
        $this->performAjaxValidation($model);
        // Flag to know if we will render the form or try to add 
        // new jon.
		$flag=true;
	   	if(isset($_POST['Submit']))
        {
			 										 
			$flag=false;
			$model->attributes=$_POST['Batches'];
			
			if($level->config_value == -1)
			 {
				
				 $course = Courses::model()->findbyAttributes(array('id'=>$_GET['val1']));
				 $value = $course->exam_format;
			 }
			$model->start_date=date('Y-m-d', strtotime($model->start_date)); 
			$model->end_date=date('Y-m-d', strtotime($model->end_date)); 
			$model->academic_yr_id=Yii::app()->user->year;
			$model->exam_format=$value;
			$model->save();	
					if($model->save() and $model->exam_format == 2){ echo 'aa';exit;
							$subject = new Subjects;
							$subject->name = 'Drawing';
							$subject->batch_id = $model->id;
							$subject->save();
							if($subject->save()){
								$subject = new Subjects;
								$subject->name = 'GK';
								$subject->batch_id = $model->id;
								$subject->save();
							}
					}
		}
		if($flag) {
				Yii::app()->clientScript->scriptMap=array(
					'jquery.js'=>false,
					'jquery.min.js' => false,
				);
			//Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			$this->renderPartial('create',array('model'=>$model,'val1'=>$_GET['val1']),false,true);
		}
   }
    public function actionAddupdate()
    { 
        $flag=true;		  
        $this->performAjaxValidation($model);
        if(isset($_POST['Batches']))
        {   
            $flag=false;
            $model=Batches::model()->findByPk($_GET['val1']);				
			
			$old_timetable_format	= $model->timetable_format;
			
            $model->attributes=$_POST['Batches'];
			
			if(Configurations::model()->timetableConfig()!=-2){ // timetable format is not selected as batch level
				$model->timetable_format	= $old_timetable_format;
			}
					
			//check semester enabled for course
			$sem_enabled= Configurations::model()->isSemesterEnabledForCourse($model->course_id);
			if($sem_enabled==1){
				$model->setScenario('sem_enabled');
			}

            if($_POST['Batches']['exam_format'] == null)
            {
                $configuration = Configurations::model()->findByAttributes(array('id'=>41));
                if($configuration->config_value == 1)
                {
                        $model->exam_format=1;
                }
                if($configuration->config_value == 2)
                {
                        $model->exam_format=2;
                }

            }						
            $model->start_date=date('Y-m-d', strtotime($model->start_date)); 
            $model->end_date=date('Y-m-d', strtotime($model->end_date)); 
            $sem_enabled= Configurations::model()->isSemesterEnabledForCourse($model->course_id);
            if($sem_enabled==1){
                $model->semester_id =   $_POST['Batches']['semester_id'];
            }
            

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
        if($flag)
        {
            $model=Batches::model()->findByPk($_GET['val1']);
            $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
            if($settings!=NULL)
            {	
                    $date1=date($settings->displaydate,strtotime($model->start_date));
                    $date2=date($settings->displaydate,strtotime($model->end_date));
            }
            $model->start_date=$date1;
            $model->end_date=$date2;

            $sem_enabled= Configurations::model()->isSemesterEnabledForCourse($_GET['course_id']);
            if($sem_enabled==1){
                $model->setScenario('sem_enabled');
            }
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            $this->renderPartial('update',array('model'=>$model,'val1'=>$_GET['val1'],'course_id'=>$_GET['course_id']),false,true);
        }
    }
    public function actionRemove(){
	   if(Yii::app()->request->isPostRequest){
		    if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){ //Remove option fro deactivted batch list
				$val	= $_REQUEST['id'];
			}
			else{ //Remove option from batch list
				$val 	= $_POST['val1'];
			}
			
			$model				= Batches::model()->findByPk($val);
			$model->is_active 	= 0;
			$model->is_deleted 	= 1;
			$model->employee_id = ' ';
			if($model->save()){
				// Student Deletion
				$students = Students::model()->findAllByAttributes(array('batch_id'=>$model->id));
				if($students){
					foreach($students as $student){													
						$student->saveAttributes(array('batch_id'=>NULL));			
					}
				}
				
				//Remove batch - student relation
				$batch_students = BatchStudents::model()->findAllByAttributes(array('batch_id'=>$model->id));
				if($batch_students){
					foreach($batch_students as $batch_student){
						$batch_student->delete();
					}
				}
				
				// Subject Association Deletion
				$subjects = Subjects::model()->findAllByAttributes(array('batch_id'=>$model->id));
				foreach($subjects as $subject){
					EmployeesSubjects::model()->DeleteAllByAttributes(array('subject_id'=>$subject->id));
					$subject->delete();
				}
				
				// elective Subject Association Deletion
				$electives = Electives::model()->findAllByAttributes(array('batch_id'=>$model->id));
				foreach($electives as $elective){
					EmployeeElectiveSubjects::model()->DeleteAllByAttributes(array('subject_id'=>$elective->id));
					$elective->delete();
				}
				
				Yii::app()->user->setFlash('successMessage', Yii::t('app','Action performed successfully'));			
			}		
			if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){ //Remove option fro deactivted batch list
				$this->redirect(array('/courses/courses/deactivatedbatches'));
			}
			else{
				echo $val;
			}
		}
		else{
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
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Batches');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Batches('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Batches']))
			$model->attributes=$_GET['Batches'];

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
		$model=Batches::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='batches-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionWaitinglist()
	{
		
		$this->render('waitinglist');
	}
	
	public function actionExamStatusView()
	{
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
		$this->renderPartial('exam_status_view',array('id'=>$_REQUEST['id'], 'batch_id'=>$_REQUEST['batch_id']),false,true);		
	}
	public function actionGenerateRoll()
	{
		$bid =	$_GET['bid'];
		$posts=Yii::app()->getModule('students')->studentsOfBatch($bid);
		if($posts!=NULL){
			$i=1;
			foreach($posts as $posts_1){
				
				$this_batch = BatchStudents::model()->findByAttributes(array('student_id'=>$posts_1->id,'batch_id'=>$bid));
				$this_batch->roll_no = $i;
				if($this_batch->save()){
					$i++;
				}	
				
			}
		}
		$this->redirect(array('batchstudents', 'id' =>$bid));
	}
        
        //student list for add students from another batch to selected batch
        public function actionAddStudents()
	{	
                if(Yii::app()->user->year)
		{
                    $year = Yii::app()->user->year;
		}
		else
		{
                    $current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
                    $year = $current_academic_yr->config_value;
		}
		 
		$model=new Students;
		$criteria = new CDbCriteria;
		$criteria->join         =   'JOIN batch_students bs ON bs.student_id=t.id'; 
		$criteria->condition    =   't.is_deleted=:is_del AND t.is_active=1 AND bs.batch_id<>:cbatch ';   
		$criteria->addCondition(new CDbExpression("not exists (select * from batch_students t2 where t2.student_id = t.id and t2.batch_id = :cbatch and bs.result_status=0)"));
		$criteria->params       =   array(':is_del'=>0, ':cbatch'=>$_REQUEST['id']);
                $criteria->distinct=true;
				    
		if(isset($_REQUEST['val']))
		{
                    $criteria->condition=$criteria->condition.' and '.'(t.first_name LIKE :match or t.last_name LIKE :match or t.middle_name LIKE :match)';		 
                    $criteria->params[':match'] = $_REQUEST['val'].'%';
		}
		
		if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL)
		{
		if((substr_count( $_REQUEST['name'],' '))==0)
		 { 	
		 $criteria->condition=$criteria->condition.' and '.'(t.first_name LIKE :name or t.last_name LIKE :name or t.middle_name LIKE :name)';
		 $criteria->params[':name'] = $_REQUEST['name'].'%';
		}
		else if((substr_count( $_REQUEST['name'],' '))>=1)
		{
		 $name=explode(" ",$_REQUEST['name']);
		 $criteria->condition=$criteria->condition.' and '.'(t.first_name LIKE :name or t.last_name LIKE :name or t.middle_name LIKE :name)';
		 $criteria->params[':name'] = $name[0].'%';
		 $criteria->condition=$criteria->condition.' and '.'(t.first_name LIKE :name1 or t.last_name LIKE :name1 or t.middle_name LIKE :name1)';
		 $criteria->params[':name1'] = $name[1].'%';
		 	
		}
		}
		
		if(isset($_REQUEST['admissionnumber']) and $_REQUEST['admissionnumber']!=NULL)
		{
		 $criteria->condition=$criteria->condition.' and '.'t.admission_no LIKE :admissionnumber';
		 $criteria->params[':admissionnumber'] = $_REQUEST['admissionnumber'].'%';
		}
		
		if(isset($_REQUEST['Students']['batch_id']) and $_REQUEST['Students']['batch_id']!=NULL)
		{
			$model->batch_id = $_REQUEST['Students']['batch_id'];
			$criteria->condition=$criteria->condition.' and '.'t.batch_id = :batch_id';
		    $criteria->params[':batch_id'] = $_REQUEST['Students']['batch_id'];
		}
		
		if(isset($_REQUEST['Students']['gender']) and $_REQUEST['Students']['gender']!=NULL)
		{
			$model->gender = $_REQUEST['Students']['gender'];
			$criteria->condition=$criteria->condition.' and '.'t.gender = :gender';
		    $criteria->params[':gender'] = $_REQUEST['Students']['gender'];
		}				
		//end
		$criteria->order = 't.first_name ASC';		
                $page_size  =   10;
                if(isset($_REQUEST['size']) && $_REQUEST['size']!=NULL)
                {
                    $page_size  =   $_REQUEST['size'];
                }                
		$students_list = Students::model()->findAll($criteria);
		$total = Students::model()->count($criteria);
		$pages = new CPagination($total);
                $pages->setPageSize($page_size);
                $pages->applyLimit($criteria);  // the trick is here!
		$posts = Students::model()->findAll($criteria);
				 
		$this->render('add_students',array('model'=>$model,
		'list'=>$posts,
		'pages' => $pages,
		'item_count'=>$total,
		'page_size'=>$page_size)) ;            
	}
        
        public function actionBatch()
	{				
            //$data=Batches::model()->findAll('course_id=:id AND is_deleted=:x AND is_active=:y', array(':id'=>(int) $_POST['cid'],':x'=>'0',':y'=>1));                                  
            $data   = Batches::model()->findAllByAttributes(array('course_id'=>(int) $_POST['cid'],'is_deleted'=>0,'is_active'=>1),array('order'=>'name ASC'));  
            $batch_label = Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");		  
            echo CHtml::tag('option', array('value' => 0), CHtml::encode(Yii::t('app','Select')." ".$batch_label), true);
            $data=CHtml::listData($data,'id','name');
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);                                               
            }
	}
        
        //add students from other batches to selected batch
        public function actionAdd_all()
	{
		if(Yii::app()->request->isPostRequest){			
			$datas = $_POST['id'];	
                        $sel_batch_id  =   $_POST['sel_batch'];
                        $c=0;
			foreach($datas as $data){
				$model	= Students::model()->findByAttributes(array('id'=>$data));                                
                                $current_academic_yr = Configurations::model()->findByPk(35);				  
                                $student_batches = BatchStudents::model()->findAll('student_id=:x AND batch_id=:y',array(':x'=>$model->id,':y'=>$sel_batch_id));					  
                                if($student_batches==NULL){                                    
                                    $new_batch 				= new BatchStudents;
                                    $new_batch->student_id 		= $model->id;
                                    $new_batch->batch_id 		= $sel_batch_id;
                                    $new_batch->academic_yr_id          = $current_academic_yr->config_value;
                                    $new_batch->status 			= 1;
                                    if($new_batch->save())
                                    {
                                        $c++;
                                    }                                                                        
                                }
			}
                        Yii::app()->user->setFlash('successMessage',$c." ".Yii::t('app','Student(s) added successfully'));	
                        $url    = Yii::app()->createUrl('/courses/batches/batchstudents', array('id'=>$sel_batch_id));
	   		echo CJSON::encode(array('status'=>'success','url'=>$url));
			exit;		  
		}
		else{
			echo CJSON::encode(array('status'=>'error'));
			exit;
		}
	}
        
        //add student from other batches to current bacth - for single student
        public function actionAddStudent($student_id, $batch_id)
        {
            if(Yii::app()->request->isPostRequest)
            { 
                $batch_label = Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");
                $model	= Students::model()->findByAttributes(array('id'=>$student_id));                                
                $current_academic_yr = Configurations::model()->findByPk(35);				  
                $student_batches = BatchStudents::model()->findByAttributes(array('student_id'=>$student_id,'batch_id'=>$batch_id));					 
                if($student_batches==NULL){                                    
                    $new_batch 				= new BatchStudents;
                    $new_batch->student_id 		= $model->id;
                    $new_batch->batch_id 		= $batch_id;
                    $new_batch->academic_yr_id          = $current_academic_yr->config_value;
                    $new_batch->status 			= 1;
                    if($new_batch->save())
                    {
						$model->batch_id = $batch_id;
						$model->save();
                        Yii::app()->user->setFlash('successMessage',Yii::t('app','Student added successfully'));	
                    }
                    else
                    {
                        Yii::app()->user->setFlash('errorMessage',Yii::t('app',"Can't add student to this")." ".$batch_label);
                    }
                   
                }else{
					$student_batches->result_status	=	0;
					$student_batches->status 		= 	1;
					if($student_batches->save())
                    {
						$model->batch_id = $batch_id;
						$model->save();
                        Yii::app()->user->setFlash('successMessage',Yii::t('app','Student added successfully'));	
                    }
                    else
                    {
                        Yii::app()->user->setFlash('errorMessage',Yii::t('app',"Can't add student to this")." ".$batch_label);
                    }
				}
				 $this->redirect(array('batchstudents', 'id' =>$batch_id));	
            }
            else
                throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
        }
        
        //remove student from selected batch
        public function actionRemoveStudent()
        {
            if(Yii::app()->request->isPostRequest){
                $current_academic_yr = Configurations::model()->findByPk(35);
                $model  =   BatchStudents::model()->findByAttributes(array('student_id'=>$_REQUEST['sid'],'batch_id'=>$_REQUEST['id'],'academic_yr_id'=>$current_academic_yr->config_value));
                if($model!=NULL)
                {
                    
                    if($model->delete())
                    {
                        $student_model      =   Students::model()->findByAttributes(array('id'=>$_REQUEST['sid']));
                        if($student_model->batch_id==$_REQUEST['id']) 
                        {
                            $new_batch_id = Yii::app()->getModule('students')->getActiveBatch($_REQUEST['sid']);
                            $student_model->saveAttributes(array('batch_id'=>$new_batch_id));
                        }
                    }
                    $this->redirect(array('batchstudents', 'id' =>$_REQUEST['id']));
                }
            }
        }
        
        //set student to inactive from selected batch
        public function actionInactive()
        {
            if(Yii::app()->request->isPostRequest){
                $current_academic_yr = Configurations::model()->findByPk(35);
                $model  =   BatchStudents::model()->findByAttributes(array('student_id'=>$_REQUEST['sid'],'batch_id'=>$_REQUEST['id'],'academic_yr_id'=>$current_academic_yr->config_value,'status'=>1));
                if($model!=NULL)
                {
                    $model->status  =   2; //inactive
                    if($model->save())
                    {
                        $student_model      =   Students::model()->findByAttributes(array('id'=>$_REQUEST['sid']));
                        if($student_model->batch_id==$_REQUEST['id'] or $student_model->batch_id==NULL)
                        {
                            $new_batch_id = Yii::app()->getModule('students')->getActiveBatch($_REQUEST['sid']);
                            $student_model->saveAttributes(array('batch_id'=>$new_batch_id));
                        }
                        $check_model        =   BatchStudents::model()->findAllByAttributes(array('student_id'=>$_REQUEST['sid'],'status'=>1,'result_status'=>0));
                        if($check_model==NULL)
                        {
                            //set student to inactive when not active in other batches
                            $batch_stu	 = BatchStudents::model()->findAllByAttributes(array('student_id'=>$_REQUEST['sid']));
                            foreach($batch_stu as $batch_s){
                                    $batch_s->roll_no=NULL;
                                    $batch_s->save();
                            }                                                                                   
                            $student_model->saveAttributes(array('is_active'=>'0'));
                            
                            ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'5',$student_model->id,ucfirst($student_model->first_name).' '.ucfirst($student_model->middle_name).' '.ucfirst($student_model->last_name),NULL,NULL,NULL);
                            if($student_model->uid and $student_model->uid!=NULL and $student_model->uid!=0)
                            {
                                    $user = User::model()->findByPk($student_model->uid); // Making student user inactive
                                    if($user!=NULL and $user->status == 1){
                                            $user->saveAttributes(array('status'=>'0'));
                                    }
                            }
                                                        
                            //Make Parent inactive		
                            $guardians = GuardianList::model()->findAllByAttributes(array('student_id'=>$_REQUEST['sid']));
                            if($guardians){						
                                    foreach($guardians as $guardian){
                                            $guardian_detail = Guardians::model()->findByAttributes(array('id'=>$guardian->guardian_id));
                                            if($guardian_detail!=NULL and $guardian_detail->uid != 0){
                                                    $criteria = new CDbCriteria;		
                                                    $criteria->join = 'LEFT JOIN guardian_list t1 ON t.id = t1.student_id'; 
                                                    $criteria->condition = 't1.guardian_id=:guardian_id and t.is_active=:is_active';
                                                    $criteria->params = array(':guardian_id'=>$guardian_detail->id,':is_active'=>1);
                                                    $active_students = Students::model()->findAll($criteria);

                                                    if($active_students == NULL){
                                                            $guardian_user = User::model()->findByPk($guardian_detail->uid);
                                                            if($guardian_user!=NULL and $guardian_user->status == 1){
                                                                    $guardian_user->saveAttributes(array('status'=>0));										
                                                            }
                                                            $guardian_detail->saveAttributes(array('is_delete'=>1));
                                                    }
                                            }
                                    }
                            }
                        }
                    }
                    
                    $this->redirect(array('batchstudents', 'id' =>$_REQUEST['id']));
                }
            }
        }
        
        //set student to active from selected batch
        public function actionActive()
        {
            if(Yii::app()->request->isPostRequest)
            {
                $current_academic_yr = Configurations::model()->findByPk(35);
                $batch_model  =   BatchStudents::model()->findByAttributes(array('student_id'=>$_REQUEST['sid'],'batch_id'=>$_REQUEST['id'],'academic_yr_id'=>$current_academic_yr->config_value,'status'=>2));
                if($batch_model!=NULL)
                {
                    $batch_model->status  =   1; //inactive
                    if($batch_model->save())
                    {
                        $model = Students::model()->findByAttributes(array('id'=>$_REQUEST['sid']));
                        $model->saveAttributes(array('is_active'=>'1'));
                        
                        ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'6',$model->id,ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name),NULL,NULL,NULL);
                        if($model->uid and $model->uid!=NULL and $model->uid!=0)
                        {
                                $user = User::model()->findByPk($model->uid); // Making student user active
                                if($user!=NULL and $user->status == 0){
                                        $user->saveAttributes(array('status'=>'1'));
                                }
                        }
                        // Making parent user active
                        $guardians = GuardianList::model()->findAllByAttributes(array('student_id'=>$_REQUEST['sid']));
                        if($guardians){						
                                foreach($guardians as $guardian){
                                        $guardian_detail = Guardians::model()->findByAttributes(array('id'=>$guardian->guardian_id));
                                        if($guardian_detail!=NULL and $guardian_detail->is_delete == 1){
                                                $guardian_detail->saveAttributes(array('is_delete'=>0));
                                        }
                                        if($guardian_detail!=NULL and $guardian_detail->uid != 0){
                                                $guardian_user = User::model()->findByPk($guardian_detail->uid);
                                                if($guardian_user!=NULL and $guardian_user->status == 0){
                                                        $guardian_user->saveAttributes(array('status'=>1));										
                                                }								
                                        }
                                }
                        }
                    }
                    $this->redirect(array('batchstudents', 'id' =>$_REQUEST['id']));
                }
            }
        }
}

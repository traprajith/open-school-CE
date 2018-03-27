<?php

class SiteController extends RController
{
	public $layout='//layouts/none';
	
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->layout = 'column2';	
		$this->render('index');
	}

        public function actionData()
        {
            var_dump(Yii::app()->session);
        }

                /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail($model->email,$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact',Yii::t("app",'Thank you for contacting us. We will respond to you as soon as possible.'));
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$user=User::model()->findAll();
		if($user==NULL)
		{
			$this->redirect('index.php?r=configurations/setup');
		}
		
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$this->redirect(Yii::app()->user->returnUrl);
				
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionSearch()
	{
		
		if(isset($_POST['char']) and $_POST['char']!=NULL)
		{
		
		$this->layout='column2';
		$model=new Students;
		$criteria = new CDbCriteria;
		
		if((substr_count( $_POST['char'],' '))==0){ 	
			$criteria->condition='first_name LIKE :name or last_name LIKE :name or middle_name LIKE :name';
			$criteria->params[':name'] = $_POST['char'].'%';
		}else if((substr_count( $_POST['char'],' '))>=1){
			$name=explode(" ",$_POST['char']);			
			$criteria->condition='first_name LIKE :name or last_name LIKE :name or middle_name LIKE :name';
			$criteria->params[':name'] = $name[0].'%';
			$criteria->condition=$criteria->condition.' and '.'(first_name LIKE :name1 or last_name LIKE :name1 or middle_name LIKE :name1)';
			$criteria->params[':name1'] = $name[1].'%';		 	
		}
		
		
		$criteria->addSearchCondition('is_active', 1);
		$criteria->addSearchCondition('is_deleted', 0);
		$criteria->order = 'first_name ASC';
		$total = Students::model()->count($criteria);
		$pages = new CPagination($total);
        $pages->setPageSize(Yii::app()->params['listPerPage']);
        $pages->applyLimit($criteria);  // the trick is here!
		$posts = Students::model()->findAll($criteria);
		
		$emp=new Employees;
		$criteria_1 = new CDbCriteria;
		
		if((substr_count( $_POST['char'],' '))==0){ 	
			$criteria_1->condition='first_name LIKE :name or last_name LIKE :name or middle_name LIKE :name';
			$criteria_1->params[':name'] = $_POST['char'].'%';
		}else if((substr_count( $_POST['char'],' '))>=1){
			$name=explode(" ",$_POST['char']);			
			$criteria_1->condition='first_name LIKE :name or last_name LIKE :name or middle_name LIKE :name';
			$criteria_1->params[':name'] = $name[0].'%';
			$criteria_1->condition=$criteria_1->condition.' and '.'(first_name LIKE :name1 or last_name LIKE :name1 or middle_name LIKE :name1)';
			$criteria_1->params[':name1'] = $name[1].'%';		 	
		}
		
		//$criteria_1->addSearchCondition('is_deleted', 0);
		$criteria_1->order = 'first_name ASC';
		$tot = Employees::model()->count($criteria_1);
		$pages_1 = new CPagination($total);
        $pages_1->setPageSize(Yii::app()->params['listPerPage']);
        $pages_1->applyLimit($criteria_1);  // the trick is here!
		$posts_1 = Employees::model()->findAll($criteria_1);		
		 
		$this->render('search',array('model'=>$model,
		'list'=>$posts,
		'posts'=>$posts_1,
		'pages' => $pages,
		'item_count'=>$total,
		'page_size'=>10,)) ;
		
		//$stud = Students::model()->findAll('first_name LIKE '.$_POST['char']);
		//echo count($stud);
		//exit;
	//print_r($_POST);
		}
		else
		{
			$this->redirect(Yii::app()->user->returnUrl);
		}
	}
	
	public function actionSemstudent()
	 {
		 
			$id			  =	$_REQUEST['id'];
			$Student	  = Students::model()->findByAttributes(array('id'=>$_REQUEST['id'])); 
			$student_name =	$Student->studentFullName("forStudentProfile").'@#$`'.$_REQUEST['id'];
				
			// semester details
			$stu_batchs=BatchStudents::model()->findAllByAttributes(array("student_id"=>$id)); 
			$datas=array();
			
			foreach($stu_batchs as $stu_batch)
			{
				$bid	=	$stu_batch->batch_id;
				$batch	=	Batches::model()->findByPk($bid);
				$sem	=	Semester::model()->findByPk($batch->semester_id);
				if(isset($sem) and $sem!=NULL){
				if(!in_array($sem->id,$data))
					$data[]=$sem->id;
				}
					
			}
			$semester_data	=	CHtml::tag('option', array('value' => ''), CHtml::encode(Yii::t('app','Select Semester')), true);
			for($i=0;$i<count($data);$i++){
				$sems	=	Semester::model()->findByPk($data[$i]);
				$semester_data.=CHtml::tag('option',array('value'=>$sems->id),CHtml::encode($sems->name),true);
			}
				
			echo CJSON::encode(array('student_name'=>$student_name,'semester_data'=>$semester_data));	
		
	 }
	 public function actionStudent()
	 {
		if(Yii::app()->request->isAjaxRequest)
		{
			$Student = Students::model()->findByAttributes(array('id'=>$_REQUEST['id'])); 
			echo $Student->studentFullName("forStudentProfile").'@#$`'.$_REQUEST['id'];
			
		}
		
	 }
	public function actionExplorer()
	{
		if(Yii::app()->request->isAjaxRequest)
		 {
			 $this->renderPartial('explorer',array(),false,true);
		 }
	}
	public function actionManage()
	 {
		if(Yii::app()->request->isAjaxRequest)
		 {
		
		$name='';
	    $bat='';
	    $ad='';  		  
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
		$criteria->compare('is_deleted',0);  // normal DB field
		$criteria->condition='is_deleted=:is_del AND is_active=:is_active';
		 $criteria->params = array(':is_del'=>0,':is_active'=>1);
		if(isset($_REQUEST['val']) and $_REQUEST['val']!=NULL)
		{
		 $criteria->condition=$criteria->condition.' and first_name LIKE :match';
		 $criteria->params[':match'] = $_REQUEST['val'].'%';
		}
		
		if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL)
		{
		 $criteria->condition=$criteria->condition.' and '.'first_name LIKE :name';
		 $criteria->params[':name'] = $_REQUEST['name'].'%';
		 $name=$_REQUEST['name'];
		}
		
		if(isset($_REQUEST['admissionnumber']) and $_REQUEST['admissionnumber']!=NULL)
		{
		 $criteria->condition=$criteria->condition.' and '.'admission_no LIKE :admissionnumber';
		 $criteria->params[':admissionnumber'] = $_REQUEST['admissionnumber'].'%';
		 $ad=$_REQUEST['admissionnumber'];
		}
		
		if(isset($_REQUEST['Students']['batch_id']) and $_REQUEST['Students']['batch_id']!=NULL)
		{
			$model->batch_id = $_REQUEST['Students']['batch_id'];
			$criteria->condition=$criteria->condition.' and '.'batch_id = :batch_id';
		    $criteria->params[':batch_id'] = $_REQUEST['Students']['batch_id'];
			$bat=$_REQUEST['Students']['batch_id'];
		}
		
		if(isset($_REQUEST['Students']['gender']) and $_REQUEST['Students']['gender']!=NULL)
		{
			$model->gender = $_REQUEST['Students']['gender'];
			$criteria->condition=$criteria->condition.' and '.'gender = :gender';
		    $criteria->params[':gender'] = $_REQUEST['Students']['gender'];
		}
		
		if(isset($_REQUEST['Students']['blood_group']) and $_REQUEST['Students']['blood_group']!=NULL)
		{
			$model->blood_group = $_REQUEST['Students']['blood_group'];
			$criteria->condition=$criteria->condition.' and '.'blood_group = :blood_group';
		    $criteria->params[':blood_group'] = $_REQUEST['Students']['blood_group'];
		}
		
		if(isset($_REQUEST['Students']['nationality_id']) and $_REQUEST['Students']['nationality_id']!=NULL)
		{
			$model->nationality_id = $_REQUEST['Students']['nationality_id'];
			$criteria->condition=$criteria->condition.' and '.'nationality_id = :nationality_id';
		    $criteria->params[':nationality_id'] = $_REQUEST['Students']['nationality_id'];
		}
		
		
		if(isset($_REQUEST['Students']['dobrange']) and $_REQUEST['Students']['dobrange']!=NULL)
		{
			  
			  $model->dobrange = $_REQUEST['Students']['dobrange'] ;
			  if(isset($_REQUEST['Students']['date_of_birth']) and $_REQUEST['Students']['date_of_birth']!=NULL)
			  {
				  if($_REQUEST['Students']['dobrange']=='2')
				  {  
					  $model->date_of_birth = $_REQUEST['Students']['date_of_birth'];
					  $criteria->condition=$criteria->condition.' and '.'date_of_birth = :date_of_birth';
					  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Students']['date_of_birth']));
				  }
				  if($_REQUEST['Students']['dobrange']=='1')
				  {  
				  
					  $model->date_of_birth = $_REQUEST['Students']['date_of_birth'];
					  $criteria->condition=$criteria->condition.' and '.'date_of_birth < :date_of_birth';
					  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Students']['date_of_birth']));
				  }
				  if($_REQUEST['Students']['dobrange']=='3')
				  {  
					  $model->date_of_birth = $_REQUEST['Students']['date_of_birth'];
					  $criteria->condition=$criteria->condition.' and '.'date_of_birth > :date_of_birth';
					  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Students']['date_of_birth']));
				  }
				  
			  }
		}
		elseif(isset($_REQUEST['Students']['dobrange']) and $_REQUEST['Students']['dobrange']==NULL)
		{
			  if(isset($_REQUEST['Students']['date_of_birth']) and $_REQUEST['Students']['date_of_birth']!=NULL)
			  {
				  $model->date_of_birth = $_REQUEST['Students']['date_of_birth'];
				  $criteria->condition=$criteria->condition.' and '.'date_of_birth = :date_of_birth';
				  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Students']['date_of_birth']));
			  }
		}
		
		
		if(isset($_REQUEST['Students']['admissionrange']) and $_REQUEST['Students']['admissionrange']!=NULL)
		{
			  
			  $model->admissionrange = $_REQUEST['Students']['admissionrange'] ;
			  if(isset($_REQUEST['Students']['admission_date']) and $_REQUEST['Students']['admission_date']!=NULL)
			  {
				  if($_REQUEST['Students']['admissionrange']=='2')
				  {  
					  $model->admission_date = $_REQUEST['Students']['admission_date'];
					  $criteria->condition=$criteria->condition.' and '.'admission_date = :admission_date';
					  $criteria->params[':admission_date'] = date('Y-m-d',strtotime($_REQUEST['Students']['admission_date']));
				  }
				  if($_REQUEST['Students']['admissionrange']=='1')
				  {  
				  
					  $model->admission_date = $_REQUEST['Students']['admission_date'];
					  $criteria->condition=$criteria->condition.' and '.'admission_date < :admission_date';
					  $criteria->params[':admission_date'] = date('Y-m-d',strtotime($_REQUEST['Students']['admission_date']));
				  }
				  if($_REQUEST['Students']['admissionrange']=='3')
				  {  
					  $model->admission_date = $_REQUEST['Students']['admission_date'];
					  $criteria->condition=$criteria->condition.' and '.'admission_date > :admission_date';
					  $criteria->params[':admission_date'] = date('Y-m-d',strtotime($_REQUEST['Students']['admission_date']));
				  }
				  
			  }
		}
		elseif(isset($_REQUEST['Students']['admissionrange']) and $_REQUEST['Students']['admissionrange']==NULL)
		{
			  if(isset($_REQUEST['Students']['admission_date']) and $_REQUEST['Students']['admission_date']!=NULL)
			  {
				  $model->admission_date = $_REQUEST['Students']['admission_date'];
				  $criteria->condition=$criteria->condition.' and '.'admission_date = :admission_date';
				  $criteria->params[':admission_date'] = date('Y-m-d',strtotime($_REQUEST['Students']['admission_date']));
			  }
		}
		
		if(isset($_REQUEST['Students']['status']) and $_REQUEST['Students']['status']!=NULL)
		{
			$model->status = $_REQUEST['Students']['status'];
			$criteria->condition=$criteria->condition.' and '.'is_active = :status';
		    $criteria->params[':status'] = $_REQUEST['Students']['status'];
		}
		//accademic status check
		$batch_stu = BatchStudents::model()->findAllByAttributes(array('result_status'=>0,'status'=>1,'academic_yr_id'=>$year));
		$students	=array();
		foreach($batch_stu as $stu)
		{
			$students[]	=	$stu->student_id;
		}
		$criteria->addInCondition('id',$students);
		//end
		$criteria->order = 'first_name ASC';
	
		$total = Students::model()->count($criteria);
		
		//$pages = new CPagination($total);
        //$pages->setPageSize(Yii::app()->params['listPerPage']);
       //$pages->applyLimit($criteria);  // the trick is here!
		$posts = Students::model()->findAll($criteria);
		
		 
		$this->renderPartial('student_panel',array('model'=>$model,
		'list'=>$posts,
		//'pages' => $pages,
		//'item_count'=>$total,'name'=>$name,'ad'=>$ad,'bat'=>$bat,
		//'page_size'=>10,
		)) ;
		
		 }
	 
	 }
	 public function actionAutocomplete() 
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
	  if (isset($_GET['term'])) {
		$criteria=new CDbCriteria;
		//$criteria->alias = "first_name";
		$criteria->condition = "first_name   like '" . $_GET['term'] . "%'"." or last_name   like '" . $_GET['term'] . "%'";
		$criteria->addSearchCondition('is_active', 1);
		$criteria->addSearchCondition('is_deleted', 0);
		//accademic status check
		$batch_stu = BatchStudents::model()->findAllByAttributes(array('result_status'=>0,'status'=>1,'academic_yr_id'=>$year));
		$students	=array();
		foreach($batch_stu as $stu)
		{
			$students[]	=	$stu->student_id;
		}
		$criteria->addInCondition('id',$students);
		//end
		$criteria->order = 'first_name ASC';
		$Students = Students::model()->findAll($criteria);
	
		$return_array = array();
		foreach($Students as $Student) {
		  $return_array[] = array(
						'label'=>$Student->studentFullName('forStudentProfile'),
						'id'=>$Student->id,
						);
		}
		echo CJSON::encode($return_array);
		Yii::app()->end();
	  }
	}
	
	public function actionParentautocomplete() 
	 {
	  if (isset($_GET['term'])) {
		$criteria	= new CDbCriteria;
		$criteria->condition	= '(first_name LIKE :name OR last_name LIKE :name) AND (is_delete=:is_delete)';
		$criteria->params		= array(':name'=>$_GET['term'].'%', ':is_delete'=>0);			
		$criteria->order 		= 'first_name ASC';
		$guardians = Guardians::model()->findAll($criteria);
	
		$return_array = array();
		foreach($guardians as $guardian) {
		  $return_array[] = array(
						'label'=>ucfirst($guardian->first_name).' '.ucfirst($guardian->last_name) ,
						'id'=>$guardian->id,
						);
		}
		echo CJSON::encode($return_array);
		Yii::app()->end();
	  }
	}
	
	public function actionParentemailcomplete() 
	 {
	  if (isset($_GET['term'])) {
		$criteria	= new CDbCriteria;
		$criteria->condition	= '(email LIKE :email) AND (is_delete=:is_delete)';
		$criteria->params		= array(':email'=>$_GET['term'].'%', ':is_delete'=>0);		
		$criteria->order 		= 'email ASC';
		$guardians = Guardians::model()->findAll($criteria);
		$return_array = array();
		foreach($guardians as $guardian) {
		  $return_array[] = array(
						'label'=>$guardian->email,
						'id'=>$guardian->id,
						);
		}
		echo CJSON::encode($return_array);
		Yii::app()->end();
	  }
	}
	
	public function actionEmployeeautocomplete() 
	 {
	  if (isset($_GET['term'])) { 
		$criteria=new CDbCriteria;
		$criteria->condition = "first_name   like '" . $_GET['term'] . "%'"." or last_name   like '" . $_GET['term'] . "%'";
		$criteria->addSearchCondition('is_deleted', 0);
		$criteria->order = 'first_name ASC';
		$employees = Employees::model()->findAll($criteria);
	
		$return_array = array();
		foreach($employees as $employee) {
		  $return_array[] = array(
						'label'=>Employees::model()->getTeachername($employee->id) ,
						'id'=>$employee->id,
						);
		}
		echo CJSON::encode($return_array);
	  }
	}
	
	public function actionEmanage()
	 {
		 if(Yii::app()->request->isAjaxRequest)
		 {
		
		$name='';
	    $bat='';
	    $ad='';  		  
		    
		
		 
		$model=new Employees;
		$criteria = new CDbCriteria;
		$criteria->compare('is_deleted',0);
		$criteria->condition='is_deleted=:is_del';
	    $criteria->params = array(':is_del'=>0);
		if(isset($_REQUEST['val']))
		{
		 $criteria->condition=$criteria->condition.' and '.'first_name LIKE :match';
		 $criteria->params[':match'] = $_REQUEST['val'].'%';
		}
		
		if(isset($_REQUEST['ename']) and $_REQUEST['ename']!=NULL)
		{
		 $criteria->condition=$criteria->condition.' and '.'first_name LIKE :name';
		 $criteria->params[':name'] = $_REQUEST['ename'].'%';
		 $name=$_REQUEST['ename'];
		}
		
		if(isset($_REQUEST['employeenumber']) and $_REQUEST['employeenumber']!=NULL)
		{
		 $criteria->condition=$criteria->condition.' and '.'employee_number LIKE :employeenumber';
		 $criteria->params[':employeenumber'] = $_REQUEST['employeenumber'].'%';
		 $ad=$_REQUEST['employeenumber'];
		}
		
		if(isset($_REQUEST['Employees']['employee_department_id']) and $_REQUEST['Employees']['employee_department_id']!=NULL)
		{
			$model->employee_department_id = $_REQUEST['Employees']['employee_department_id'];
			$criteria->condition=$criteria->condition.' and '.'employee_department_id = :employee_department_id';
		    $criteria->params[':employee_department_id'] = $_REQUEST['Employees']['employee_department_id'];
			$bat=$_REQUEST['Employees']['employee_department_id'];
		}
		
		if(isset($_REQUEST['Employees']['employee_category_id']) and $_REQUEST['Employees']['employee_category_id']!=NULL)
		{
			$model->employee_category_id = $_REQUEST['Employees']['employee_category_id'];
			$criteria->condition=$criteria->condition.' and '.'employee_category_id = :employee_category_id';
		    $criteria->params[':employee_category_id'] = $_REQUEST['Employees']['employee_category_id'];
		}
		
		if(isset($_REQUEST['Employees']['employee_position_id']) and $_REQUEST['Employees']['employee_position_id']!=NULL)
		{
			$model->employee_position_id = $_REQUEST['Employees']['employee_position_id'];
			$criteria->condition=$criteria->condition.' and '.'employee_position_id = :employee_position_id';
		    $criteria->params[':employee_position_id'] = $_REQUEST['Employees']['employee_position_id'];
		}
		
		
		if(isset($_REQUEST['Employees']['employee_grade_id']) and $_REQUEST['Employees']['employee_grade_id']!=NULL)
		{
			$model->employee_grade_id = $_REQUEST['Employees']['employee_grade_id'];
			$criteria->condition=$criteria->condition.' and '.'employee_grade_id = :employee_grade_id';
		    $criteria->params[':employee_grade_id'] = $_REQUEST['Employees']['employee_grade_id'];
		}
		
		
		if(isset($_REQUEST['Employees']['gender']) and $_REQUEST['Employees']['gender']!=NULL)
		{
			$model->gender = $_REQUEST['Employees']['gender'];
			$criteria->condition=$criteria->condition.' and '.'gender = :gender';
		    $criteria->params[':gender'] = $_REQUEST['Employees']['gender'];
		}
		
		if(isset($_REQUEST['Employees']['marital_status']) and $_REQUEST['Employees']['marital_status']!=NULL)
		{
			$model->marital_status = $_REQUEST['Employees']['marital_status'];
			$criteria->condition=$criteria->condition.' and '.'marital_status = :marital_status';
		    $criteria->params[':marital_status'] = $_REQUEST['Employees']['marital_status'];
		}
		
		if(isset($_REQUEST['Employees']['blood_group']) and $_REQUEST['Employees']['blood_group']!=NULL)
		{
			$model->blood_group = $_REQUEST['Employees']['blood_group'];
			$criteria->condition=$criteria->condition.' and '.'blood_group = :blood_group';
		    $criteria->params[':blood_group'] = $_REQUEST['Employees']['blood_group'];
		}
		
		if(isset($_REQUEST['Employees']['nationality_id']) and $_REQUEST['Employees']['nationality_id']!=NULL)
		{
			$model->nationality_id = $_REQUEST['Employees']['nationality_id'];
			$criteria->condition=$criteria->condition.' and '.'nationality_id = :nationality_id';
		    $criteria->params[':nationality_id'] = $_REQUEST['Employees']['nationality_id'];
		}
		
		
		if(isset($_REQUEST['Employees']['dobrange']) and $_REQUEST['Employees']['dobrange']!=NULL)
		{
			  
			  $model->dobrange = $_REQUEST['Employees']['dobrange'] ;
			  if(isset($_REQUEST['Employees']['date_of_birth']) and $_REQUEST['Employees']['date_of_birth']!=NULL)
			  {
				  if($_REQUEST['Employees']['dobrange']=='2')
				  {  
					  $model->date_of_birth = $_REQUEST['Employees']['date_of_birth'];
					  $criteria->condition=$criteria->condition.' and '.'date_of_birth = :date_of_birth';
					  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Employees']['date_of_birth']));
				  }
				  if($_REQUEST['Employees']['dobrange']=='1')
				  {  
				  
					  $model->date_of_birth = $_REQUEST['Employees']['date_of_birth'];
					  $criteria->condition=$criteria->condition.' and '.'date_of_birth < :date_of_birth';
					  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Employees']['date_of_birth']));
				  }
				  if($_REQUEST['Employees']['dobrange']=='3')
				  {  
					  $model->date_of_birth = $_REQUEST['Employees']['date_of_birth'];
					  $criteria->condition=$criteria->condition.' and '.'date_of_birth > :date_of_birth';
					  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Employees']['date_of_birth']));
				  }
				  
			  }
		}
		elseif(isset($_REQUEST['Employees']['dobrange']) and $_REQUEST['Employees']['dobrange']==NULL)
		{
			  if(isset($_REQUEST['Employees']['date_of_birth']) and $_REQUEST['Employees']['date_of_birth']!=NULL)
			  {
				  $model->date_of_birth = $_REQUEST['Employees']['date_of_birth'];
				  $criteria->condition=$criteria->condition.' and '.'date_of_birth = :date_of_birth';
				  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Employees']['date_of_birth']));
			  }
		}
		
		
		if(isset($_REQUEST['Employees']['joinrange']) and $_REQUEST['Employees']['joinrange']!=NULL)
		{
			  
			  $model->joinrange = $_REQUEST['Employees']['joinrange'] ;
			  if(isset($_REQUEST['Employees']['joining_date']) and $_REQUEST['Employees']['joining_date']!=NULL)
			  {
				  if($_REQUEST['Employees']['joinrange']=='2')
				  {  
					  $model->joining_date = $_REQUEST['Employees']['joining_date'];
					  $criteria->condition=$criteria->condition.' and '.'joining_date = :joining_date';
					  $criteria->params[':joining_date'] = date('Y-m-d',strtotime($_REQUEST['Employees']['joining_date']));
				  }
				  if($_REQUEST['Employees']['joinrange']=='1')
				  {  
				  
					  $model->joining_date = $_REQUEST['Employees']['joining_date'];
					  $criteria->condition=$criteria->condition.' and '.'joining_date < :joining_date';
					  $criteria->params[':joining_date'] = date('Y-m-d',strtotime($_REQUEST['Employees']['joining_date']));
				  }
				  if($_REQUEST['Employees']['joinrange']=='3')
				  {  
					  $model->joining_date = $_REQUEST['Employees']['joining_date'];
					  $criteria->condition=$criteria->condition.' and '.'joining_date > :joining_date';
					  $criteria->params[':joining_date'] = date('Y-m-d',strtotime($_REQUEST['Employees']['joining_date']));
				  }
				  
			  }
		}
		elseif(isset($_REQUEST['Employees']['joinrange']) and $_REQUEST['Employees']['joinrange']==NULL)
		{
			  if(isset($_REQUEST['Employees']['joining_date']) and $_REQUEST['Employees']['joining_date']!=NULL)
			  {
				  $model->joining_date = $_REQUEST['Employees']['joining_date'];
				  $criteria->condition=$criteria->condition.' and '.'joining_date = :joining_date';
				  $criteria->params[':joining_date'] = date('Y-m-d',strtotime($_REQUEST['Employees']['joining_date']));
			  }
		}
		
		if(isset($_REQUEST['Employees']['status']) and $_REQUEST['Employees']['status']!=NULL)
		{
			$model->status = $_REQUEST['Employees']['status'];
			$criteria->condition=$criteria->condition.' and '.'is_active = :status';
		    $criteria->params[':status'] = $_REQUEST['Employees']['status'];
		}
		
		
		$criteria->order = 'first_name ASC';
		
		$total = Employees::model()->count($criteria);
		//$pages = new CPagination($total);
        //$pages->setPageSize(Yii::app()->params['listPerPage']);
        //$pages->applyLimit($criteria);  // the trick is here!
		$posts = Employees::model()->findAll($criteria);
		
		 
		$this->renderPartial('user_panel',array('model'=>$model,

		'list'=>$posts,
		//'pages' => $pages,
		'item_count'=>$total,'name'=>$name,'ad'=>$ad,'bat'=>$bat
		//'page_size'=>Yii::app()->params['listPerPage'],
		)
		) ;
	 
		
		
		
		 }
	 
	 }
	 
	 public function actionBmanage()
	 {
		 $this->renderPartial('batch_panel',array());
	 }
	 
	 public function actionBookmark()
	 {
		 
			 echo Yii::t("app",'saved');
		 
	 }
         
         
         public function actionOffline()
         {
             $this->render('offline');
         }
         
         public function actionPdf()
         {
            $filename	= "report.pdf";
            Yii::app()->osPdf->generate("application.views.site.printpdf", $filename, array(),1);
         }
}
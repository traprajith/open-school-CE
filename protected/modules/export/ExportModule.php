

<?php

class ExportModule extends CWebModule
{
	public $allowedModels	=	array();
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'export.models.*',
			'export.components.*',
		));
		
		$this->allowedModels	=	array(
			'Students'	=> array(
				'label'	=> Yii::t('app','Students'),
				'allowedColumns'	=> array('admission_no', 'admission_date', 'first_name', 'middle_name', 'last_name', 'national_student_id', 'batch_id', 'date_of_birth', 'gender', 'nationality_id', 'language', 'religion', 'student_category_id', 'address_line1', 'address_line2', 'city', 'state', 'pin_code', 'email'),// or 'all',
				'compare' => array(
					'batch_id'
				),
				//foreignKeys must be present in the allowedColumns. With the identifier in the primary table , the required attribute from the second table will be fetched.			
				'foreignKeys'=>array(
					'course_id'=>array(
						'model'=>'Courses',	// model to check with
						'compareWith'=>'id',	// checking will be done by using findByAttributes()
						'attributes'=>'course_name',	// add more attributes as array if needed like - array('course_name', 'code', 'created_at')
						'defaultValue'=>'-'		// will be returned if there is no record found
					),
					'batch_id'=>array(
						'model'=>'Batches',
						'compareWith'=>'id',
						'attributes'=>'name',
						'defaultValue'=>'-'
					),
					'nationality_id'=>array(
						'model'=>'Nationality',
						'compareWith'=>'id',
						'attributes'=>'name',
						'defaultValue'=>'-'
					),
					'country_id'=>array(
						'model'=>'Countries',
						'compareWith'=>'id',
						'attributes'=>'name',
						'defaultValue'=>'-'
					),
					'student_category_id'=>array(
						'model'=>'StudentCategories',
						'compareWith'=>'id',
						'attributes'=>'name',
						'defaultValue'=>'-'
					),
				),
				//can format the data for output
				'dataFormats'=>array(
					'is_active'=>function($data){
						return ($data==1)?Yii::t('app',"Active"):Yii::t('app',"Inactive");
					},
					'gender'=>function($data){
						return ($data=="M")?Yii::t('app',"Male"):Yii::t('app',"Female");
					},
				),
				'render' => '_student',
			),
			'Employees'	=> array(
				'label'	=> Yii::t('app','Teachers'),
				'allowedColumns'	=> array('employee_number', 'joining_date', 'first_name', 'last_name', 'gender', 'date_of_birth', 'employee_department_id', 'employee_position_id', 'employee_grade_id', 'job_title', 'qualification', 'experience_year', 'experience_month', 'nationality_id', 'home_address_line1', 'home_address_line2', 'home_city', 'home_state', 'office_pin_code', 'office_phone1', 'email'),				
				'compare' => array(
					'employee_department_id',
					'employee_category_id',
				),
				//foreignKeys must be present in the allowedColumns. With the identifier in the primary table , the required attribute from the second table will be fetched.			
				'foreignKeys'=>array(
					'employee_department_id'=>array(
						'model'=>'EmployeeDepartments',	// model to check with
						'compareWith'=>'id',	// checking will be done by using findByAttributes()
						'attributes'=>'name',	// add more attributes as array if needed like - array('course_name', 'code', 'created_at')
						'defaultValue'=>'-'		// will be returned if there is no record found
					),
					'employee_position_id'=>array(
						'model'=>'EmployeePositions',
						'compareWith'=>'id',
						'attributes'=>'name',
						'defaultValue'=>'-'
					),
					'employee_grade_id'=>array(
						'model'=>'EmployeeGrades',
						'compareWith'=>'id',
						'attributes'=>'name',
						'defaultValue'=>'-'
					),
					'nationality_id'=>array(
						'model'=>'Nationality',
						'compareWith'=>'id',
						'attributes'=>'name',
						'defaultValue'=>'-'
					),
				),
				//can format the data for output
				'dataFormats'=>array(
					'gender'=>function($data){
						return ($data=="M")?Yii::t('app',"Male"):Yii::t('app',"Female");
					},
				),
				'render' => '_employee',
			),
			'Guardians'	=> array(
				'label'	=> Yii::t('app','Guardians'),
				'allowedColumns'	=> array('first_name', 'last_name', 'relation', 'email', 'mobile_phone', 'city', 'state', 'country_id'),
				'compare' => array(
				),
				'foreignKeys'=>array(					
					'country_id'=>array(
						'model'=>'Countries',
						'compareWith'=>'id',
						'attributes'=>'name',
						'defaultValue'=>'-'
					)
				)
			)
		);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}

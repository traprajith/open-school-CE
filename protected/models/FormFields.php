<?php

class FormFields extends CActiveRecord
{
    
    const VISIBLE_ALL=3;
	const VISIBLE_REGISTER_USER=2;
	const VISIBLE_ONLY_OWNER=1;
	const VISIBLE_NO=0;
	
	const REQUIRED_NO = 0;
	const REQUIRED_YES = 1;
	const REQUIRED_NO_SHOW_REG = 2;
	const REQUIRED_YES_NOT_SHOW_REG = 3;
	/**
	 * Returns the static model of the specified AR class.
	 * @return FormFields the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'form_fields';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tab_selection, form_field_type, title,required, model', 'required'),
			array('required, position, visible, admin_student_reg_form, online_admission_form, student_profile ,student_profile_pdf, student_portal, parent_portal, teacher_portal, tab_selection, tab_sub_section, order, is_dynamic', 'numerical', 'integerOnly'=>true),
			array('varname, field_type', 'length', 'max'=>50),
                    //    array('varname','unique'),
                        array('tab_sub_section','required','on'=>'create'),
                        array('varname','generateField','on'=>'create'),
			array('title, match, range, error_message, other_validator, default, widget, model, label, form_field_type', 'length', 'max'=>255),
			array('field_size, field_size_min', 'length', 'max'=>15),
			array('widgetparams', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, varname, is_exception, title, field_type, field_size, field_size_min, required, match, range, error_message, other_validator, default, widget, widgetparams, position, visible, model, label, admin_student_reg_form, online_admission_form, student_profile_pdf, student_portal, parent_portal, teacher_portal, form_field_type, tab_selection, tab_sub_section, order, is_dynamic', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
	
	public function scopes()
    {
        return array(
            'forAdminRegistration'=>array(
                'condition'=>'admin_student_reg_form=:value',
                'params'=>array(':value'=>1),
            ),
            'forOnlineRegistration'=>array(
                'condition'=>'online_admission_form=1',
            ),
			'forStudentProfile'=>array(
                'condition'=>'student_profile=1',
            ),
			'forStudentProfilePdf'=>array(
                'condition'=>'student_profile_pdf=1',
            ),
            'forStudentPortal'=>array(
                'condition'=>'student_portal=1',
            ),
			'forParentPortal'=>array(
                'condition'=>'parent_portal=1',
            ),
            'forTeacherPortal'=>array(
                'condition'=>'teacher_portal=1',
            )
        );
    }
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'varname' => Yii::t('app','Varname'),
			'title' => Yii::t('app','Title'),
			'field_type' => Yii::t('app','Data Type'),
			'field_size' => Yii::t('app','Field Size'),
			'field_size_min' => Yii::t('app','Field Size Min'),
			'required' => Yii::t('app','Required'),
			'match' => Yii::t('app','Match'),
			'range' => Yii::t('app','Range'),
			'error_message' => Yii::t('app','Error Message'),
			'other_validator' => Yii::t('app','Other Validator'),
			'default' => Yii::t('app','Default'),
			'widget' => Yii::t('app','Widget'),
			'widgetparams' => Yii::t('app','Widgetparams'),
			'position' => Yii::t('app','Position'),
			'visible' => Yii::t('app','Visible'),
			'model' => Yii::t('app','Model'),
			'label' => Yii::t('app','Label'),
			'admin_student_reg_form' => Yii::t('app','Admin Student Reg Form'),
			'online_admission_form' => Yii::t('app','Online Admission Form'),
			'student_profile_pdf' => Yii::t('app','Student Profile Pdf'),
			'student_portal' => Yii::t('app','Student Portal'),
			'parent_portal' => Yii::t('app','Parent Portal'),
			'teacher_portal' => Yii::t('app','Teacher Portal'),
			'form_field_type' => Yii::t('app','Field Type'),
			'tab_selection' => Yii::t('app','Tab Selection'),
			'tab_sub_section' => Yii::t('app','Tab Sub Section'),
			'order' => Yii::t('app','Order'),
			'is_dynamic' => Yii::t('app','Is Dynamic'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('varname',$this->varname,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('field_type',$this->field_type,true);
		$criteria->compare('field_size',$this->field_size,true);
		$criteria->compare('field_size_min',$this->field_size_min,true);
		$criteria->compare('required',$this->required);
		$criteria->compare('match',$this->match,true);
		$criteria->compare('range',$this->range,true);
		$criteria->compare('error_message',$this->error_message,true);
		$criteria->compare('other_validator',$this->other_validator,true);
		$criteria->compare('default',$this->default,true);
		$criteria->compare('widget',$this->widget,true);
		$criteria->compare('widgetparams',$this->widgetparams,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('admin_student_reg_form',$this->admin_student_reg_form);
		$criteria->compare('online_admission_form',$this->online_admission_form);
		$criteria->compare('student_profile_pdf',$this->student_profile_pdf);
		$criteria->compare('student_portal',$this->student_portal);
		$criteria->compare('parent_portal',$this->parent_portal);
		$criteria->compare('teacher_portal',$this->teacher_portal);
		$criteria->compare('form_field_type',$this->form_field_type,true);
		$criteria->compare('tab_selection',$this->tab_selection);
		$criteria->compare('tab_sub_section',$this->tab_sub_section);
		$criteria->compare('order',$this->order);
		$criteria->compare('is_dynamic',$this->is_dynamic);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getSubsection($main_tab)
	{
		$list= array(
				'1'=>array('1'=>Yii::t('app','Personal Details'),'2'=>Yii::t('app','Contact Details')),
				'2'=>array('1'=>Yii::t('app','Parent Personal Details'),'2'=>Yii::t('app','Parent Contact Details')),
                                '3'=>array('1'=>'Emergency Contact'),
                                '4'=>array('1'=>Yii::t('app','Institution Details')),
                                //'5'=>array('1'=>Yii::t('app','Document Details')),
			);

		if(isset($main_tab))
		{
			return $list[$main_tab];
		}
	}
        
        public static function getmodelname($id)
        {
            $model="";
            if($id==1 || $id==3)
            {
                $model= "Students";
            }
            else if($id==2)
            {
                $model= "Guardians";
            }
            else if($id==4)
            {
                $model= "StudentPreviousDatas";
            }
            else if($id==5)
            {
                $model= "StudentDocument";
            }
            return $model;
            
        }

                public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'field_type' => array(
				'INTEGER' => Yii::t('app','INTEGER'),
				'VARCHAR' => Yii::t('app','VARCHAR'),
				'TEXT'=> Yii::t('app','TEXT'),
				'DATE'=> Yii::t('app','DATE'),				
				'DECIMAL'=> Yii::t('app','DECIMAL'),
				//'LONGBLOB'=>Yii::t('app','LONGBLOB'),
				
			),
            'tab_selection' => array(
				'1' => Yii::t('app','Student Details'),
				'2' => Yii::t('app','Guardian Details'),
				//'3'=> Yii::t('app','Emergency Contact'),
				'4'=> Yii::t('app','Previous Details'),
                //'5'=>Yii::t('app','Student Documents'),
                		
			),
			'form_field_type'=>array(
				'1' => Yii::t('app','Text Field'),
				'2' => Yii::t('app','Text Area'),
				'3' => Yii::t('app','Drop Down'),
				'4' => Yii::t('app','Radio Button'),
				'5' => Yii::t('app','Check Box'),
				'6' => Yii::t('app','Date Picker'),
				//'7' => Yii::t('app','File Upload'),
				),
            'tab_sub_section' => array(
				'1' => Yii::t('app','Personal Details'),
				'2' => Yii::t('app','Contact Details'),
			),
            'model' => array(
				'Students' => Yii::t('app','Students'),
				'Guardians' => Yii::t('app','Guardians'),
                'StudentPreviousDatas' => Yii::t('app','StudentPreviousDatas'),
                'StudentDocument' => Yii::t('app','StudentDocument'),                                
                
			),
			'required' => array(
				self::REQUIRED_NO => Yii::t('app','No'),				
				self::REQUIRED_YES => Yii::t('app','Yes'),
			),
			'visible' => array(
				self::VISIBLE_ALL => Yii::t('app','For all'),				
				self::VISIBLE_NO => Yii::t('app','Hidden'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
	
//Check whether the fie1d is made visible or not
	public function isVisible($field_name,$model_name,$scope)
	{
		
		if($field_name=="fullname"){
			if($model_name=="Students")
				return $this->isVisible("first_name", $model_name, $scope) || $this->isVisible("middle_name", $model_name, $scope) || $this->isVisible("last_name", $model_name, $scope);
			else if($model_name=="Guardians")
				return $this->isVisible("first_name", $model_name, $scope) || $this->isVisible("last_name", $model_name, $scope);
		}

		$model 	= NULL;
		if($field_name!=NULL and $model_name!=NULL and $scope!=NULL){
			$criteria	= new CDbCriteria;
			$criteria->condition = "`varname`=:varname and `model`=:model";
			$criteria->params = array('varname'=>$field_name,'model'=>$model_name);			
			$model = FormFields::model()->$scope()->find($criteria);				
		}

		if($model != NULL)
			return true;
		else
			return false;
	}

	public function getVisibleFields($model_name, $scope){
		$model = NULL;
		if($model_name!=NULL and $scope!=NULL){
			$criteria	= new CDbCriteria;
			$criteria->condition = "`model`=:model";
			$criteria->params = array('model'=>$model_name);			
			$model = FormFields::model()->$scope()->findAll($criteria);				
		}
		if($model != NULL){
			return CHtml::listData($model, 'id', 'varname');
		}else{
			return array();
		}
	}
        

	public function fieldValues($id){
		$data 		= array();
		$criteria 	= new CDbCriteria;
		$criteria->compare('field_id', $id);
		$values 	= FormFieldData::model()->findAll($criteria);
		if(count($values)>0)
			$data 	= CHtml::listData($values, 'id', 'option_name');
		return $data;
	}

	public function getFieldValue($id){
		$data 	= FormFieldData::model()->findByPk($id);
		if($data!=NULL)
			return $data->option_name;
		else
			return '-';
	}
	
	public function fieldValue($id){
		$criteria 	= new CDbCriteria;
		$criteria->compare('field_id', $id);
		$data 	= FormFieldData::model()->find($criteria);
		if($data!=NULL)
			return $data->id;
		else
			return 0;
	}
	
	public function fieldLabel($id){
		$criteria 	= new CDbCriteria;
		$criteria->compare('field_id', $id);
		$data 	= FormFieldData::model()->find($criteria);
		if($data!=NULL)
			return $data->option_name;
		else
			return "";
	}

	public static function Status($id)
	{
		if($id==1)
		{
			return "Yes";
		}
		else
			return "No";
	}
	
	public function getDynamicFields($tab, $section, $scope){
		$criteria	= new CDbCriteria;
		$criteria->condition	= "`tab_selection`=:tab_selection AND `tab_sub_section`=:tab_sub_section AND `is_dynamic`=:is_dynamic AND `is_exception`=:is_exception";
		$criteria->params		= array(':tab_selection'=>$tab, 'tab_sub_section'=>$section, ':is_dynamic'=>1, ':is_exception'=>0);
		$criteria->order		= "`position` ASC";
		return FormFields::model()->$scope()->findAll($criteria);		
	}
    
    public function getStaticFields($model, $scope){
		$criteria 				= new CDbCriteria;
		$criteria->condition	= "`model`=:model AND `is_dynamic`=:is_dynamic";
		$criteria->params		= array(':model'=>$model, ':is_dynamic'=>0);
		$criteria->order		= "`id` ASC";
		return FormFields::model()->$scope()->findAll($criteria);
	}
	   
        //for generate field name
        public function generateField()
        {
            if($this->title!="" && $this->model!="")
            {
                $string= strtolower($this->title);
                $first= preg_replace('#[^\\/\-a-z\s]#i', '', $string);
                $second=  preg_replace('!\s+!', ' ', $first);
                $third= str_replace(' ', '_', $second);
                $new_string= trim($third,"_");
                $model= $this->model;
                $flag=0;
                $field_array= $model::model()->getTableSchema()->getColumnNames();  
                
                while(in_array($new_string, $field_array))
                {
                    $new_string= FormFields::model()->checkAvailability($new_string,$model);                    
                }                
                $this->varname= $new_string;
                
            }
           
        }
        
        public static function checkAvailability($new_string,$model)
        {
            $field_array= $model::model()->getTableSchema()->getColumnNames();                
            if(in_array($new_string, $field_array))
            {
                $field= $new_string;                        
                $last_char=  substr($field, -1);
                if(is_numeric($last_char))
                {
                    $last_char= $last_char+1;
                    $new_string= substr_replace($field, $last_char, -1);
                }
                else
                {                            
                    $field= $field.+1;
                    $new_string= $field;
                }
                
               return $new_string;
            }
            else
            {
                return $new_string;
            }
        }
}
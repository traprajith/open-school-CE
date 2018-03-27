<?php

class FormFieldsCommon extends CActiveRecord
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
			array('varname, is_exception,form_field_type, title,required, model, is_dynamic', 'required'),
			array('required, position, visible, admin_student_reg_form, online_admission_form, student_profile ,student_profile_pdf, student_portal, parent_portal, teacher_portal, tab_selection, tab_sub_section, order, is_dynamic', 'numerical', 'integerOnly'=>true),
			array('varname, field_type', 'length', 'max'=>50),
                    //    array('varname','unique'),
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
                'condition'=>'online_admission_form=1',
            ),
            'forOnlineRegistration'=>array(
                'condition'=>'admin_student_reg_form=1',
            )
        );
    }
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'varname' => 'Varname',
			'title' => 'Title',
			'field_type' => 'Data Type',
			'field_size' => 'Field Size',
			'field_size_min' => 'Field Size Min',
			'required' => 'Required',
			'match' => 'Match',
			'range' => 'Range',
			'error_message' => 'Error Message',
			'other_validator' => 'Other Validator',
			'default' => 'Default',
			'widget' => 'Widget',
			'widgetparams' => 'Widgetparams',
			'position' => 'Position',
			'visible' => 'Visible',
			'model' => 'Model',
			'label' => 'Label',
			'admin_student_reg_form' => 'Admin Student Reg Form',
			'online_admission_form' => 'Online Admission Form',
			'student_profile_pdf' => 'Student Profile Pdf',
			'student_portal' => 'Student Portal',
			'parent_portal' => 'Parent Portal',
			'teacher_portal' => 'Teacher Portal',
			'form_field_type' => 'Field Type',
			'tab_selection' => 'Tab Selection',
			'tab_sub_section' => 'Tab Sub Section',
			'order' => 'Order',
			'is_dynamic' => 'Is Dynamic',
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
				'1'=>array('1'=>'Personal Details','2'=>'Contact Details'),
				'2'=>array('1'=>'Parent Personal Details','2'=>'Parent Contact Details'),
                                '3'=>array('1'=>'Emergency Contact'),
                                '4'=>array('1'=>'Institution Details'),
                                '5'=>array('1'=>'Document Details'),
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
				'2' => Yii::t('app','Parent Details'),
				'3'=> Yii::t('app','Emergency Contact'),
				'4'=> Yii::t('app','Previous Details'),
                '5'=>Yii::t('app','Student Documents'),
                		
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
	public function isVisible($field_name=NULL,$module_name=NULL,$action_name=NULL)
	{
		$model = NULL;
		if($field_name!=NULL and $module_name!=NULL){
			if($module_name == 'onlineadmission'){
				$model = FormFields::model()->findByAttributes(array('varname'=>$field_name,'online_admission_form'=>1,'model'=>'Students'));								
			}
			if($module_name == 'students'){
				$model = FormFields::model()->findByAttributes(array('varname'=>$field_name,'admin_student_reg_form'=>1,'model'=>'Students'));								
			}
		}
		if($model != NULL){
			return true;
		}else{
			return false;
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

	public static function Status($id)
	{
		if($id==1)
		{
			return "Yes";
		}
		else
			return "No";
	}
}
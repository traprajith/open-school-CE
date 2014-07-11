<?php

/**
 * This is the model class for table "employees_subjects".
 *
 * The followings are the available columns in table 'employees_subjects':
 * @property integer $id
 * @property integer $employee_id
 * @property integer $subject_id
 */
class EmployeesSubjects extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EmployeesSubjects the static model class
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
		return 'employees_subjects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_id, subject_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, employee_id, subject_id', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'employee_id' => 'Employee',
			'subject_id' => 'Subject',
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
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('subject_id',$this->subject_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function Employeenotassigned($id,$sub)
	{
		    $results=array();
			$emp=Employees::model()->findAllByAttributes(array('employee_department_id'=>$id));
			if($emp!=NULL)
			{
				$i=0;
				foreach($emp as $emp1)
				{
					if(EmployeesSubjects::model()->findByAttributes(array('employee_id'=>$emp1->id,'subject_id'=>$sub))==NULL)
					{
						$results[$i] = $emp1;
						$i++;
					}
					
				}
			}
			return $results;
	}
}
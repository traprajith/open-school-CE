<?php

/**
 * This is the model class for table "academic_years".
 *
 * The followings are the available columns in table 'academic_years':
 * @property integer $id
 * @property string $name
 * @property string $start
 * @property string $end
 * @property string $description
 * @property integer $status
 */
class AcademicYears extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AcademicYears the static model class
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
		return 'academic_years';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start, end, description, status', 'required'),
			array('status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>120),
			array('description', 'length', 'max'=>255),
			array('start', 'check'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, start, end, description, status, is_deleted', 'safe', 'on'=>'search'),
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
			'id' => Yii::t("app",'ID'),
			'name' => Yii::t("app",'Name'),
			'start' => Yii::t("app",'Starts On'),
			'end' => Yii::t("app",'Ends On'),
			'description' => Yii::t("app",'Description'),
			'status' => Yii::t("app",'Status'),
			'is_deleted' => Yii::t("app",'Is Deleted')
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function convertStart($data,$row)
	{ 
		if($data->start != null)
		{
			
			$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
			if($settings!=NULL)
			{	
				$data->start = date($settings->displaydate,strtotime($data->start));
				

			}
			
			return $data->start;
		}
		else
		{
				return '-';
		}
		
	}
	
	public function convertEnd($data,$row)
	{ 
		if($data->end != null)
		{
			
			$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
			if($settings!=NULL)
			{	
				$data->end = date($settings->displaydate,strtotime($data->end));
				

			}
			
			return $data->end;
		}
		else
		{
				return '-';
		}
		
	}
	
	public function check($attribute,$params)
	{		
            if($this->start!='' and $this->end!='')
            {
                if($this->start > $this->end)
                {
                        $this->addError($attribute,Yii::t("app",'Start date should be less than End date'));
                }
            }
	}
}
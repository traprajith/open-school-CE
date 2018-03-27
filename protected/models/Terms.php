<?php

/**
 * This is the model class for table "terms".
 *
 * The followings are the available columns in table 'terms':
 * @property integer $id
 * @property integer $term_id
 * @property integer $academic_yr_id
 * @property string $start_date
 * @property string $end_date
 */
class Terms extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Terms the static model class
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
		return 'terms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		if(Yii::app()->controller->action->id == 'create')
		{
			return array(
				array('term_id, academic_yr_id, start_date, end_date', 'required'),
				array('term_id, academic_yr_id', 'numerical', 'integerOnly'=>true),
				array('academic_yr_id', 'checkterm'),
				array('start_date', 'checkstartdate'),
				array('start_date', 'checkacademicyrstart'),
				array('end_date', 'checkacademicyrend'),
				array('start_date', 'checkinsidetermstart'),
				array('end_date', 'checkinsidetermend'),
				//array('start_date', 'checkdaterangestart'),
				//array('end_date', 'checkdaterangeend'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, term_id, academic_yr_id, start_date, end_date', 'safe', 'on'=>'search'),
			);
		}
		
		if(Yii::app()->controller->action->id == 'update')
		{
			return array(
				array('term_id, academic_yr_id, start_date, end_date', 'required'),
				array('term_id, academic_yr_id', 'numerical', 'integerOnly'=>true),
				array('start_date', 'checkstartdate'),
				array('start_date', 'checkacademicyrstart'),
				array('end_date', 'checkacademicyrend'),
				array('start_date', 'checkinsidetermstart'),
				array('end_date', 'checkinsidetermend'),
				array('id, term_id, academic_yr_id, start_date, end_date', 'safe', 'on'=>'search'),
			);
		}
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
			'term_id' => 'Term Name',
			'academic_yr_id' => 'Academic Year',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
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
		$criteria->compare('term_id',$this->term_id);
		$criteria->compare('academic_yr_id',$this->academic_yr_id);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function checkterm($attribute,$params)
	{		
            if($this->term_id!='')
            {
                $terms= Terms::model()->findByAttributes(array('term_id'=>$this->term_id,'academic_yr_id'=>$this->academic_yr_id));
                if($terms!=NULL)
                {
                        $this->addError($attribute,Yii::t("app",'Term Already created for this Academic Year'));
                }
            }
	}
	
	public function checkstartdate($attribute,$params)
	{		
            if($this->start_date!='')
            {
                if($this->start_date > $this->end_date)
                {
                        $this->addError($attribute,Yii::t("app",'Start date should be less than End date'));
                }
            }
	}
	
	public function checkacademicyrstart($attribute,$params) //checking start date is after academic year start date
	{	
	 if($this->academic_yr_id!='')	
	 {
		 $year = AcademicYears::model()->findByAttributes(array('id'=>$this->academic_yr_id));
		 $start = $year->start;
		 $start_date=substr($start, 0, 4); 
		 
	 }
            if($this->start_date!='')
            {
                if($this->start_date < $start_date)
                {
					   $this->addError($attribute,Yii::t("app",'Start date must be inside Academic year'));
                }
            }
			 
	}
	
	public function checkacademicyrend($attribute,$params) //checking end date is before academic year end date
	{	
	 if($this->academic_yr_id!='')	
	 {
		 $year = AcademicYears::model()->findByAttributes(array('id'=>$this->academic_yr_id));
		 $end = $year->end;
		 
	 }
            if($this->end_date!='')
            {
                if($this->end_date > $end)
                {
                        $this->addError($attribute,Yii::t("app",'End date must be inside Academic year'));
                }
            }
			 
	}
	
	public function checkinsidetermstart($attribute,$params) //checking end date is before academic year end date
	{	
		 if($this->term_id!='' and $this->academic_yr_id!='')	
		 {
			 if($this->term_id == 1)
			 	$term_id	=	2;
			 else
			 	$term_id	=	1;
			 $terms = Terms::model()->findByAttributes(array('term_id'=>$term_id,'academic_yr_id'=>$this->academic_yr_id));
			 $start_date = $terms->start_date;
			 $end_date = $terms->end_date;
		 }
		if($this->start_date!='')
		{
			if(($this->start_date >= $start_date and   $this->start_date <= $end_date) or 
			($this->start_date < $start_date and $this->end_date > $start_date))
			{
					$this->addError($attribute,Yii::t("app",'Term start date overlaps'));
			}
			
		}
		
			 
	}
	
	public function checkinsidetermend($attribute,$params) //checking end date is before academic year end date
	{	
		 if($this->term_id!='' and $this->academic_yr_id!='')	
		 {
			 if($this->term_id == 1)
			 	$term_id	=	2;
			 else
			 	$term_id	=	1;
			 $terms = Terms::model()->findByAttributes(array('term_id'=>$term_id,'academic_yr_id'=>$this->academic_yr_id));
			 $start_date = $terms->start_date;
			 $end_date = $terms->end_date;
		 }
		if($this->end_date!='')
		{
			
			if(($this->end_date >= $start_date and  $this->end_date <= $end_date))
			{
					$this->addError($attribute,Yii::t("app",'Term end date overlaps'));
			}
		}
			 
	}
	
	public function checkdaterangestart($attribute,$params)
	{		
            if($this->start_date!='' and $this->end_date!='')
            {
				$terms = Terms::model()->findAll();
				if($terms){
					foreach($terms as $term){
						if($this->start_date >= $term->start_date or $this->start_date <= $term->end_date)
						{
								$this->addError($attribute,Yii::t("app",'Start date overlaps some other Term range'));
						}
					}
				}
            }
	}
	public function checkdaterangeend($attribute,$params)
	{		
            if($this->start_date!='' and $this->end_date!='')
            {
				$terms = Terms::model()->findAll();
				if($terms){
					foreach($terms as $term){
						if($this->end_date <= $term->end_date or $this->end_date >= $term->start_date)
						{
								$this->addError($attribute,Yii::t("app",'End date overlaps some other Term range'));
						}
					}
				}
            }
	}
	
	
}
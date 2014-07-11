<?php

/**
 * This is the model class for table "events_type".
 *
 * The followings are the available columns in table 'events_type':
 * @property integer $id
 * @property string $name
 * @property string $colour_code
 */
class EventsType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EventsType the static model class
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
		return 'events_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, colour_code', 'length', 'max'=>120),
			array('name, colour_code', 'required'),
			array('name','unique'),
			array('colour_code','check'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, colour_code', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'colour_code' => 'Colour Code',
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
		$criteria->compare('colour_code',$this->colour_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function check($attribute,$params)
    {
		if(!preg_match('/^#[a-f0-9]{6}$/i', $attribute))
        {
			$this->addError($attribute,'Enter valid color hex code');
		}
		
    }
	
	function color($data,$row)
	{
		
		$color = $data->colour_code.' <span style="background-color:'.$data->colour_code.';">&nbsp;&nbsp;&nbsp;<span>';	
		echo $color;
	}
	
	
	
	
	
	
}
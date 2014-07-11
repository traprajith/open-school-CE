<?php

/**
 * This is the model class for table "finance_fee_collections".
 *
 * The followings are the available columns in table 'finance_fee_collections':
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $due_date
 * @property integer $fee_category_id
 * @property integer $batch_id
 * @property integer $is_deleted
 */
class FinanceFeeCollections extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FinanceFeeCollections the static model class
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
		return 'finance_fee_collections';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fee_category_id, batch_id, is_deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>25),
			array('start_date, end_date, due_date', 'safe'),
			array('fee_category_id, name, start_date, end_date, due_date','required'),
			array('name','CRegularExpressionValidator', 'pattern'=>'/^[A-Za-z_ ]+$/','message'=>"{attribute} should contain only letters."),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, start_date, end_date, due_date, fee_category_id, batch_id, is_deleted', 'safe', 'on'=>'search'),
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
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'due_date' => 'Due Date',
			'fee_category_id' => 'Fee Category',
			'batch_id' => 'Batch',
			'is_deleted' => 'Is Deleted',
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
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('fee_category_id',$this->fee_category_id);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function convertDate($model,$str)
        {               
        echo $str;
		
                if($str != null)
                {
								$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$str=date($settings->displaydate,strtotime($str));
									echo $date1;
		
								}
								

                        
                }
                else
                {
                        $str = '';
                }
                
                return $str;
        }
		
	public function feecategory($data,$row){
		$fees_category=FinanceFeeCategories::model()->findByAttributes(array('id'=>$data->fee_category_id,'is_deleted'=>0));
		if(count($fees_category)>0){
			return $fees_category->name;
		}
		else{
			return '-';
		}
	}
	
	public function batchname($data,$row){
		$batch_name=Batches::model()->findByAttributes(array('id'=>$data->batch_id,'is_deleted'=>0));
		if(count($batch_name)>0){
			return $batch_name->name;
		}
		else{
			return '-';
		}
	}
        
}
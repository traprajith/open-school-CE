<?php

/**
 * This is the model class for table "logo".
 *
 * The followings are the available columns in table 'logo':
 * @property integer $id
 * @property string $photo_file_name
 * @property string $photo_content_type
 * @property string $photo_file_size
 * @property string $photo_data
 */
class Logo extends CActiveRecord
{
	public $uploadedFile;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Logo the static model class
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
		return 'logo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('photo_file_name, photo_content_type, photo_file_size, photo_data', 'required'),
			array('photo_file_name, photo_content_type, photo_file_size', 'length', 'max'=>120),
			array('uploadedFile', 'file', 'types'=>'jpg, png','maxSize'=>1024*60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, photo_file_name, photo_content_type, photo_file_size, photo_data', 'safe', 'on'=>'search'),
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
			'photo_file_name' => Yii::t("app",'Photo File Name'),
			'photo_content_type' => Yii::t("app",'Photo Content Type'),
			'photo_file_size' => Yii::t("app",'Photo File Size'),
			'photo_data' => Yii::t("app",'Photo Data'),
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
		$criteria->compare('photo_file_name',$this->photo_file_name,true);
		$criteria->compare('photo_content_type',$this->photo_content_type,true);
		$criteria->compare('photo_file_size',$this->photo_file_size,true);
		$criteria->compare('photo_data',$this->photo_data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getLogo()
        {
            $criteria=new CDbCriteria;
            $criteria->order='id DESC';
            $logo=Logo::model()->findAll($criteria);
            $flag=0;
            $i=0;
            if($logo!=NULL)
            {
                while($i<=count($logo) && $flag==0)
                {                    
                    if(DocumentUploads::model()->fileStatus(7, $logo[$i]->id, $logo[$i]->photo_file_name)==true && $flag==0)
                    {                                                            
                        return array('1'=>$logo[$i]->id,'2'=>$logo[$i]->photo_file_name);
                        $flag=1;
                    }
                    $i= $i+1;
                }
            }
            else if($flag==0)
            {
                return NULL;
            }
        }
}
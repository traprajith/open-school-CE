<?php

/**
 * This is the model class for table "themes".
 *
 * The followings are the available columns in table 'themes':
 * @property integer $id
 * @property integer $user_id
 * @property string $topbar_background
 * @property string $topbar_background_text
 * @property string $topbar_message
 * @property string $topbar_account_background
 * @property string $topbar_account_color
 * @property string $body_background
 * @property string $search_background
 * @property string $search_color
 * @property string $menu_background
 * @property string $menu_border
 * @property string $menu_text_color
 * @property string $menu_active_background
 * @property string $menu_active_color
 * @property string $breadcrumbs_background
 * @property string $breadcrumbs_color
 */
class Themes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Themes the static model class
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
		return 'themes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('topbar_background, topbar_background_text, topbar_message, topbar_account_background, topbar_account_color, body_background, search_background, search_color, menu_background, menu_border, menu_text_color, menu_active_background, menu_active_color, breadcrumbs_background, breadcrumbs_color', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, topbar_background, topbar_background_text, topbar_message, topbar_account_background, topbar_account_color, body_background, search_background, search_color, menu_background, menu_border, menu_text_color, menu_active_background, menu_active_color, breadcrumbs_background, breadcrumbs_color', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('app','ID'),
			'user_id' => Yii::t('app','User'),
			'topbar_background' => Yii::t('app','Topbar Background'),
			'topbar_background_text' => Yii::t('app','Topbar Background Text'),
			'topbar_message' => Yii::t('app','Topbar Message'),
			'topbar_account_background' => Yii::t('app','Topbar Account Background'),
			'topbar_account_color' => Yii::t('app','Topbar Account Color'),
			'body_background' => Yii::t('app','Body Background'),
			'search_background' =>Yii::t('app', 'Search Background'),
			'search_color' => Yii::t('app','Search Color'),
			'menu_background' => Yii::t('app','Menu Background'),
			'menu_border' => Yii::t('app','Menu Border'),
			'menu_text_color' => Yii::t('app','Menu Text Color'),
			'menu_active_background' =>Yii::t('app', 'Menu Active Background'),
			'menu_active_color' => Yii::t('app','Menu Active Color'),
			'breadcrumbs_background' => Yii::t('app','Breadcrumbs Background'),
			'breadcrumbs_color' =>Yii::t('app', 'Breadcrumbs Color'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('topbar_background',$this->topbar_background,true);
		$criteria->compare('topbar_background_text',$this->topbar_background_text,true);
		$criteria->compare('topbar_message',$this->topbar_message,true);
		$criteria->compare('topbar_account_background',$this->topbar_account_background,true);
		$criteria->compare('topbar_account_color',$this->topbar_account_color,true);
		$criteria->compare('body_background',$this->body_background,true);
		$criteria->compare('search_background',$this->search_background,true);
		$criteria->compare('search_color',$this->search_color,true);
		$criteria->compare('menu_background',$this->menu_background,true);
		$criteria->compare('menu_border',$this->menu_border,true);
		$criteria->compare('menu_text_color',$this->menu_text_color,true);
		$criteria->compare('menu_active_background',$this->menu_active_background,true);
		$criteria->compare('menu_active_color',$this->menu_active_color,true);
		$criteria->compare('breadcrumbs_background',$this->breadcrumbs_background,true);
		$criteria->compare('breadcrumbs_color',$this->breadcrumbs_color,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
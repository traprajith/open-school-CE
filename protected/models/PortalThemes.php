<?php

/**
 * This is the model class for table "student_portal_theme".
 *
 * The followings are the available columns in table 'student_portal_theme':
 * @property integer $id
 * @property integer $user_id
 * @property string $header_logo_background
 * @property string $header_bar_background
 * @property string $header_border
 * @property string $header_dropdown_background
 * @property string $header_dropdown_text
 * @property string $header_dropdown_over
 * @property string $header_text_color
 * @property string $page_header_background
 * @property string $page_header_text
 * @property string $left_panel_background
 * @property string $left_panel_text
 * @property string $left_panel_over_background
 * @property string $left_panel_over_text
 * @property string $left_panel_active_background
 * @property string $left_panel_active_text
 * @property string $main_panel_background
 */
class PortalThemes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return StudentPortalTheme the static model class
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
		return 'portal_themes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('header_logo_background, header_border, header_dropdown_background, header_dropdown_text, header_dropdown_over, header_text_color, page_header_background, page_header_text, left_panel_background, left_panel_text, left_panel_over_background, left_panel_over_text, left_panel_active_background, left_panel_active_text, main_panel_background', 'length', 'max'=>10),
			array('header_bar_background', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, header_logo_background, header_bar_background, header_border, header_dropdown_background, header_dropdown_text, header_dropdown_over, header_text_color, page_header_background, page_header_text, left_panel_background, left_panel_text, left_panel_over_background, left_panel_over_text, left_panel_active_background, left_panel_active_text, main_panel_background', 'safe', 'on'=>'search'),
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
                        'header_logo_background'=>  Yii::t('app', 'Header Logo Background'),
			'header_bar_background' => Yii::t('app','Header Bar Background'),
			'header_border' => Yii::t('app','Header Border'),
			'header_dropdown_background' => Yii::t('app','Header Dropdown Background'),
			'header_dropdown_text' => Yii::t('app','Header Dropdown Text'),
			'header_dropdown_over' => Yii::t('app','Header Dropdown Over'),
			'header_text_color' => Yii::t('app','Header Text Color'),
			'page_header_background' => Yii::t('app','Page Header Background'),
			'page_header_text' => Yii::t('app','Page Header Text'),
			'left_panel_background' => Yii::t('app','Left Panel Background'),
			'left_panel_text' => Yii::t('app','Left Panel Text'),
			'left_panel_over_background' => Yii::t('app','Left Panel Over Background'),
			'left_panel_over_text' => Yii::t('app','Left Panel Over Text'),
			'left_panel_active_background' => Yii::t('app','Left Panel Active Background'),
			'left_panel_active_text' => Yii::t('app','Left Panel Active Text'),
			'main_panel_background' => Yii::t('app','Main Panel Background'),
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
		$criteria->compare('header_logo_background',$this->header_logo_background,true);
		$criteria->compare('header_bar_background',$this->header_bar_background,true);
		$criteria->compare('header_border',$this->header_border,true);
		$criteria->compare('header_dropdown_background',$this->header_dropdown_background,true);
		$criteria->compare('header_dropdown_text',$this->header_dropdown_text,true);
		$criteria->compare('header_dropdown_over',$this->header_dropdown_over,true);
		$criteria->compare('header_text_color',$this->header_text_color,true);
		$criteria->compare('page_header_background',$this->page_header_background,true);
		$criteria->compare('page_header_text',$this->page_header_text,true);
		$criteria->compare('left_panel_background',$this->left_panel_background,true);
		$criteria->compare('left_panel_text',$this->left_panel_text,true);
		$criteria->compare('left_panel_over_background',$this->left_panel_over_background,true);
		$criteria->compare('left_panel_over_text',$this->left_panel_over_text,true);
		$criteria->compare('left_panel_active_background',$this->left_panel_active_background,true);
		$criteria->compare('left_panel_active_text',$this->left_panel_active_text,true);
		$criteria->compare('main_panel_background',$this->main_panel_background,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
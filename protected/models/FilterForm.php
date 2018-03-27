<?php

/**
 * UserRecoveryForm class.
 * UserRecoveryForm is the data structure for keeping
 * user recovery form data. It is used by the 'recovery' action of 'UserController'.
 */
class FilterForm extends CFormModel {
	public $type,$date, $month,$range_from,$range_to;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			
		);
	}
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'type'=>Yii::t("app",'Type'),
			'date'=>Yii::t("app",'Date'),
			'month'=>Yii::t("app",'Month'),
			'range_from'=>Yii::t("app",'Date From'),
			'range_to'=>Yii::t("app",'Date To'),
		);
	}
	
	
	
}
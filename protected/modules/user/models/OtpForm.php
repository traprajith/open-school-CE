<?php


class OtpForm extends CFormModel
{
	public $otp;
	
        
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
            
            return array(
                   array('otp', 'length', 'max'=>255),  
                   array('otp','required'),
                    array('otp','check'),
            );
                       
	}

	public function check($attribute,$params)
        {
            $model= UserOtpDetails::model()->findByAttributes(array('key'=>$_REQUEST['key']));
            if($model!=NULL)
            {
                $otp_log_time = strtotime($model->created_at);
                $current_time = strtotime(date("Y-m-d H:i:s"));
                $interval  = abs($current_time - $otp_log_time);
                $minutes   = round($interval / 60);
                
                if($model->otp!=$this->otp)
                {
                    $this->addError($attribute, Yii::t('app',"Invalid OTP"));
                }
                if($minutes>5)
                {
                    $this->addError($attribute, Yii::t('app',"Time expired"));
                }
            }
            else
            {
                $this->addError($attribute, Yii::t('app',"Invalid OTP"));
            }
            
        }
        
	public function attributeLabels()
	{
		return array(
			'otp'=>Yii::t('app',"OTP"),
			
		);
	}

	
}

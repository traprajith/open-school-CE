<?php

class PaypalForm extends CFormModel
{
    public $amount;
 
    public function rules()
    {
        return array(
        	array('amount', 'required'),
            array('amount', 'type', 'type'=>'float', 'message'=>Yii::t('app', '{attribute} must be a valid number')),
			array('amount', 'validAmount'),
        );
    }
	
	public function validAmount(){
		$amount_payable		= FeesInvoices::model()->getAmountPayable($_REQUEST['id']);
		if($this->amount>$amount_payable){
			$this->addError("amount", Yii::t("app", "Amount must be lessthan or equal to amount payable"));
		}
	}
}
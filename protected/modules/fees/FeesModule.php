<?php

class FeesModule extends CWebModule
{
	public $defaultController	= 'dashboard';
	public $invoice_templates;
	public $subjectMaxCharsDisplay = 100;
	public $ellipsis = '...';
	public $allowableCharsSubject = '0-9a-z.,!?@\s*$%#&;:+=_(){}\[\]\/\\-';
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'fees.models.*',
			'fees.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		$roles	= Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role		
		foreach($roles as $role){
			if(sizeof($roles)==1 and $role->name == 'parent')
				$controller->layout='application.views.portallayouts.none';
		}
		
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	public function sendInvoicesForNewStudent($id){
		$student	= Students::model()->findByPk($id);	
		if($student!=NULL){
			//check if already send invoice
			$criteria				= new CDbCriteria;
			$criteria->condition	= '`user_type`=:type AND `table_id`=:sid';
			$criteria->params		= array(':type'=>1, ':sid'=>$student->id);
			$found					= FeeInvoices::model()->find($criteria);
			if($found==NULL){
				$batch					= Batches::model()->findByPk($student->batch_id);
				$course					= ($batch!=NULL)?Courses::model()->findByPk($batch->course_id):NULL;
				$criteria				= new CDbCriteria;
				$criteria->join			= 'JOIN `fee_particulars` `fp` ON `fp`.`fee_id`=`t`.`id` JOIN `fee_particular_access` `fpa` ON `fpa`.`particular_id`=`fp`.`id`';
				$criteria->condition	= '(`fpa`.`access_type`=:type1 AND (`fpa`.`course`=:course OR `fpa`.`batch`=:batch)) OR (`fpa`.`access_type`=:type2 AND `fpa`.`admission_no`=:admission_no)';
				$criteria->params		= array(':type1'=>1, ':type2'=>2, ':course'=>($course!=NULL)?$course->id:NULL, ':batch'=>$student->batch_id, ':admission_no'=>$student->admission_no);
				$categories				= FeeCategories::model()->findAll($criteria);
			
				foreach($categories as $category){
					//fetch particulars
					$criteria		= new CDbCriteria;
					$criteria->compare("fee_id", $category->id);
					$particulars	= FeeParticulars::model()->findAll($criteria);
					
					$invoices		= array();
				
					if($category->invoice_generated==1){
						foreach($particulars as $particular){
							//accesses
							$criteria	= new CDbCriteria;
							$criteria->compare("particular_id", $particular->id);
							$accesses	= FeeParticularAccess::model()->findAll($criteria);
							foreach($accesses as $access){											
								switch($access->access_type){
									case 1:
										$students		= array();
										//course , batch , student category
										if($access->student_category_id==$student->student_category_id){
											if($course!=NULL and $access->course==$course->id){
												if($access->batch==$batch->id){
													// $priority - 2
													$priority		= 2;
												}
												else{
													// $priority - 3
													$priority		= 3;
												}
											}
											else{
												// $priority - 4
												$priority		= 4;
											}
										}
										else{	// all categories
											if($course!=NULL and $access->course==$course->id){
												if($access->batch==$batch->id){
													// $priority - 5
													$priority		= 5;
												}
												else{
													// $priority - 6
													$priority		= 6;
												}
											}
											else{
												// $priority - 7
												$priority		= 7;
											}
										}
										
										//if students are there in current access group							
										if((!isset($invoices[$student->id][$particular->id]['priority'])) or (isset($invoices[$student->id][$particular->id]['priority']) and $invoices[$student->id][$particular->id]['priority']>$priority)){	
											$invoices[$student->id]['uid']				= $student->uid;
											$invoices[$student->id]['user_type']		= 1;	//student
											$invoices[$student->id][$particular->id]	= array(
												'access_id'=>$access->id,
												'priority'=>$priority
											);
										}
									break;
									
									case 2:
										// check by admission number
										// $priority - 1
										$priority	= 1;
										if($access->admission_no==$student->admission_no){
											$invoices[$student->id]['uid']				= $student->uid;
											$invoices[$student->id]['user_type']		= 1;	//student
											$invoices[$student->id][$particular->id]	= array(
												'access_id'=>$access->id,
												'priority'=>$priority
											);
										}
									break;
								}
							}
						}
					
						//check if there is students in the current category
						if(count($invoices)>0){				
							//subscriptions
							$subscriptions	= FeeSubscriptions::model()->findAllByAttributes(array('fee_id'=>$category->id));
							//generate invoices here
							foreach($invoices as $id=>$invoice){	//repeat each invoice for each student
								foreach($subscriptions as $subscription){	//repeat for due dates
									$feeinvoice	= new FeeInvoices;
									$feeinvoice->academic_year_id	= $category->academic_year_id;
									$feeinvoice->uid				= $invoice['uid'];						
									$feeinvoice->user_type			= $invoice['user_type'];
									$feeinvoice->table_id			= $id;						
									$feeinvoice->fee_id				= $category->id;
									$feeinvoice->subscription_id	= $subscription->id;
									$feeinvoice->name				= $category->name;
									$feeinvoice->description		= $category->description;
									$feeinvoice->subscription_type	= $category->subscription_type;
									$feeinvoice->start_date			= $category->start_date;
									$feeinvoice->end_date			= $category->end_date;
									$feeinvoice->due_date			= $subscription->due_date;
									$feeinvoice->created_at			= date("Y-m-d h:i:s");
									$feeinvoice->created_by			= Yii::app()->user->id;
									
									if($feeinvoice->save()){
										$total_amount	= 0;					
										//save particulars for this invoice
										foreach($invoice as $particular_id=>$access){
											if(isset($access['access_id'])){
												$particular			= FeeParticulars::model()->findByPk($particular_id);
												$particular_access	= FeeParticularAccess::model()->findByPk($access['access_id']);
												if($particular!=NULL and $particular_access!=NULL){
													$invoiceparticular	= new FeeInvoiceParticulars;
													$invoiceparticular->invoice_id		= $feeinvoice->id;
													$invoiceparticular->name			= $particular->name;
													$invoiceparticular->description		= $particular->description;											
													$invoiceparticular->tax				= $particular->tax;
													$invoiceparticular->discount_value	= $particular->discount_value;
													$invoiceparticular->discount_type	= $particular->discount_type;											
													$invoiceparticular->amount			= $particular_access->amount;
													if($invoiceparticular->save()){
														$amount	= $invoiceparticular->amount;
														//apply discount
														if($invoiceparticular->discount_type==1){	//percentage
															$amount	= $invoiceparticular->amount - (($invoiceparticular->amount * $invoiceparticular->discount_value)/100);
														}
														else if($invoiceparticular->discount_type==2){	//amount
															$amount	= $invoiceparticular->amount - $invoiceparticular->discount_value;
														}
														
														//apply tax
														if($invoiceparticular->tax!=0){
															$tax	= FeeTaxes::model()->findByPk($invoiceparticular->tax);
															if($tax!=NULL){
																$amount	= $amount + (($amount * $tax->value)/100);
															}
														}
														
														$total_amount	+= $amount;
													}
												}
											}
										}						
										//save total amount
										$feeinvoice->total_amount	= $total_amount;
										if($feeinvoice->save()){
											//send Email, SMS and Internal Message
											$this->sendInvoiceAsEmail($feeinvoice->id);
											$this->sendInvoiceAsSms($feeinvoice->id);
											$this->sendInvoiceAsMessage($feeinvoice->id);
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	
	public function sendInvoiceAsEmail($id){
		$feeinvoice		= FeeInvoices::model()->findByPk($id);
		$notification 	= NotificationSettings::model()->findByPk(8);
		$college		= Configurations::model()->findByPk(1);
		$email_template = EmailTemplates::model()->findByPk(28);	// fee invoice email template
		$guardian		= NULL;
		if($notification!=NULL and $notification->parent_1==1 and $notification->mail_enabled == 1 and $feeinvoice->user_type==1){
			$guardian	= Students::model()->getPrimaryGuardian($feeinvoice->table_id);
			if($guardian!=NULL and $guardian->email!=NULL){
				$subject 	= $email_template->subject;
				$message 	= $email_template->template;
				$subject 	= str_replace("{{SCHOOL NAME}}", $college->config_value, $subject);							
				$message 	= str_replace("{{SCHOOL NAME}}", $college->config_value, $message);
				
				$criteria			= new CDbCriteria;
				$criteria->compare("invoice_id", $feeinvoice->id);
				$particulars		= FeeInvoiceParticulars::model()->findAll($criteria);			
				$invoice_details	= Yii::app()->controller->renderPartial("application.modules.fees.views.invoices.email.template", array('invoice'=>$feeinvoice, 'particulars'=>$particulars, 'guardian'=>$guardian), true);
				
				$message 			= str_replace("{{INVOICE DETAILS}}", $invoice_details, $message);
				
				UserModule::sendMail($guardian->email, $subject, $message);
			}
		}
	}
	
	public function sendInvoiceAsSms($id){
		$feeinvoice		= FeeInvoices::model()->findByPk($id);
		$notification 	= NotificationSettings::model()->findByPk(8);
		$college		= Configurations::model()->findByPk(1);
		$sms_template 	= SystemTemplates::model()->findByPk(39);	// fee invoice sms template
		$guardian		= NULL;
		if($notification!=NULL and $notification->parent_1==1 and $notification->sms_enabled == 1 and $feeinvoice->user_type==1){	// student
			$guardian	= Students::model()->getPrimaryGuardian($feeinvoice->table_id);
			if($guardian!=NULL and $guardian->mobile_phone!=NULL){
				$message 	= $sms_template->template;
				$message 	= str_replace("<School Name>", $college->config_value, $message);
				SmsSettings::model()->sendSms($guardian->mobile_phone, $college->config_value, $message);
			}
		}
	}
	
	public function sendInvoiceAsMessage($id){
		$feeinvoice		= FeeInvoices::model()->findByPk($id);
		$notification 	= NotificationSettings::model()->findByPk(8);
		$guardian		= NULL;
		if($notification!=NULL and $notification->parent_1==1 and $notification->msg_enabled == 1 and $feeinvoice->user_type==1){	// student
			$guardian	= Students::model()->getPrimaryGuardian($feeinvoice->table_id);
			if($guardian!=NULL and $guardian->uid!=NULL){
				$to   		= $guardian->uid;
				$subject  	= Yii::t('app','Invoice Generated');
				$message  	= Yii::t('app','Fees Invoice is generated. Please check your fees dashboard/email.');
				$message	.= "<br />".Yii::t('app', 'Fee Category')." : ".$feeinvoice->name;
				NotificationSettings::model()->sendMessage($to,$subject,$message);  
			}
		}
	}
}

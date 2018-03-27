<?php

class NewsController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Publish;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Publish']))
		{
			$model->attributes = $_POST['Publish'];
			$model->created_at = date('Y-m-d');
			$model->author_id  = Yii::app()->user->id;
			
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Publish']))
		{
			$model->attributes=$_POST['Publish'];
			$model->updated_at = date('Y-m-d H:i:s');
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest){
			$this->loadModel($id)->delete();
			$this->redirect(array('admin'));
		}
		else
			throw new CHttpException(404,Yii::t('app','Invalid Request'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if(Yii::app()->request->isPostRequest){
		$dataProvider=new CActiveDataProvider('Publish');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		}
		else
		{
			throw new CHttpException(404,Yii::t('app','Invalid Request'));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$cs = Yii::app()->clientScript;
		$cs->scriptMap['menu.js'] = false;
		$criteria=new CDbCriteria;
		$criteria->order = 'created_at DESC';
		
		$model=Publish::model()->findAll($criteria);
		$this->render('admin',array(
			'news'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Publish::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('app','The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionPublish($id)
	{
		if(Yii::app()->request->isPostRequest){
		
			$news=Publish::model()->findByPk($id);
			//saving is_published as 1.
			$result = $this->send_mail('news@example.com',$news->title,$news->content);
						
			if($result == 'success')
				$this->loadModel($id)->delete();
			//$news->saveAttributes(array('conversation_id'=>$msg_details[0],'message_id'=>$msg_details[1],'is_published'=>1));
			//$news->saveAttributes(array('is_published'=>1));
			$this->redirect(array('admin'));
		}
		else
		{
			throw new CHttpException(404,Yii::t('app','Invalid Request'));
		}
		
	}
	
	public function send_mail($to,$subject,$message)
	{ 
				
		if(isset($to))
		{
			$t = time();
			$conv = new Mailbox();
			$conv->subject = ($subject)? $subject : Yii::app()->getModule('mailbox')->defaultSubject;
			$conv->to = $to;
			$conv->initiator_id = Yii::app()->getModule('mailbox')->getUserIdMail();

			// Check if username exist
			if(strlen($to)>1)
				$conv->interlocutor_id = Yii::app()->getModule('mailbox')->getUserIdMail($to);
			else
				$conv->interlocutor_id = 0;
			// ...if not check if To field is user id
			if(!$conv->interlocutor_id)
			{
				if($to && (Yii::app()->getModule('mailbox')->allowLookupById || Yii::app()->getModule('mailbox')->isAdmin()))
					$username = Yii::app()->getModule('mailbox')->getUserName($to);
				if(@$username) {
					$conv->interlocutor_id = $to;
					$conv->to = $username;
				}
				else {
					// possible that javscript was off and user selected from the userSupportList drop down.
					if( $this->module->getUserIdMail($to)) {
						
						$conv->to = $to;
						$conv->initiator_id = Yii::app()->getModule('mailbox')->getUserIdMail($to);
					}
					else
					{
						//$err_message = 1;
						$conv->addError('to',Yii::t('app','User not found?'));
					}
				}
			}
			
			if($conv->interlocutor_id && $conv->initiator_id == $conv->interlocutor_id) {
				//$err_message = 2;
				$conv->addError('to', Yii::t('app',"Can't send message to self!"));
			}
			
			if(!ModuleAccess::model()->check('My Account')){
				$conv->addError('to', Yii::t('app',"Don't have permission to send news!"));
				//$err_message = 3;
			}
			
			// check user-to-user perms
			if(!$conv->hasErrors() && !Yii::app()->getModule('mailbox')->userToUser && !Yii::app()->getModule('mailbox')->isAdmin())
			{
				if(!Yii::app()->getModule('mailbox')->isAdmin($conv->to)){
					$conv->addError('to', Yii::t('app',"Invalid user!"));
					$err_message = 4; }
			}
			
			$conv->modified = $t;
			$conv->bm_read = Mailbox::INITIATOR_FLAG;
			if(Yii::app()->getModule('mailbox')->isAdmin())
				$msg = new DashboardMessage('admin');
			else
				$msg = new DashboardMessage('user');
			$msg->text = $message;
			$validate = $conv->validate(array('text'),false); // html purify
			$msg->created = $t;
			$msg->sender_id = $conv->initiator_id;
			$msg->recipient_id = $conv->interlocutor_id;
			if(Yii::app()->getModule('mailbox')->checksums) {
				$msg->crc64 = DashboardMessage::crc64($msg->text); // 64bit INT
			}
			else
				$msg->crc64 = 0;
			// Validate
			$validate = $conv->validate(null,false); // don't clear errors
			$validate = $msg->validate() && $validate;
			if($validate)
			{ 
				$conv->save();
				$msg->conversation_id = $conv->conversation_id;
				$msg->save();
				
				Yii::app()->user->setFlash('notification',Yii::t('app',"News Published"));
				//Yii::app()->user->setFlash('success', "Message has been sent!");
				//$this->redirect(array('message/inbox'));
				return 'success'; 
				//return array($conv->conversation_id,$msg->message_id);
			}
			else
			{
				//Yii::app()->user->setFlash('error', "Error sending message!");
				Yii::app()->user->setFlash('notification', $err_message);
				return 'error';
			}
		}
	}
}

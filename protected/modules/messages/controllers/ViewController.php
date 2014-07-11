<?php

class ViewController extends RController {

	public $defaultAction = 'view';

	public function actionView() {
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = Message::model()->findByPk($messageId);

		if (!$viewedMessage) {
			 throw new CHttpException(404, MessageModule::t('Message not found'));
		}

		$userId = Yii::app()->user->getId();

		if ($viewedMessage->sender_id != $userId && $viewedMessage->receiver_id != $userId) {
		    throw new CHttpException(403, MessageModule::t('You can not view this message'));
		}
		if (($viewedMessage->sender_id == $userId && $viewedMessage->deleted_by == Message::DELETED_BY_SENDER)
		    || $viewedMessage->receiver_id == $userId && $viewedMessage->deleted_by == Message::DELETED_BY_RECEIVER) {
		    throw new CHttpException(404, MessageModule::t('Message not found'));
		}
		$message = new Message();

		$isIncomeMessage = $viewedMessage->receiver_id == $userId;
		if ($isIncomeMessage) {
		    $message->subject = preg_match('/^Re:/',$viewedMessage->subject) ? $viewedMessage->subject : 'Re: ' . $viewedMessage->subject;
			$message->receiver_id = $viewedMessage->sender_id;
		} else {
			$message->receiver_id = $viewedMessage->receiver_id;
		}

		if (Yii::app()->request->getPost('Message')) {
			$message->attributes = Yii::app()->request->getPost('Message');
			$message->sender_id = $userId;
			if ($message->save()) {
				Yii::app()->user->setFlash('success', MessageModule::t('Message has been sent'));
			    if ($isIncomeMessage) {
					$this->redirect($this->createUrl('inbox/'));
			    } else {
					$this->redirect($this->createUrl('sent/'));
				}
			}
		}

		if ($isIncomeMessage) {
			$viewedMessage->markAsRead();
		}

		$this->render(Yii::app()->getModule('message')->viewPath . '/view', array('viewedMessage' => $viewedMessage, 'message' => $message));
	}

}

<?php

class SentController extends RController
{
	public $defaultAction = 'sent';

	public function actionSent() {
		$messagesAdapter = Message::getAdapterForSent(Yii::app()->user->getId());
		$pager = new CPagination($messagesAdapter->totalItemCount);
		$pager->pageSize = 10;
		$messagesAdapter->setPagination($pager);

		$this->render(Yii::app()->getModule('message')->viewPath . '/sent', array(
			'messagesAdapter' => $messagesAdapter
		));
	}
}

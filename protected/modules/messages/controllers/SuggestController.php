<?php

class SuggestController extends RController {

	public function actionUser() {
		$q = Yii::app()->request->getParam('name_startsWith');
		$userModels = (array) call_user_func(array(
			CActiveRecord::model(Yii::app()->getModule('message')->userModel),
			Yii::app()->getModule('message')->getSuggestMethod
		), $q);

		$users = array();
		if ($userModels) {
			foreach ($userModels as $userModel) {
				$users[] = array(
					'id' => $userModel->getPrimaryKey(),
					'name' => call_user_func(array(
						$userModel, $this->getModule()->getNameMethod
					))
				);
			}
		}
		$json = CJSON::encode(array('users' => $users));

		if (Yii::app()->request->getParam('callback')) {
		    $callback = Yii::app()->request->getParam('callback');
			$json = $callback . '('. $json . ')';
		}

		header('Cache-Control: no-store');
		header('Pragma: no-store');
		header("Content-type: application/json");
		echo $json;
		Yii::app()->end();
	}
}

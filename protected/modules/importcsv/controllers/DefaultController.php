<?php

class DefaultController extends RController {

    public $colsArray = array();
	
	public function filters(){
		return array(
			'rights'
		);
	}

    /*
     * action for form
     */

    public function actionIndex() {
		
			$this->render('index');
    }

}

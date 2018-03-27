<?php
class LetterFilter extends CWidget{
	public $outerWrapperId		= '';
	public $outerWrapperClass	= '';
	public $innerWrapperId		= '';
	public $innerWrapperClass	= '';
	public $containerId			= '';
	public $containerClass		= '';
	public $activeClass			= 'active';
	public $language			= '';
	public $letters				= array();
	public $url					= '';
	
	public function init(){		
		$this->language		= (isset(Yii::app()->language) and Yii::app()->language!="" and isset(Yii::app()->params['alphabets'][Yii::app()->language]))?Yii::app()->language:'en_us';
		$this->letters		= Yii::app()->params['alphabets'][$this->language];
		$this->url			= ($this->url != NULL)?$this->url:Yii::app()->request->getUrl();
	}
	
	public function run(){		
		$this->render('_filter');
	}
}
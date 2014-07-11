<?php
Yii::import('application.extensions.fullcalendar.FullcalendarWidget');
class FullcalendarGraphWidget extends FullcalendarWidget{
	/**
	 * @var string the name of the container element that contains the progress bar. Defaults to 'div'.
	 */
	public $tagName = 'div';

	/**
	 * Run this widget.
	 * This method registers necessary javascript and renders the needed HTML code.
	 */
	public function run(){
		$id=$this->getId();
		$this->htmlOptions['id']=$id;        

		echo CHtml::openTag($this->tagName,$this->htmlOptions);
		echo CHtml::closeTag($this->tagName);

		$encodeoptions=CJavaScript::encode($this->options+array('events'=>array($this->data)));
		
		Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$id,"$('#$id').fullCalendar($encodeoptions);");
	}

}
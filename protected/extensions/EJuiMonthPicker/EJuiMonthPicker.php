<?php

/**
 * Yii extension wrapping the jQuery UI Monthpicker Widget from Julien Poumailloux
 * {@link http://www.jpoumailloux.com/jquery-ui-monthpicker/}
 * {@link https://github.com/thebrowser/jquery.ui.monthpicker}
 * 
 * @author C.Yildiz <c@cba-solutions.org>
 *
 */
Yii::import('zii.widgets.jui.CJuiInputWidget');

/**
 * Base class.
 */
class EJuiMonthPicker extends CJuiInputWidget
{
	 /**
	 * @var CModel the data model associated with this widget.
	 */
	public $model=null;
	/**
	 * @var string the attribute associated with this widget.
	 * The name can contain square brackets (e.g. 'name[1]') which is used to collect tabular data input.
	 */
	public $attribute=null;
	/**
	 * @var string the name of the drop down list. This must be set if {@link model} is not set.
	 */
	public $name = null;
	/**
	 * @var string the selected input value(s). This is used only if {@link model} is not set.
	 */
	public $value = null;
	/**
	 * @var array the options for the jQuery UI MultiSelect Widget
	 */
	public $options = array();
	/**
	 * @var array additional HTML attributes for the drop down list
	 * Options like class, style etc. are adopted by the jQuery UI MultiSelect Widget
	 */
	public $htmlOptions = array();
	



	public function init()
	{
		// Put togehther options for plugin
		$cs = Yii::app()->getClientScript();
		$assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets');
		$cs->registerScriptFile($assets . '/jquery.ui.monthpicker.js');
		
		// Default options for the jQuery widget
		$default_options = array(
			'monthNames' => array('January','February','March','April','May','June','July','August','September','October','November','December'),
				
			
			'monthNamesShort' => array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'),
				
			'prevText'=>Yii::t('EJuiMonthPicker.EJuiMonthPicker','Prev'),
			'nextText'=>Yii::t('EJuiMonthPicker.EJuiMonthPicker','Next'),
			'showOn'=>'focus',
			'yearRange'=>'-5:+15',
			'dateFormat'=>'yy-mm',
			'changeYear'=>true,
			'buttonImageOnly' => false,
			'buttonImage' => $assets."/images/calendar.png",
			'buttonText'=>Yii::t('EJuiMonthPicker.EJuiMonthPicker','Select Month'),
			//'onSelect'=>'js:function(input){$(this).focus(); }'
		);
		if(!empty($this->options)) $opt = array_merge($default_options, $this->options);
		else $opt = $default_options;
		$this->options = $opt;
		
		parent::init();
	}

	/**
	 * Run this widget.
	 * This method registers necessary javascript and renders the needed HTML code.
	 */
	public function run()
	{
		list($name, $id) = $this->resolveNameId();
		
		if($this->hasModel())
			echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions); 
		else
			echo CHtml::textField($this->name, $this->value, $this->htmlOptions);
			
		$joptions=CJavaScript::encode($this->options);
		$jscode = "jQuery('#{$id}').monthpicker({$joptions});";
		Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $id, $jscode);
	}
}

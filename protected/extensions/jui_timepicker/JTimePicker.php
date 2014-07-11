<?php
/**
 * JTimePicker class file.
 *
 *Jeff Benetti aka 'doodle' www.site-byte.com
 */

Yii::import('zii.widgets.jui.CJuiInputWidget');

/**
 * JTimePicker displays a time picker.
 * all credit except for the wrapper code goes to
 * Francois Gelinas http://fgelinas.com/code/timepicker/
 *
 * Thanks Fancois
 *
     *$('#timepicker').timepicker({
        // Options
        timeSeparator: ':',           // The character to use to separate hours and minutes. (default: ':')
        showLeadingZero: true,        // Define whether or not to show a leading zero for hours < 10. (default: true)
        showMinutesLeadingZero: true, // Define whether or not to show a leading zero for minutes < 10. (default: true)
        showPeriod: false,            // Define whether or not to show AM/PM with selected time. (default: false)
        showPeriodLabels: true,       // Define if the AM/PM labels on the left are displayed. (default: true)
        altField: '#alternate_input', // Define an alternate input to parse selected time to
        defaultTime: '12:34',         // Define a default time to use if displayed inline or input is empty
        zIndex: null,                 // Overwrite the default zIndex used by the time picker

        // trigger options
        showOn: 'focus',              // Define when the timepicker is shown.
                                      // 'focus': when the input gets focus, 'button' when the button trigger element is clicked,
                                      // 'both': when the input gets focus and when the button is clicked.
        button: null,                 // jQuery selector that acts as button trigger. ex: '#trigger_button'

        // Localization
        hourText: 'Hour',             // Define the locale text for "Hours"
        minuteText: 'Minute',         // Define the locale text for "Minute"
        amPmText: ['AM', 'PM'],       // Define the locale text for periods

        // Events
        onSelect: onSelectCallback,   // Define a callback function when an hour / minutes is selected.
        onClose: onCloseCallback,     // Define a callback function when the timepicker is closed.
        onHourShow: onHourShow,       // Define a callback to enable / disable certain hours. ex: function onHourShow(hour)
        onMinuteShow: onMinuteShow,   // Define a callback to enable / disable certain minutes. ex: function onMinuteShow(hour, minute)

        // custom hours and minutes
        hours: {
            starts: 0,                  // first displayed hour
            ends: 23                    // last displayed hour
        },
        minutes: {
            starts: 0,                  // first displayed minute
            ends: 55,                   // last displayed minute
            interval: 5                 // interval of displayed minutes
        },
        rows: 4                         // number of rows for the input tables, minimum 2, makes more sense if you use multiple of 2
    });
 */
class JTimePicker extends CJuiInputWidget
{
	/**
	 * @var string the locale ID (eg 'fr', 'de') for the language to be used by the date picker.
	 * If this property is not set, I18N will not be involved. That is, the date picker will show in English.
	 * You can force English language by setting the language attribute as '' (empty string)
	 */
	public $language;
        /**
        * @var string Path of the asset files after publishing.
        */
         private $assetsPath;
	/**
	 * @var string The i18n Jquery UI script file. It uses scriptUrl property as base url.
	 */
	public $i18nScriptFile = 'jquery-ui-i18n.min.js';

	/**
	 * @var array The default options called just one time per request. This options will alter every other CJuiDatePicker instance in the page.
	 * It has to be set at the first call of CJuiDatePicker widget in the request.
	 */
	public $defaultOptions;

	/**
	 * @var boolean If true, shows the widget as an inline calendar and the input as a hidden field. Use the onSelect event to update the hidden field
	 */
	public $flat = false;
        /**
	 * Run this widget.
	 * This method registers necessary javascript and renders the needed HTML code.
	 */
        public function init() {
	$assets = dirname(__FILE__) . '/' . 'assets';
        $this->assetsPath = Yii::app()->getAssetManager()->publish($assets);
        Yii::app()->getClientScript()->registerCssFile($this->assetsPath . '/' . 'jquery-ui-timepicker.css', 'screen, projection');
        Yii::app()->getClientScript()->registerScriptFile($this->assetsPath . '/' . 'jquery.ui.timepicker.js');

        $this->resolvePackagePath();
        Yii::app()->getClientScript()->registerCssFile($this->themeUrl.'/'.$this->theme.'/'.$this->cssFile);
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
    }

	public function run()
	{

		list($name,$id)=$this->resolveNameID();

		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];
		else
			$this->htmlOptions['name']=$name;

		if ($this->flat===false)
		{
			if($this->hasModel())
				echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
			else
				echo CHtml::textField($name,$this->value,$this->htmlOptions);
		}
		else
		{
			if($this->hasModel())
			{
				echo CHtml::activeHiddenField($this->model,$this->attribute,$this->htmlOptions);
				$attribute = $this->attribute;
				$this->options['defaultDate'] = $this->model->$attribute;
			}
			else
			{
				echo CHtml::hiddenField($name,$this->value,$this->htmlOptions);
				$this->options['defaultDate'] = $this->value;
			}

			if (!isset($this->options['onSelect']))
				$this->options['onSelect']="js:function( selectedDate ) { jQuery('#{$id}').val(selectedDate);}";

			$id = $this->htmlOptions['id'] = $this->htmlOptions['id'].'_container';
			$this->htmlOptions['name'] = $this->htmlOptions['name'].'_container';

			echo CHtml::tag('div', $this->htmlOptions, '');
		}

		$options=CJavaScript::encode($this->options);
		$js = "jQuery('#{$id}').timepicker($options);";

		$cs = Yii::app()->getClientScript();
		$cs->registerScript(__CLASS__.'#'.$id, $js);

	}
}
<?php
/**
 * SColorPicker class file.
 *
 * @author Evan Johnson <thaddeusmt@gmail.com>
 * @link http://www.yiiframework.com/extension/minicolors-colorpicker/
 * @link https://github.com/thaddeusmt/yii-miniColors-colorpicker
 * @copyright Copyright &copy; 2011 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2
 *
 * miniColors JQuery Plugin:
 * http://abeautifulsite.net/blog/2011/02/jquery-minicolors-a-color-selector-for-input-controls/
 * http://plugins.jquery.com/project/jQueryMiniColors
 *
 * A typical CForm usage (without a model) of JColorPicker is as follows:
 * <pre>
 * $this->widget('ext.SMiniColors.SColorPicker', array(
 *     'id' => 'myInputId',
 *     'defaultValue'=>'#000000',
 *     'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
 *     'options' => array(), // jQuery plugin options
 *     'htmlOptions' => array(), // html attributes
 * ));
 * </pre>
 *
 */

class SColorPicker extends CWidget
{
  /**
   * @var whether the textfield with the hex value is shown or not (next to the color picker)
   */
  public $hidden = false;
  /**
   * @var array miniColors jQuery plugin options
   */
  public $options = array();
  /**
   * @var array input element attributes
   */
  public $htmlOptions = array();
  /**
   * @var default hexadecimal color value string, including the # sign
   */
  public $defaultValue = '';

  /**
	 * Initializes the widget.
	 * This method will publish jQuery and miniColors plugin assets if necessary.
   * @return void
	 */
  public function init()
  {
    $id = $this->getId();

    if (isset($this->options['value'])) {
      $this->defaultValue = $this->options['value'];
    } elseif (isset($this->htmlOptions['value'])) {
      $this->defaultValue = $this->htmlOptions['value'];
    }

    $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'source';
    $baseUrl = Yii::app()->getAssetManager()->publish($dir);

    $cs = Yii::app()->getClientScript();
    $cs->registerCoreScript('jquery');
    $cs->registerScriptFile($baseUrl.'/jquery.miniColors.min.js');
    $cs->registerCssFile($baseUrl.'/jquery.miniColors.css');

    $options = CJavaScript::encode($this->options);

    $cs->registerScript('miniColors-'.$id, '$("#'.$id.'").miniColors('.$options.');');
  }

  /**
	 * Renders the widget.
	 */
  public function run()
  {
    if ($this->hidden)
      echo CHtml::hiddenField($this->getId(), $this->defaultValue, $this->htmlOptions);
    else
      echo CHtml::textField($this->getId(), $this->defaultValue, $this->htmlOptions);
  }
}

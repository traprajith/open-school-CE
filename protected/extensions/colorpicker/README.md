# ColorPicker for Yii

The color picker widget is implemented based this jQuery plugin:
https://github.com/laktek/really-simple-color-picker

Demo: http://www.laktek.com/2008/10/27/really-simple-color-picker-in-jquery

This widget is more useful as a textfield (the default mode)

## Example:
```php
    ...
        $this->widget('ext.colorpicker.ColorPicker', array(
            'model' => $model,
            'attribute' => 'color',
            'options' => array( // Optional
                'pickerDefault' => "ccc", // Configuration Object for JS
            ),
        ));
    ...
        $this->widget('ext.colorpicker.ColorPicker', array(
            'name' => 'color',
        ));
    ...
```

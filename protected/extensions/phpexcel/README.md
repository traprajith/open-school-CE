yii-phpexcel
============

Wrapper for the PHPExcel library.

## Installation:

1. Unzip the contents of this directory to protected/extensions/phpexcel
2. Download the latest version of PHPExcel: https://github.com/PHPOffice/PHPExcel/tags
3. Unzip the contents of the folder Classes to a new folder protected/extensions/phpexcel/vendor

## Usage:

```php
Yii::import('ext.phpexcel.XPHPExcel');		
$phpExcel = XPHPExcel::createPHPExcel();
```

Or if you don't want a PHPExcel object:

```php
Yii::import('ext.phpexcel.XPHPExcel');		
XPHPExcel::init();
```

## Troubleshooting

Q: Error message: "include(PHPExcel_Style_Supervisor.php) [function.include]: failed to open stream: No such file or directory"
A: https://github.com/marcovtwout/yii-phpexcel/issues/3#issuecomment-38112059
    
    

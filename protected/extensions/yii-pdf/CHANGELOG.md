Yii-PDF Change Log
==================

### Version 0.2a (2012-02-05)

* Fixed method name (mpdf) for some case-sensitive *nix OS filesystems (it may cause for some errors) [thanks to Hylke]

### Version 0.2 (2012-01-18)

* Parameter `'defaultParams'` is not required anymore (will be used constructor's default params of selected library)
* Added a few helper constants for `Output()` method (detailed info located in extension's class)

```php
<?php
    class EYiiPdf extends CApplicationComponent
    {
        ...
        const OUTPUT_TO_BROWSER = "I";
        const OUTPUT_TO_DOWNLOAD = "D";
        const OUTPUT_TO_FILE = "F";
        const OUTPUT_TO_STRING = "S";
        ...
    }

    #Example (make sure that target directory is writable)
    $html2pdf->Output('/path/to/file.pdf', EYiiPdf::OUTPUT_TO_FILE);
?>
```

* Some small fixes

### Version 0.1 (2012-01-16)

* Initial release
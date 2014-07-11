Yii-PDF Extension
=================

Небольшое расширение для Yii Framework, которое делает "обертку" для нескольких PHP-библиотек
(mPDF и HTML2PDF на данный момент) для конвертации HTML в PDF

### Ссылки

* [Yii Framework](http://yiiframework.com/)
* [mPDF](http://www.mpdf1.com/) - это PHP класс для создания PDF файлов из HTML с поддержкой Unicode/UTF-8 и CJK
* [HTML2PDF](http://html2pdf.fr/en/default) - это PHP класс, который использует FPDF для PHP4, и TCPDF для PHP5.
Библиотека может конвертировать валидный HTML и XHTML в PDF

### Системные требования

* Yii 1.1.9 или выше
* [mPDF](http://www.mpdf1.com/mpdf/download) версия 5.3 (была выпущена 2011-07-21) или выше
* [HTML2PDF](http://sourceforge.net/projects/phphtml2pdf/) версия 4.03 (была выпущена 2011-05-27) или выше

### Официальная документация и примеры

* mPDF - [manual](http://mpdf1.com/manual/) и [примеры](http://www.mpdf1.com/mpdf/examples)
* HTML2PDF - [Wiki](http://wiki.spipu.net/doku.php?id=html2pdf:en:Accueil) и [примеры](http://html2pdf.fr/en/example)

### Установка

* Скачайте и распакуйте расширение в директорию `protected/extensions/yii-pdf`
* Скачайте и распакуйте библиотеку ([mPDF](http://www.mpdf1.com/mpdf/download) and/or [HTML2PDF](http://sourceforge.net/projects/phphtml2pdf/))
в свою папку каталога `protected/vendors` или укажите новое значение для параметра `'librarySourcePath'` в массиве `'params'`
* Массив `'defaultParams'` - это массив параметров по умолчанию для конструктора выбранной библиотеки.
Если хотите изменить параметры по умолчанию - можете установить их в конфигурационном файле (как показано ниже).
При изменении - **вы должны сохранить порядок элементов массива!**
* В вашем конфигурационным файле `protected/config/main.php`, добавьте такие строчки:

```php
<?php
//...
    'components'=>array(
        //...
        'ePdf' => array(
            'class'         => 'ext.yii-pdf.EYiiPdf',
            'params'        => array(
                'mpdf'     => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants'         => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class'=>'mpdf', // Для некоторых "регистрочувствительных" систем
                    /*'defaultParams'     => array( // Детальней: http://mpdf1.com/manual/index.php?tid=184
                        'mode'              => '', //  This parameter specifies the mode of the new document.
                        'format'            => 'A4', // format A4, A5, ...
                        'default_font_size' => 0, // Sets the default document font size in points (pt)
                        'default_font'      => '', // Sets the default font-family for the new document.
                        'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                        'mgr'               => 15, // margin_right
                        'mgt'               => 16, // margin_top
                        'mgb'               => 16, // margin_bottom
                        'mgh'               => 9, // margin_header
                        'mgf'               => 9, // margin_footer
                        'orientation'       => 'P', // landscape or portrait orientation
                    )*/
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                    /*'defaultParams'     => array( // Детальней: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format'      => 'A4', // format A4, A5, ...
                        'language'    => 'en', // language: fr, en, it ...
                        'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                    )*/
                )
            ),
        ),
        //...
    )
//...
```

### Использование

```php
<?php
...
    public function actionIndex()
    {
        # mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # Вы можете с легкостью переопределить параметры по умолчанию для конструктора
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

        # render (полная страница page)
        $mPDF1->WriteHTML($this->render('index', array(), true));

        # Загрузить таблицу стилей в документ
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);

        # renderPartial (только представление текущего контроллера)
        $mPDF1->WriteHTML($this->renderPartial('index', array(), true));

        # Отрисовка картинки в документе
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

        # Вывод готового PDF
        $mPDF1->Output();

        ////////////////////////////////////////////////////////////////////////////////////

        # у HTML2PDF очень схож синтаксис
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('index', array(), true));
        $html2pdf->Output();

        ////////////////////////////////////////////////////////////////////////////////////

        # Пример с HTML2PDF wiki: Отправка PDF по почте
        $content_PDF = $html2pdf->Output('', EYiiPdf::OUTPUT_TO_STRING);
        require_once(dirname(__FILE__).'/pjmail/pjmail.class.php');
        $mail = new PJmail();
        $mail->setAllFrom('webmaster@my_site.net', "My personal site");
        $mail->addrecipient('mail_user@my_site.net');
        $mail->addsubject("Example sending PDF");
        $mail->text = "This is an example of sending a PDF file";
        $mail->addbinattachement("my_document.pdf", $content_PDF);
        $res = $mail->sendmail();
    }
...
```

### Лицензия

* **mPDF** - GNU General Public License version 2
* **HTML2PDF** - GNU Library or Lesser General Public License (LGPL)
* [Это расширение](https://github.com/Borales/yii-pdf) было выпущено под [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
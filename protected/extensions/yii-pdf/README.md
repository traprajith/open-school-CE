Yii-PDF Extension
=================

Small Yii extension, that wraps a few PHP libraries (mPDF and HTML2PDF so far) to convert HTML to PDF

### Resources

* [Yii Framework](http://yiiframework.com/)
* [mPDF](http://www.mpdf1.com/) - is a PHP class to generate PDF files from HTML with Unicode/UTF-8 and CJK support
* [HTML2PDF](http://html2pdf.fr/en/default) - is a PHP class using FPDF for the PHP4 release, and TCPDF for the PHP5 release.
It can convert valid HTML and xHTML to PDF

### Requirements

* Yii 1.1.9 or above
* [mPDF](http://www.mpdf1.com/mpdf/download) version 5.3 (has been released 2011-07-21) or above
* [HTML2PDF](http://sourceforge.net/projects/phphtml2pdf/) version 4.03 (has been released 2011-05-27) or above

### Official documentation and examples

* mPDF - [manual](http://mpdf1.com/manual/) and [examples](http://www.mpdf1.com/mpdf/examples)
* HTML2PDF - [Wiki](http://wiki.spipu.net/doku.php?id=html2pdf:en:Accueil) and [examples](http://html2pdf.fr/en/example)

### Installation

* Download and extract extension to the directory `protected/extensions/yii-pdf`
* Download and extract library ([mPDF](http://www.mpdf1.com/mpdf/download) and/or [HTML2PDF](http://sourceforge.net/projects/phphtml2pdf/))
to own directory in catalog `protected/vendors` or set new value for `'librarySourcePath'` parameter in `'params'` array
* Array `'defaultParams'` - this is an array of constructor's default params of selected library.
If you want to change default params - you can set them in config file (like shown below).
If you do so - **you must keep the order of array items!**
* In your `protected/config/main.php`, add the following:

```php
<?php
//...
	'components'=>array(
		//...
		'ePdf' => array(
			'class'			=> 'ext.yii-pdf.EYiiPdf',
			'params'		=> array(
				'mpdf'	   => array(
					'librarySourcePath' => 'application.vendors.mpdf.*',
					'constants'			=> array(
						'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
					),
					'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder.
					/*'defaultParams'	  => array( // More info: http://mpdf1.com/manual/index.php?tid=184
						'mode'				=> '', //  This parameter specifies the mode of the new document.
						'format'			=> 'A4', // format A4, A5, ...
						'default_font_size' => 0, // Sets the default document font size in points (pt)
						'default_font'		=> '', // Sets the default font-family for the new document.
						'mgl'				=> 15, // margin_left. Sets the page margins for the new document.
						'mgr'				=> 15, // margin_right
						'mgt'				=> 16, // margin_top
						'mgb'				=> 16, // margin_bottom
						'mgh'				=> 9, // margin_header
						'mgf'				=> 9, // margin_footer
						'orientation'		=> 'P', // landscape or portrait orientation
					)*/
				),
				'HTML2PDF' => array(
					'librarySourcePath' => 'application.vendors.html2pdf.*',
					'classFile'			=> 'html2pdf.class.php', // For adding to Yii::$classMap
					/*'defaultParams'	  => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
						'orientation' => 'P', // landscape or portrait orientation
						'format'	  => 'A4', // format A4, A5, ...
						'language'	  => 'en', // language: fr, en, it ...
						'unicode'	  => true, // TRUE means clustering the input text IS unicode (default = true)
						'encoding'	  => 'UTF-8', // charset encoding; Default is UTF-8
						'marges'	  => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
					)*/
				)
			),
		),
		//...
	)
//...
```

### Usage

```php
<?php
...
	public function actionIndex()
	{
		# mPDF
		$mPDF1 = Yii::app()->ePdf->mpdf();

		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

		# render (full page)
		$mPDF1->WriteHTML($this->render('index', array(), true));

		# Load a stylesheet
		$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
		$mPDF1->WriteHTML($stylesheet, 1);

		# renderPartial (only 'view' of current controller)
		$mPDF1->WriteHTML($this->renderPartial('index', array(), true));

		# Renders image
		$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

		# Outputs ready PDF
		$mPDF1->Output();

		////////////////////////////////////////////////////////////////////////////////////

		# HTML2PDF has very similar syntax
		$html2pdf = Yii::app()->ePdf->HTML2PDF();
		$html2pdf->WriteHTML($this->renderPartial('index', array(), true));
		$html2pdf->Output();

		////////////////////////////////////////////////////////////////////////////////////

		# Example from HTML2PDF wiki: Send PDF by email
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

### License

* **mPDF** has GNU General Public License version 2
* **HTML2PDF** has GNU Library or Lesser General Public License (LGPL)
* [This extension](https://github.com/Borales/yii-pdf) was released under the [New BSD License](http://www.opensource.org/licenses/bsd-license.php)

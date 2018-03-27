<?php

/**
 * PDF generator
 */
class OsPdf extends CApplicationComponent
{
    private $_language 		= "";
	private $_viewpath 		= "";
	private $_parameters	= "";
	private $_format		= "";
	private $_filename 		= "";
	private $_mpdf			= NULL;
	private $_rtl_languages	= array("ar");
	
    public function generate($path, $filename="report.pdf", $parameters=array(), $landscape="", $output="", $format="A4", $margin_left=15, $margin_right=15, $margin_top=16, $margin_bottom=16){				
		$this->_language		= (isset(Yii::app()->language))?Yii::app()->language:"";
		$this->_viewpath		= $path;
		$this->_parameters		= $parameters;
		$this->_format			= $format;
		if($landscape==1)
			$this->_format		.= "-L";
		$this->_filename		= $filename;
		
		include(dirname(__FILE__) .'/../vendors/MPDF/mpdf.php');	
		$this->_mpdf	= new mPDF($this->_language, $this->_format, '', 'freesans', $margin_left, $margin_right, $margin_top, $margin_bottom);
		
		if(in_array($this->_language, $this->_rtl_languages)){	//if need rtl design to pdf, there must be file for rtl
			$this->_viewpath	.= "_rtl";
			$this->_mpdf->SetDirectionality('rtl');
		}
		//Yii::app()->controller->renderPartial($this->_viewpath, $this->_parameters);
		$this->_mpdf->WriteHTML(Yii::app()->controller->renderPartial($this->_viewpath, $this->_parameters, true));
		if($output==""){
			$output="I";
		}
		$this->_mpdf->Output($this->_filename, $output);	
    }
}
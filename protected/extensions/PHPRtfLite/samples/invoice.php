<?php
$dir = dirname(__FILE__);

//include library
require_once $dir . '/../lib/PHPRtfLite.php';

//autoloader
PHPRtfLite::registerAutoloader();

//font family
$font_family	= 'Verdana';

//font size
$n_10			= new PHPRtfLite_Font(9, $font_family);							// normal - 10px
$n_15			= new PHPRtfLite_Font(15, $font_family);						// normal - 15px
$n_25			= new PHPRtfLite_Font(25, $font_family);						// normal - 25px
$b_10			= new PHPRtfLite_Font(9, $font_family);$b_10->setBold();		// bold - 10px
$u_10			= new PHPRtfLite_Font(9, $font_family);$u_10->setUnderline();	// underline - 10px

//text alignment
$par_format_center		= new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_CENTER);
$par_format_left		= new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_LEFT);
$par_format_right		= new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_RIGHT);

//intializing object
$rtf = new PHPRtfLite();

//borders
$border 		= PHPRtfLite_Border::create($rtf, 1, '#000000');
$border_left 	= new PHPRtfLite_Border(
    $rtf,                                       // PHPRtfLite instance
    new PHPRtfLite_Border_Format(1, '#000000'), // left border: 2pt, green color
	NULL,	// top border: 1pt, yellow color
	NULL,	// right border: 2pt, red color
	NULL	// bottom border: 1pt, blue color
);

$border_right 	= new PHPRtfLite_Border(
    $rtf,                                       // PHPRtfLite instance
    NULL, // left border: 2pt, green color
	NULL,	// top border: 1pt, yellow color
	new PHPRtfLite_Border_Format(1, '#000000'),	// right border: 2pt, red color
	NULL	// bottom border: 1pt, blue color
);

$border_top 	= new PHPRtfLite_Border(
    $rtf,                                       // PHPRtfLite instance
    NULL, // left border: 2pt, green color
	new PHPRtfLite_Border_Format(1, '#000000'),	// top border: 1pt, yellow color
	NULL,	// right border: 2pt, red color
	NULL	// bottom border: 1pt, blue color
);

$border_bottom 	= new PHPRtfLite_Border(
    $rtf,                                       // PHPRtfLite instance
    NULL, // left border: 2pt, green color
	NULL,	// top border: 1pt, yellow color
	NULL,	// right border: 2pt, red color
	new PHPRtfLite_Border_Format(1, '#000000')	// bottom border: 1pt, blue color
);

//page orientation
$rtf->setLandscape();

//section
$sect = $rtf->addSection();

//header
$table = $sect->addTable();
$table->addRows(4, 0.75);
$table->addColumnsList(array(23.6));
$table->writeToCell(1, 1, 'Gyan Sagar Public School', $n_25, $par_format_center);
$table->writeToCell(2, 1, 'Affiliation No:AR477547'.PHP_EOL.'R2P-235, Raj Ngr-II, Palam Colony, Sec 8, Dwarka-New Delhi-110077'.PHP_EOL.'Telephone :25362207, 363466 Email :institution@domain.com', $n_10, $par_format_center);
$table->writeToCell(3, 1, '<hr/>', $n_10, $par_format_center);
$table->writeToCell(4, 1, 'Fee Receipt', $n_15, $par_format_center);

//info
$table = $sect->addTable();
$table->addRows(4, 0.75);
$table->addColumnsList(array(3.5, .5, 4, 3.5, .5, 4, 3.5, .5, 3));

//Row 1
$table->writeToCell(1, 1, 'Receipt No', $b_10, $par_format_left);
$table->writeToCell(1, 2, ':', $b_10, $par_format_left);
$table->writeToCell(1, 3, '4', $n_10, $par_format_left);
$table->writeToCell(1, 4, 'Date', $b_10, $par_format_left);
$table->writeToCell(1, 5, ':', $b_10, $par_format_left);
$table->writeToCell(1, 6, '03 Oct 2017', $n_10, $par_format_left);
$table->writeToCell(1, 7, 'Mode', $b_10, $par_format_left);
$table->writeToCell(1, 8, ':', $b_10, $par_format_left);
$table->writeToCell(1, 9, 'Cash', $n_10, $par_format_left);

//Row 2
$table->writeToCell(2, 1, 'Transaction Info', $b_10, $par_format_left);
$table->writeToCell(2, 2, ':', $b_10, $par_format_left);
$table->writeToCell(2, 3, '5865436366 / Indian Bank', $n_10, $par_format_left);
$table->writeToCell(2, 4, 'Term', $b_10, $par_format_left);
$table->writeToCell(2, 5, ':', $b_10, $par_format_left);
$table->mergeCellRange(2, 6, 2, 9);
$table->writeToCell(2, 6, 'September', $n_10, $par_format_left);

//Row 3
$table->writeToCell(3, 1, 'Name', $b_10, $par_format_left);
$table->writeToCell(3, 2, ':', $b_10, $par_format_left);
$table->writeToCell(3, 3, 'Anju S Balachandran', $n_10, $par_format_left);
$table->writeToCell(3, 4, 'Student ID', $b_10, $par_format_left);
$table->writeToCell(3, 5, ':', $b_10, $par_format_left);
$table->writeToCell(3, 6, '1021', $n_10, $par_format_left);
$table->writeToCell(3, 7, 'S/d of', $b_10, $par_format_left);
$table->writeToCell(3, 8, ':', $b_10, $par_format_left);
$table->writeToCell(3, 9, 'Balan M', $n_10, $par_format_left);

//Row 4
$table->writeToCell(4, 1, 'Roll no', $b_10, $par_format_left);
$table->writeToCell(4, 2, ':', $b_10, $par_format_left);
$table->writeToCell(4, 3, '5', $n_10, $par_format_left);
$table->writeToCell(4, 4, 'Class', $b_10, $par_format_left);
$table->writeToCell(4, 5, ':', $b_10, $par_format_left);
$table->writeToCell(4, 6, 'Test Course', $n_10, $par_format_left);
$table->writeToCell(4, 7, 'Section', $b_10, $par_format_left);
$table->writeToCell(4, 8, ':', $b_10, $par_format_left);
$table->writeToCell(4, 9, 'Test Batch', $n_10, $par_format_left);

//invoice particulars
$table = $sect->addTable();
$table->addRow(1, 0.25);
$table->addColumnsList(array(16.6, 7));

$table->writeToCell(1, 1, 'Particulars', $b_10, $par_format_left);
$table->writeToCell(1, 2, 'Amount', $b_10, $par_format_center);
$table->setBorderForCellRange($border, 1, 1, 1, 2);

$table->addRow(1, 0.25);
$table->writeToCell(2, 1, 'Tuition Fee', $n_10, $par_format_left);
$table->writeToCell(2, 2, '1,000.00', $n_10, $par_format_center);

$table->addRow(1, 0.25);
$table->writeToCell(3, 1, 'Library Fee', $n_10, $par_format_left);
$table->writeToCell(3, 2, '50.00', $n_10, $par_format_center);

$table->addRow(1, 0.25);
$table->writeToCell(4, 1, 'Transportation Fee', $n_10, $par_format_left);
$table->writeToCell(4, 2, '200.00', $n_10, $par_format_center);

$table->addRow(1, 0.25);
$table->writeToCell(5, 1, 'Total (USD)', $n_10, $par_format_right);
$table->writeToCell(5, 2, '1,250.00', $n_10, $par_format_center);

$table->addRow(1, 0.25);
$table->writeToCell(6, 1, 'Amount Received (USD)', $n_10, $par_format_right);
$table->writeToCell(6, 2, '174.00', $n_10, $par_format_center);

$table->addRow(1, 0.25);
$table->writeToCell(7, 1, 'Amount Due (USD)', $n_10, $par_format_right);
$table->writeToCell(7, 2, '(-) 1,076.00', $n_10, $par_format_center);

$table->setBorderForCellRange($border_left, 2, 1, 7, 2);
$table->setBorderForCellRange($border_right, 2, 1, 7, 2);
$table->setBorderForCellRange($border_right, 2, 1, 7, 2);
$table->setBorderForCellRange($border_bottom, 7, 1, 7, 2);
$table->setBorderForCellRange($border_top, 5, 1, 5, 2);

$table->addRow(1, 0.75);
$table->mergeCellRange(8, 1, 8, 2);
$table->writeToCell(8, 1, 'Amount received : one hundred and seventy-four rupees only', $u_10, $par_format_left);

$table->addRow(1, 0.75);
$table->mergeCellRange(9, 1, 9, 2);
$table->writeToCell(9, 1, 'Authorised Signatory', $n_10, $par_format_right);

// download rtf document
$rtf->sendRtf(basename(__FILE__, '.php') . '-'.time().'.rtf');
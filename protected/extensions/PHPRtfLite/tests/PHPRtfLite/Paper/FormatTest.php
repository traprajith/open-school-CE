<?php

/**
 * Test class for PHPRtfLite_Paper_FormatTest
 */
class PHPRtfLite_Paper_FormatTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException PHPRtfLite_Exception
     */
    public function testGetPaperWidthByPaperFormatThrowsException()
    {
        PHPRtfLite_Paper_Format::getPaperWidthByPaperFormat('not_supported_paper_format');
    }


    /**
     * @expectedException PHPRtfLite_Exception
     */
    public function testGetPaperHeightByPaperFormatThrowsException()
    {
        PHPRtfLite_Paper_Format::getPaperHeightByPaperFormat('not_supported_paper_format');
    }


    /**
     * @dataProvider provider
     */
    public function testGetPaperWidthAndHeightByPaperFormat($paperFormat, $expected)
    {
        $paperWidth = PHPRtfLite_Paper_Format::getPaperWidthByPaperFormat($paperFormat);
        $this->assertEquals($expected['width'], $paperWidth);

        $paperHeight = PHPRtfLite_Paper_Format::getPaperHeightByPaperFormat($paperFormat);
        $this->assertEquals($expected['height'], $paperHeight);
    }


    public function provider()
    {
        return array(
            array(PHPRtfLite_Paper_Format::FORMAT_A3,       array('width' => 297, 'height' => 420)),
            array(PHPRtfLite_Paper_Format::FORMAT_A4,       array('width' => 210, 'height' => 297)),
            array(PHPRtfLite_Paper_Format::FORMAT_A5,       array('width' => 148, 'height' => 210)),
            array(PHPRtfLite_Paper_Format::FORMAT_LETTER,   array('width' => 216, 'height' => 279)),
            array(PHPRtfLite_Paper_Format::FORMAT_LEGAL,    array('width' => 216, 'height' => 356)),
        );
    }

}
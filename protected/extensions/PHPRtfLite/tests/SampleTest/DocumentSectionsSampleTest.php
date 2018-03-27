<?php

/**
 * Created on 08.04.2010
 *
 * @author sz
 */
class DocumentSectionsSampleTest extends PHPRtfLiteSampleTestCase
{

    private $_name = 'document_sections';

    public function test()
    {
        $this->processTest($this->_name . '.php');
    }

    protected function getSampleFile()
    {
        return $this->getSampleDir() . '/generated/' . $this->_name . '.rtf';
    }

}

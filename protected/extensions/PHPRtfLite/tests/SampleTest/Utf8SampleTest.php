<?php

/**
 * Created on 08.04.2010
 *
 * @author sz
 */
class Utf8SampleTest extends PHPRtfLiteSampleTestCase
{

    private $_name = 'utf8';

    public function test()
    {
        $this->processTest($this->_name . '.php');
    }

    protected function getSampleFile()
    {
        return $this->getSampleDir() . '/generated/' . $this->_name . '.rtf';
    }

}

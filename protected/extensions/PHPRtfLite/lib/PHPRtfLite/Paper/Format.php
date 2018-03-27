<?php
/*
    PHPRtfLite
    Copyright 2007-2008 Denis Slaveckij <sinedas@gmail.com>
    Copyright 2010-2012 Steffen Zeidler <sigma_z@sigma-scripts.de>

    This file is part of PHPRtfLite.

    PHPRtfLite is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    PHPRtfLite is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Lesser General Public License for more details.

    You should have received a copy of the GNU Lesser General Public License
    along with PHPRtfLite.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * Class for paper format.
 *
 * @version     1.3.0
 * @author      Mario Raspe <mario.raspe@gmail.com>
 * @copyright   2007-2008 Denis Slaveckij, 2010-2012 Steffen Zeidler
 * @package     PHPRtfLite
 * @subpackage  PHPRtfLite_Paper
 */
class PHPRtfLite_Paper_Format
{
    /**
     * Constants for international paper formats: A
     */
    const FORMAT_A3 = 'A3';
    const FORMAT_A4 = 'A4';
    const FORMAT_A5 = 'A5';

    /**
     * Constants for north american paper formats.
     */
    const FORMAT_LETTER = 'Letter';
    const FORMAT_LEGAL = 'Legal';


    /**
     * Mapping array from paper format to width and height of a paper.
     * The values for width and height are in millimeter.
     *
     * @var array
     */
    private static $paperFormats = array(
        self::FORMAT_A3 => array(
            'width' => 297, 'height' => 420
        ),
        self::FORMAT_A4 => array(
            'width' => 210, 'height' => 297
        ),
        self::FORMAT_A5 => array(
            'width' => 148, 'height' => 210
        ),
        self::FORMAT_LETTER => array(
            'width' => 216, 'height' => 279
        ),
        self::FORMAT_LEGAL => array(
            'width' => 216, 'height' => 356
        )
    );


    /**
     * @param string $paperFormat
     * @return integer
     * @throws PHPRtfLite_Exception
     */
    public static function getPaperWidthByPaperFormat($paperFormat)
    {
        if (isset(self::$paperFormats[$paperFormat])) {
            return self::$paperFormats[$paperFormat]['width'];
        }
        throw new PHPRtfLite_Exception("Paper format '$paperFormat' is not supported.");
    }

    /**
     * @param string $paperFormat
     * @return integer
     * @throws PHPRtfLite_Exception
     */
    public static function getPaperHeightByPaperFormat($paperFormat)
    {
        if (isset(self::$paperFormats[$paperFormat])) {
            return self::$paperFormats[$paperFormat]['height'];
        }
        throw new PHPRtfLite_Exception("Paper format '$paperFormat' is not supported.");
    }
}
<?php
class LocalTime extends CApplicationComponent
{
    /*
    *       Notes
    * 1.    Column field types must be timestamp not date, time, datetime
    *       This is because timestamp columns are stored as UTC then converted to the specified timezone
    *       date, time and datetime columns don't save the timezone
    * 2.    Set the timezone to UTC in protected/config/main.php
    *       so that all retrieved times are in the UTC timezone for consistency
    *       'db'=>array(
    *       ...
    *       'initSQLs'=>array("set names utf8;set time_zone='+00:00';"),
    *       ),
    * 3.    When using phpMyAdmin, just use "set time_zone='+00:00'"
    *       or whatever timezone you require to display timestamps in your zone
    * 4.    Yii::app()->setTimeZone() and setLanguage() is not saved globally
    *       So this class is used to save the users timezone and locale
    * 5.    After a user logs in call Yii::app()->localtime->setLocale('en_gb');
    *       and Yii->app()->localtime->setTimeZone('Europe/London');
    * 6.    All date/time formats default to 'short' eg: dd/mm/yyyy hh:mm - no seconds
    */
 
    // Used for setting/getting the global variable - change this if there are conflicts
    const _globalTimeZone = 'LocalTime_timezone';
    const _globalLocale = 'LocalTime_locale';
    // Default server time
    const _utc = 'UTC';
 
    // Set the timezone - usually after the user has logged in
    // Use one of the supported timezones, eg: Europe/London as this will calculate daylight saving hours
    // http://php.net/manual/en/timezones.php
    public function setTimezone($timezone)
    {
        // Save the timezone for the session
        Yii::app()->setGlobalState(self::_globalTimeZone,$timezone);
    }
 
    // Return the current timezone
    public function getTimezone()
    {
        // Get the localDateTimeZone if its been set
        $timezone=Yii::app()->getGlobalState(self::_globalTimeZone);
 
        // Default to UTC if it hasn't
        if ($timezone===null)
            $timezone=self::_utc;
 
        return($timezone);
    }
 
    // Set the locale - usually after the user has logged in
    // Use one of the supported locales, eg: en_gb
    // http://php.net/manual/en/timezones.php
    public function setLocale($locale)
    {
        // Save the timezone for the session
        Yii::app()->setGlobalState(self::_globalLocale,$locale);
    }
 
    // Return the current locale
    public function getLocale()
    {
        // Get the localDateTimeZone if its been set
        $locale=Yii::app()->getGlobalState(self::_globalLocale);
 
        // Default to yii language if it isn't - note that Yii::app()->setLanguage doesn't save globally
        if ($locale===null)
            $locale=Yii::app()->language;
 
        return($locale);
    }
 
    // Local now() function
    // Can use any of the php date() formats to return the local date/time value
    // http://php.net/manual/en/function.date.php
    public function getLocalNow($format=DATE_ISO8601)
    {
        $localnow=new DateTime(null,$this->localDateTimeZone);
        return $localnow->format($format);
    }
 
    // UTC Now() function
    // Can use any of the php date() formats to return the UTC date/time value
    // http://php.net/manual/en/function.date.php
    public function getUTCNow($format=DATE_ISO8601)
    {
        $utcnow=new DateTime(null,$this->serverDateTimeZone);
        return $utcnow->format($format);
    }
 
    // Return a datetimezone object for the local time
    public function getLocalDateTimeZone($timezone=null)
    {
        if ($timezone===null)
            $timezone = $this->timezone;
 
        // Create a local datetimezone object
        $datetimezone = new DateTimeZone($timezone);
 
        return($datetimezone);
    }
 
    // Return a datetimezone object for UTC
    public function getServerDateTimeZone()
    {
        // Create a local datetimezone object
        $datetimezone = new DateTimeZone(self::_utc);
 
        return($datetimezone);
    }
 
    // Converts a timestamp from UTC to a local time
    // Expects a date in Y-m-d H:i:s type format and assumes it is UTC
    // Returns a date in the local time zone
    public function fromUTC($servertimestamp)
    {
        // Its okay if an ISO8601 time is passed because the timezone in the string will be used and the _serverDateTimeZone object is ignored
        $localtime = new DateTime($servertimestamp,$this->serverDateTimeZone);
 
        // Then set the timezone to local and it will be automagically updated, even allowing for daylight saving
        $localtime->setTimeZone($this->localDateTimeZone);
 
        // Return as 2010-08-15 15:52:01 for use in the yii app
        return($localtime->format('Y-m-d H:i:s'));
    }
 
    // Converts a local timestamp to UTC
    // Expects a date in Y-m-d H:i:s format and assumes it is the local time zone
    // Returns an ISO date in the UTC zone
    public function toUTC($localtimestamp)
    {
        // Create an object using the local time zone - this will account for daylight saving
        $servertime = new DateTime($localtimestamp,$this->localDateTimeZone);
 
        // Then set the timezone to UTC and it will be automagically updated
        // In theory this step isn't needed if using the ISO8601 format.
        $servertime->setTimeZone($this->serverDateTimeZone);
 
        // Return as 2010-08-15T15:52:01+0000 so the timestamp column is properly updated
        return($servertime->format(DATE_ISO8601));
    }
 
    // Use in afterFind
    // Ensure that the SQL "set time_zone='+00:00'" has been set
    // Returns a date/time combination based on the current locale
    // Expects a date/time in the yyyy-mm-dd hh:mm:ss type format
    public function toLocalDateTime($servertimestamp,$datewidth='short',$timewidth='short')
    {
        // Create a server datetime object
        $localtime = new DateTime($servertimestamp,$this->serverDateTimeZone);
 
        // Then set the timezone to local and it will be automagically updated, even allowing for daylight saving
        $localtime->setTimeZone($this->localDateTimeZone);
 
        // Get the local yii date+time format
        $localformat = $this->getLocalDateTimeFormat($datewidth,$timewidth);
 
        // Convert to php date format
        $localformat = $this->YiitoPHPDateFormat($localformat);
 
        // Return as a local datetime
        return($localtime->format($localformat));
 
    }
 
    // Use in afterFind
    // Ensure that the SQL "set time_zone='+00:00'" has been set
    // Returns the date based on the current locale
    // Expects a date string in the yyyy-mm-dd hh:mm:ss type format
    public function toLocalDate($servertimestamp,$datewidth='short')
    {
        // Create a server datetime object
        $localtime = new DateTime($servertimestamp,$this->serverDateTimeZone);
 
        // Then set the timezone to local and it will be automagically updated, even allowing for daylight saving
        $localtime->setTimeZone($this->localDateTimeZone);
 
        // Get the local yii date only format
        $localformat = $this->getLocalDateFormat($datewidth);
 
        // Convert to php date format
        $localformat = $this->YiitoPHPDateFormat($localformat);
 
        // Return as a local datetime
        return($localtime->format($localformat));
    }
 
    // Use in beforeSave
    // Converts a date/time string in the locale format to an ISO time for saving to the server
    // eg 31/12/2011 will become 2011-12-31T00:00:00+0000
    public function fromLocalDateTime($localtime,$datewidth='short',$timewidth='short')
    {
        // Local datetime format
        $localformat = $this->getLocalDateTimeFormat($datewidth,$timewidth);
 
        // Uses a modified CDateTimeParser that defaults the time values rather than return false
        // Also returns a time string rather than a timestamp just in case the timestamp is the wrong timezone
        $defaults = array('year'=>$this->getLocalNow('Y'), 'month'=>$this->getLocalNow('m'), 'day'=>$this->getLocalNow('d'), 'hour'=>0, 'minute'=>0, 'second'=>0 );
        $timevalues = DefaultDateTimeParser::parse($localtime, $localformat, $defaults);
 
        // Create a new date time in the local timezone
        $servertime = new DateTime($timevalues,$this->localDateTimeZone);
 
        // Set the timezone to UTC
        $servertime = $servertime->setTimeZone($this->serverDateTimeZone);
 
        // Return it as an iso date ready for saving
        return($servertime->format(DATE_ISO8601));
 
    }
 
    // Returns the local date time format from yii
    public function getLocalDateTimeFormat($datewidth='short',$timewidth='short')
    {
        // Set the language so the local date/time format is returned
        // This assumes the locale has already been set
        Yii::app()->setLanguage($this->locale);
 
        // This returns the order of the date time combination, eg {1} {0}
        $localformat = Yii::app()->locale->getDateTimeFormat();
 
        // Get the local date format - eg dd/MM/yyyy
        $localformat = str_replace('{1}', Yii::app()->locale->getDateFormat($datewidth), $localformat);
 
        // Get the local time format with seconds - eg hh:mm:ss
        $localformat = str_replace('{0}', Yii::app()->locale->getTimeFormat($timewidth), $localformat);
 
        return $localformat;
    }
 
    // Just a wrapper of the yii getDateFormat function
    public function getLocalDateFormat($width='short')
    {
        // Set the language so the local date format is returned
        // Assumes the locale has been set
        Yii::app()->setLanguage($this->locale);
 
        // Get the local date format - eg dd/MM/yyyy
        $localformat = Yii::app()->locale->getDateFormat($width);
        return $localformat;
    }
 
    // Converts a yii date format to a php date format
    // Eg dd/MM/yyyy HH:mm:ss will be converted to d/m/Y H:i:s
    public function YiitoPHPDateFormat($dateformat)
    {
        $patterns = array(
            // 'ampm'=>array('a'=>'a','A'=>'A'),
            'microseconds'=>array('zzzz'=>'u','z'=>'u'),
            'seconds'=>array('ss'=>'s','s'=>'s'),
            'minutes'=>array('mm'=>'i','m'=>'i'),
            '24hours'=>array('HH'=>'H','H'=>'G'),
            '12hours'=>array('hh'=>'h','h'=>'g'),
            'years'=>array('yyyy'=>'Y','yy'=>'y'),
            'months'=>array('MM'=>'m','M'=>'n'),
            'days'=>array('dd'=>'d','d'=>'j'),
        );
 
 
        // Run through each time pattern
        foreach($patterns as $pattern)
        {
            foreach($pattern as $search=>$replace)
            {
                if (strpos($dateformat,$search)!==false)
                {
                    // We have a winner!
                    // Replace the first pattern found and then get out of here
                    $dateformat = str_replace($search, $replace, $dateformat);
                    break;
                }
            }
        }
        return($dateformat);
    }
 
}
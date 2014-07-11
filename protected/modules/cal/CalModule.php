<?php
/*
 *  ver.1.2     07 Feb 2011
 */
class CalModule extends CWebModule
{
    /**
     * Module create tables if var is 'true'.
     * @var bool   Defaults to 'false'. 
     */
    public $debug = false;

    /**
     * @var string  'column1' or 'column2'
     * Defaults to 'column2'.
     */
    public $layout = 'column2';

    public $calendarOptions = array(
            'editable'=>true,
            'selectable'=>true,

            // (bool) use jQuery UI theme
            'theme'=>true,

            // (string) jQuery UI theme name
            // theme place in folder 'cal/component/fullCal'
            'themeName'=>'redmond',

            // (int) 0 - Sun, 1 - Mon
            'firstDay'=>0,

            'timeFormat'=>'H(:mm)',
            'header'=>array(
                            'left'=>'today prev,next',
                            'center'=>'title', //basicWeek,basicDay,
                            'right'=>'month,agendaWeek,agendaDay'), //month,agendaWeek,agendaDay
            'defaultView'=>'month',
            'buttonText'=>array(
                            'today'=>'Today',
                            'month'=>'Month',
                            'week'=>'Week',
                            'day'=>'Day',
            ),
            'monthNames'=>array('January', 'February', 'March', 'April', 'May', 'June', 'July',
                            'August', 'September', 'October', 'November', 'December'),
            'monthNamesShort'=>array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
            'dayNames'=>array('Sunday', 'Monday', 'Tuesday', 'Wednesday',
                            'Thursday', 'Friday', 'Saturday'),
            'dayNamesShort'=>array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'),
            'allDayText'=>'All day',
            'axisFormat'=>'HH(:mm)',
            'slotMinutes'=>30,
            'firstHour'=>8,     // first visible hour
            'minTime'=>'7:30',  // start day time
            'maxTime'=>'21:00', // end day time

            // Cron check all events for all users
            // from now to (now + cronPeriod)
            // and send alert via e-mail or/and sms.
            // Call controller 'cal/cron' every 'cronPeriod' minutes.
            // User preference dialog hidded if value set to 0.
            'cronPeriod'=>60, // minutes
    );

    public function init()
    {
        $this->defaultController = 'main';
        // import the module-level models and components
        $this->setImport(array(
                'cal.models.*',
                'cal.components.*',
        ));
        if( $this->debug == true)
        {
            $this->tableCreate();
        }

        if(!empty($_GET['layout'])) $this->layout = $_GET['layout'];
    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

    protected function tableCreate()
    {
        $db = Yii::app()->db;
        if($db)
        {
            $transaction = $db->beginTransaction();
            if(!in_array('events', $db->getSchema()->tableNames))
            {
                $sql = "CREATE TABLE IF NOT EXISTS `events` (
                     `id` int unsigned NOT NULL auto_increment,
                     `user_id` int unsigned NOT NULL,
                     `title` varchar(1000) character set utf8 default NULL,
                     `allDay` smallint unsigned NOT NULL default 0,
                     `start` int unsigned,
                     `end` int unsigned,
                     `editable` tinyint(1) NOT NULL default 1,
                      PRIMARY KEY  (`id`)
                        ) DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;";
                $db->createCommand($sql)->execute();
            }
            if(!in_array('events_helper', $db->getSchema()->tableNames))
            {
                $sql = "CREATE TABLE IF NOT EXISTS `events_helper` (
                     `id` int unsigned NOT NULL auto_increment,
                     `user_id` int unsigned NOT NULL,
                     `title` varchar(1000) character set utf8 default NULL,
                      PRIMARY KEY  (`id`)
                        ) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
                $db->createCommand($sql)->execute();
                
                $sql="INSERT INTO `events_helper`(`user_id`, `title`) VALUES (1,'test event 1');";
                $db->createCommand($sql)->execute();
                $sql="INSERT INTO `events_helper`(`user_id`, `title`) VALUES (1,'test event 2');";
                $db->createCommand($sql)->execute();
            }

            if(!in_array('events_user_preference', $db->getSchema()->tableNames))
            {
                $sql = "CREATE TABLE IF NOT EXISTS `events_user_preference` (
                     `user_id` int unsigned NOT NULL,
                     `mobile` varchar(20) character set utf8 default NULL,
                     `mobile_alert` tinyint(1) NOT NULL default 0,
                     `email` varchar(40) character set utf8 default NULL,
                     `email_alert` tinyint(1) NOT NULL default 0,
                      PRIMARY KEY  (`user_id`)
                        ) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
                $db->createCommand($sql)->execute();
            }
            $transaction->commit();
        }
        else throw new CException('Database connection is not working');
    }
}

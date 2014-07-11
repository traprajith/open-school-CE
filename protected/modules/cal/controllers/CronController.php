<?php

class CronController extends RController {

    public function actionIndex() 
    {
        if (!Yii::app()->controller->module->calendarOptions['cronPeriod']) return;
        $timeSlot = 60*Yii::app()->controller->module->calendarOptions['cronPeriod'];
        $timeStart = time(); 
        $timeEnd = $timeStart + $timeSlot;
        $sql = "select a.title, b.*";
        $sql .=" from events a, events_user_preference b";
        $sql .=" where a.user_id = b.user_id and a.start between :timeStart and :timeEnd";
        $sql .=" and ((b.mobile_alert = 1) or (b.email_alert = 1))";
        $db = Yii::app()->db;
        $command = $db->createCommand($sql);
        $command->bindParam(":timeStart", $timeStart, PDO::PARAM_INT);
        $command->bindParam(":timeEnd", $timeEnd, PDO::PARAM_INT);
        $rows = $command->query()->readAll();
        foreach ($rows as $row) { 
            if ((bool) $row['email_alert'])
                $this->sendCronMail($row['email'], $row['title']);
            if ((bool) $row['mobile_alert'])
            {
                $mobileAddr = $this->getMobileAddr($row['mobile']);
                if($mobileAddr)
                    $this->sendCronMail($mobileAddr, $row['title']);
            }
        }
    }

    protected function sendCronMail($addr, $body) {
        $from = Yii::app()->params['adminEmail'];
        $headers = "From: {$from}\r\nReply-To: {$from}";
        mail($addr, 'Calendar event', $body, $headers);
    }

    protected function getMobileAddr($mobile)
    {
        $smsGate = array(
            '097'=>'@2sms.kyivstar.net',
            '050'=>'@sms.umc.ua',
            '068'=>'@sms.beeline.ua',
            '066'=>'@sms.jeans.com.ua',
        );
        $operator = substr($mobile, 0, 3);
        if(array_key_exists($operator, $smsGate))
            return $mobile.$smsGate[$operator];
        else
            return false;
    }
}
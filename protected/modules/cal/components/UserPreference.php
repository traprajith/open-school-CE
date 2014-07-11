<?php

class UserPreference extends CWidget
{

    public $userId;

    public function run()
    {
        $userPref = EventsUserPreference::model()->findByPk($this->userId);
        if(is_null($userPref)) {
            $userPref = new EventsUserPreference;
            $userPref->user_id = $this->userId;
            $userPref->save();
        }
        $formUserPref = new CForm('application.modules.cal.views.main.formUserPref', $userPref);
        echo $formUserPref;
    }
}

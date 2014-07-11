<?php

Yii::import('zii.widgets.CPortlet');

class EventHelper extends CPortlet
{

    public $title;
    public $userId;
    public $dialogMode = false;

    public function init()
    {
        if(!$this->dialogMode)
            $this->title = Yii::t('CalModule.fullCal', 'Events list');
        parent::init();
    }

    protected function renderContent()
    {
        $criteria = new CDbCriteria(array('condition' => 'user_id=' . $this->userId));
        $events = EventsHelper::model()->findAll($criteria);
        $this->render('eventHelper', array('eventsList'=>$events, 'dialogMode'=>$this->dialogMode));
    }

}
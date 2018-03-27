<?php

class MainController extends RController
{
	
    public function init()
    {
        $this->layout = $this->module->layout;
        $this->defaultAction = 'browse';
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'rights', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', 
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Render event calendar page.
     */
    public function actionBrowse()
    {
        Yii::app()->clientScript->scriptMap['jquery-ui-1.8.17.custom.min.js'] = false;
        $userId = (isset($_POST['currentUser'])) ? $_POST['currentUser'] : Yii::app()->user->getId();
        Yii::app()->user->setState('calUserId', $userId);
		
		/*$criteria = new CDbCriteria(array(
		'condition' => 'user_id=:user_id',
		'params'=>array(':user_id'=>1),
		));
		//$criteria->addBetweenCondition('start',0,0,'AND');
		$events = Event::model()->findAll($criteria);
		foreach($events as $event)
		{
			echo $event->start.'-'.$event->end.'/////';
		}*/
					
		$this->render('browse', array('userId' => $userId));
           
    }

    /**
     * Return events as JSON-string for AJAX call
     * @param <int> $start unix time
     * @param <int> $end   unix time
     */
    public function actionList($start = 0, $end = 0)
    {
		//echo $_REQUEST['type'];exit;
        if ((Yii::app()->request->isAjaxRequest) and (Yii::app()->user->hasState('calUserId')) )
        {
			if($_GET['type'])
			{
            $criteria = new CDbCriteria(array(
                        'condition' => 'type=:type',
                        'params'=>array(':type'=>$_GET['type']),
                    ));
			}
			else
			{
				 $criteria = new CDbCriteria();
				
			}
            $criteria->addBetweenCondition('start', $start, $end);
			
            $events = Event::model()->findAll($criteria);
			
			
			foreach($events as  $k => $event){
				//code
				$event_type = EventsType::model()->findByPk($event->type);
				$events[$k]['code']	=	$event_type->colour_code;
			}
			
            echo CJSON::encode($events);
			
            Yii::app()->end();
        }
    }

    /**
     *  Update or create new event via AJAX
     */
    public function actionUpdate()
    {
        if (!Yii::app()->user->hasState('calUserId'))
            Yii::app()->end();
        $user_id = Yii::app()->user->getState('calUserId');
        $title = $_POST['title'];
		$desc = $_POST['desc'];
		$type = $_POST['type'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $allDay = ($_POST['allDay'] == 'true') ? 1 : 0;
        $editable = ($_POST['editable'] == 'true') ? 1 : 0;
        $eventId = $_POST['eventId'];
		$placeholder = $_POST['placeholder'];
		$organizer= $_POST['organizer'];				
        if (Yii::app()->request->isAjaxRequest)
        {
            $event = ($eventId == 0) ? new Event : Event::model()->findByPk($eventId);
			$event->title = $title;
			$event->desc = $desc;
			$event->type = $type;
			$event->user_id = $user_id;
			$event->start = $start;
			$event->end = $end;
			$event->allDay = $allDay;
			$event->editable = $editable;
			$event->placeholder = $placeholder;
			$event->organizer=$organizer;			
			if($event->save()){
				
					$users_arr = array();	
					if($_POST['placeholder'] != '0'){
						$criteria	= new CDbCriteria();
						$criteria->condition 	= 'itemname=:itemname AND userid<>:userid';
						$criteria->params		= array(':itemname'=>$_POST['placeholder'], ':userid'=>Yii::app()->user->id);
						$users 					= AuthAssignment::model()->findAll($criteria);
						if($users){
							foreach($users as $user){
								if(!in_array($user->userid, $users_arr)){
									$users_arr[] = $user->userid;
								}
							}
						}
					}				
					$criteria	= new CDbCriteria();					 
					if($_POST['placeholder'] != '0'){
						$criteria->addInCondition('uid', $users_arr);
					}
					else{
						$criteria->condition		= 'uid<>:uid';
						$criteria->params[':uid']	= Yii::app()->user->id;
					}           

				echo $event->id;
			}
			else{
				echo json_encode($event->getErrors());					
			}
			Yii::app()->end();
        }
    }

    /**
     *  Move event via AJAX
     */
    public function actionMove()
    {
        if (!Yii::app()->user->hasState('calUserId'))
            Yii::app()->end();
		
        $delta = $_POST['delta'];
        $allDay = ($_POST['allDay'] == 'true') ? 1 : 0;
        $eventId = $_POST['eventId'];
        if ((Yii::app()->request->isAjaxRequest) and !empty($eventId))
        {
            $event = Event::model()->findByPk($eventId);
            $event->start += $delta;
            $event->end += $delta;
            $event->allDay = $allDay;
            $event->save();
            Yii::app()->end();
        }
    }

    /**
     *  Resize event via AJAX
     */
    public function actionResize()
    {
        if (!Yii::app()->user->hasState('calUserId'))
            Yii::app()->end();

        $delta = $_POST['delta'];
        $eventId = $_POST['eventId'];
        if ((Yii::app()->request->isAjaxRequest) and !empty($eventId))
        {
            $event = Event::model()->findByPk($eventId);
            $event->end += $delta;
            $event->save();
            Yii::app()->end();
        }
    }

    /**
     *  Add new record in the list
     */
    public function actionCreateHelper()
    {
        if (!Yii::app()->user->hasState('calUserId'))
            Yii::app()->end();

        $user_id = Yii::app()->user->getState('calUserId');
        $title = $_POST['title'];

        if (Yii::app()->request->isAjaxRequest)
        {
            $ev = new EventsHelper;
            $ev->title = $title;
            $ev->user_id = $user_id;
            $ev->save();
            Yii::app()->end();
        }
    }
	
	
	public function actionDelete()
    {
         if (Yii::app()->request->isAjaxRequest)
        {
            if (!Yii::app()->user->hasState('calUserId'))
                Yii::app()->end();
            
            $user_id 	= Yii::app()->user->getState('calUserId');
            $title 		= $_POST['title'];
			$event_id	= $_POST['eventId'];
			$event		= Events::model()->findByAttributes(array('id'=>$event_id));
			if($event){
				$event->delete();
			}            
			echo 0;
            Yii::app()->end();
        }
    }
	
	public function deletePermission()
	{
		$role = Rights::getAssignedRoles(Yii::app()->user->Id);				
		if(key($role) == 'Admin'){
			return 1;
		}
		else{
			return 0;
		}
	}

	

    /**
     *  Remove record from table
     */
    public function actionRemoveHelper()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            if (!Yii::app()->user->hasState('calUserId'))
                Yii::app()->end();

            //$user_id = $_POST['ui'];
            $user_id = Yii::app()->user->getState('calUserId');
            $title = $_POST['title'];
            $criteria = new CDbCriteria;
            $criteria->condition = 'user_id=:user_id';
            $criteria->params = array(':user_id' => $user_id);
            $criteria->addSearchCondition('title', $title);
            $eventsHelper = EventsHelper::model()->find($criteria);
            $eventsHelper->delete();
            Yii::app()->end();
        }
    }

    /**
     *  Store preference (e-mail, mobile) for current user
     */
    public function actionUserpreference()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            if (!Yii::app()->user->hasState('userId'))
                Yii::app()->end();

            $userPref = EventsUserPreference::model();
            $userPref->attributes = $_POST['EventsUserpreference'];
            $userPref->updateByPk(Yii::app()->user->getState('calUserId') /*$userPref->attributes['user_id']*/, $_POST['EventsUserpreference']);
            Yii::app()->end();
        }
    }

}
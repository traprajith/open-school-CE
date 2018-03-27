<?php

/**
 * This is the model class for table "dashboard".
 *
 * The followings are the available columns in table 'dashboard':
 * @property integer $id
 * @property string $block
 * @property integer $is_visible
 * @property integer $portal
 * @property integer $default_order
 */
class Dashboard extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Dashboard the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dashboard';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('block', 'required'),
			array('is_visible, portal, default_order', 'numerical', 'integerOnly'=>true),
			array('block', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, block, is_visible, portal, default_order', 'safe', 'on'=>'search'),
		);
	}
        

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'block' => 'Block',
			'is_visible' => 'Is Visible',
			'portal' => 'Portal',
			'default_order' => 'Default Order',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('block',$this->block,true);
		$criteria->compare('is_visible',$this->is_visible);
		$criteria->compare('portal',$this->portal);
		$criteria->compare('default_order',$this->default_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        //get recent news
        public static function getNews()
        {
            $news = DashboardMessage::model()->findAll(array("condition"=>"recipient_id='".Yii::app()->getModule('mailbox')->newsUserId."'",'order'=>'message_id DESC'));
            return $news;
        }
        
        //get student admission counts
        public static function getStudents()
        {
            if(Yii::app()->user->year)
            {
                $year = Yii::app()->user->year;
            }
            else
            {
                $current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
                $year = $current_academic_yr->config_value;
            }
            $criteria = new CDbCriteria; 
            $criteria->compare('is_deleted',0);
            $criteria->condition = 'is_active=:is_active and is_deleted = :is_deleted';
            $criteria->params = array(':is_active'=>1,'is_deleted'=>0);
            $batch_stu = BatchStudents::model()->findAllByAttributes(array('result_status'=>0,'status'=>1,'academic_yr_id'=>$year));
            $students	=array();
            foreach($batch_stu as $stu)
            {
                $students[]	=	$stu->student_id;
            }
            $criteria->addInCondition('id',$students);
            //end
            $total = Students::model()->count($criteria);
            $criteria->order = 'id DESC';
            $criteria->limit = '10';
            $recent = Students::model()->findAll($criteria);
            $inactive =   Students::model()->findAll(array('condition'=>'is_active=:x AND is_deleted=:y','params'=>array(':x'=>'0',':y'=>'0'),'group'=>'id'));
            
            return array('total'=>$total,'recent'=>$recent,'inactive'=>$inactive);
        }

        
        //teacher details
        public static function getTeacherCount()
        {
            $criteria = new CDbCriteria;
            $criteria->compare('is_deleted',0);
            $total = Employees::model()->count($criteria);
            $criteria->order = 'id DESC';
            $criteria->limit = '10';
            $posts = Employees::model()->findAll($criteria);
            
            return array('total'=>$total,'recent'=>count($posts));
        }
        
        //events details
        public static function getEvents()
        {
            $events_sameday =   $events_sameweek    =   $events_nextweek    =   $events_nextmonth   =   array();
            $criteria = new CDbCriteria;
            $criteria->order = 'start DESC';
            if($rolename!= 'Admin')
            {
                $criteria->condition = 'placeholder = :default or placeholder=:placeholder';
                $criteria->params[':placeholder'] = $rolename;
                $criteria->params[':default'] = '0';
            }
            $events = Events::model()->findAll($criteria);
            if($events and $events!=NULL)
            {
                foreach($events as $event)
                {
                    $today              = strtotime("00:00:00");
                    $next_monday = strtotime('Next Monday', $today);
                    $second_next_monday = strtotime('+1 week',$next_monday);
                    $next_month = strtotime('+1 month',$today);
                    $next_month_start = strtotime('first day of this month',$next_month);
                    $next_month_end = strtotime('first day of next month',$next_month);

                    if(date("Y-m-d",$event->start) == date('Y-m-d') )
                    {
                    $events_sameday[] = $event ; 
                    }
                    elseif($event->start >= $today and $event->start < $next_monday)
                    {
                    $events_sameweek[] = $event ; 
                    }
                    elseif($event->start >= $next_monday and $event->start < $second_next_monday)
                    {
                    $events_nextweek[] = $event ; 	
                    }
                    elseif($event->start >= $next_month_start and $event->start < $next_month_end)
                    {
                    $events_nextmonth[] = $event ; 	
                    }
                }
            }            
            return array('events_sameday'=>$events_sameday,'events_sameweek'=>$events_sameweek,'events_nextweek'=>$events_nextweek,'events_nextmonth'=>$events_nextmonth);
        }
        
       
}
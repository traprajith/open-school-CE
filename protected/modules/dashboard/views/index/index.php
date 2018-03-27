<link href="<?php echo Yii::app()->request->baseUrl;?>/css/tabulous.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl;?>/css/portal/portal_dashboard.css" rel="stylesheet" type="text/css" />
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/tab/tabulous.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/tab/dash_tab.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/scroll/perfect-scrollbar.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/scroll/jquery.mousewheel.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/scroll/chart-js/data.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/scroll/chart-js/drilldown.js"></script>
<script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('.Default').perfectScrollbar();
      });
</script>
<?php $this->breadcrumbs = array(
	Yii::t('app', 'Dashboard'),
);?>    
<?php
    $currdate = date('d-m-Y');
    $one =date("m"); 
    $one_1=date("M");
    $two =date("m d y", strtotime("-1 months", strtotime($currdate))); 
    $two_1 =date("M", strtotime("-1 months", strtotime($currdate))); 
    $three =date("m", strtotime("-2 months", strtotime($currdate))); 
    $three_1=date("M", strtotime("-2 months", strtotime($currdate))); 
    $four =date("m", strtotime("-3 months", strtotime($currdate))); 
    $four_1 =date("M", strtotime("-3 months", strtotime($currdate))); 
    $five =date("m", strtotime("-4 months", strtotime($currdate))); 
    $five_1 =date("M", strtotime("-4 months", strtotime($currdate))); 
    $six =date("m", strtotime("-5 months", strtotime($currdate))); 
    $six_1 =date("M", strtotime("-5 months", strtotime($currdate))); 
    $seven =date("m", strtotime("-6 months", strtotime($currdate))); 
    $seven_1 =date("M", strtotime("-6 months", strtotime($currdate))); 
    $eight =date("m", strtotime("-7 months", strtotime($currdate))); 
    $eight_1 =date("M", strtotime("-7 months", strtotime($currdate))); 
    $nine =date("m", strtotime("-8 months", strtotime($currdate))); 
    $nine_1 =date("M", strtotime("-8 months", strtotime($currdate))); 
    $ten =date("m", strtotime("-9 months", strtotime($currdate))); 
    $ten_1 =date("M", strtotime("-9 months", strtotime($currdate))); 
    $eleven =date("m", strtotime("-10 months", strtotime($currdate))); 
    $eleven_1 =date("M", strtotime("-10 months", strtotime($currdate))); 
    $twelve =date("m", strtotime("-11 months", strtotime($currdate))); 
    $twelve_1 =date("M", strtotime("-11 months", strtotime($currdate))); 
	
    $data_1 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$one,':status'=>'0'));	
    $data_2 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$two,':status'=>'0'));
    $data_3 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$three,':status'=>'0'));
    $data_4 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$four,':status'=>'0'));
    $data_5 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$five,':status'=>'0'));
    $data_6 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$six,':status'=>'0'));
    $data_7 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$seven,':status'=>'0'));
    $data_8 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$eight,':status'=>'0'));
    $data_9 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$nine,':status'=>'0'));
    $data_10 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$ten,':status'=>'0'));
    $data_11 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$eleven,':status'=>'0'));
    $data_12 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$twelve,':status'=>'0'));

    $month = '["'.$one_1.'","'.$two_1.'","'.$three_1.'","'.$four_1.'","'.$five_1.'","'.$six_1.'","'.$seven_1.'","'.$eight_1.'","'.$nine_1.'","'.$ten_1.'","'.$eleven_1.'","'.$twelve_1.'",]';
    $data = "[".count($data_1).",".count($data_2).",".count($data_3).",".count($data_4).",".count($data_5).",".count($data_6).",".count($data_7).",".count($data_8).",".count($data_9).",".count($data_10).",".count($data_11).",".count($data_12).",]";
?>
  
<script type="text/javascript">
var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			type: 'column'
		},
		title: {
			text: '<?php echo Yii::t('app','Monthly Average Admissions'); ?>'
		},
		subtitle: {
		},
		xAxis: {
			categories: 
				<?php echo $month; ?>
			
		},
		yAxis: {
			min: 0,
			title: {
				text: '<?php echo Yii::t('app','No.of Admissions'); ?>'
			}
		},
		credits: {
			enabled: false
		},

		legend: {
			layout: 'none',

		},
		tooltip: {
			formatter: function() {
				return ''+
					this.x +': '+ this.y +' '+'<?php echo Yii::t('app','Admissions'); ?>';
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
			series: [{
			name: '<?php echo Yii::t('app','Month'); ?>',
			data: <?php echo $data; ?>,
			color:'#adce5c',
		}, ]
	});
});
</script>

<!--------examination ---script------>
<?php
$average	= 0;
$anual_avg	= 0;
$avg		= 0;
$last_avg	= 0;
//exam_group_ids
$exam_group_ids	= array();
//exam_ids
$exam_ids	= array();
$exam_criteria	= array();
$all_students_marks	= array();
$passed_students	= array();
$max_total_marks	= 0;
$students_total_marks	= 0;

//exam groups
$criteria		= new CDbCriteria;
$criteria->condition	= 'YEAR(`exam_date`) = :this_year AND `result_published`=:result_published';
$criteria->params	= array( ':this_year' => date('Y'),':result_published' =>1);						  						  
$exam_groups            = ExamGroups::model()->findAll($criteria);

if(count($exam_groups)>0)
{
    foreach($exam_groups as $exam_group){
        array_push($exam_group_ids, $exam_group->id);
    }	
    //exams
    $criteria		= new CDbCriteria;
    $criteria->addInCondition('`exam_group_id`', $exam_group_ids);
    $exams              = Exams::model()->findAll($criteria);
    if(count($exams)>0){
            foreach($exams as $exam){	
                    array_push($exam_ids, $exam->id);	
                    $exam_criteria[$exam->id]	= array('min'	=> $exam->minimum_marks,'max'	=> $exam->maximum_marks);                                                      
            }
            //exam scores
            $criteria		= new CDbCriteria;
            $criteria->addInCondition('`exam_id`', $exam_ids);
            $exam_scores	= ExamScores::model()->findAll($criteria);
            if(count($exam_scores)>0){
                    foreach($exam_scores as $exam_score){
                            $all_students_marks[$exam_score->student_id][$exam_score->exam_id]	= $exam_score->marks;
                    }

                    //fetching all student ids for checkig if student exists
                    $allstudents	= Students::model()->findAll();
                    $student_ids	= array();
                    foreach($allstudents as $student){
                            array_push($student_ids, $student->id);
                    }

                    foreach($all_students_marks as $student_id=>$student_marks){				
                            if(in_array($student_id, $student_ids)){
                                    $student_passed_the_exam	= true;
                                    foreach($student_marks as $exam_id=>$mark){
                                            if($mark < $exam_criteria[$exam_id]['min'])		//checking mark with $exam_criteria min mark
                                                    $student_passed_the_exam	= false;

                                            $max_total_marks		+= $exam_criteria[$exam_id]['max'];
                                            $students_total_marks	+= ($mark > $exam_criteria[$exam_id]['max'])?$exam_criteria[$exam_id]['max']:$mark;
                                    }

                                    //check if student passed
                                    if($student_passed_the_exam)
                                        array_push($passed_students, $student_id);	
                            }
                            else{
                                unset($all_students_marks[$student_id]);
                            }
                    }
            }
    }
}
//annual exam pass
$average	=	floor(( count($passed_students) / count($all_students_marks) ) * 100);
//annual exam average marks
$anual_avg	=	floor(( $students_total_marks / $max_total_marks ) * 100);
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/justgage.1.0.1.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/raphael.2.1.0.min.js"></script>
<script>
	var dg1, dg2, g3, g4;
	window.onload = function(){
	
	var dg1 = new JustGage({
	id: "dg1", 
	value: <?php echo $average;?>, 
	levelColors : Array("#fd2600","#fc4f00","#b0e108"),
	min: 0,
	max: 100,
	title: "<?php echo Yii::t('app','Annual Exam Pass'); ?>",
	titleFontColor :"#464646",
	label: "<?php echo Yii::t('app','percentage'); ?>"
	});
	
	var dg2 = new JustGage({
	id: "dg2", 
	value:<?php echo $anual_avg;?>, 
	min: 0,
	max: 100,
	titleFontColor :"#464646",
	title: "<?php echo Yii::t('app','Annual Exam Average Marks'); ?>",
	label: "<?php echo Yii::t('app','marks'); ?>"
	});
	
	/*var g3 = new JustGage({
	id: "g3", 
	value:<?php //echo $avg;?>, 
	min: 0,
	max: 100,
	titleFontColor :"#464646",
	title: "Last Assessment Pass",
	label: "percentage"
	});
	
	var g4 = new JustGage({
	id: "g4", 
	value:<?php //echo $last_avg;?>, 
	min: 0,
	max: 100,
	titleFontColor :"#464646",
	title: "Last Assessment Average",
	label: "percentage"
	});*/
	
	/*setInterval(function() {
	g1.refresh(getRandomInt(50, 100));
	g2.refresh(getRandomInt(50, 100));          
	g3.refresh(getRandomInt(0, 50));
	g4.refresh(getRandomInt(0, 50));
	}, 2500);*/
	};
</script>


 

<div class="dashboard_bg">
    <?php 
    $roles = Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
    foreach($roles as $role)
    {
        $rolename = $role->name;
    }		
    if($rolename == 'parent')
    { ?> 
        <div class="dash_child">
            <h4><?php echo Yii::t('app','Children'); ?></h4>
            <div class="children_area">
            <ul> <?php
                    $parent = Guardians::model()->findByAttributes(array('uid'=>Yii::app()->user->Id)) ;
                    $wards = Students::model()->findAllByAttributes(array('parent_id'=>$parent->id)) ;
                    foreach($wards as $ward)
                    {
                            echo '<li>'.CHtml::link($ward->first_name, array('/dashboard','id'=>$ward->uid)).'</li>';
                            $check_uid[] = $ward->uid;
                    }
                    ?> 
                    </ul>
            </div>
            <div class="clear"></div>        
        </div>
        <?php			
            if(in_array($_REQUEST['id'], $check_uid))
            {
                $student_user_id = $_REQUEST['id'];
            }
    }
    elseif($rolename == 'student')
    {
        $student_user_id = Yii::app()->user->Id ;
    }		
    ?>
    <div class="clear"></div>

    <!------------News--start---------------->  
    <div class="os_dash_box">
        <div class="dash_subhed news"><?php echo Yii::t('app','News'); ?></div>
        <div class="Default dash_box1_iner-pdng dash_bord-scrol left-icon dash_box-pading" >
            <ul>
                <?php 
                //$newss = DashboardMessage::model()->findAllByAttributes(array('recipient_id'=>Yii::app()->getModule('mailbox')->newsUserId));
                $news_data = Dashboard::getNews();
                if($news_data and $news_data!=NULL)
                { 
                    foreach($news_data as $news)
                    { ?>
                        <li class="mail_green">
                            <h3><?php echo @Mailbox::model()->findByAttributes(array('conversation_id'=>$news->conversation_id))->subject ;?></h3>
                            <p><?php echo $news->text; ?></p>
                            <span><?php echo DashboardMessage::getTime($news->created); ?></span>
                        </li>
                <?php }
                }
                else
                {?>    
                    <li>
                        <h3><?php echo Yii::t('app','No News'); ?></h3>
                        <p>. . . .</p>
                    </li>
                <?php } ?>
            </ul>
        </div>
        
        <div class="dash_bottom dashboard-action-blk">
            <ul>
                <li></li>
                <li><?php echo CHtml::link(Yii::t('app','View'), array('/mailbox/news'));?></li>
                <?php 
                if(Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('My Account'))
                { ?>                                                            
                    <li><?php echo CHtml::link(Yii::t('app','Create'), array('/news/create'));?></li>
                <?php } ?>                                                                               
            </ul>
        </div>
    </div>
    <!------------News--end-----------------> 
    
    <!------------Event--start---------------->      
    <div class="os_dash_box">
        <div class="dash_subhed">
		<div class="dash_subhed_hide_one events"><?php echo Yii::t('app','Events'); ?></div>
        <div class="dash_subhed_hide_two"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
        
        <div class="dash_box-pading">
            <div id="tabs4" class="event-tab">
                <ul id="tm23">
                    <li><a href="#tabs-1" title=""><?php echo Yii::t('app','Today'); ?></a></li>
                    <li><a href="#tabs-2" title=""><?php echo Yii::t('app','Current Week'); ?></a></li>
                    <li><a href="#tabs-3" title=""><?php echo Yii::t('app','Next Week'); ?></a></li>
                    <li><a href="#tabs-4" title=""><?php echo Yii::t('app','Next month'); ?></a></li>
                </ul>
                <div id="tabs_container" class="mousescroll Default">
                <?php 
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
                    ?>
                    <div id="tabs-1">
                    <?php 
                        if($events_sameday and $events_sameday!=NULL)
                        {
                            foreach($events_sameday as $event_sameday)
                            {
                                echo CHtml::ajaxLink('<h3>'.substr($event_sameday->title,0,25).'</h3>
                                            <p>'.substr($event_sameday->desc,0,50).'</p>
                                            <span>'.date("Y-m-d",$event_sameday->start).'</span>',$this->createUrl('default/view',array('event_id'=>$event_sameday->id)),array('update'=>'#jobDialog'),array('id'=>'showJobDialog1'.$event_sameday->id,'class'=>'add event-inner-blk'));
                            }
                        }
                        else
                        {
                            echo '<p class="mail_dashnew_error">'.Yii::t('app','No Events Today').'</p>';
                        }
                    ?>
                    </div>

                    <div id="tabs-2">
                    <?php 
                        if($events_sameweek and $events_sameweek!=NULL)
                        {
                            foreach($events_sameweek as $event_sameweek)
                            {
                                echo CHtml::ajaxLink('<h3>'.substr($event_sameweek->title,0,25).'</h3>
                                            <h5>'.substr($event_sameweek->desc,0,50).'</h5>
                                            <h4 class="tab_date">'.date("Y-m-d",$event_sameweek->start).'</h4>',$this->createUrl('default/view',array('event_id'=>$event_sameweek->id)),array('update'=>'#jobDialog'),array('id'=>'showJobDialog1'.$event_sameweek->id));
                            }
                        }
                        else
                        {
                            echo '<p class="mail_dashnew_error">'.Yii::t('app','No Upcoming Events This week').'</p>';
                        }
                    ?>
                    </div>

                    <div id="tabs-3">
                    <?php 
                        if($events_nextweek and $events_nextweek!=NULL)
                        {
                            foreach($events_nextweek as $event_nextweek)
                            { 
                                echo CHtml::ajaxLink('<h3>'.substr($event_nextweek->title,0,25).'</h3>
                                            <h5>'.substr($event_nextweek->desc,0,50).'</h5>
                                            <h4 class="tab_date">'.date("Y-m-d",$event_nextweek->start).'</h4>',$this->createUrl('default/view',array('event_id'=>$event_nextweek->id)),array('update'=>'#jobDialog'),array('id'=>'showJobDialog1'.$event_nextweek->id));
                            }
                        }
                        else
                        {
                            echo '<p class="mail_dashnew_error">'.Yii::t('app','No Upcoming Events Next Week').'</p>';
                        }
                    ?>
                    </div>

                    <div id="tabs-4">
                    <?php 
                        if($events_nextmonth and $events_nextmonth!=NULL)
                        {
                            foreach($events_nextmonth as $event_nextmonth)
                            {

                                echo CHtml::ajaxLink('<h3>'.substr($event_nextmonth->title,0,25).'</h3>
                                            <h5>'.substr($event_nextmonth->desc,0,50).'</h5>
                                            <h4 class="tab_date">'.date("Y-m-d",$event_nextmonth->start).'</h4>',$this->createUrl('default/view',array('event_id'=>$event_nextmonth->id)),array('update'=>'#jobDialog'),array('id'=>'showJobDialog1'.$event_nextmonth->id));
                            }
                        }
                        else
                        {
                            echo '<p class="mail_dashnew_error">'.Yii::t('app','No Upcoming Events Next Month').'</p>';
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="dash_bottom dashboard-action-blk">
            <ul>
                <li></li>
                <li><?php echo CHtml::link(Yii::t('app','View'), array('default/events'));?></li>
                <?php  
                if(Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('My Account'))
                { 
                ?>
                <li><?php echo CHtml::link(Yii::t('app','Create'), array('/cal'));?></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <!------------Event--end----------------->

    <!------------Students--start----------------->
    <?php 
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
    ?>

    <div class="os_dash_box">
        <div class="dash_subhed student"><?php echo Yii::t('app','Student'); ?></div>
        <div class="dash_box-pading">
            <a href="#">
                <div class="dash_st_grid st_grid_colr1">                    
                    <h3><?php echo (isset($total))?$total:"-"; ?></h3>
                    <p><?php echo Yii::t('app','Total Student'); ?></p>
                </div>
            </a>
            <a href="#">
            <div class="dash_st_grid st_grid_colr2">
                <h3><?php echo (isset($recent))?count($recent):"-"; ?></h3>
                <p><?php echo Yii::t('app','New Admissions'); ?></p>
            </div>
            </a>
            <a href="#">
            <div class="dash_st_grid st_grid_colr3">                
                <h3><?php echo (isset($inactive))?count($inactive):"-"; ?></h3>
                <p><?php echo Yii::t('app','Inactive Students'); ?></p>
            </div>
            </a>
            <div class="clear-fix"></div>
            <div class="cv">
               <div id="container" style="width:100%; height: 155px; margin: 0 auto"></div>
            </div>           
        </div>                
        <div class="dash_bottom dashboard-action-blk">
            <ul>
                <li></li>
                <li><a href="">View</a></li>
                <li><a href="">Create</a></li>
            </ul>
        </div>
    </div>
    <!------------Students--end----------------->
    
    <!------------Teacher--start----------------->
    <div class="os_dash_box">
            <div class="dash_subhed teacher">Teacher</div>
                    <div class="dash_box-pading">
                    <a href="#">
                    <div class="dash_st_grid2 t_grid_colr1">
                        <h3>14</h3>
                        <p>Total Teacherst</p>
                    </div>
                </a>
                <a href="#">		
                    <div class="dash_st_grid2 st_grid_colr2">
                        <h3>14</h3>
                        <p>Recently Hired</p>
                    </div>
                </a>
            </div>
        <div class="dash_bottom dashboard-action-blk">
        <ul>
                    <li></li>
            <li><a href="">View</a></li>
            <li><a href="">Create</a></li>
        </ul>
        </div>
    </div>
    <!------------Teacher--end----------------->
    
    <!------------Examination--start----------------->
    <div class="os_dash_box">
            <div class="dash_subhed examination">Examination</div>
            <div class="dash_box-pading">
                        <div class="clear"></div>
                        <div id="dg1" style=" width:100%; height:100px;"></div>
                       <div id="dg2" style=" width:100%; height:100px;"></div>
            </div>
        <div class="dash_bottom dashboard-action-blk">
        <ul>
            <li><a href="">View</a></li>
        </ul>
        </div>
    </div> 
    <!------------Examination--end----------------->
    
    <!------------Attendance--start----------------->
    <div class="os_dash_box">
            <div class="dash_subhed timetable">Attendance</div>
            <div class="dash_box-pading">
                <div class="dash_attnd_grid attnd_grid_colr1">
                    <a href="#">
                    <div class="innet_attnd-block1 innet_attnd-orang1">
                        <h3>Student</h3>
                        <p>Attendance</p>
                    </div>
                    </a>
                    <div class="innet_attnd-block2 innet_attnd-orang2">
                        <h3>5/<span>10</span></h3>
                    </div>
                </div>
                            <div class="dash_attnd_grid attnd_grid_colr2">
                    <a href="#">
                        <div class="innet_attnd-block1 innet_attnd-gray1">
                            <h3>Student</h3>
                            <p>Attendance</p>
                        </div>
                    </a>
                    <div class="innet_attnd-block2 innet_attnd-gray2">
                        <h3>5/<span>10</span></h3>
                    </div>
                </div>
            </div>
        <div class="dash_bottom dashboard-action-blk">
        <ul>
            <li><a href="">View</a></li>
            <li><a href="">Create</a></li>
        </ul>
        </div>
    </div> 
    <!------------Attendance--end----------------->
    
    <!------------Mailbox--start----------------->
    <?php $mailbox_messages = new CActiveDataProvider(News::model()->inbox(Yii::app()->user->Id)); ?>
    <div class="os_dash_box1">
        <div class="dash_subhed_mail mail_list"><?php echo Yii::t('app','Mailbox'); ?></div>
            <div class="Default ps-container dash_box1_iner-pdng dash_bord-scrol dash_box-pading ">
                <ul>
                                <?php $this->widget('zii.widgets.CListView', array(
                    'id'=>'mailbox',
                    'dataProvider'=>$mailbox_messages,
                    'itemView'=>'_news_list',
                    'template'=>'{items}',
                    )); ?>
                </ul>
            </div>
    </div>
    <!------------Mailbox--end----------------->
    
    <!------------Fees--start----------------->
    <div class="os_dash_box">
	<div class="dash_subhed fees">fees</div>
    	<div class="dash_box-pading">
            <div class="dash_attnd_grid fee_grid_colr1">
                <a href="#">
                    <div class="innet_attnd-block1 innet_attnd-orang1">
                        <h3>Total Fee </h3>
                        <p>Categories</p>
                    </div>
                </a>
                <div class="innet_attnd-block2 innet_attnd-orang2">
                    <h3>5</h3>
                </div>
            </div>
            <div class="dash_attnd_grid attnd_grid_colr2">
            	<a href="#">
                    <div class="innet_attnd-block1 innet_attnd-gray1">
                        <h3>Invoices</h3>
                        <p>Generated</p>
                    </div>
                </a>
                <div class="innet_attnd-block2 innet_attnd-gray2">
                    <h3>5</h3>
                </div>
            </div>
        </div>
        <div class="dash_bottom dashboard-action-blk">
            <ul>
                <li><a href="">View</a></li>
                <li><a href="">Create</a></li>
            </ul>
        </div>
    </div>
    <!------------Fees--end----------------->
   
    <?php 
	if(($rolename=='student' or $rolename=='parent') and isset($student_user_id))
	{		
            $student = Students::model()->findByAttributes(array('uid'=>$student_user_id)) ;
            if($student and $student!=NULL)
            {
            ?>
            <div class="dash_box4 for_student_box4">
                <div class="dash_subhed time_table"><?php echo Yii::t('app','Timetable'); ?>
                    <div class="subhed_date"><?php echo date('Y-m-d') ;?></div>
                </div>        
                <div  class="mousescroll Default">
                    <div class="time_table_dash">       	
                    <?php if($student->batch_id and ($student->batch_id !=NULL or $student->batch_id!=0))
                    { 
                        $check_entry = TimetableEntries::model()->findAllByAttributes(array('batch_id'=>$student->batch_id));
                        if($check_entry and $check_entry!=NULL)
                        {	
                            $TimetableEntries = TimetableEntries::model()->findAllByAttributes(array('batch_id'=>$student->batch_id,'weekday_id'=>date('N')+1));
                            if($TimetableEntries and $TimetableEntries!=NULL)
                            {
                                ?>
                                <table width="316" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th width="10% "><?php echo Yii::t('app','Time'); ?></th>
                                        <th><?php echo Yii::t('app','Subject'); ?></th>
                                    </tr>
                                    <?php foreach($TimetableEntries as $TimetableEntry)
                                    { ?>
                                    <tr>    
                                    <?php 	
                                        $ClassTiming= ClassTimings::model()->findByAttributes(array('id'=>$TimetableEntry->class_timing_id)); 	
                                        if($ClassTiming and $ClassTiming!=NULL)
                                        { ?>
                                            <td><div class="dash_blue"><?php echo $ClassTiming->start_time.' - '.$ClassTiming->end_time ?></div></td>
                                            <td><?php $subject = Subjects::model()->findByAttributes(array('id'=>$TimetableEntry->subject_id));
                                                if($subject and $subject!=NULL)
                                                {
                                                    echo $subject->name;
                                                }
                                                else
                                                {
                                                    echo '----';
                                                }?>
                                            </td>
                                        <?php }
                                        else
                                        { ?>
                                            <td><div class="dash_blue">..</div></td>
                                            <td>..</td>
                                        <?php         
                                        }	
                                        ?>            
                                    </tr>
                                    <?php   
                                    } ?>    
                                </table>
                                <?php 
                            }
                            else
                            {
                                echo Yii::t('app','No classes scheduled for today');
                            }
                        }
                        else
                        {
                            echo Yii::t('app','Time Table not available for your').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");
                        }
                    }
                    else
                    {	
                        echo Yii::t('app','You are not Enrolled in any').' '.Yii::app()->getModule("students")->labelCourseBatch();
                    }
                    ?>
                    </div>
                </div>
                <div class="dash_bottom">
                    <ul>
                        <li></li>
                        <li><div class="more"></div><?php echo CHtml::link(Yii::t('app','More'), array('/studentportal/default/timetable'));?></li>                                        
                    </ul>
                </div>
            </div>    
    <?php }} 
    ?>
    <?php 
	if(($rolename=='student' or $rolename=='parent') and isset($student_user_id))
	{ 
	if($student and $student!=NULL)
	{
	
	?>
    <div class="dash_box5">
    	<div class="dash_subhed attendance"><?php echo Yii::t('app','Attendance'); ?></div>
        <div class="attendance_date"><?php echo Yii::t('app','Last 7 days'); ?></div>
        
        <?php if($student->batch_id and ($student->batch_id !=NULL or $student->batch_id!=0))
        { 
		
		$weekdays = Weekdays::model()->findAllByAttributes(array('batch_id'=>$student->batch_id)); 
		
		if(count($weekdays)!=7)
		{
			$weekdays = Weekdays::model()->findAll("batch_id IS NULL");
		}
		?> 
        	<div class="att_listbox">
            	
                <?php 
				for ($i = 6; $i >= 0; $i--)
				{ ?>
                <ul>
                <li>
				
				<?php 
				$weekday_number = date('N', strtotime("-$i days")); 
				if($weekday_number==7)
				{
					$weekday_number =0 ;
				}
				
				$date = date('Y-m-d', strtotime("-$i days")); ?> 
                
				<?php echo $date ;echo date('D', strtotime("-$i days")); ?>
                
                </li>
                
                <?php if($weekdays[$weekday_number]['weekday']==0)
				{
					 echo '<li></li>';
                }
				else
				{
					$attendance = StudentAttentance::model()->findByAttributes(array('date'=>date('Y-m-d', strtotime("-$i days")),'student_id'=>$student->id)); 
					if($attendance and $attendance!=NULL)
					{
						echo '<li class="bg_white_cross"></li>';
					}
					else
					{
						echo '<li class="bg_white_tick"></li>';
					}
				}
					
					?></ul>
                <?php }?>
                	
                   
                
            </div>
            
            <?php 
			
			}
			else
			{
			  //echo Yii::t('app','You are not Enrolled in any Course/Batch');
			  echo Yii::t('app','You are not Enrolled in any').' '.Yii::app()->getModule("students")->labelCourseBatch();
			}
			?>
            <div class="clear"></div>
            	<div class="att_bottom">
            	<ul>
                
                	<!--<li><div class="dash_submit"></div><a href="#">Submit Attendance</a></li>-->
                                    <li><div class="dash_eye"></div><?php echo CHtml::link(Yii::t('app','View Attendance'), array('/studentportal/default/attendance'));?></li>
                   
                   <!-- <li><div class="dash_leave"></div><a href="#">Leave Applicatione</a></li>-->
                    
                </ul>
                
            </div>
            
            
        
    </div>
    
    <?php }} 
    ?>
        
    <?php 
	if(($rolename=='student' or $rolename=='parent') and isset($student_user_id))
	{ 
	if($student and $student!=NULL)
	{?>
    <div class="dash_box6 for_student_exam">
    	<div class="dash_subhed class_exams"><?php echo Yii::t('app','Class Exams'); ?></div>
        <div class="mousescroll Default">
       
	 <?php if($student->batch_id and ($student->batch_id !=NULL or $student->batch_id!=0))
        { 
		$criteria = new CDbCriteria;
		
		$criteria->condition='student_id=:x';
		$criteria->params = array(':x'=>$student->id);
		$criteria->order = 'exam_id DESC';
		$criteria->limit = 10 ;
		$exams = ExamScores::model()->findAll($criteria);
		
		?>

<table width="254" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th  height="35"><?php echo Yii::t('app','Exam'); ?></th>
    <th  height="35"><?php echo Yii::t('app','Subject'); ?></th>
    <th><?php echo Yii::t('app','Mark'); ?></th>
  </tr>
  
  <?php foreach($exams as $exam)
						{
							$exm=Exams::model()->findByAttributes(array('id'=>$exam->exam_id));
							$group=ExamGroups::model()->findByAttributes(array('id'=>$exm->exam_group_id));
							$sub=Subjects::model()->findByAttributes(array('id'=>$exm->subject_id));
							if($sub->elective_group_id!=0 and $sub->elective_group_id!=NULL)
									{
										
										$student_elective = StudentElectives::model()->findByAttributes(array('student_id'=>$student->id));
										if($student_elective!=NULL)
										{
											$electname = Electives::model()->findByAttributes(array('id'=>$student_elective->elective_id,'elective_group_id'=>$sub->elective_group_id));
											if($electname!=NULL)
											{
												$subjectname = $electname->name;
											}
										}
									
										
									}
									else
									{
										$subjectname = $sub->name;
									} ?>
                                    <?php if($group->is_published==1)
									{ ?>
  <tr>
    <td><?php echo $group->name ; ?></td>
    <td><?php echo $subjectname ; ?></td>
    <td><?php echo $exam->marks ; ?></td>
  </tr>
  <?php }} ?>
 
  
</table>

 <?php 
			
			}
			else
			{
			
			  echo Yii::t('app','You are not enrolled in any').' '.Yii::app()->getModule("students")->labelCourseBatch();
			}
			?>

</div>

<div class="dash_bottom">
            	<ul>
                	<li></li>
                    <li><div class="dash_eye"></div><?php echo CHtml::link(Yii::t('app','View Results'), array('/studentportal/default/exams'));?></li>
                    <!--<li><div class="dash_sub"></div><a href="#">Take exam</a></li>-->
                </ul>
            </div>
    </div> 
    <?php }} 
    ?>    
    
    
    
             
    <div class="clear"></div>
    <div id="jobDialog"></div>
</div>


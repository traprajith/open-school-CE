
<?php 
$hide_text  = Yii::t('app','Hide this block');
//$hide_text  = Yii::t('app','Disabled for the Demo version');
if(isset($block) && $block!=NULL)
{
    if($block=="News")
    {        
    ?>        
        <div class="os_dash_box block_class" block-id="<?php echo $block_id; ?>">
            <div class="dash_subhed">
                <div class="dash_subhed_hide_one news">
                	<?php echo Yii::t('app','News'); ?>
                </div>
                <div class="dash_subhed_hide_two" title="<?php echo $hide_text; ?>" id="<?php echo $block_id; ?>"><i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
            
            <div class="Default dash_box1_iner-pdng dash_bord-scrol left-icon dash_box-pading" >
                <ul>
                    <?php                 
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
                    <li><?php echo CHtml::link(Yii::t('app','View'), array('/mailbox/news'));?></li>
                    <?php 
                    if(Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('My Account'))
                    { ?>                                                            
                        <li><?php echo CHtml::link(Yii::t('app','Create'), array('/news/create'));?></li>
                    <?php } ?>                    
                </ul>
            </div>
        </div>        
    <?php 
    }
    else if($block=="Events")
    {
    ?>
        <div class="os_dash_box block_class" block-id="<?php echo $block_id; ?>">
        <div class="dash_subhed">
		<div class="dash_subhed_hide_one events"><?php echo Yii::t('app','Events'); ?></div>
        <div class="dash_subhed_hide_two" title="<?php echo $hide_text; ?>" id="<?php echo $block_id; ?>"><i class="fa fa-times" aria-hidden="true"></i></div>
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
                    $events             =   Dashboard::getEvents();
                    $events_sameday     =   $events['events_sameday'];
                    $events_sameweek    =   $events['events_sameweek'];
                    $events_nextweek    =   $events['events_nextweek'];
                    $events_nextmonth   =   $events['events_nextmonth'];
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
    <?php 
    }
    else if($block=="Student" and (Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('Students')))
    {
        $admission_data     =   Dashboard::getStudents();
        $total_students     =   $admission_data['total'];
        $recent_students    =   $admission_data['recent'];
        $inactive_students  =   $admission_data['inactive'];
        
    ?>
        <div class="os_dash_box block_class" block-id="<?php echo $block_id; ?>">
            <div class="dash_subhed">
            <div class="dash_subhed_hide_one  student"><?php echo Yii::t('app','Student'); ?></div>
            <div class="dash_subhed_hide_two" title="<?php echo $hide_text; ?>" id="<?php echo $block_id; ?>"><i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
            <div class="dash_box-pading">
                <a href="<?php echo Yii::app()->createUrl("/students/students/manage"); ?>">
                    <div class="dash_st_grid st_grid_colr1">                    
                        <h3><?php echo (isset($total_students))?$total_students:"-"; ?></h3>
                        <p><?php echo Yii::t('app','Total'); ?></p>
                         <p><?php echo Yii::t('app','Student'); ?></p>
                        
                    </div>
                </a>
                <a href="<?php echo Yii::app()->createUrl("/students"); ?>">
                <div class="dash_st_grid st_grid_colr2">
                    <h3><?php echo (isset($recent_students))?count($recent_students):"-"; ?></h3>
                    <p><?php echo Yii::t('app','New'); ?></p>
                    <p><?php echo Yii::t('app','Admissions'); ?></p>
                </div>
                </a>
                <a href="<?php echo Yii::app()->createUrl("/students/students/manage&Students[status]=0"); ?>">
                <div class="dash_st_grid st_grid_colr3">                
                    <h3><?php echo (isset($inactive_students))?count($inactive_students):"-"; ?></h3>
                    <p><?php echo Yii::t('app','Inactive'); ?></p>
                    <p><?php echo Yii::t('app','Students'); ?></p>
                </div>
                </a>
                <div class="clear-fix"></div>
                <div class="cv">
                   <div id="container" style="width:100%; height: 155px; margin: 0 auto"></div>
                </div>           
            </div>                
            <div class="dash_bottom dashboard-action-blk">
                <ul>
                   
                    <li><?php echo CHtml::link(Yii::t('app','View'), array('/students/students/manage'));?></li>
                    <?php  
                    if(Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('Students'))
                    { 
                    ?>
                    <li><?php echo CHtml::link(Yii::t('app','Create'), array('/students/students/create'));?></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    <?php 
    }
    else if($block=="Teacher" and (Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('Teachers')))
    {
        $teacher_data       =   Dashboard::getTeacherCount();
        $total_teachers     =   $teacher_data['total'];
        $recent_teachers    =   $teacher_data['recent'];
        
        //student block
        $attendance_data    =   0;
        $month              =   $attendance_data['month'];
        $data               =   $attendance_data['data'];
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
        <div class="os_dash_box block_class" block-id="<?php echo $block_id; ?>">
            <div class="dash_subhed ">
            <div class="dash_subhed_hide_one  teacher"><?php echo Yii::t('app','Teacher'); ?></div>
            <div class="dash_subhed_hide_two" title="<?php echo $hide_text; ?>" id="<?php echo $block_id; ?>"><i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
                    <div class="dash_box-pading">
                    <a href="<?php echo Yii::app()->createUrl("/employees/employees/manage"); ?>">
                    <div class="dash_st_grid2 t_grid_colr1">
                        <h3><?php echo (isset($total_teachers))?$total_teachers:"-"; ?></h3>
                        <p><?php echo Yii::t('app','Total Teachers'); ?></p>
                    </div>
                </a>
                <a href="<?php echo Yii::app()->createUrl("/employees"); ?>">		
                    <div class="dash_st_grid2 st_grid_colr2">
                        <h3><?php echo (isset($recent_teachers))?$recent_teachers:"-"; ?></h3>
                        <p><?php echo Yii::t('app','Recently Hired'); ?></p>
                    </div>
                </a>
            </div>
            <div class="dash_bottom dashboard-action-blk">
            <ul>
           
                <li><?php echo CHtml::link(Yii::t('app','View'), array('/employees/employees/manage'));?></li>
                <?php  
                if(Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('Teachers'))
                { 
                ?>
                <li><?php echo CHtml::link(Yii::t('app','Create'), array('/employees/employees/create'));?></li>
                <?php
                }
                ?>                
            </ul>
            </div>
        </div>
    <?php 
    }
    else if($block=="Examination" and (Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('Examination')))
    {                
        //examination block
        $examination_data   =   0;
        $average            =   $examination_data['average'];
        $anual_avg          =   $examination_data['anual_avg'];
    ?>
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
                };
        </script>
        <div class="os_dash_box block_class" block-id="<?php echo $block_id; ?>">
            <div class="dash_subhed">
            <div class="dash_subhed_hide_one examination"><?php echo Yii::t('app','Examination'); ?></div>
            <div class="dash_subhed_hide_two" title="<?php echo $hide_text; ?>" id="<?php echo $block_id; ?>"><i class="fa fa-times" aria-hidden="true"></i></div>
            
            </div>
            <div class="dash_box-pading">
                        <div class="clear"></div>
                        <div id="dg1" class="exm-graph" style=" width:100%; height:100px;"></div>
                       <div id="dg2" class="exm-graph" style=" width:100%; height:100px;"></div>
            </div>
            <div class="dash_bottom dashboard-action-blk">
            <ul>
                <li><?php echo CHtml::link(Yii::t('app','View'), array('/examination'));?></li>
            </ul>
            </div>
        </div> 
    <?php 
    }
    else if($block=="Attendance" and (Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('Attendance')))
    {                
        $attendance_data        =   0;
        $total_students         =   $attendance_data['total_student'];
        $student_absent_count   =   $attendance_data['student_absent'];
        $student_present        =   $total_students - $student_absent_count;
        
        $total_employees        =   $attendance_data['total_employees'];
        $employee_absent_count  =   $attendance_data['employee_absent'];
        $employee_present       =   $total_employees - $employee_absent_count;        
    ?>        
           
        <div class="os_dash_box block_class" block-id="<?php echo $block_id; ?>">
            <div class="dash_subhed">
            <div class="dash_subhed_hide_one attendance"><?php echo Yii::t('app','Attendance'); ?></div>
            <div class="dash_subhed_hide_two" title="<?php echo $hide_text; ?>" id="<?php echo $block_id; ?>"><i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
            <div class="dash_box-pading">
                <div class="dash_attnd_grid attnd_grid_colr1">
                    <a href="<?php echo Yii::app()->createUrl("/attendance"); ?>">
                    <div class="innet_attnd-block1 innet_attnd-orang1">
                        <h3><?php echo Yii::t('app','Student').$date; ?></h3>
                        <p><?php echo Yii::t('app','Attendance'); ?></p>
                    </div>
                    </a>
                    <div class="innet_attnd-block2 innet_attnd-orang2">
                        <h3><?php echo $student_present; ?>/<span><?php echo $total_students; ?></span></h3>
                    </div>
                </div>
                <div class="dash_attnd_grid attnd_grid_colr2">
                    <a href="<?php echo Yii::app()->createUrl("/attendance"); ?>">
                        <div class="innet_attnd-block1 innet_attnd-gray1">
                            <h3><?php echo Yii::t('app','Teacher'); ?></h3>
                            <p><?php echo Yii::t('app','Attendance'); ?></p>
                        </div>
                    </a>
                    <div class="innet_attnd-block2 innet_attnd-gray2">
                        <h3><?php echo $employee_present; ?>/<span><?php echo $total_employees; ?></span></h3>
                    </div>                   
                </div>               
            </div>
            <div class="dash_bottom dashboard-action-blk">
            <ul>
                <li><?php echo CHtml::link(Yii::t('app','View'), array('/attendance'));?></li>                
            </ul>
            </div>
        </div> 
    <?php 
    }
    else if($block=="Mailbox")
    {
    ?>
        <?php $mailbox_messages = new CActiveDataProvider(News::model()->inbox(Yii::app()->user->Id)); ?>
        <div class="os_dash_box1 block_class" block-id="<?php echo $block_id; ?>">
            <div class="dash_subhed_mail">
			
             <div class="dash_subhed_hide_one mail_list"><?php echo Yii::t('app','Mailbox'); ?></div>
            <div class="dash_subhed_hide_two" title="<?php echo $hide_text; ?>" id="<?php echo $block_id; ?>"><i class="fa fa-times" aria-hidden="true"></i></div>
            
            </div>
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
    <?php 
    }
    else if($block=="Fees" and (Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('Fees')))
    {
        $fee_data           =   0;
        $total_category     =   $fee_data['fee_category'];
        $invoices           =   $fee_data['invoices'];
        $fee_collected      =   $fee_data['fees'];
    ?>
        <div class="os_dash_box block_class" block-id="<?php echo $block_id; ?>">
            <div class="dash_subhed">
                <div class="dash_subhed_hide_one  fees"><?php echo Yii::t('app','Fees'); ?></div>
                <div class="dash_subhed_hide_two" title="<?php echo $hide_text; ?>" id="<?php echo $block_id; ?>"><i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
            <div class="dash_box-pading">
                <div class="dash_attnd_grid fee_grid_colr1">
                    <a href="<?php echo Yii::app()->createUrl("/fees"); ?>">
                        <div class="innet_attnd-block1 innet_attnd-orang1">
                            <h3><?php echo Yii::t('app','Total Fee'); ?> </h3>
                            <p><?php echo Yii::t('app','Categories'); ?></p>
                        </div>
                    </a>
                    <div class="innet_attnd-block2 innet_attnd-orang2">
                        <h3><?php echo isset($total_category)?$total_category:'-'; ?></h3>
                    </div>
                </div>
                
                <div class="dash_attnd_grid attnd_grid_colr1">
                    <a href="<?php echo Yii::app()->createUrl("/fees"); ?>">
                        <div class="innet_attnd-block1 innet_attnd-orang1">
                            <h3><?php echo Yii::t('app','Invoices'); ?></h3>
                            <p><?php echo Yii::t('app','Generated'); ?></p>
                        </div>
                    </a>
                    <div class="innet_attnd-block2 innet_attnd-orang2">
                        <h3><?php echo isset($invoices)?$invoices:'-'; ?></h3>
                    </div>
                </div>
                
                <div class="dash_attnd_grid attnd_grid_colr2">
                    <a href="<?php echo Yii::app()->createUrl("/fees"); ?>">
                        <div class="innet_attnd-block1 innet_attnd-gray1">
                            <h3><?php echo Yii::t('app','Fees'); ?></h3>
                            <p><?php echo Yii::t('app','Collected'); ?></p>
                        </div>
                    </a>
                    <div class="innet_attnd-block2 innet_attnd-gray2">
                        <h3><?php echo isset($fee_collected)?$fee_collected:'-'; ?></h3>
                    </div>
                </div>
                
            </div>
            <div class="dash_bottom dashboard-action-blk">
                <ul>
                    <li><li><?php echo CHtml::link(Yii::t('app','View'), array('/fees'));?></li></li>
                    <?php  
                    if(Yii::app()->user->checkAccess('Admin') or ModuleAccess::model()->check('Fees'))
                    { 
                    ?>
                    <li><?php echo CHtml::link(Yii::t('app','Create'), array('/fees'));?></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    <?php 
    }
}
?>

    
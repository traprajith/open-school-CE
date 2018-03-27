<?php
$this->breadcrumbs=array(
	'Semesters'=>array('index'),
	$model->name,
);
?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="247" valign="top">
                <div id="othleft-sidebar">
					<?php $this->renderPartial('/courses/left_side');?>
                </div>
             </td>
             <td valign="top">
                <div class="cont_right formWrapper">
                    <h1><?php echo UserModule::t('View Semester'); ?></h1>
                    <div class="">
                        <table class="detail-view" width="60%">
                            <tr>
                                <th width="100px"><?php echo $model->getAttributeLabel('name');?></th>
                                <td><?php echo $model->name;?></td>
                             </tr>
                             <tr>
                                <th width="100px"><?php echo $model->getAttributeLabel('description');?></th>
                                <td><?php echo $model->description;?></td>
                             </tr>
                             <tr>
                                <th width="100px"><?php echo $model->getAttributeLabel('start_date');?></th>
                                <td ><?php 
									  $settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
									  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));  
									  date_default_timezone_set($timezone->timezone);
									  $date = date($settings->displaydate,strtotime($model->start_date)); 
									 echo $date;?></td>
                             </tr>
                             <tr>
                                <th width="100px"><?php echo $model->getAttributeLabel('end_date');?></th>
                                <td>
								<?php 
									  $settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
									  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));  
									  date_default_timezone_set($timezone->timezone);
									  $date = date($settings->displaydate,strtotime($model->end_date)); 
									 echo $date;?>
                                </td>
                             </tr>
                             <tr>
                                <th width="100px"><?php echo UserModule::t('Courses'); ?></th>
                                <td>
									<?php 
									$s_courses 	= SemesterCourses::model()->findAllByAttributes(array('semester_id'=>$model->id));
									$course_data=array();
									foreach($s_courses as $key=>$course_s)
									{
										$courses				= Courses::model()->findByPk($course_s->course_id);
										$course_data [] = $courses->course_name;
										
									}
									echo implode(",",$course_data);
                                    ?>	
                                </td>
                             </tr>
                             
                             
                        </table>
                         </div>
                </div>
            </td>
        </tr>
    </table>

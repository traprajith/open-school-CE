<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="80" valign="top">
<div id="othleft-sidebar">
<?php $this->renderPartial('/default/left_side');?>
  </div>
 </td>
 <td valign="top">
<div class="cont_right formWrapper usertable" >

<h1><?php echo UserModule::t('Your profile'); ?></h1>
<?php
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>
<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success" style="background:#FFF; color:#C00;">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

	
<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
            <li><?php echo CHtml::link('<span>'.Yii::t('user','Edit Profile').'</span>',array('/user/profile/edit'),array('class'=>'a_tag-btn'));?></li>
            <li><?php echo CHtml::link('<span>'.Yii::t('user','Change Password').'</span>',array('/user/profile/changepassword'),array('class'=>'a_tag-btn'));?></li>                               
</ul>
</div> 

</div>

<table class="detail-view">
	<tr>
            <th class="label"><?php echo Yii::t('app','Username'); ?></th>
	    <td><?php echo CHtml::encode($model->username); ?></td>
	</tr>
	<?php 
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
				//echo "<pre>"; print_r($profile); die();
			?>
	<tr>
		<th class="label"><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
    	<td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
	</tr>
			<?php
			}//$profile->getAttribute($field->varname)
		}
	?>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
    	<td><?php echo CHtml::encode($model->email); ?></td>
	</tr>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
    	<td><?php 
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
	  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));  
	  date_default_timezone_set($timezone->timezone);
	  $date = date($settings->displaydate,strtotime($model->create_at)); 
	  $time = date($settings->timeformat,strtotime($model->create_at)); 
	  echo $date/*.' '.$time*/; ?></td>
	</tr>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
    	<td>
        <?php
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
	  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));  
	  date_default_timezone_set($timezone->timezone);
	  $date = date($settings->displaydate,strtotime($model->lastvisit_at)); 
	  $time = date($settings->timeformat,strtotime($model->lastvisit_at)); 
	  echo $date/*.' '.$time*/; ?>
		</td>
	</tr>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
    	<td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></td>
	</tr>
</table>
</div>
 </td>
  </tr>
</table>

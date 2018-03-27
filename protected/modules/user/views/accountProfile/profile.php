<?php 
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('app',"Profile");
$this->breadcrumbs=array(
	Yii::t('app',"Profile"),
);

?>
<?php 
	$roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role					
	foreach($roles as $role)
	{
	   if(sizeof($roles)==1 and $role->name == 'parent')
	   {
		 echo $this->renderPartial('application.modules.parentportal.views.default.leftside');
	   }
	   if(sizeof($roles)==1 and $role->name == 'student')
	   { 
		 echo $this->renderPartial('application.modules.studentportal.views.default.leftside');
	   }
	   if(sizeof($roles)==1 and $role->name == 'teacher')
	   { 
		 echo $this->renderPartial('application.modules.teachersportal.views.default.leftside');
	   }
	}

 ?>

<div class="pageheader">
      <h2><i class="fa fa-gear"></i> <?php echo Yii::t('app','Settings'); ?> <span><?php echo Yii::t('app','Your settings here'); ?></span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo Yii::t('app','You are here:'); ?></span>
        <ol class="breadcrumb">
          <!--<li><a href="index.html">Home</a></li>-->
          <li class="active"><?php echo Yii::t('app','Settings'); ?></li>
        </ol>
      </div>
    </div>
    
    
    <div class="contentpanel">
    
    	<div class="panel-heading">
        
<h3 class="panel-title"><?php echo Yii::t('app','Your profile'); ?></h3>
        
<div class="button-bg button-bg-none">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
    <ul>
       
            <li><?php echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>',array('/user/accountProfile/edit'),array('class'=>'btn btn-primary'));?></li>
            <li><?php echo CHtml::link('<span>'.Yii::t('app','Change Password').'</span>',array('/user/accountProfile/changepassword'),array('class'=>'btn btn-primary'));?></li>
            <li><?php echo CHtml::link('<span>'.Yii::t('app','Change Preferences').'</span>',array('/user/preferences/edit'),array('class'=>'btn btn-primary'));?></li>
    </ul>
</div>
</div>

</div>
        
        <div class="people-item">
        <div class="table-responsive">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
 <td valign="top">
<div class="cont_right formWrapper usertable" >

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


<table class="table table-hover mb30">

	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
	    <td><?php echo CHtml::encode($model->username); ?></td>
	</tr>
	<?php 
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
				//echo "<pre>"; print_r($profile); die();
			?>
	<tr>
		<th><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
    	<td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
	</tr>
			<?php
			}//$profile->getAttribute($field->varname)
		}
	?>
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
    	<td><?php echo CHtml::encode($model->email); ?></td>
	</tr>
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
    	<td><?php echo $model->create_at; ?></td>
	</tr>
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
    	<td><?php echo $model->lastvisit_at; ?></td>
	</tr>
	<tr>
		<th><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
    	<td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></td>
	</tr>
</table>
</div>
 </td>
  </tr>
</table>
        
        </div>
    
    
    </div>
    </div>


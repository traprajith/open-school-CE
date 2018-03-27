<?php 
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('app',"Change Password");
$this->breadcrumbs=array(
	Yii::t('app',"Profile") => array('/user/profile'),
	Yii::t('app',"Change Password"),
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
    			
<h3 class="panel-title"><?php echo Yii::t('app','Change Preferences'); ?></h3>
<div class="button-bg button-bg-none">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>
					 <li><?php echo CHtml::link('<span>'.Yii::t('app','Edit Profile').'</span>',array('/user/accountProfile/edit'),array('class'=>'btn btn-primary'));?></li>
                     <li><?php echo CHtml::link('<span>'.Yii::t('app','Change Password').'</span>',array('/user/accountProfile/changepassword'),array('class'=>'btn btn-primary'));?></li>
				</ul>
		</div>
	</div>
	

</div>
	
	
<div class="people-item">
		
<div class="table-responsive">    

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>

 <td valign="top">
 

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	/*'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),*/
)); ?>
<div class="cont_right formWrapper usertable">

<p style="padding-left:20px;"><?php echo Yii::t('app','Fields with');?><span class="required">*</span><?php echo Yii::t('app','are required.');?></p>
	<?php //echo $form->errorSummary($model); ?>
	<div >
	
		<div class="form-group">
		<label class="col-sm-2 col-4-reqst control-label"><?php echo $form->labelEx($model,Yii::t('app','Language'),array('style'=>'color:#222222;')); ?></label>
		
		<div class="col-sm-6 col-4-reqst">
        
		<?php
        $languages = array(
			'en_us'=>'English', 
			'af'=>'Afrikaans',
			'sq'=>'shqiptar',
			'ar'=>'العربية',
			'cz'=>'中国的 ',
			'cs'=>'český', 
			'nl'=>'Nederlands', 
			'fr'=>'français', 
			'de'=>'Deutsch', 
			'el'=>'ελληνικά',
			'gu'=>'Γκουτζαρατικά',
			'hi'=>'हिंदी',
			'id'=>'Indonesia', 
			'ga'=>'Gaeilge',
			'it'=>'italiano',  
			'ja'=>'日本人',
			'kn'=>'ಕನ್ನಡ', 
			'ko'=>'한국의', 
			'la'=>'Latine',
			'ms'=>'Melayu', 
			'pt'=>'português', 
			'ru'=>'русский', 
			'es'=>'español',
			'ta'=>'தமிழ்',
			'te'=>'తెలుగు',
			'th'=>'ภาษาไทย',
			'uk'=>'Український',
			'ur'=>'اردو',
			'vi'=>'Việt',
			'vi_vn'=>'Tiếng Việt'
        );
		
        echo $form->dropDownList($model, 'language',$languages, array('class'=>'form-control'));
        ?>
		<?php echo $form->error($model,'oldPassword'); ?></div>
		</div>
		<div class="form-group">
		<label class="col-sm-2 col-4-reqst control-label"></label>
		
		<div class="col-sm-6 col-4-reqst"><div class="form-group"><?php echo CHtml::submitButton(Yii::t('app',"Save"),array('class'=>'btn btn-danger')); ?>
		</div></div>
		</div>
</div>
<?php $this->endWidget(); ?>
<!-- form -->
</td>
</tr>
</table>
</div>
</div>
</div>
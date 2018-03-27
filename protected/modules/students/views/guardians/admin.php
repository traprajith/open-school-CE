<style>
.items tr:nth-child(3) {background:#F00;}

</style>
<?php
$this->breadcrumbs=array(
	Yii::t('app','Guardians')=>array('admin'),
	Yii::t('app','Manage'),
);

$this->menu=array(
	//array('label'=>'List Guardians', 'url'=>array('index')),
	//array('label'=>'Create Guardians', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('guardians-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('app','Manage Guardians');?></h1>
<?php /*?><div class="c_subbutCon" align="right" style="width:100%">
    <div class="c_cubbut" style="width:320px;">
    <ul>
    <li>
    <?php echo CHtml::link('Create New Guardian', array(''),array('class'=>'addbttn'));?>
  </li>
   <li>
    <?php echo CHtml::link('Associate Guardian', array(''),array('class'=>'addbttn last'));?>
  </li>
    </ul>
    <div class="clear"></div>
    </div>
    </div><?php */?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->beginWidget('CActiveForm', array(
				'id'=>'search-form',
				'method'=>'GET',
				'enableAjaxValidation'=>false,
				'action' => Yii::app()->createUrl('students/guardians/search/')
			)); ?>
<div class="formCon">
                    <div class="formConInner">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="s_search">
                            <tr>
                                <td width="5%"><?php echo Yii::t('app','Name');?></td>
                                <td width="23%"> 
                                    <div class="exp_but_input-full">
                                    <?php  $this->widget('zii.widgets.jui.CJuiAutoComplete',
                                    array(
                                    'name'=>'name',
                                    'id'=>'name_widget',
                                    'source'=>$this->createUrl('/site/autocomplete'),
                                    'htmlOptions'=>array('style'=>'','placeholder'=>Yii::t('app','Student Name')),
                                    'options'=>
                                    array(
                                    'showAnim'=>'fold',
                                    'select'=>"js:function(student, ui) {
                                    $('#id_widget').val(ui.item.id);
                                    
                                    }"
                                    ),
                                    
                                    ));
                                    ?>
                                  

                                    </div>
                                </td>
                                <td width="5%"><?php echo CHtml::ajaxLink('',array('/site/explorer','widget'=>'1'),array('update'=>'#explorer_handler'),array('id'=>'explorer_student_name','class'=>'exp_but-non'));?></td>
                                <td width="23%"><div><?php echo CHtml::submitButton( Yii::t('app','Search'),array('name'=>'','class'=>'formbut-n')); ?></div></td>
                            </tr>
                        </table>
                    	
                    </div> <!-- END div class="formConInner" -->
                </div> <!--  END div class="formCon" -->
                 <?php $this->endWidget(); ?>
<?php 

$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
if(Yii::app()->user->year)
{
	$year = Yii::app()->user->year;
}
else
{
	$year = $current_academic_yr->config_value;
}
$is_delete = PreviousYearSettings::model()->findByAttributes(array('id'=>4));

if($year != $current_academic_yr->config_value and $is_delete->settings_value==0)
{
?>
	<div>
        <div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
            <div class="y_bx_head" style="width:650px;">
            <?php 
                echo Yii::t('app','You are not viewing the current active year. '); 
                echo Yii::t('app','To delete a guardian, enable Delete option in Previous Academic Year Settings.');
            ?>
            </div>
            <div class="y_bx_list" style="width:650px;">
                <h1><?php echo CHtml::link(Yii::t('app','Previous Academic Year Settings'),array('/previousYearSettings/create')) ?></h1>
            </div>
        </div>
    </div>
<?php
}
$template = '';
				if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
				{
					$template = $template.'{update}';
				}
				
				if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
				{
					$template = $template.'{delete}';
				}
                                
                                
                                
                                
              //   <!-- DYNAMIC FIELD ARRAY START -->    
                                $new_array= array();
                                if(FormFields::model()->isVisible("fullname", "Guardians", "forAdminRegistration"))
                                {
                                    $new_array[]= array('name'=>'first_name',
                                                'header' => Yii::t('app','Name'),
                                                'type'=>'raw',
                                                'value' => array($model,'parentnamedata'));
                                }
                                //if(FormFields::model()->isVisible('ward_id','Guardians','forAdminRegistration'))
                                {
                                    $new_array[]= array('name'=>'ward_id',
                                                'type'=>'raw',
                                                'value' => array($model,'studentlist'),
                                                'filter' => false,
                                               // 'filter' => CHtml::activeTextField($model, 'student_name'),
                                                'htmlOptions' => array('style'=>'width:250px;')
                                                );
                                }
//                                if(FormFields::model()->isVisible('email','Guardians','forStudentProfile'))
//                                {
                                    $new_array[]= array('name'=>'email',
                                                    'type'=>'raw',
                                                    'value'=>'$data->email');
                                //}
                                
                                $new_array[]= array(
                                                    'header'=>Yii::t('app','Action'),
                                                    'class'=>'CButtonColumn',
                                                    'deleteConfirmation'=>Yii::t('app','Are you sure you want to delete this guardian?'),
                                                    'htmlOptions' => array('style'=>'width:80px;'),
                                                     'template' =>$template,
                                                     'headerHtmlOptions'=>array('style'=>'font-size:12px; font-weight:bold;'),
                                                     //'visible'=>Guardians::model()->getVisible($data),
                                            );
                                
                  //   <!-- DYNAMIC FIELD ARRAY END -->      
                                
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'guardians-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	'columns'=>$new_array
)); ?>
 	</div>
    </td>
  </tr>
</table>

<style>
    .alligner .row label{ display: inline-block;
    width: 180px;}
    
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'themes-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php //echo $form->errorSummary($model); ?>
<div class="formCon">
<div class="formConInner alligner">
	
	<div class="row">
		<?php echo $form->labelEx($model,'topbar_background'); ?>
		 <?php 		
		$this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'topbar_background',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));
		?>
        
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'topbar_background_text'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'topbar_background_text',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		)); ?>
		<?php echo $form->error($model,'topbar_background_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'topbar_message'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'topbar_message',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'topbar_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'topbar_account_background'); ?>
		<?php  $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'topbar_account_background',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'topbar_account_background'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'topbar_account_color'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'topbar_account_color',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		)); ?>
		<?php echo $form->error($model,'topbar_account_color'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body_background'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'body_background',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'body_background'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'search_background'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'search_background',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'search_background'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'search_color'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'search_color',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		)); ?>
		<?php echo $form->error($model,'search_color'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_background'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'menu_background',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'menu_background'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_border'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'menu_border',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'menu_border'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_text_color'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'menu_text_color',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'menu_text_color'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_active_background'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'menu_active_background',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'menu_active_background'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_active_color'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'menu_active_color',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'menu_active_color'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'breadcrumbs_background'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'breadcrumbs_background',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'breadcrumbs_background'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'breadcrumbs_color'); ?>
		<?php $this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'breadcrumbs_color',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));  ?>
		<?php echo $form->error($model,'breadcrumbs_color'); ?>
	</div>

	<div class="form buttons">
		<?php
                if($status==1)
                {
                    echo CHtml::Button(Yii::t('app','Save'),array('submit'=>array('themes/update'),'class'=>'formbut'));
                }
                else
                {
                    echo CHtml::Button(Yii::t('app','Save'),array('submit'=>array('themes/create'),'class'=>'formbut'));
                }
?>
	</div>
    </div>
</div>
<span id="success-EventsType_colour_code"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
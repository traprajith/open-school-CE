

<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher')=>array('index'),
	Yii::t('app','Attendance'),
);


?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    <div class="emp_cont_left">
   <?php $this->renderPartial('application.modules.employees.views.employees.profileleft');?>
    
    </div>
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Teacher Profile');?></h1> 
                <div class="button-bg">
                <div class="top-hed-btn-left"></div>
                <div class="top-hed-btn-right">
                <ul>                                    
                <li><?php echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('update', 'id'=>$_REQUEST['id']),array('class'=>'a_tag-btn')); ?></li>
                <li><?php echo CHtml::link('<span>'.Yii::t('app','Teachers').'</span>', array('employees/manage'),array('class'=>'a_tag-btn')); ?></li>                                
                </ul>
                </div>
                </div>
   
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">

	<?php $this->renderPartial('application.modules.employees.views.employees.tab');?>

    <div class="clear"></div>
    <div class="full-formWrapper opnsl_new_edtn_block">                   
            <div class="add_banner_block">
                <h2>The Community Edition is feature-limited.</h2>
                <p>Buy our latest Premium version to get this feature and manage your institution more efficiently!</p>
            </div>
            <div class="opnsl_tbl_editon_footer">
                <a href="https://open-school.org/pricing" target="_blank" class="upgrade_btn">Talk to Sales</a>
            </div>
        </div>
    </div>
    
    </div>
    </div>
   
    </td>
  </tr>
</table>

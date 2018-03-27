<?php
$this->breadcrumbs=array(
	Yii::t('app','Students')=>array('index'),
	Yii::t('app','Attendance'),
);
?>
<script language="javascript">
function getmode(type){
	var student_id	= <?php echo $_REQUEST['id']; ?>;
	var batch_id	= $('#batch_id').val();
	if(type	== 1){
		if(student_id != '' && batch_id != ''){
			window.location= 'index.php?r=students/students/attentance&id='+student_id+'&bid='+batch_id;
		}
		else if(student_id != ''){
			window.location= 'index.php?r=students/students/attentance&id='+student_id;
		}
		else{
			window.location= 'index.php?r=students/students/attentance';
		}
	}	
}
</script>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    <div class="emp_cont_left">
   <?php $this->renderPartial('profileleft');?>
    
    </div>
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
    <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
<h1><?php echo Yii::t('app','Student Profile');?></h1>     
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
     <?php $this->renderPartial('application.modules.students.views.students.tab');?>
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
<script>
$('.abs').click(function(e) {
    $('form#student-attentance-form').remove();
});
</script>

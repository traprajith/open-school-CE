<?php 

$batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); 
$this->breadcrumbs=array(
	Yii::t('app','Courses')=>array('/courses'),
	$batch->name=>array('/courses/batches/batchstudents','id'=>$_REQUEST['id']),
	Yii::t('app','Attendances'),
);

?>
                
<div  style="background:#fff; min-height:800px;"> 

    <table  width="100%" border="0" cellspacing="0" cellpadding="0">

        <tbody>
            <tr>
                <td valign="top">
               
                    <div style="padding:20px;">
                       
                        <div class="clear"></div>
                        <div class="emp_right_contner">
                            <div class="emp_tabwrapper">
								<?php $this->renderPartial('/batches/tab');?>
                                
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
                                </div> <!-- END div class="formConInner" -->
                            </div> <!-- END div class="emp_tabwrapper" -->
                        </div> <!-- END div class="emp_right_contner" -->                   
                </td>
            </tr>
        </tbody>
    </table>
</div>

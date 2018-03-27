<style type="text/css">
#mform button{ border-radius:0px !important;
background:none repeat scroll 0 0 #f38108 !important;
color:#fff;
text-shadow:0px 0px #fdbd59;}
</style>

<?php
$this->breadcrumbs=array(
	Yii::t('app',ucfirst($this->module->id))=>array('inbox'),
	Yii::t('app',ucfirst($this->getAction()->getId()))
);
?>

<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
  window.parent.CKEDITOR.tools.callFunction(CKEditorFuncNum, 
    url, errorMessage);
</script>
<script type="text/javascript">
$(document).ready(function () {
	var config =
	    {
		height: 300,
		width : '95%',
		resize_enabled : false,
		toolbar :

		[

		['Bold','Italic','Underline','Strike','-','Subscript','Superscript','-','SelectAll','RemoveFormat'],

		['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],

		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],

		]

	};
        //Set for the CKEditor
		$('#DashboardMessage_text').ckeditor(config);

    });


  
</script>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top" id="port-left">
    
     <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%">
        <div class="cont_right formWrapper" style="padding:0px; width:753px;">
      <div id="parent_rightSect">
      <div class="parentright_innercon">
      <div class="mail_head"><?php echo Yii::t('app','New Message');?><span><?php echo Yii::t('app','Compose new message here.');?></span></div>
      <div >
<?php
$this->renderpartial('_menu');
?>
<div class="mailbox-compose ui-helper-clearfix">

<?php

$this->renderPartial('_flash');


$form=$this->beginWidget('CActiveForm', array(
'id'=>'message-form',
'enableAjaxValidation'=>true,

)); ?>
	<div class="formCon" style="margin:10px; padding:10px; width:710px;">	

		<div class="formConInner" style="width:660px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo '<strong>'.CHtml::activeLabelEx($conv,'to').'</strong>'; ?></td>
    <td>
    <?php
		if (Yii::app()->user->isSuperuser or ModuleAccess::model()->check('Home')) {
			   $all_roles=new RAuthItemDataProvider('roles', array( 
			'type'=>2,
			));
			  $data=$all_roles->fetchData();
			  
	?>
    
        <?php  echo $form->dropDownList($conv,'to',CHtml::listData($data,'name','name'),array('id'=>'messagegroup-to','prompt'=>Yii::t('app','select')));?> 
    
<?php
}
?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo '<strong>'.CHtml::activeLabelEx($conv,'subject',array('class'=>'mailbox-label')).'</strong>'; ?></td>
    <td><?php echo $form->textField($conv,'subject',array(/*'class'=>'mailbox-input',*/'style'=>'width:50%;','placeholder'=>Yii::t('app',$this->module->defaultSubject),'id'=>'subjectid')); ?>
				<?php echo $form->error($conv,'subject'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
    	<?php echo $form->textArea($msg,'text',array('cols'=>50,'rows'=>7, 'class'=>'mailbox-message-input','style'=>'width:100%;','placeholder'=>Yii::t('app','Enter message here...'))); ?>
		<?php echo $form->error($msg,'text'); ?>
    </td>
  </tr>
</table>

		<div id="mform" align="right">
			<input type="submit" onclick="no_recieve()" class="formbut" value="<?php echo Yii::t('app','Send Message'); ?>" />
		</div>
        </div>
	</div>
<?php $this->endWidget(); ?><!-- form --> 

</div> 
    </div>
    </div>
    </div>
    <div class="clear"></div>
    </div>
 </td>
        
      </tr>
    </table>
   
    </td>
  </tr>
</table>
<script type="text/javascript">
function no_recieve()
{
	
	if(document.getElementById("messagegroup-to").value=='')
	{
		alert("<?php echo Yii::t('app','Add any recipient'); ?>");
	}
}

function no_subject()
{
	
	if(document.getElementById("subjectid").value=='')
	{
		confirm("<?php echo Yii::t('app','Do you want to sent this message without subject?'); ?>");
	}
}
</script>
<!-- mailbox -->
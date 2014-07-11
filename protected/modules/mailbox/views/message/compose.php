<?php
$this->breadcrumbs=array(
	ucfirst($this->module->id)=>array('inbox'),
	ucfirst($this->getAction()->getId())
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
		$('#Message_text').ckeditor(config);

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
      <div class="mail_head">New Message<span>Compose new message here.</span></div>
      <div >
<?php
$this->renderpartial('_menu');
?>
<div class="mailbox-compose ui-helper-clearfix">

<?php

$this->renderPartial('_flash');


$form=$this->beginWidget('CActiveForm', array(
'id'=>'message-form',
'enableAjaxValidation'=>false,
'htmlOptions'=>array('autocomplete'=>$this->createUrl('ajax/auto')),
)); ?>
	<div class="formCon" style="margin:10px; padding:10px; width:710px;">	

		<div class="formConInner" style="width:660px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo CHtml::activeLabelEx($conv,'<strong>To</strong>'); ?></td>
    <td><?php echo $form->textField($conv,'to',array('style'=>'width:30%;','id'=>'message-to','class'=>'mailbox-input', 'edit'=>$this->module->editToField? '1' : null)); ?>
				<?php echo $form->error($conv,'to'); ?>
				<?php

					if($this->module->userSupportList)
					{

						$reps = $this->module->getUserSupportList();
						echo '<select name="ajax[to]" class="mailbox-support-list" edit="'.(($this->module->editToField)? '1' : null).'" >';
						foreach($reps as $key => &$label)
						{
						?>
						<option type="hidden" value="<?php echo $key; ?>"><?php echo $label; ?></option>
						<?php
						}
						echo '</select>';
				}
				?>
               </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo CHtml::activeLabelEx($conv,'<strong>Subject</strong>',array('class'=>'mailbox-label')); ?></td>
    <td><?php echo $form->textField($conv,'subject',array('class'=>'mailbox-input','style'=>'width:50%;','placeholder'=>$this->module->defaultSubject,'id'=>'subjectid')); ?>
				<?php echo $form->error($conv,'subject'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
    	<?php echo $form->textArea($msg,'text',array('cols'=>50,'rows'=>7, 'class'=>'mailbox-message-input','style'=>'width:100%;','placeholder'=>'Enter message here...')); ?>
		<?php echo $form->error($msg,'text'); ?>
    </td>
  </tr>
</table>

		<div id="mform" align="right">
		<button class="btn btn-large message-btn-reply" onclick="no_recieve()" onclick=" no_subject();">Send Message</button>
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
	
	if(document.getElementById("message-to").value=='')
	{
		alert("Add any recipient");
	}
}

function no_subject()
{
	
	if(document.getElementById("subjectid").value=='')
	{
		confirm("Do you want to sent this message without subject?");
	}
}
</script>
<!-- mailbox -->
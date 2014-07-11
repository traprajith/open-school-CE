 <?php

if($this->getAction()->getId()!='inbox') 
$this->breadcrumbs=array(
		ucfirst($this->module->id)=>array('inbox'),
		ucfirst($this->getAction()->getId()) 
);
else
	$this->breadcrumbs=array($this->module->id);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="80" valign="top" id="port-left">
     <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    	<div class="cont_right formWrapper" style="padding:0px; width:753px;">
      <div id="parent_rightSect">
      <div class="parentright_innercon">
      <div class="mail_head">Mailbox<span>Check your mails here.</span></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%">
        
        
      
<?php
$this->renderpartial('_menu');

if(isset($_GET['Message_sort']))
	$sortby = $_GET['Message_sort'];
elseif(isset($_GET['Mailbox_sort']))
	$sortby = $_GET['Mailbox_sort'];
else
	$sortby = '';

echo '<div id="mailbox-list" class="mailbox-list ui-helper-clearfix" sortby="'.$sortby.'">';


$this->renderpartial('_flash');

$ie6br = <<<EOD
<!--[if lt IE 6]>
<br clear="all" />
<![endif]-->
EOD;

if($dataProvider->getItemCount() > 0) {
?>
<form id="message-list-form" action="<?php echo $this->createUrl($this->getId().'/'.$this->getAction()->getId()); ?>" method="post">
	<input type="hidden" class="mailbox-count" name="ui[]" value="<?php echo $dataProvider->getItemCount(); ?>" />
	<input type="hidden" class="mailbox-sortby" name="ui[]" value="<?php echo $sortby; ?>" />
	<div class="mailbox-clistview-container ui-helper-clearfix">
    
   <?php
	//if($dataProvider->getItemCount() > 1 && $this->getAction()->getId() != 'sent') : ?>
		<div class="btn-group mailbox-checkall-buttons">
        	<input type="checkbox"  name="ch1" class="chkbox checkall" /> 
			<!--<button class="btn checkall"  />Check All</button>
			<button class="btn uncheckall" onclick="return item();" />Uncheck All</button>-->
            
		</div>
	<?php
	//endif; ?>
    
    <?php if($this->getAction()->getId()!='sent') : ?>
<div class="m-toplink" id="top" style="padding:left" > <span class="mailbox-buttons-label"></span>
		<?php if($this->getAction()->getId()=='trash') : ?>
	<input type="submit" id="mailbox-action-restore" class="btn mailbox-button"  name="button[restore]" value="Restore" onclick="return item();"/> 
	<input type="submit" id="mailbox-action-delete" class="btn mailbox-button" name="button[delete]" value="Delete forever" onclick="return del();" />
		<?php else: ?>
			<?php if(!$this->module->readOnly || ( $this->module->readOnly && !$this->module->isAdmin())): ?>
	<input type="submit" id="mailbox-action-delete" class="btn mailbox-button" name="button[delete]" value="Delete" onclick="return del();" /> 
			<?php endif; ?>
	<input type="submit" id="mailbox-action-read" class="btn mailbox-button" name="button[read]" value="Read" onclick="return item();" /> 
	<input type="submit" id="mailbox-action-unread" class="btn mailbox-button" name="button[unread]" value="Unread" onclick="return item();" /> 
		<?php endif; ?>
</div>
   <?php endif; ?> 
	
	<?php

$this->widget('zii.widgets.CListView', array(
    'id'=>'mailbox',
    'dataProvider'=>$dataProvider,
    'itemView'=>'_list',
	/*'summaryText'=>Yii::t('zii','Result {start}-{end} of {count}.'),*/
    'itemsTagName'=>'table',
    'template'=>'<div class="mailbox-summary">{summary}</div>{sorter}'.$ie6br.'<div id="mailbox-items" class="ui-helper-clearfix">{items}</div>{pager}',
    'sortableAttributes'=>$this->getAction()->getId()=='sent'?
	array('created'=>'Sort by') :
	array('modified'=>'Sort by'),
    'loadingCssClass'=>'mailbox-loading',
    'ajaxUpdate'=>'mailbox-list',
    'afterAjaxUpdate'=>'$.yiimailbox.updateMailbox',
    'emptyText'=>'<div style="width:100%"><h3>You have no mail in your '.$this->getAction()->getId().' folder.</h3></div>',
    //'htmlOptions'=>array('class'=>'ui-helper-clearfix'),
    'sorterHeader'=>'', 
    'sorterCssClass'=>'mailbox-sorter',
    'itemsCssClass'=>'mailbox-items-tbl ui-helper-clearfix',
    'pagerCssClass'=>'mailbox-pager',
	
    //'updateSelector'=>'.inbox',
));
?>
	<?php
	//if($dataProvider->getItemCount() > 1 && $this->getAction()->getId() != 'sent') : ?>
		<!--<div class="btn-group mailbox-checkall-buttons">
        	<input type="checkbox"  name="ch1" class="chkbox checkall" /> Select All
			<!--<button class="btn checkall" onclick="s()" />Check All</button>
			<button class="btn uncheckall" onclick="return item();" />Uncheck All</button>
		</div>-->
	<?php
	//endif; ?>
     <?php if($this->getAction()->getId()!='sent') : ?>
<div> <span class="mailbox-buttons-label btm-mailbox-btns"></span> 
		<?php if($this->getAction()->getId()=='trash') : ?>
	<input type="submit" id="mailbox-action-restore" class="btn mailbox-button" name="button[restore]" value="restore" onclick="return item();"/> 
	<input type="submit"  id="mailbox-action-delete" class="btn mailbox-button" name="button[delete]" value="delete forever" onclick="return del();" />
		<?php else: ?>
			<?php if(!$this->module->readOnly || ( $this->module->readOnly && !$this->module->isAdmin())): ?>
	<input type="submit"  id="mailbox-action-delete" class="btn mailbox-button" name="button[delete]" value="Delete"  onclick="return del();"  /> 
			<?php endif; ?>
	<input type="submit"  id="mailbox-action-read" class="btn mailbox-button" name="button[read]" value="Read" onclick="return item();"   /> 
	<input type="submit"  id="mailbox-action-unread" class="btn mailbox-button" name="button[unread]" value="Unread" onclick="return item();" />
		<?php endif; ?>
</div>
	
    	<?php endif; ?>
	</div>
</form>

<?php

}
else {
	$this->renderpartial('_empty');
} 
?>
</div>

 </td>
        
      </tr>
    </table>
    
    </div>
    </div>
<div class="clear"></div>
</div>
    </td>
  </tr>
</table>

<script type="text/javascript">
/*<![CDATA[*/
jQuery(function($) {
	$('.message-subject').hide();
});
/*]]>*/
</script>
<script type="text/javascript">
function del()
{
	 var chks	=	$("[type='checkbox']");
	 var checked	=	false;
	for(var i=0; i<chks.length; i++){
		if(chks[i].checked){checked=true;
		}
	}
	if(checked==false){
		alert('No item selected');return false;
	}
	else{
		if(confirm('Are you sure ?')){
			return true;
		}
		else{
			return false;
		}
	}
	return true;
	
}
</script>
<script type="text/javascript">
function item()
{
	 var chks	=	$("[type='checkbox']");
	 var checked	=	false;
	for(var i=0; i<chks.length; i++){
		if(chks[i].checked){checked=true;
		}
	}
	if(checked==false){
		alert('No item selected');return false;
	}
	return true;
	
}
</script>
<script type="text/javascript">
function enable()
{
	$(".mailbox-check").on("change", function(e){
  if($(".mailbox-check").attr("checked")){
    $(".btn mailbox-button").submit("enable");
  } else {
    $(".btn mailbox-button").submit("disable");
  }
  
});
}

</script>


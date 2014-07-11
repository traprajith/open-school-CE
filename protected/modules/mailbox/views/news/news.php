<style>
.mailbox-link span{ width:0px !important;}
.mailbox-summary{ left:0px !important;}
.list-view .summary{text-align:left !important;}
tr.mailbox-item > td > div{padding:4px 4px 15px !important;}
.msg-new .mailbox-subject a{text-align:left;}

</style>

<?php

if($this->getAction()->getId()!='index') 
$this->breadcrumbs=array(
		ucfirst($this->module->id)=>array('news/'),
		ucfirst($this->getAction()->getId()) 
);
else
	$this->breadcrumbs=array('Site News'); ?>
    
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
     <div class="mail_head">Site News<span>Latest news listed here</span></div>
    <?php 

//$this->renderpartial('_menu');

if(isset($_GET['Mailbox_sort']))
	$sortby = $_GET['Mailbox_sort'];
else
	$sortby = '';

echo '<div class="news-list ui-helper-clearfix" sortby="'.$sortby.'">';

$this->renderpartial('../message/_flash');

if($dataProvider->getItemCount() > 0) {
?>

<form id="message-list-form" action="<?php echo $this->createUrl($this->getId().'/'.$this->getAction()->getId()); ?>" method="post">
	<div class="mailbox-clistview-container ui-helper-clearfix">
	<?php
	if($this->module->isAdmin() && $dataProvider->getItemCount() > 1) : ?>
		<div class="btn-group mailbox-checkall-buttons">
            <input type="checkbox"  name="ch1" class="chkbox checkall" /> Select All
            
			<!--<button class="checkall" />Check All</button>
			<button class="uncheckall" />Uncheck All</button>-->
		</div>
	<?php
	endif;

$this->widget('zii.widgets.CListView', array(
    'id'=>'mailbox',
    'dataProvider'=>$dataProvider,
    'itemView'=>'_news_list',
	/*'summaryText'=>Yii::t('zii','Result {start}-{end} of {count}.'),*/
    'itemsTagName'=>'table',
    'template'=>'<div class="mailbox-summary">{summary}</div>{sorter}<div id="mailbox-items" class="ui-helper-clearfix">{items}</div>{pager}',
    'sortableAttributes'=>array('modified'=>'Sort by'),
    'loadingCssClass'=>'mailbox-loading',
    'ajaxUpdate'=>'mailbox-list',
    'afterAjaxUpdate'=>'$.yiimailbox.updateMailbox',
    'emptyText'=>'<div style="width:100%"><h3>No news to report.</h3></div>',
    //'htmlOptions'=>array('class'=>'ui-helper-clearfix'),
    'sorterHeader'=>'', 
    'sorterCssClass'=>'mailbox-sorter',
    'itemsCssClass'=>'mailbox-items-tbl ui-helper-clearfix',
    'pagerCssClass'=>'mailbox-pager',
    //'updateSelector'=>'.inbox',
));
?>
	<?php if($this->module->isAdmin()) : ?>
<div style="clear:left; padding-left:20px;"> <span class="mailbox-buttons-label">  </span> 
	<input type="submit" id="mailbox-action-delete" class="btn mailbox-button" name="button[delete]" value="delete"  onclick="return del();"/> 
	
</div>	<?php endif; ?>
	</div>
</form>

<?php

}
else {
	echo '<div class="mailbox-empty">No news to report.</div>';
}

echo '</div>';

?>
 
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
	function del()
{
	 var chks	=	$("[type='checkbox']");
	 var checked	=	false;
	for(var i=0; i<chks.length; i++){
		if(chks[i].checked){checked=true;}
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
$(".chkbox").change(function() {
    var val = $(this).val();
  if( $(this).is(":checked") ) {

    $(":checkbox[value='"+val+"']").attr("checked", true);
  }
    else {
        $(":checkbox[value='"+val+"']").attr("checked", false);
    }
});
</script>


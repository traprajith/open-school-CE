<style>
.mailbox-link span{ width:0px !important;}
/*.mailbox-summary{ left:0px !important;}*/
/*.list-view .summary{text-align:left !important;}*/
tr.mailbox-item > td > div{padding:9px 4px 15px !important;}
.msg-new .mailbox-subject a{text-align:left;}
.mailbox-subject-text{
	display:inline-block;
	min-width:350px !important;
	overflow:hidden;
	font-weight:bold;
	margin-right:20px;
	text-align:left;
}
.mailbox-item td{
	width:20px !important;
}
</style>

<?php

if($this->getAction()->getId()!='index') 
$this->breadcrumbs=array(
		Yii::t('app',ucfirst($this->module->id))=>array('news/'),
		Yii::t('app',ucfirst($this->getAction()->getId())) 
);
else
	$this->breadcrumbs=array(Yii::t('app','Site News')); ?>
    
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
     <div class="mail_head"><h1 style="margin:0px;"><?php echo Yii::t('app','Site News');?></h1><span><?php echo Yii::t('app','Latest news listed here');?></span></div>
    <?php  $roles = Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
			foreach($roles as $role)
			{
				$rolename = $role->name;
			}
		  if($rolename == 'Admin' or ModuleAccess::model()->check('My Account')) {?>

<div class="button-bg" style=" padding:8px">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li> <?php echo CHtml::link('<span>'.Yii::t('app','Create News').'</span>', array('/news/create'),array('class'=>'a_tag-btn')); ?></li>
<li> <?php echo CHtml::link('<span>'.Yii::t('app','Publish News').'</span>', array('/news/admin'),array('class'=>'a_tag-btn')); ?></li>                                  
</ul>
</div> 
</div>

    <?php 
		  }
		

//$this->renderpartial('_menu');

if(isset($_GET['Mailbox_sort']))
	$sortby = $_GET['Mailbox_sort'];
else
	$sortby = '';

echo '<div class="news-list ui-helper-clearfix" sortby="'.$sortby.'">';

$this->renderpartial('../message/_flash');

if($dataProvider->getItemCount() > 0) {?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-list-form',
	'action'=>$this->createUrl($this->getId().'/'.$this->getAction()->getId()),
)); ?>
<?php /*?><form id="message-list-form" action="<?php echo $this->createUrl($this->getId().'/'.$this->getAction()->getId()); ?>" method="post"><?php */?>
	<div class="mailbox-clistview-container ui-helper-clearfix">
	<?php
	if(($this->module->isAdmin() or ModuleAccess::model()->check('Home')) && $dataProvider->getItemCount() > 1) : ?>
		<div class="btn-group mailbox-checkall-buttons" style="margin-top:10px;">
<!-- chkbox-->        
            <input type="checkbox"  name="ch1" class="chkbox2 checkall" /> <?php echo Yii::t('app','Select All');?> 
            
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
    'emptyText'=>'<div style="width:100%"><h3>'.Yii::t('app','No news to report.').'</h3></div>',
    //'htmlOptions'=>array('class'=>'ui-helper-clearfix'),
    'sorterHeader'=>'', 
    'sorterCssClass'=>'mailbox-sorter',
    'itemsCssClass'=>'mailbox-items-tbl ui-helper-clearfix',
    'pagerCssClass'=>'mailbox-pager',
    //'updateSelector'=>'.inbox',
));
?>
	<?php if($this->module->isAdmin() or ModuleAccess::model()->check('Home')) : ?>
<div style="clear:left; padding-left:20px;"> <span class="mailbox-buttons-label">  </span> 
	<input type="submit" id="mailbox-action-delete" class="btn mailbox-button" name="button[delete]" value="<?php echo Yii::t('app','delete');?>"  onclick="return del();"/> 
	
</div>	<?php endif; ?>
	</div>
<?php /*?></form><?php */?>
<?php $this->endWidget(); ?>
<?php

}else {
	echo '<div class="mailbox-empty">'.Yii::t('app','No news to report.').'</div>';
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
		alert('<?php echo Yii::t('app','No item selected'); ?>');return false;
	}
	else{
		if(confirm('<?php echo Yii::t('app','Are you sure you want to delete the news ?'); ?>')){
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
$(".chkbox2").change(function() {	
    var val = $(this).val();	
  if( $(this).is(":checked") ) {

    $(":checkbox[value='"+val+"']").attr("checked", true);
  }
    else {
        $(":checkbox[value='"+val+"']").attr("checked", false);
    }
});
</script>



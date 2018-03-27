 
<style type="text/css">
	.grid-view table.items th, .grid-view table.items td {
    border-bottom: 1px solid #d3dde6;
    border-right: 1px solid #d3dde6;
    font-size: 11px;
    padding: 5px 4px !important;
}
</style>

<?php
$this->breadcrumbs=array(
	Yii::t('app','News')=>array('admin'),
	Yii::t('app','Manage'),
);



?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('mailbox.views.default.left_side'); ?>   
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper" >
<h1><?php echo Yii::t('app','News');?></h1>


<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li> <?php echo CHtml::link('<span>'.Yii::t('app','Create News').'</span>', array('create'),array('class'=>'a_tag-btn')); ?></li>
        <li> <?php echo CHtml::link('<span>'.Yii::t('app','View News').'</span>', array('/mailbox/news'),array('class'=>'a_tag-btn')); ?></li>                                    
</ul>
</div> 
</div>
<center>
    <?php
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>
 
<?php if(Yii::app()->user->hasFlash('notification')):?>
    <div class="flash-success" style="color:#F00; padding-left:150px; font-size:12px">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
<?php endif; ?>
</center>
<br>



<div class="knewscon">
 <?php if($news){?>
<?php foreach($news as $news1){ ?>
	<div class="knewslist_con">
    	<div class="knewslist_top"><h4><?php echo $news1->title; ?></h4></div>
        <div class="kcal"><?php $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$date1=date($settings->displaydate,strtotime($news1->created_at));
									echo $date1;
		
								}
								else
								echo $news1->created_at; ?></div>
        <div class="knewslist_btm"><p><article><?php echo $news1->content; ?></article></p></div>
        <div class="knews_controls">
        	<ul>
            	<li> 
				<?php 
				if($news1->is_published == 0)
				{
					echo CHtml::Link(Yii::t('app','Edit'),array('news/update','id'=>$news1->id),array('class'=>'edit')); 
				}
				?></li>
                <li><?php echo CHtml::Link(Yii::t('app','Delete'),"#",array('submit'=>array('news/delete','id'=>$news1->id),'class'=>'delete','confirm' => Yii::t('app','Are you sure?'), 'csrf'=>true)); ?></li>
            </ul>
            <?php 
			if($news1->is_published == 0)
			{
				echo CHtml::Link(Yii::t('app','Publish'),"#",array('submit'=>array('news/publish','id'=>$news1->id), 'class'=>'publish', 'confirm' => Yii::t('app','Are you sure?'), 'csrf'=>true)); 
			}
			else
			{
			?>
            	<a class="publish"><?php echo Yii::t('app','Published'); ?></a>
            <?php	
			}
			?>
            
             <div class="clear"></div>
        </div>
    </div>
    
    <?php }}else{$this->renderpartial('_empty');
				} ?>
    
   
</div>
</div>
    </td>
  </tr>
</table>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/readmore.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/readmore.js"></script>
<script type="text/javascript">
//$('article').readmore({maxHeight: 100});
</script>
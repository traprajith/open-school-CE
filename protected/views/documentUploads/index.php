<?php
 $this->breadcrumbs=array(
	 Yii::t("app",'Manage Document Uploads')
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
<div id="othleft-sidebar">
<?php $leftside = 'mailbox.views.default.left_side'; ?>	
<script language="javascript">
function hide(id)
{
	$(".drop_search").hide();
	$('#'+id).toggle();	
}


</script>
<?php $this->renderPartial($leftside);?>

  </div>
 </td>
 <td valign="top">
<div class="cont_right formWrapper">  
<h1><?php echo Yii::t('app','Manage Document Uploads'); ?></h1>

<div class="button-bg">
<div class="top-hed-btn-right">
<ul>                                    
<li>
</li>
<li>
</li>                                    
</ul>
</div> 
<div class="top-hed-btn-left">
<?php echo CHtml::link('<span>'.Yii::t('app','Clear Filter').'</span>', array('/documentUploads'),array('class'=>'a_tag-btn')); ?>
</div>
</div>
<div class="filtercontner">
    <div class="filterbxcntnt">
        <!-- Filter List -->
        <div class="filterbxcntnt_inner" style="border-bottom:#ddd solid 1px;">
            <ul>
                <li style="font-size:12px"><?php echo Yii::t('app','Filter :');?></li>
                
                <?php $form=$this->beginWidget('CActiveForm', array(
                'method'=>'get',
                )); ?>
                
                <!-- Name Filter -->
                <li>
                    <div onClick="hide('identifier')" style="cursor:pointer;"><?php echo Yii::t('app','Identifier');?></div>
                    <div id="identifier" style="display:none; width:230px;" class="drop_search" >
                        <div class="droparrow" style="left:10px;"></div>
                        <div class="filter_ul">
                        	<ul>
                        	<li class="Text_area_Box">                        
							<?php 
							$identifier_list = DocumentUploads::model()->setIdentifier();
							if(isset($_REQUEST['DocumentUploads']['identifier']) and $_REQUEST['DocumentUploads']['identifier']!=NULL){
								$model->identifier = $_REQUEST['DocumentUploads']['identifier'];
							}
							echo CHtml::activeDropDownList($model,'identifier',$identifier_list,array('prompt'=>Yii::t('app','All'))); ?></li>
                            <li class="Btn_area_Box"><input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /></li>
                            </ul>
                        </div>

                        
                    </div>
                </li>
                
                <li>
                    <div onClick="hide('status')" style="cursor:pointer;"><?php echo Yii::t('app','Status');?></div>
                    <div id="status" style="display:none; width:230px;" class="drop_search" >
                        <div class="droparrow" style="left:10px;"></div>
                        <div class="filter_ul">
                        	<ul>
                        	<li class="Text_area_Box">  
                        <?php 
							if(isset($_REQUEST['DocumentUploads']['status']) and $_REQUEST['DocumentUploads']['status']!=NULL){
								$model->status = $_REQUEST['DocumentUploads']['status'];
							}	
							else{
								$model->status = '';
							}
							echo CHtml::activeDropDownList($model,'status',array(0 => Yii::t('app','Pending'), 1 => Yii::t('app','Approved'), 2 => Yii::t('app','Disapproved')),array('prompt'=>Yii::t('app','All'))); ?>
                        	</li>
                       <li class="Btn_area_Box"> <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /></li>
                       </ul>
                       </div>
                    </div>
                </li>
                <?php $this->endWidget(); ?>
            </ul>
           
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
<!-- Active Filter -->        
        <div class="filterbxcntnt_inner_bot">
        	<div class="filterbxcntnt_left"><strong><?php echo Yii::t('app','Active Filters:');?></strong></div>
            <div class="clear"></div>
            <div class="filterbxcntnt_right">
            	<ul>
                	<?php 
					if(isset($_REQUEST['DocumentUploads']['identifier']) and $_REQUEST['DocumentUploads']['identifier']!=NULL)
					{ 
						$j++;
						$identifier = DocumentUploads::model()->getIdentifier($_REQUEST['DocumentUploads']['identifier']);
					?>
						<li><?php echo Yii::t('app','Identifier'); ?> : <?php echo $identifier?><a href="<?php echo Yii::app()->request->getUrl().'&DocumentUploads[identifier]='?>"></a></li>
					<?php 
					}
					?>
                    
                    <?php 
					if(isset($_REQUEST['DocumentUploads']['status']) and $_REQUEST['DocumentUploads']['status']!=NULL)
					{ 
						$j++;
						$status = DocumentUploads::model()->getStatus($_REQUEST['DocumentUploads']['status']);
					?>
						<li><?php echo Yii::t('app','Status'); ?> : <?php echo $status?><a href="<?php echo Yii::app()->request->getUrl().'&DocumentUploads[status]='?>"></a></li>
					<?php 
					}
					?>
                </ul>
            </div>
        </div>
        
    </div>
</div>

    <div class="pdtab_Con" style="padding-top:0px;">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr class="pdtab-h">
                <td align="center" width="40"><?php echo Yii::t('app','#'); ?></td>
                <td align="center" width="200"><?php echo Yii::t('app','Identifier'); ?></td>
                <td align="center" width="80"><?php echo Yii::t('app','Status'); ?></td>
                <td align="center" width="160"><?php echo Yii::t('app','Upload By'); ?></td>
                <td align="center" width="200"><?php echo Yii::t('app','Reason'); ?></td>
                <td align="center" width="225"><?php echo Yii::t('app','Manage'); ?></td>
            </tr>        
<?php                         
        if($list){
            if(isset($_REQUEST['page'])){
                $i=($pages->pageSize*$_REQUEST['page'])-9;
            }
            else{
                $i=1;
            }
            
            foreach($list as $data){				
?>        
                <tr>
                    <td style="text-align:center"><?php echo $i; ?></td>
                    <td style="text-align:center"><?php echo DocumentUploads::model()->getIdentifier($data->identifier); ?></td>
                    <td style="text-align:center"><?php echo DocumentUploads::model()->getStatus($data->status); ?></td>
                    <td style="text-align:center"><?php echo DocumentUploads::model()->displayName($data->created_by); ?></td>
                    <td style="text-align:center">
						<?php 
							if($data->reason!=NULL){
								echo ucfirst($data->reason);
							}
							else{
								echo '-';
							}
						?>
                    </td>
                    <td style="text-align:center">
                    	<div class="online_but">
                            <ul class="tt-wrapper">
<?php
								if($data->status == 0){
?>                            	
                                    <li>
                                        <?php echo CHtml::link('<span>'.Yii::t('app','Approve').'</span>', "#", array("submit"=>array('approve','id'=>$data->id),'confirm' => Yii::t('app', 'Are you sure ?'), 'csrf'=>true, 'class'=>'tt-approved')); ?>
                                    </li>
                                   
                                    <li>
                                        <?php echo CHtml::ajaxLink('<span>'.Yii::t('app','Disapprove').'</span>',$this->createUrl('/documentUploads/disapprove'),array('onclick'=>'$("#jobDialog_comment").dialog("open"); return false;','update'=>'#jobDialog_comment_dis'.$data->id,'type' =>'GET','data' => array('id' =>$data->id),'dataType' => 'text',),array('id'=>'showJobDialog_comment'.$data->id,'class'=>'addbttn last disapprove_btn tt-disapproved')); ?>									
                                    </li>                                    
<?php
								}
?>                                     
                                <li>
                                	 <?php echo CHtml::link('<span>'.Yii::t('app','Download').'</span>', "#", array("submit"=>array('/documentUploads/download','id'=>$data->id), 'csrf'=>true, 'class'=>'tt-download')); ?>                                	
                                </li>
<?php
							
							if(DocumentUploads::model()->checkIsImage($data->identifier, $data->file_id, $data->file_name)){
?>
								<li>
                                	 <?php echo CHtml::ajaxLink('<span>'.Yii::t('app','View').'</span>',$this->createUrl('/documentUploads/viewImage'),array('onclick'=>'$("#jobDialog_image").dialog("open"); return false;','update'=>'#jobDialog_image_div'.$data->id,'type' =>'GET','data' => array('id' =>$data->id),'dataType' => 'text',),array('id'=>'showJobDialog_image_btn'.$data->id,'class'=>'addbttn last tt-view')); ?>                                	
                                </li>				
<?php								
							}
?>                             
                                
                            </ul>
                               
                        </div>    
						<div id="jobDialog_image_div<?php echo $data->id; ?>"></div>
                        <div id="jobDialog_comment_dis<?php echo $data->id; ?>"></div>
                    </td>
                </tr>
<?php
				$i++;             
            }
        }
        else{
?>    
            <tr>
                <td colspan="6" style="text-align:center; font-style:italic;"><?php echo Yii::t('app','Nothing Found!'); ?></td>
            </tr>
<?php    		
        }    
 ?>   
       
        </table>
        
        <div class="pagecon">
        <?php                                          
          $this->widget('CLinkPager', array(
          'currentPage'=>$pages->getCurrentPage(),
          'itemCount'=>$item_count,
          'pageSize'=>$page_size,
          'maxButtonCount'=>5,          
          'header'=>'',
        'htmlOptions'=>array('class'=>'pages'),
        ));?>
        
        </div> <!-- END div class="pagecon" 2 -->
        <div class="clear"></div>                        
    </div>
</div>
     
<script>
$('body').click(function()
{
   $('#identifier').hide(); 
   $('#status').hide();
});
$('.filterbxcntnt_inner').click(function(event){
   event.stopPropagation();
});

$('.load_filter').click(function(event){
   event.stopPropagation();
});

$(".disapprove_btn").click(function(e) {
    $("form#reason-form").remove();
});
</script>
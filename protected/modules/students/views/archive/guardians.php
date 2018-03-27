<style type="text/css">
.nothing-found{
	font-style:italic;
	text-align:center;
}
</style>
<script language="javascript">
function hide(id)
{
	$(".drop_search").hide();
	$('#'+id).toggle();	
}
</script>

<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<?php
$this->breadcrumbs=array(
	Yii::t('app','Students')=>array('/students'),
	Yii::t('app','Manage Guardians Archive'),
);
?>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
        <td width="247" valign="top"><?php $this->renderPartial('/default/left_side');?></td>
        <td valign="top">
            <div class="cont_right formWrapper">
				<h1><?php echo Yii::t('app','Manage Guardians Archive');?></h1>

<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    


 <li><?php echo CHtml::link('<span>'.Yii::t('app','Clear All').'</span>', array('guardians'), array('class'=>'a_tag-btn')); ?></li>                                  
</ul>
</div> 
</div>       
<!-- Flash Message -->
			<?php if(Yii::app()->user->hasFlash('success')){ ?>
                <div class="alert-box">
                    <div class="alert-hd">
                    	<h3><?php echo Yii::t('app','Previous action returns the following messages'); ?></h3>
                    	<a href="javascript:void(0);" title="<?php echo Yii::t('app','Close'); ?>" id="close_btn"><span class="alert-close"><i class="fa fa-times" aria-hidden="true"></i></span></a>
                    </div>
                    <div class="alert-pading">
<?php 
						$messages	= Yii::app()->user->getFlashes();
						foreach($messages as $key => $message) {
							if($key === "success"){	
?>                    	
                            	<div class="grean-test grean-test-icon"><p><?php echo $message; ?></p></div>
<?php
							}
							else if($key === "error"){	
?>                                
                            	<div class="grean-test-hd"><p><?php echo $message; ?></p></div>
<?php
							}
							else{
?>                                
                            	<div class="red-test red-test-icon"><p><?php echo $message; ?></p></div>
<?php
							}
						}
?>                        
                	</div>                
                </div> 
			<?php } ?>   
                                         
<!-- Filter Section Start -->                            
                <div class="filtercontner">
                	<div class="filterbxcntnt">	
                    	<div class="filterbxcntnt_inner" style="border-bottom:#ddd solid 1px;">
                        	<ul>
                            	<li style="font-size:12px"><?php echo Yii::t('app','Filter Your Guardian:');?></li>
                                
                                <?php $form=$this->beginWidget('CActiveForm', array('method'=>'get')); ?>                                
                                    <!-- Name Filter -->
                                    <li>
                                        <div onClick="hide('name')" style="cursor:pointer;"><?php echo Yii::t('app','Name');?></div>
                                        <div id="name" style="display:none; width:230px;" class="drop_search" >
                                            <div class="droparrow" style="left:10px;"></div>
                                                    <div class="filter_ul">
                                                    <ul>
                                                        <li class="Text_area_Box">
                                                         <input type="search" placeholder="<?php echo Yii::t('app','search'); ?>" name="name" value="<?php echo isset($_GET['name']) ? CHtml::encode($_GET['name']) : '' ; ?>" />
                                                        </li>
                                                        <li class="Btn_area_Box">
                                                           <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
                                                        </li>
                                                    </ul>
                                                    </div>
                                        	</div>
                                    </li>
                                    <!-- End Name Filter -->
                                    
                                    <!-- Email Filter -->
                                    <li>
                                        <div onClick="hide('email')" style="cursor:pointer;"><?php echo Guardians::model()->getAttributeLabel('email');?></div>
                                        <div id="email" style="display:none;width:230px;" class="drop_search">
                                            <div class="droparrow" style="left:10px;"></div>
                                                  <div class="filter_ul">
                                                    <ul>
                                                        <li class="Text_area_Box">
                                                          <input type="search" placeholder="<?php echo Yii::t('app','search'); ?>" name="email" value="<?php echo isset($_GET['email']) ? CHtml::encode($_GET['email']) : '' ; ?>" />
                                                        </li>
                                                        <li class="Btn_area_Box">
                                                               <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" /> 
                                                        </li>
                                                    </ul>
                                                    </div>
                                        	</div>
                                    </li>
                                    <!-- End Email Filter -->
                                    
                                    <!-- Mobile number Filter -->
                                    <li>
                                        <div onClick="hide('phone_no')" style="cursor:pointer;"><?php echo Guardians::model()->getAttributeLabel('mobile_phone'); ?></div>
                                        <div id="phone_no" style="display:none;width:230px;" class="drop_search">
                                            <div class="droparrow" style="left:10px;"></div>
                                                                                                <div class="filter_ul">
                                                    <ul>
                                                        <li class="Text_area_Box">
                                                         <input type="search" placeholder="<?php echo Yii::t('app','search'); ?>" name="phone_no" value="<?php echo isset($_GET['phone_no']) ? CHtml::encode($_GET['phone_no']) : '' ; ?>" />
                                                        </li>
                                                        <li class="Btn_area_Box">
                                                              <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
                                                        </li>
                                                    </ul>
                                                    </div>
                                                    </div>
                                   				 </li>
                                    <!-- End Mobile number Filter -->
                                    
                                    
								<?php $this->endWidget(); ?>                                    
                            </ul>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        
                        <div class="filterbxcntnt_inner_bot">
                        	<div class="filterbxcntnt_left"><strong><?php echo Yii::t('app','Active Filters:');?></strong></div>
                            <div class="clear"></div>
                            <div class="filterbxcntnt_right">
                            	<ul>
                                	<!-- Name Active Filter -->
<?php									 
									if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL){
                                    	$j++; 
?>									
                                    	<li><?php echo Yii::t('app','Name'); ?> : <?php echo $_REQUEST['name']?><a href="<?php echo Yii::app()->request->getUrl().'&name='?>"></a></li>
<?php                                     
									}
?>									
                                    <!-- END Name Active Filter -->                                                                        
                                     
                                    <!-- Email Active Filter -->
<?php                                     
									if(isset($_REQUEST['email']) and $_REQUEST['email']!=NULL){ 
                                    	$j++; 
?>									
                                    	<li><?php echo Guardians::model()->getAttributeLabel('email'); ?> : <?php echo $_REQUEST['email']?><a href="<?php echo Yii::app()->request->getUrl().'&email='?>"></a></li>								
<?php									 
									}
?>									
                                     <!-- END Email Active Filter -->
                                     
                                    <!-- Phone Number Active Filter -->
<?php                                     
									if(isset($_REQUEST['phone_no']) and $_REQUEST['phone_no']!=NULL){ 
                                    	$j++; 
?>									
                                    	<li><?php echo Guardians::model()->getAttributeLabel('mobile_phone'); ?> : <?php echo $_REQUEST['phone_no']?><a href="<?php echo Yii::app()->request->getUrl().'&phone_no='?>"></a></li>								
<?php									 
									}
?>									
                                     <!-- END Phone Number Active Filter -->   
                                </ul>
                            </div>
                        	<div class="clear"></div>
                        </div>                                                                
                    </div>
                </div>    
<!-- Filter Section End   -->
				<!-- Alphabetic Sort -->
				<?php $this->widget('application.extensions.letterFilter.LetterFilter', array(
					//parameters
					'outerWrapperClass'=>'list_contner_hdng',
					'innerWrapperId'=>'letterNavCon',
					'innerWrapperClass'=>'letterNavCon',
					'activeClass'=>'ln_active',
				)); ?>
                <!-- END Alphabetic Sort -->
                
                <div class="qurdn-not">
                	<div class="head">
                    	<b><h2><?php echo Yii::t('app','Note').' :'; ?></h2></b>
                    </div>
                    	<div class="not-bullet">
                        	<ul>
                            	<li><?php echo Yii::t('app','Emails or Phone numbers already in use should be changed before restoration.'); ?></li>                                
                               	<li><?php echo Yii::t('app','Removing an entry from here will result in permanent deletion and cannot be retrieved.'); ?></li>
                            </ul>
                        </div>
                </div>
                
				<?php echo CHtml::beginForm('','post',array('id'=>'guardian_list_form')); ?>                
					
                	<div class="btn-position-bg">
						<?php 							
							if($guardians){
								?>

            <div class="top-hed-btn-left"> </div>
            <div class="top-hed-btn-right">
            <ul>
            <li><?php echo CHtml::submitButton(Yii::t('app','Delete All'),array('submit' =>CController::createUrl('/students/archive/deleteGuardian'), 'id'=>'delete_btn','class'=>'','name'=>'delete_btn'));    ?></li>
            <li><?php echo CHtml::submitButton(Yii::t('app','Restore'),array('id'=>'restore_btn','class'=>'','name'=>'restore_btn'));  ?></li>
            </ul>
            </div>
            </div>
            <?php
            
            }
            ?>

					<div id="jobDialog"></div>
                    <div class="pdtab_Con" style="padding-top:10px;"> 
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr class="pdtab-h">
                                <td align="center" width="25"><?php echo CHtml::checkBox('all_guardian','',array('class'=>'check_all')); ?></td>
                                <td align="center" width="25"><?php echo Yii::t('app','#'); ?></td>
                                <td align="center" width="150"><?php echo Yii::t('app','Name'); ?></td>                                
                                <td align="center" width="75"><?php echo Guardians::model()->getAttributeLabel('email'); ?></td>
                                <td align="center" width="75"><?php echo Guardians::model()->getAttributeLabel('mobile_phone'); ?></td>
                                <td align="center" width="65"><?php echo Yii::t('app','Action'); ?></td>                                                            
                            </tr>
<?php
                            if($guardians){
                                if(isset($_REQUEST['page'])){
                                    $i	= ($pages->pageSize*$_REQUEST['page'])-19;
                                }
                                else{
                                    $i	= 1;
                                }
                                foreach($guardians as $guardian){
?>
                                    <tr>
                                        <td align="center"><?php echo CHtml::checkBox('guardian_id[]','',array('value'=>$guardian->id, 'class'=>'guardian_checkbox')); ?></td>
                                        <td align="center"><?php echo $i; ?></td>
                                        <td align="center"><?php echo $guardian->parentFullName('forStudentProfile'); ?></td>                                          
                                        <td align="center">
<?php 						
											if($guardian->email){																										
												echo $guardian->email; 
												if(Students::model()->checkEmailDuplicate('guardian', $guardian->id)){
?>
													<div class="tt-wrapper-new">
														<a href="javascript:void(0);" class="makealert"><span><?php echo Guardians::model()->getAttributeLabel('email').' '.Yii::t('app','already in use') ?></span></a>
													</div>
<?php													
												}
											}
											else{
												echo '-';
											}
?>											
                                        </td>
                                        <td align="center">
<?php 
											if($guardian->mobile_phone){																																
												echo $guardian->mobile_phone; 
												if(Students::model()->checkPhoneDuplicate('guardian', $guardian->id)){
?>
													<div class="tt-wrapper-new">
														<a href="javascript:void(0);" class="makealert"><span><?php echo Guardians::model()->getAttributeLabel('mobile_phone').' '.Yii::t('app','already in use') ?></span></a>
													</div>
<?php													
												}
											}
											else{
												echo '-';
											}
?>											
                                        </td> 
                                        <td align="center">
                                        	<div class="tt-wrapper-new"> 
<?php
												echo CHtml::ajaxLink('<span>'.Yii::t('app','Edit').' '.Guardians::model()->getAttributeLabel('email').' & '.Guardians::model()->getAttributeLabel('mobile_phone').'</span>',$this->createUrl('/students/archive/updateGuardian'),array('onclick'=>'$("#jobDialog").dialog("open"); return false;','update'=>'#jobDialog','type' =>'GET','data' => array('id' =>$guardian->id),'dataType' => 'text'),array('id'=>'showJobDialog_edit_student'.$guardian->id,'class'=>'makeedit')); 
											
												echo CHtml::link('<span>'.Yii::t('app','Permanent Delete').'</span>', "#", array('submit'=>array('/students/archive/deleteGuardian','id'=>$guardian->id), 'confirm'=>Yii::t('app','Are you sure?'),'class'=>'makedelete', 'csrf'=>true));
												
												echo CHtml::link('<span>'.Yii::t('app','Restore').'</span>', "#", array('submit'=>array('/students/archive/guardians','id'=>$guardian->id,'flag'=>1), 'confirm'=>Yii::t('app','Are you sure?'),'class'=>'makerestore', 'csrf'=>true));
?>                                            	
                                            </div>
                                        </td>                                  
                                    </tr>
<?php		
                                    $i++;					
                                }							
                            }
                            else{
?>
                                <tr>
                                    <td colspan="7" class="nothing-found"><?php echo Yii::t('app','No Guardians Found!'); ?></td>
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
                            ));
?>						                        
                        </div>    	                    
                    </div> 
				<?php echo CHtml::endForm(); ?>   
                <div class="clear"></div>                                
            </div>
        </td>
	</tr>
</table>
</body>
<script type="text/javascript">
$('body').click(function() {	
	$('#name').hide();	
	$('#email').hide();	
});
$('.filterbxcntnt_inner').click(function(event){
   event.stopPropagation();
});

$('.load_filter').click(function(event){
   event.stopPropagation();
});
$(".check_all").change(function(){
	if(this.checked) {
		$('.guardian_checkbox').attr('checked', true);
	}
	else{
		$('.guardian_checkbox').attr('checked', false);
	}
});

$(".guardian_checkbox").change(function(){ 
	if($('.guardian_checkbox:checked').length == $('.guardian_checkbox').length){
		$('.check_all').attr('checked', true);
	}
	else{
		$('.check_all').attr('checked', false);
	}
});

$('#restore_btn, #delete_btn').click(function(ev){
	if(confirm("<?php echo Yii::t('app','Are you sure?'); ?>")){
		var chks	=	$("[type='checkbox'][name='guardian_id[]']:checked");
		if(chks.length==0){
			alert("<?php echo Yii::t('app','Select any Guardian'); ?>");
			return false;
		}
	}
	else{
		return false;
	}
});	

$('#close_btn').click(function(ev){
	$('.alert-box').remove();
});
</script>
<?php
$this->breadcrumbs=array(
    Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Form Fields'),
	Yii::t('app','Manage'),
);


?>

<style>
    .pdtab_Con table td{
        padding: 8px 7px;
    }
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top"> 
         
        <div class="cont_right formWrapper">
            <h1><?php echo Yii::t('app','Manage Fields');?></h1>

<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li><?php echo CHtml::link('<span>'.Yii::t('app','Create Form Field').'</span>', array('/dynamicform/formFields/create'),array('class'=>'a_tag-btn')); ?></li>                                 
</ul>
</div> 
</div>
            
            <?php $this->beginWidget('CActiveForm', array(
				'id'=>'search-form',
				'method'=>'GET',
				'enableAjaxValidation'=>false,
				'action' => Yii::app()->createUrl('/dynamicform/formFields/list')
			)); ?>
                <div class="formCon">
                    <div class="formConInner">
                    
                    <div class="txtfld-col-box">
                    	<div class="txtfld-col-block-One">
                        	<input type="text" name="field_title" id="field_title" value="<?php  if(isset($_GET['field_title'])) echo $_GET['field_title']; ?>" placeholder="Enter Field Name" />
                        </div>
                        <div class="txtfld-col-block-One">
                        	<?php 
                                    $id="";
                                    if(isset($_GET['field_type'])) $id= $_GET['field_type'];
                                    echo CHtml::dropDownList("field_type",$id, FormFields::itemAlias('form_field_type'),array('empty'=>'Select')); ?>
                        </div>
                        <div class="txtfld-col-block-One">
<?php echo CHtml::submitButton( Yii::t('app','Search'),array('class'=>'formbut')); ?>
                        </div> 
                    </div>
                        <?php /*?><table width="90%" border="0" cellspacing="0" cellpadding="0" class="s_search">
                           
                            <tr>
                                <td> 
                                    <div style="position:relative;" >
                                    <input type="text" name="field_title" id="field_title" value="<?php  if(isset($_GET['field_title'])) echo $_GET['field_title']; ?>" placeholder="Enter Field Name" />                               
                                    <?php 
                                    $id="";
                                    if(isset($_GET['field_type'])) $id= $_GET['field_type'];
                                    echo CHtml::dropDownList("field_type",$id, FormFields::itemAlias('form_field_type'),array('empty'=>'Select')); ?>
                                    <?php echo CHtml::submitButton( Yii::t('app','Search'),array('class'=>'formbut')); ?>
                                    </div>
                                </td>
                            </tr>
                        </table><?php */?>
                    	
                    </div> <!-- END div class="formConInner" -->
                </div> <!--  END div class="formCon" -->
                 <?php $this->endWidget(); ?>
                
                
                
        <div class="pdtab_Con"  style="width:100%; padding: 10px 0 0">
             
             
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                     <tr class="pdtab-h">
                        <td height="18" align="center">#</td>
                        <td align="center"><?php echo Yii::t('app','Field Name'); ?></td>
                        <td align="center"><?php echo Yii::t('app','Category'); ?></td>
                        <td align="center"><?php echo Yii::t('app','Admin Student Registration'); ?></td>
                        <td align="center"><?php echo Yii::t('app','Online Admission'); ?></td>
                        <td align="center"><?php echo Yii::t('app','Student Profile PDF'); ?></td>
                        <td align="center"><?php echo Yii::t('app','Student Profile'); ?></td>
                        <td align="center"><?php echo Yii::t('app','Student Portal'); ?></td>
                        <td align="center"><?php echo Yii::t('app','Parent Portal'); ?></td>
                        <td align="center"><?php echo Yii::t('app','Teacher Portal'); ?></td>                        
                        <td align="center"><?php echo Yii::t('app','Manage'); ?></td>
                    </tr>                       
                </tbody>
        <tbody>
        <?php						
        if($fields)
        {		
				$field_array= array(6,8,26,42,43,45);				
                if(isset($_REQUEST['page'])){
                        $i=($pages->pageSize*$_REQUEST['page'])-9;
                }
                else{
                        $i=1;
                }
                foreach($fields as $data)
                {
                    ?>                     
                    <tr>
                    <td align="center"><?php echo $i; ?></td>
                    <td align="center"><?php echo CHtml::link($data->title,array('detail','id'=>$data->id)); ?></td>
                    <td align="center"><?php 
                    if($data->model=="StudentPreviousDatas")
                    {
                        echo "Student Previous Data";
                    }
                    else if($data->model=="StudentDocument")
                    {
                        echo "Student Document";
                    }
                    else
                    echo $data->model; ?></td>
                    
                    <?php
                    $disp='';
					$basic_disp='';
                    if($data->admin_student_reg_form==0 && $data->online_admission_form==0)
                    {
                        $disp='disabled';
                    }
					if(in_array($data->id,$field_array)){
						$basic_disp	=	'disabled';
					}
                    ?>
                    <td align="center"><input <?php echo $basic_disp; ?> class="status_master" value="1" data="<?php echo $data->id; ?>" portal="<?php echo 1; ?>"  <?php if($data->admin_student_reg_form==1){ echo "checked"; } ?>  type="checkbox"></td>
                    <td align="center"><input <?php echo $basic_disp; ?> class="status_master" value="1" data="<?php echo $data->id; ?>" portal="<?php echo 2; ?>"  <?php if($data->online_admission_form==1){ echo "checked"; } ?>  type="checkbox"></td>
                    <td align="center"><input <?php echo $disp; ?> class="status" value="1" data="<?php echo $data->id; ?>" portal="<?php echo 3; ?>"  <?php if($data->student_profile_pdf==1){ echo "checked"; } ?>  type="checkbox"></td>
                    <td align="center"><input <?php echo $disp; ?> class="status" value="1" data="<?php echo $data->id; ?>" portal="<?php echo 4; ?>"  <?php if($data->student_profile==1){ echo "checked"; } ?>  type="checkbox"></td>
                    <td align="center"><input  <?php echo $disp; ?> class="status" value="1" data="<?php echo $data->id; ?>" portal="<?php echo 5; ?>"  <?php if($data->student_portal==1){ echo "checked"; } ?>  type="checkbox"></td>
                    <td align="center"><input <?php echo $disp; ?> class="status" value="1" data="<?php echo $data->id; ?>" portal="<?php echo 6; ?>"  <?php if($data->parent_portal==1){ echo "checked"; } ?>  type="checkbox"></td>
                    <td align="center"><input <?php echo $disp; ?> class="status" value="1" data="<?php echo $data->id; ?>" portal="<?php echo 7; ?>"  <?php if($data->teacher_portal==1){ echo "checked"; } ?>  type="checkbox"></td>
                    
                    <td align="center">
                    <?php 
                        if($data->is_dynamic==1)
                        { 
                            echo CHtml::link(Yii::t('app','Edit'),array('dynamic','id'=>$data->id));
                            echo " / ";
                            echo CHtml::link(Yii::t('app','Delete'), array('/dynamicform/formFields/fielddelete','id'=>$data->id), array('title'=>Yii::t('app','Delete'), 'class'=>'delete-icon', 'data-id'=>$data->id));
						} 
                       else 
                       {
						   if(!in_array($data->id,$field_array)){
                           		echo CHtml::link(Yii::t('app','Edit'),array('update','id'=>$data->id));
						   }
						   else
						   		echo "-";
                       }
                        
                     ?></td>
                    </tr>
                    <?php
                        $i++;
                }
            }
            else
            {
                ?>						
                <tr>
                <td colspan="11" align="center"><?php echo Yii::t('app','Nothing Found'); ?>!</td>
                </tr>	
                <?php						
            }
?>                        
</tbody>
				</table>  
        </div>
        
			
            <div class="pagecon">
				<?php 
                  $this->widget('CLinkPager', array(
                  'currentPage'=>$pages->getCurrentPage(),
                  'itemCount'=>$item_count,
                  'pageSize'=>$page_size,
                  'maxButtonCount'=>5,
                  //'nextPageLabel'=>'My text >',
                  'header'=>'',
                'htmlOptions'=>array('class'=>'pages'),
                ));?>
            </div>
			</div>
    </td>
  </tr>
</table>
<script>
    
    $(".status").change(function()
    {                    
        var field_id= $(this).attr("data");
        var portal= $(this).attr("portal");
        var that	= this;
        if($(this).is(':checked'))
        {            
            $.ajax({
                    url:'<?php echo Yii::app()->createUrl('/dynamicform/formFields/settings');?>',
                    type:'POST',
                    data:{status: 1, field_id:field_id, portal: portal, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
                    dataType:"json",
                    success: function(response){
                            if(response.status=="success")
                            {
                               //
                            }

                    }
            });

        }
        else
        {            
            $.ajax({
                    url:'<?php echo Yii::app()->createUrl('/dynamicform/formFields/settings');?>',
                    type:'POST',
                    data:{status: 0, field_id:field_id, portal: portal, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
                    dataType:"json",
                    success: function(response){
                            if(response.status=="success")
                            {
                                //
                            }

                    }
            });
        }
        
    });
    
    $(".status_master").change(function()
    {                           
        var field_id= $(this).attr("data");
        var portal= $(this).attr("portal");
        var that	= this;
        if($(this).is(':checked'))
        {         
            $(this).closest('tr').find('.status').show();
             $(this).closest('tr').find('.status').removeAttr("disabled");
            $.ajax({
                    url:'<?php echo Yii::app()->createUrl('/dynamicform/formFields/settings');?>',
                    type:'POST',
                    data:{status: 1, field_id:field_id, portal: portal, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
                    dataType:"json",
                    success: function(response){
                            if(response.status=="success")
                            {
                               //window.location.reload();
                            }

                    }
            });

        }
        else
        {
            var a= $(this).closest('tr').find('.status_master:checked').size();           
            if(a==0)
            {
                    $(this).closest('tr').find('.status').removeAttr("checked");
                   $(this).closest('tr').find('.status').attr('disabled', 'disabled');
                  // $('#sr').attr('readonly',true); 
                   $.ajax({
                        url:'<?php echo Yii::app()->createUrl('/dynamicform/formFields/allsettings');?>',
                        type:'POST',
                        data:{status: 0, field_id:field_id, portal: portal, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
                        dataType:"json",
                        success: function(response){
                                if(response.status=="success")
                                {
                                    //window.location.reload();
                                }

                        }
                });
                   
            }
            else
            {
                $(this).closest('tr').find('.status').show();
                $.ajax({
                        url:'<?php echo Yii::app()->createUrl('/dynamicform/formFields/settings');?>',
                        type:'POST',
                        data:{status: 0, field_id:field_id, portal: portal, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
                        dataType:"json",
                        success: function(response){
                                if(response.status=="success")
                                {
                                    //
                                }

                        }
                });
            }
        }
        
    });
    
    </script>
    <script type="text/javascript">
$('.delete-icon').click(function(e) {
	if(confirm('Are You Sure?'))
        {
		var that	= this;	
		var url		= $(that).attr('href');
                var id		= $(that).attr('data-id');
		$.ajax({
                    url:url,
                    type:'POST',
                    data:{id:id, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
                    dataType:"json",
                    success: function(response){
                            if(response.status=="success")
                            {
                                //alert('Success');
                                //$(that).closest('tr').remove();
				window.location.reload();
                            }
                            if(response.status=="error")
                            {
                                alert('Error');
                                //$(that).closest('tr').remove();
				//window.location.reload();
                            }
                            

                    }
            });
	}
	return false;
});
</script>
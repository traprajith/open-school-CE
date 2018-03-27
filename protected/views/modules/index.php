<?php
$this->breadcrumbs=array(
	Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Modules'),
);

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
<div id="othleft-sidebar">
<?php $this->renderPartial('//configurations/left_side');?>
  </div>
 </td>
 <td valign="top">
<div class="cont_right formWrapper">

<h1><?php echo Yii::t('app','Manage Modules');?></h1>

<?php $cls = "even"; ?>

 <div class="tablebx">
 	<?php
        $module_control = array();
        $module_list    = array('5','6','7','8','9','11','12','13','14','15','16','18','21','22');
        $criteria       = new CDbCriteria();
        $criteria->addInCondition('id',$module_list);
        $module_check   = Modules::model()->findAll($criteria);
        foreach($module_check as $module_check1){
            $module_control[] = $module_check1->control;
        }
        if(in_array('0',$module_control)){
            $check = 'checked';
        }
    ?>
    <label class="switch">
    	<input class="demo_mod" value="1" <?php echo $check; ?> type="checkbox"> 
    	<span class="slider round"></span>
	</label>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="tablebx_topbg">
                                <td><?php echo Yii::t('app','Name');?></td>	
                                <td><?php echo Yii::t('app','Action');?></td>
                                </tr>
<?php 
foreach($modules as $module)
{ 
    if($module->name!='Settings' and !in_array($module->id, $module_list))
    {
?>
		

                                <tr class=<?php echo $cls;?>>
                                
                                <td><?php echo $module->name; ?></td>	
                                <td><?php 
								
								if($module->control=='1')
										{
											echo CHtml::link(Yii::t('app','Disable'), array('disable', 'id'=>$module->id),array('confirm'=>Yii::t('app','Are you sure you want to disable this module?')));
										}
										else
										{
											echo CHtml::link(Yii::t('app','Enable'), array('enable', 'id'=>$module->id),array('confirm'=>Yii::t('app','Are you sure you want to enable this module ?')));
										}
								
								
								?></td>
                                </tr>



<?php 
if($cls=="even")
{
	$cls="odd";
}
else
{
	$cls="even";
}
    }
}

?>
</table>
</div>
</div>
 </td>
  </tr>
</table>

<script>
	 $(".demo_mod").change(function()
    {                    
        if($(this).is(':checked'))
        {            
            $.ajax({
                    url:'<?php echo Yii::app()->createUrl('/configurations/disableModules');?>',
                    type:'POST',
                    data:{demo_mod: 1, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
                    dataType:"json",
                    success: function(response){
                            if(response.status=="success")
                            {
                               location.reload();
                            }

                    }
            });

        }
        else
        {            
            $.ajax({
                    url:'<?php echo Yii::app()->createUrl('/configurations/disableModules');?>',
                    type:'POST',
                    data:{demo_mod: 0, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
                    dataType:"json",
                    success: function(response){
                            if(response.status=="success")
                            {
                               location.reload();
                            }

                    }
            });
        }
        
    });
</script>
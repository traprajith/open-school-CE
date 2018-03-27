<?php
	$model		= new FormFieldData;
?>
<?php 
$data_flag=0;
$mdl= FormFieldData::model()->countByAttributes(array('field_id'=>$_REQUEST['id']));
if($mdl)
{
    $first= $mdl;
    $data_flag=1;
    
}
?>

    
    <?php $mdl= FormFieldData::model()->findAllByAttributes(array('field_id'=>$_REQUEST['id']));
    if($mdl)
    {
        $i=0;
         
       foreach($mdl as $key=>$data)
       {  
           ?>
               <div class="advance" data-row="<?php echo $first;?>">
                <div class="formConInner">
            <?php
                echo CHtml::activeTextField($model, "option_name[".$i."]", array('placeholder'=>Yii::t("app", "Option Data"),'value'=>$data->option_name));
                echo CHtml::hiddenField("option_data[".$i."]",$data->id);   
                   //if($i!=0)
                   {
                   ?>
                       <a href="javascript:void(0);" title="<?php echo Yii::t("app", "Click to remove option");?>" class="remove_row fees-trash" data="<?php if(isset($data->id)){ echo $data->id; } ?>"  data-row="<?php echo $i;?>"></a>            					                       
                       <?php
                   }
                   $i= $i+1;
                  
                   echo "</div></div>";
       }
    }
    ?>
                       
<?php 
    $flag=0;
    if(isset($_REQUEST['id']) && $_REQUEST['id']!=NULL)
    {
        $id= $_REQUEST['id'];
        $form_model= FormFields::model()->findByPk($id);
        if($form_model)
        {
            if($form_model->form_field_type==5)
            {
                $flag=1;
            }
        }
    }
?>
<?php 

if($flag!=1 or $data_flag==0)
{
 
?>                
<div class="advance" data-row="<?php echo $first;?>">
<div class="formConInner">
        <?php echo CHtml::activeTextField($model, "option_name[".$first."]", array('placeholder'=>Yii::t("app", "Option Data")));?>                              
    
    
   
        <?php if($first!=0) 
        { ?>
       <a href="javascript:void(0);" title="<?php echo Yii::t("app", "Click to remove option");?>" class="remove_row fees-trash"  data-row="<?php echo $first;?>"></a>            					
        <?php 
        
        } ?>    
    <div class="clearfix"></div>
</div>
</div>
<?php } ?>
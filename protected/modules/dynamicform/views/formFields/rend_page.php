<?php
$this->breadcrumbs=array(
    Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Form Fields')=>array('list'),
	Yii::t('app','Create'),
);


?>
<style>
    .dynamic-btn
    {
        margin: 15px;
    }
</style>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('/default/left_side');?>
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Add Option Data');?></h1>
                <div class="formCon">
                
                <?php $last=0; ?>           
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'option-form',	
                        'enableAjaxValidation'=>false,
                )); 
                ?>


                  <div id="basic-<?php echo $last;?>">
                        <?php //echo $form->errorSummary($model); ?>
                        <?php echo $form->hiddenField($model,'field_id',array('value'=>$_REQUEST['id'])); ?>
                        <?php $this->renderPartial('option',array('model'=>$model,'last'=>0,'first'=>$first)); ?>
                  </div> 
                    
                    <div id="nextbtn" style="padding: 0px 0 20px 20px">
                       <?php if($flag==0)
                       {
                        ?>
                  <a href="javascript:void(0);" title="<?php echo Yii::t("app", "Add New Option");?>" class="add_new_row" style="font-size:12px;" data-row="<?php echo $last;?>"><strong><?php echo Yii::t("app", "+Add New");?></strong></a>
                       <?php } ?>
                    
                    </div>
                    <div class="dynamic-btn">
                        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Save'),array('class'=>'formbut')); ?>
                    </div>

                <?php $this->endWidget(); ?>
                </div>	
				
            </div>
        </td>
    </tr>
</table>





		


<script>


var add_access	= function(that){
	var last	= parseInt($(that).attr("data-row"));
	var first	= parseInt($("#basic-" + last + " .advance").last().attr("data-row")) + 1;
        
	$.ajax({
		url:'<?php echo Yii::app()->createUrl("/dynamicform/formFields/addRow");?>',
		type:'GET',
		data:{last:last, first:first},
		dataType:"json",
		success: function(response){
			if(response.status=="success")
                        {
				var data	= $(response.data);
				$("#basic-" + last).append(data);
				if(first==9)
                                {
                                    $('#nextbtn').hide();
                                }                                                                								
				setup_actions();
			}
			else{
				alert("<?php echo Yii::t("app", "Can't add access");?>");
			}
		}
	});
};

var remove_access	= function(that){
	var row	= parseInt($(that).attr("data-row"));
        var data= parseInt($(that).attr("data"));
        
       if(row==0)
       {
           alert("Cant Delete this Row")
       }
       else
       {
           if(data)
           {
               $.ajax({
		url:'<?php echo Yii::app()->createUrl("/dynamicform/formFields/deleteData");?>',
		type:'POST',
		data:{id:data},
		dataType:"json",
		success: function(response){
			if(response.status=="success")
                        {
				alert("success");
			}
			else
                        {
				alert("<?php echo Yii::t("app", "Can't Delete");?>");
			}
		}
                });
           }
            $(that).closest(".advance").remove();
            
        }		
};

var setup_actions	= function(){
    $(".add_new_row").unbind('click').click(function(e) {
		var that	= this;
		add_access(that);
    });		
    $(".remove_row").unbind('click').click(function(e) {
            var that	= this;
            remove_access(that);        
    });
};


    
    
    
    
    $("form#option-form").submit(function(e) {
	var that	= this;
	var data	= $(that).serialize();
	data	+= "&yid=" + $("#system_yid").val();
	$.ajax({
		url:'<?php echo Yii::app()->createUrl("/dynamicform/formFields/fields");?>',
		type:'POST',
		data:data,
		dataType:"json",
		success: function(response){
                        $('.errorMessage').remove();
			$(that).find("input, select").attr('title', '');
			$(that).find("*").removeClass("error-brd");
			if(response.status=="success"){                                                      
				window.location.href	= response.redirect;
			}
			else if(response.hasOwnProperty("errors")){
				var errors	= response.errors;                                                                  
				$.each(errors, function(attribute, earray){
                                   
					$.each(earray, function(index, error)
                                        {
                                           
                                            $('<div class="errorMessage" />').html(error).insertAfter($('#' + attribute));
						//$('#' + attribute).attr('title', error).addClass("error-brd");
					});										
				});				
			}
			
			else{
				alert("<?php echo Yii::t("app", "Some problem found while saving data !!");?>");
			}
		}
	});
	
    return false;
});

setup_actions();
</script>
<style>
    
   .error-brd{
	border-color:#F30 !important;
}
.errorMessage{ display:inline;}

.remove{ float:left
;}
    </style>
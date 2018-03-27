<?php
$this->breadcrumbs=array(
    Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Form Fields')=>array('list'),
	Yii::t('app','Arrange'),
);
?>
<style type="text/css">
.formCon input[type="text"] {
    background: #ffffff none repeat scroll 0 0;
    border: 1px solid #c2cfd8;
    border-radius: 2px;
    box-shadow: -1px 1px 2px #d5dbe0 inset;
    padding: 6px 3px;
    width: 175px !important;
}

</style>
<script src="<?php echo Yii::app()->baseUrl;?>/js/jquery-ui-1.11.4.js"></script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('/default/left_side');?>
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Arrange Form Fields');?></h1>
                
<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
 <li><?php echo CHtml::link('<span>'.Yii::t('app','Create Form Field').'</span>', array('/dynamicform/formFields/create'), array('class'=>'a_tag-btn')); ?></li>                                   
</ul>
</div> 
</div>
                
                <div>
                    <div class="formCon">
                        <div class="formConInner">
                            <h3><?php echo Yii::t("app", "Select a tab from below dropdown");?></h3>
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'method'=>'GET',
                                'action'=>Yii::app()->createUrl('/dynamicform/formFields/arrange'),
                            )); ?>
                                <table>
                                    <tr>
                                        <td width="50"><?php echo Yii::t('app', 'Tab');?></td>
                                        <td width="250"><?php echo CHtml::dropDownList('model', (isset($_GET['model']) and $_GET['model']!="")?$_GET['model']:'', FormFields::model()->itemAlias('tab_selection'), array('onchange'=>'js:this.form.submit();', 'prompt'=>Yii::t('app', 'Select a model')));?></td>
                                    </tr>
                                </table>
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>               
                </div>

                <div class="row">
                    <?php                    
                    if(isset($_GET['model']) and $_GET['model']!=""){
                        $sub_tabs= FormFields::model()->getSubsection($_GET['model']);
                        foreach($sub_tabs as $tab_key=>$tab){
                            ?>
                            <div class="formCon">
                                <div class="formConInner">
                                    <?php
                                    echo "<h3>".$tab."</h3>";
                                    $criteria   = new CDbCriteria;
                                    $criteria->compare("tab_selection", $_GET['model']);
                                    $criteria->compare("tab_sub_section", $tab_key);
                                    $criteria->compare("is_dynamic", 1);
                                    $criteria->compare("is_exception", 0);
                                    $criteria->order    = "`position` ASC";
                                    $fields     = FormFields::model()->findAll($criteria);

                                    $modelname  = FormFields::model()->getmodelname($_GET['model']);
                                    $model      = new $modelname;
                                    ?>
                                    <div class="form-fields">
                                        <?php
                                        foreach ($fields as $key => $field) {
                                            if($field->form_field_type!=NULL){
                                                $this->renderPartial("application.modules.dynamicform.views.fields.arrange._field_".$field->form_field_type, array('model'=>$model, 'field'=>$field));                                                
                                            }                                                
                                        }

                                        if(count($fields)==0){
                                        ?>
                                            <i>
                                                <?php echo Yii::t("app", "There is no additional fields in this section.");?>
                                                <?php echo CHtml::link(Yii::t("app", "Add now"), array("/dynamicform/formFields/create", "FormFields"=>array("tab_selection"=>$_GET['model'], "tab_sub_section"=>$tab_key)));?>
                                            </i>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>                                
                            <?php
                        }
                    }
                    ?>
                </div>
                <span><i><?php echo Yii::t("app", "* Drag and drop the fields to change the order.");?></i></span>
            </div>
        </td>
    </tr>
</table>

<script type="text/javascript">
$(".form-fields").sortable({
    update:function(event, ui){
        var fields  = [];
        ui.item.closest('.form-fields').find('.form-field').each(function(index, element){
            fields.push($(this).attr('data-field'));            
        });

        $.ajax({
            url:'<?php echo Yii::app()->createUrl("/dynamicform/formFields/arrange");?>',
            type:"POST",
            data:{fields:fields, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
            dataType:"json",
            success:function(response){
                if(response.status=="success"){
                    //code if needed
                }
                else{
                    alert("<?php echo Yii::t('app', 'There is some problem found while changing position');?>");
                }
            },
            error:function(){
                alert("<?php echo Yii::t('app', 'There is some problem found while changing position');?>");
            }
        });
    }
});
</script>
<div class="container">
    <div class="left_panel">
    	
        <div class="nav_sub">
            <h1>Conact</h1>
            <p>This is Contacts Manager... Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, </p>
            	<ul>
					<?php 
					if((Yii::app()->controller->id=='contact' and Yii::app()->controller->action->id=='emaillists' or Yii::app()->controller->action->id=='createlist' or Yii::app()->controller->action->id=='updatelist' or Yii::app()->controller->action->id=='viewlist') or Yii::app()->controller->id=='emailList' and (Yii::app()->controller->action->id=='emaillists' or Yii::app()->controller->action->id=='create' or Yii::app()->controller->action->id=='update'))
					{
					    echo '<li class="pageCrnt">'.CHtml::link('All Contact Lists<p style="font-size:11px; line-height:5px; color:#a8a8a8; font-weight:normal;">View all Contacts</p>', array('/contact/emaillists'),array('class'=>'ic017_active')).'</li>';
					}
					else
					{
					    echo '<li>'.CHtml::link('All Contact Lists<p style="font-size:11px; line-height:5px; color:#a8a8a8; font-weight:normal;">View all Business Campaigns</p>', array('/contact/emaillists'),array('class'=>'ic017')).'</li>';
					}?> 
                    
                	<?php
					if(Yii::app()->controller->id=='contact' and (Yii::app()->controller->action->id=='index') or (Yii::app()->controller->action->id=='view'))
					{
					    echo '<li class="pageCrnt">'.CHtml::link('All Contacts<p style="font-size:11px; line-height:5px; color:#a8a8a8; font-weight:normal;">View all contacts</p>', array('/contact/index'),array('class'=>'ic01_active')).'</li>';
					}
					else
					{
					    echo '<li>'.CHtml::link('All Contacts<p style="font-size:11px; line-height:5px; color:#a8a8a8; font-weight:normal;">View all contacts</p>', array('/contact/index'),array('class'=>'ic01')).'</li>';
					}?>                  
                    
                    <?php
					if((Yii::app()->controller->id=='contact' and Yii::app()->controller->action->id=='create' ))
					{
					    echo '<li class="pageCrnt">'.CHtml::link('New Contact<p style="font-size:11px; line-height:5px; color:#a8a8a8; font-weight:normal;">Add a New Contact</p>', array('/contact/create'),array('class'=>'ic02_active')).'</li>';
					}
					else
					{
					    echo '<li>'.CHtml::link('New Contact<p style="font-size:11px; line-height:5px; color:#a8a8a8; font-weight:normal;">Add a New Contact</p>', array('/contact/create'),array('class'=>'ic02')).'</li>';
					}
					?>
                    
                    <?php 
					if(@Yii::app()->controller->module->id=='importcsv')
					{
						echo '<li class="pageCrnt">'.CHtml::link('Import Contacts<p style="font-size:11px; line-height:5px; color:#a8a8a8; font-weight:normal;">Import your contacts</p>', array('/importcsv'),array('class'=>'ic01_active')).'</li>';
					}
					else
					{
						echo '<li>'.CHtml::link('Import Contacts<p style="font-size:11px; line-height:5px; color:#a8a8a8; font-weight:normal;">Import your contacts</p>', array('/importcsv'),array('class'=>'ic01')).'</li>';
					}
					?>
                </ul>
            </div>
           
    </div>
    <div class="right_panel">
		
<div class="contacts_Con">
<div class="ec_h">Import Contacts</div>
            <p style="font-size:14px;color:#999;padding-bottom:10px; margin:0px;">Manage your business profiles, reviews and track campaigns. </p>


	<?php
	
	var_dump($model);
	
	//echo $this->errorSummary($model);
	
/**
 * ImportCSV Module
 * module form
 */
$this->breadcrumbs=array(
	Yii::t('importcsvModule.importcsv', 'Import')." CSV",
);
?>

<div>
   <div class="c_formCon_lft"></div>
   <div class="c_formCon">
   <h2><?php echo Yii::t('importcsvModule.importcsv', 'Import'); ?> Google Contacts</h2>
   
   
   
  <?php /*?> <div style="padding:10px;">
       <table>
       		<tr>
            	<td colspan="2"><?php echo $total;?> contacts added from google</td>
	   		</tr>
            <tr>
                <td>Select Contact list:</td>
                <td>
                	<?php echo CHtml::dropDownList('',1,CHtml::listData(EmailList::model()->findAll(), 'id', 'list_name'));?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                	<?php echo CHtml::submitButton('Save',array('class'=>'formbut'));?>
                </td>
            </tr>
       </table>
   </div><?php */?>
</div>

   <div class="c_formCon_rht"></div>
</div>

</div>
</div>
</div>
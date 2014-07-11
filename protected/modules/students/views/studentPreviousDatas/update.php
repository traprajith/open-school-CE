<?php
$this->breadcrumbs=array(
	'Student Previous Datases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1>Edit Student Previous Datas</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
    </td>
  </tr>
</table>
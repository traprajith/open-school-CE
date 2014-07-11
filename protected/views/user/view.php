<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List User', 'url'=>array('index')),
	//array('label'=>'Create User', 'url'=>array('create')),
   // array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//configurations/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
	<h1>User Profile</h1>




<strong>Username:</strong> <?php echo $model->username; ?>
<br />
<strong>E-Mail:</strong> <?php echo $model->email; ?>



<?php 
$this->menu=array(
	
	//array('label'=>'Create User', 'url'=>array('create')),
   // array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

</div>
    </td>
  </tr>
</table>
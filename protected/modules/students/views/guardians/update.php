<?php
$this->breadcrumbs=array(
	'Guardians'=>array('index'),
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
                <h1>Update Guardian <?php echo $model->first_name; ?></h1>
                <div class="captionWrapper">
                    <ul>
                        <li><h2 >Student Details</h2></li>
                        <li><h2 class="cur">Parent Details</h2></li>
                        <li><h2>Emergency Contact</h2></li>
                        <li><h2>Previous Details</h2></li>
                        <li class="last"><h2>Student Profile</h2></li>
                    </ul>
				</div>
                <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
            </div>
        </td>
    </tr>
</table>
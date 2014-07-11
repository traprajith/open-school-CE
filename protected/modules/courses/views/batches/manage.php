<?php
$this->breadcrumbs=array(
	'Batches'=>array('/courses'),
	'Manage',
);
?>
<script language="javascript">
function getid()
{
var id= document.getElementById('drop').value;
window.location = "index.php?r=courses/batches/manage&id="+id;
}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/batches/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right">


                <div class="row">
                <?php
                 echo CHtml::dropDownList('mydropdownlist','mydropdownlist',
                      CHtml::listData(Courses::model()->findAll(),
                      'id', 'course_name'),array('onchange'=>'getid();','id'=>'drop','prompt'=>'Select Course'));
                 ?> 
                <?php // echo $searchForm->dropDownList($model, 'category_id', CHtml::listData(Category::model()->findAll(), 'id', 'name')); ?>
                </div>
                
                <?php
                if(isset($_REQUEST['id']))
                {
                $posts=Batches::model()->findAll("course_id=:x", array(':x'=>$_REQUEST['id']));
                ?>
                    <table>
                        <?php
                            foreach($posts as $posts_1)
                            {
                                echo '<tr><td>'.CHtml::link($posts_1->name, array('batchstudents', 'id'=>$posts_1->id)).'</td></tr>';
                            }
                            ?>
                    </table>
                <?php    	
                }
                ?>
</div>
    </td>
  </tr>
</table>

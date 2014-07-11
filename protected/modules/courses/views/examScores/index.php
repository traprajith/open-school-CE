<?php
$this->breadcrumbs=array(
	'Exam Scores',
);

$this->menu=array(
	array('label'=>'Create ExamScores', 'url'=>array('create')),
	array('label'=>'Manage ExamScores', 'url'=>array('admin')),
);
?>

<h1>Exam Scores</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

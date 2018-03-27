<style type="text/css">

.grid-view table.items{ background: none repeat scroll 0 0 #fafafa;
    border-collapse: collapse;
    border-left: 1px solid #d3dde6;
    border-top: 1px solid #d3dde6 ;
    margin-top: 10px;
    width: 100%;}
.grid-view table.items tr.odd{ background:none;}

.grid-view table.items th, .grid-view table.items td{border-bottom: 1px solid #d3dde6;
    border: 1px solid #d3dde6;
    font-size: 11px;
    padding: 8px 10px;
	text-align:center;}
	
	.contrht_bttns {
    margin: 0px;
    padding: 0px;
    position: absolute;
    top: 25px;
    right: 17px;
    border: #a0a0a0 0px solid;
}
</style>

<?php $this->breadcrumbs = array(
	//'Rights'=>Rights::getBaseUrl(),
	Yii::t('app', 'Create User'),
	Yii::t('app', 'Assignments'),
);?>

<?php 
	
	if($rolename=='student' or $rolename=='parent' or $rolename=='teacher')
		{
			$this->redirect(array('/user/admin'));
		}
		else
		{
	
	 ?>

<div id="userAssignments">	
	<div class="page-header">
        <h3><?php echo Yii::t('app', 'Assignments for :username', array(
            ':username'=>$model->getName()
        )); ?></h3>
        <div class="contrht_bttns">
            <ul>                            
                <li><?php echo CHtml::link('<span>'.Yii::t('app','Manage User').'</span>', array('/user/admin')); ?></li>                            
            </ul>                    
        </div>
    </div> 
    
	<div class="assignments span-12 first">
		
		<?php
		
		 $this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$dataProvider,
			'template'=>'{items}',
			'hideHeader'=>true,
			'emptyText'=>Yii::t('app', 'This user has not been assigned any items.'),
			'htmlOptions'=>array('class'=>'grid-view user-assignment-table mini','style'=>'font-weight: bold;'),
			'columns'=>array(
    			array(
    				'name'=>'name',
    				'header'=>Yii::t('app', 'Name'),
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'name-column'),
    				//'value'=>'$data->getNameText()',
    			),
    			array(
    				'name'=>'type',
    				'header'=>Yii::t('app', 'Type'),
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'type-column'),
    				'value'=>'$data->getTypeText()',
    			),
    			array(
    				'header'=>'&nbsp;',
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'actions-column'),
    				'value'=>'$data->getRevokeAssignmentLink()',
    			),
			)
		)); 
		
		
		?>

	</div>
<br /><br /> <?php if(sizeof($dataProvider->items)==0)
{;?>
	<div class="add-assignment span-11 last">

		<h3><?php echo Yii::t('app', 'Assign item'); ?></h3>

		<?php if( $formModel!==null ): ?>

			<div class="form">

				<?php $this->renderPartial('_form', array(
					'model'=>$formModel,
					'itemnameSelectOptions'=>$assignSelectOptions,
				)); ?>

			</div>

		<?php else: ?>

			<p class="info"><?php echo Yii::t('app', 'No assignments available to be assigned to this user.'); ?>

		<?php endif; ?>

	</div>
    <?php } ?>

</div>
 <?php } ?>
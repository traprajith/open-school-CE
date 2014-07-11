<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Messages:sent"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Sent"),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_styles') ?>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_flash') ?>

<div class="row">

	<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>
	<div class="span13">
	<h2><?php echo MessageModule::t('Sent'); ?></h2>

		<?php if ($messagesAdapter->data): ?>
			<?php $form = $this->beginWidget('CActiveForm', array(
				'id'=>'message-delete-form',
				'enableAjaxValidation'=>false,
				'action' => $this->createUrl('delete/')
			)); ?>

			<table class="bordered-table zebra-striped">
				<tr>
					<th  class="from-to">To</th>
					<th>Subject</th>
					<th>Date</th>
				</tr>
				<?php foreach ($messagesAdapter->data as $index => $message): ?>
					<tr>
						<td>
							<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
							<?php echo $form->hiddenField($message,"[$index]id"); ?>
							<?php echo $message->getReceiverName() ?>
						</td>
						<td><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
						<td><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
					</tr>
				<?php endforeach ?>
			</table>

			<div>
				<button class="btn danger"><?php echo MessageModule::t("Delete Selected") ?></button>
			</div>

			<?php $this->endWidget(); ?>

			<div class="pagination">
				<?php $this->widget('CLinkPager', array('header' => '', 'pages' => $messagesAdapter->getPagination(), 'htmlOptions' => array('class' => 'pager'))) ?>
			</div>
		<?php endif; ?>
	</div>
</div>

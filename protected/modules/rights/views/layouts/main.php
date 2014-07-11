<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rights_style.css" />

<?php $this->beginContent(Rights::module()->appLayout); ?>

		<?php if( $this->id!=='install' ): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
				<?php $this->renderPartial('/_menu'); ?>

	</td>
    <td valign="top">
    <div class="rights_right rights_formWrapper">

		<?php endif; ?>

		<?php $this->renderPartial('/_flash'); ?>

		<?php echo $content; ?>

	</div>
   </td>
   </tr>
   </table>

<?php $this->endContent(); ?>

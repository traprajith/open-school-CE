<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td></tr></table>
<!--<h1>--><?php //echo $this->uniqueId . '/' . $this->action->id; ?><!--</h1>

<p>
This is the view content for action "--><?php // echo $this->action->id; ?><!--".
The action belongs to the controller "--><?php //echo get_class($this); ?><!--"
in the "--><?php //echo $this->module->id; ?><!--" module.
</p>
<p>
You may customize this page by editing <tt>--><?php //echo __FILE__; ?><!--</tt>
</p>-->
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Easy Menu Manager</title>
<meta charset="utf-8">

<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/menu/style.css">
<!--[if lte IE 8]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/menu/html5.js"></script>
<![endif]-->
<script>
var _BASE_URL = '<?php echo Yii::app()->request->baseUrl; ?>';
var current_group_id = <?php //echo $group_id; ?> 1;
</script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/menu/jquery.1.4.1.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/menu/interface-1.2.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/menu/inestedsortable.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/menu/menu.js"></script>

</head>
<body>
	<section>
		<article>
			<section>
				<ul id="menu-group">
                <?php $menu_groupss = MenuGroup::model()->findAll(); ?>
					<?php foreach ($menu_groupss as $menu_group) : ?>
					<li id="group-<?php echo $menu_group->id; ?>">
						<a href="<?php echo 'site' ?>">
							<?php echo $menu_group->title; ?>
						</a>
					</li>
					<?php endforeach; ?>
					<li id="add-group"><a href="<?php echo Menu::model()->site_url('menu_group.add'); ?>" title="Add Menu Group">+</a></li>
				</ul>
				<div class="clear"></div>

				<form method="post" id="form-menu" action="<?php echo Menu::model()->site_url('menu.save_position'); ?>">
					<div class="ns-row" id="ns-header">
						<div class="ns-actions">Actions</div>
						<div class="ns-class">Class</div>
						<div class="ns-url">URL</div>
						<div class="ns-title">Title</div>
					</div>
					<?php echo $menu_ul; ?>
					<div id="ns-footer">
						<button type="submit" class="button green small" id="btn-save-menu">Update Menu</button>
					</div>
				</form>
			</section>
			<aside>
				<div class="box info">
					<h2>Info</h2>
					<section>
						<p>Drag the menu list to re-order, and click <b>Update Menu</b> to save the position.</p>
						<p>To add a menu, use the <b>Add Menu</b> form below.</p>
					</section>
				</div>
				<div class="box">
					<h2>Current Menu Group</h2>
					<section>
						<span id="edit-group-input"><?php echo $group_title; ?></span>
						(ID: <b><?php echo $group_id; ?></b>)
						<div>
							<a id="edit-group" href="#">Edit</a>
							<?php if ($group_id > 1) : ?>
							&middot; <a id="delete-group" href="#">Delete</a>
							<?php endif; ?>
						</div>
					</section>
				</div>
				<div class="box">
					<h2>Add Menu</h2>
					<section>
                    <?php $form=$this->beginWidget('CActiveForm',array('method'=>'post','action'=>$this->createUrl('Students/add'))); ?>
						<!--<form id="form-add-menu" method="post">-->
							<p>
								<label for="menu-title">Title</label>
								<input type="text" name="title" id="menu-title">
							</p>
							<p>
								<label for="menu-url">URL</label>
								<input type="text" name="url" id="menu-url">
							</p>
							<p>
								<label for="menu-class">Class</label>
								<input type="text" name="class" id="menu-class">
							</p>
							<p class="buttons">
								<input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                               <?php echo CHtml::button('save');
                                  ?>
								<button id="add-menu" type="submit" class="button green small">Add Menu</button>
                                <input type="submit" value="search" />
							</p>
						<!--</form>-->
                        <?php $this->endWidget(); ?>
					</section>
				</div>
			</aside>
			<div class="clear"></div>
		</article>
		<footer>
			Easy Menu Manager
		</footer>
	</section>
	<div id="loading">
		<img src="<?php //echo _BASE_URL; ?>templates/images/ajax-loader.gif" alt="Loading">
		Processing...
	</div>
</body>
</html>
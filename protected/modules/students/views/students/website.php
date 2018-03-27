<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php echo Yii::t('app','Easy Menu Manager'); ?></title>
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
						<div class="ns-actions"><?php echo Yii::t('app','Actions'); ?></div>
						<div class="ns-class"><?php echo Yii::t('app','Class'); ?></div>
						<div class="ns-url"><?php echo Yii::t('app','URL'); ?></div>
						<div class="ns-title"><?php echo Yii::t('app','Title'); ?></div>
					</div>
					<?php echo $menu_ul; ?>
					<div id="ns-footer">
						<button type="submit" class="button green small" id="btn-save-menu"><?php echo Yii::t('app','Update Menu'); ?></button>
					</div>
				</form>
			</section>
			<aside>
				<div class="box info">
					<h2><?php echo Yii::t('app','Info'); ?></h2>
					<section>
						<p><?php echo Yii::t('app','Drag the menu list to re-order, and click'); ?> <b><?php echo Yii::t('app','Update Menu'); ?></b> <?php echo Yii::t('app','to save the position.'); ?></p>
						<p><?php echo Yii::t('app','To add a menu, use the'); ?> <b><?php echo Yii::t('app','Add Menu'); ?></b> <?php echo Yii::t('app','form below.'); ?></p>
					</section>
				</div>
				<div class="box">
					<h2><?php echo Yii::t('app','Current Menu Group'); ?></h2>
					<section>
						<span id="edit-group-input"><?php echo $group_title; ?></span>
						(ID: <b><?php echo $group_id; ?></b>)
						<div>
							<a id="edit-group" href="#"><?php echo Yii::t('app','Edit'); ?></a>
							<?php if ($group_id > 1) : ?>
							&middot; <a id="delete-group" href="#"><?php echo Yii::t('app','Delete'); ?></a>
							<?php endif; ?>
						</div>
					</section>
				</div>
				<div class="box">
					<h2><?php echo Yii::t('app','Add Menu'); ?></h2>
					<section>
                    <?php $form=$this->beginWidget('CActiveForm',array('method'=>'post','action'=>$this->createUrl('Students/add'))); ?>
						<!--<form id="form-add-menu" method="post">-->
							<p>
								<label for="menu-title"><?php echo Yii::t('app','Title'); ?></label>
								<input type="text" name="title" id="menu-title">
							</p>
							<p>
								<label for="menu-url"><?php echo Yii::t('app','URL'); ?></label>
								<input type="text" name="url" id="menu-url">
							</p>
							<p>
								<label for="menu-class"><?php echo Yii::t('app','Class'); ?></label>
								<input type="text" name="class" id="menu-class">
							</p>
							<p class="buttons">
								<input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                               <?php echo CHtml::button('save');
                                  ?>
								<button id="add-menu" type="submit" class="button green small"><?php echo Yii::t('app','Add Menu'); ?></button>
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
			<?php echo Yii::t('app','Easy Menu Manager'); ?>
		</footer>
	</section>
	<div id="loading">
		<img src="<?php //echo _BASE_URL; ?>templates/images/ajax-loader.gif" alt="Loading">
		<?php echo Yii::t('app','Processing...'); ?>
	</div>
</body>
</html>
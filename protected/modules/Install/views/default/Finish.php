<?php $this->pageTitle = Yii::app()->name.' - Congratulations, you made it!';?>
<h1>Congratulations, you made it!</h1>
<p class="emphasize"><?php echo Yii::app()->params['app_name'].' '.Yii::app()->params['version']; ?> has been installed successfully.</p>
<div class="form">
    <h3></h3>
    <div class="content">
    <fieldset>
    <div class="input">
        <label>Username</label><strong><?php if (Yii::app()->session->contains('aemail')) echo Yii::app()->session['aemail'];?></strong>
    </div>
    <div class="input">
        <label>Password</label><strong><?php if (Yii::app()->session->contains('password')) echo Yii::app()->session['password'];?></strong>
        <?php         
		Yii::app()->session->remove('email');
		Yii::app()->session->remove('aemail');
        Yii::app()->session->remove('password');
	    Yii::app()->session->remove('key');
		?>
        <div class="note">Please make note of the Username and random password to login.</div>
    </div>
    <div class="input" align="center">
        <?php if ($htaccessUpdated === false):?>
        <strong style="color: red"><?php echo Yii::app()->params['app_name'].' '.Yii::app()->params['version']; ?> uses SEO friendly URLs, you need to upload this file as <?php echo CHtml::link('.htaccess', array('default/htaccess'));?> to the <?php echo Yii::getPathOfAlias('webroot');?> folder.</strong><br/>
        <?php endif;?>
        <a target="_blank" href="<?php echo Yii::app()->Request->getBaseUrl(true); ?>">Get started <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/ext-link.png" /></a>
	</div>
    </fieldset>
    </div>
</div>
<?php $this->pageTitle = Yii::app()->name.' - Congratulation, you made it!';?>
<h1>Congratulation, you made it!</h1>
<p class="emphasize">openschool has been installed. It is important that you rename or remove <?php echo Yii::getPathOfAlias('application.modules.Install');?> folder to avoid other to run the installation again and delete your database.</p>
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
        <div class="note">Note that Username and Password carefully! It is a random password that was generated just for you.</div>
    </div>
    <div class="input" align="center">
        <?php if ($htaccessUpdated === false):?>
        <strong style="color: red">openschool uses SEO friendly URLs, you need to upload this file as <?php echo CHtml::link('.htaccess', array('default/htaccess'));?> to <?php echo Yii::getPathOfAlias('webroot');?> folder.</strong><br/>
        <?php endif;?>
        <a target="_blank" href="<?php echo Yii::app()->Request->getBaseUrl(true); ?>">Go to Site <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/ext-link.png" /></a>
	</div>
    </fieldset>
    </div>
</div>
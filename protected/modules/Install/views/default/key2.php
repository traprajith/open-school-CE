<style>
#email {
    margin-top: 10px;
    font-size: 12px;
    color: #333 !important;
    font-weight: lighter !important;
    border: 1px #e5e5e5 solid;
    padding: 4px 10px;
    outline: none;
}
</style>
<?php echo CHtml::beginForm(); ?>
        <fieldset>
        <h2><?php echo Yii::app()->params['app_name']; ?> Setup</h2>
		<div>
            <p>LICENSE KEY<br/>
            <input type="text" name="serial" style="height:30px;font-size:16px;font-weight:bold;color:#060;" size="24" maxlength="24" required="required" /><br/></p>
            <input type="hidden" name="email" value=<?php echo $_POST['email'] ?> />
            <input type="submit" style="border: none; color: #000; margin-top: 10px;letter-spacing:2px;" value="START" class="button" />
            <br/><br/>
            <span style="font-size:11px;color:#999;font-style:italic;">Start the installation process</span>
        </div>
        </fieldset>
<?php echo CHtml::endForm(); ?>

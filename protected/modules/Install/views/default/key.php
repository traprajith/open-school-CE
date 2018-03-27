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
        <?php
		if  (in_array  ('curl', get_loaded_extensions())) {
	    ?>
		<div>
            <p>First name <br/>
            <input type="text" name="fname" style="height:30px;font-size:16px;font-weight:bold;color:#060;" size="24" maxlength="24" required="required" /><br/></p>
            <br/><p>Last name <br/>
            <input type="text" name="lname" style="height:30px;font-size:16px;font-weight:bold;color:#060;" size="24" maxlength="24" required="required" /><br/></p>
            <br/> <p>E-mail:<br/>
            <input type="text" id="email" name="email" style="height:30px;font-size:16px;font-weight:bold;color:#060;" size="24" maxlength="50" required="required" pattern="([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)" title="Should be a valid email address" /><br/></p>
            <h2 id='result' style="font-size:12px"></h2>
            <input type="submit"  style="border: none; color: #000; margin-top: 10px;letter-spacing:2px;" value="GET KEY" class="button" /><br/><br/>
            <span style="font-size:11px;color:#999;font-style:italic;">A license key will be sent to your mail. You may use it to install the application.</span>
        </div>
	    <?php }else{ ?>
		  Installation Error <br/>
          Please Enable Curl For Continuing <?php echo Yii::app()->params['app_name']; ?> Installation <br/>
          
           Tips: <br/>
          
            1) Navigate to path\to\php\(your version of php)\<br />
            2) edit php.ini<br />
            3) Search for curl, uncomment extension=php_curl.dll<br />
            4) Navigate to path\to\apache\(your version of apache)\bin\<br />
            5) edit php.ini<br />
            6) Search for curl, uncomment extension=php_curl.dll<br />
            7) Save both<br />
            8) Restart Apache<br/>
            
            <input type="button" value="I have Enabled Curl Extension" onClick="window.location.reload()">
<?php } ?>
        </fieldset>
<?php echo CHtml::endForm(); ?>

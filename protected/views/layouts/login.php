<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>	    
	<?php 
        
        $this->renderPartial('/layouts/header'); 
        
        ?>
</head>
<body>
<div class="container" id="page">
	<div id="header-login" style="margin:0 auto; text-align: center" >		
		<div style="padding-top:60px">
		<img src="/images/logo.png" />
		</div>
	</div>
	<div id="site-content" style="margin:0 auto; width:400px; border-top:0px">
            	<?php echo $content; ?>		
	</div>

</div><!-- page -->
 
</body>
</html>
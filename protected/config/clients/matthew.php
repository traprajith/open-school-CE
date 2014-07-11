<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/../main.php'),
    array(
        'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=os_new',
			//'connectionString' => 'mysql:host=localhost;dbname=os_school',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			//'tablePrefix' => 'blog_',
		   ),
        ),
    )
);
?>
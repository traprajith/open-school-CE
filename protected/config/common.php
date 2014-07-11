<?php
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require_once(dirname(__FILE__).'/environment.php');
return CMap::mergeArray(require(dirname(__FILE__).'/main.php'));

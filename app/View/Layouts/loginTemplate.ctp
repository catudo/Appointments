<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin Panel</title>

	<?php echo $this->Html->css('style'); ?>
<!--[if lte IE 6]>
   <script type="text/javascript" src="js/pngfix/supersleight-min.js"></script>
<![endif]-->

<style type="text/css">
#content {width:938px;}
#login {width:300px;margin:0 auto;padding:20px;background:#f6f6f6;border:1px solid #ccc; -webkit-box-shadow: #fff 0px 4px 15px;
	        -moz-box-shadow: #fff 0px 4px 15px; box-shadow: #fff 0px 4px 15px; behavior: url(css/PIE.htc);}
.btn,.input {margin:8px;}
</style>
</head>
<body>

   <div id="container" class="round10">
      <div class="clear">&nbsp;</div>
      <div id="content" class="left round10">
      	<?php echo $this->fetch('content'); ?>
      </div>
      <div class="clear">&nbsp;</div>
      
   </div>

</body>
</html>

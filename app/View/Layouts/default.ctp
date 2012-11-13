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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<?php echo $this->Html->charset(); ?>
	<title>
	Appointments
	</title>
	<?php
	echo $this->Html->css('transdmin.css');
		echo $this->Html->meta('icon');
		echo $this->Html->css('pepper-grinder/jquery-ui-1.9.1.custom.css');
			echo $this->Html->script('jquery/js/jquery-1.7.2.min.js');
			echo $this->Html->script('jquery/js/jquery-ui-1.8.21.custom.min.js');
			echo $this->Html->script('jquery-validation/jquery.validate.min.js');
			echo $this->Html->script('style/jNice.js');
			echo $this->Html->script('appointments.general.js');
			echo $this->Html->script('datatables/media/js/jquery.dataTables.js');
			echo $this->Html->script('libraries/fillthis.jquery.js');
					echo $this->Html->script('i18n/messages.en');
	?>


</head>

<body>
	<div style="display:none" id="errorsDiv">
		<div id='messageDiv'>
			
		</div>
		
	</div>
	
	
	<div id="wrapper">
    	<!-- h1 tag stays for the logo, you can use the a tag for linking the index page -->
    	<h1><a href="#"><span>Appointments</span></a></h1>
        
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
                	<ul class="sideNav">
                		<li><a href="<?php echo $this->webroot;?>/Users/index">Patiens</a></li>
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2><a href="#"> <?php if(isset($title)) echo $title;  ?> </h2>
                
                <div id="main">
                	
							<?php echo $this->fetch('content'); ?>
                    
                </div>
                <!-- // #main -->
                
                <div class="clear"></div>
            </div>
            <!-- // #container -->
        </div>	
        <!-- // #containerHolder -->
        
        <p id="footer">Appointments</p>
    </div>
    <!-- // #wrapper -->
</body>
</html>








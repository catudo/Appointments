
<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title>Free HTML5 Bootstrap Admin Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">

	<!-- The styles -->
	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
			<?php

		echo $this -> Html -> css('bootstrap-cerulean.css');
		echo $this -> Html -> css('bootstrap-responsive.css');
		echo $this -> Html -> css('charisma-app.css');
		echo $this -> Html -> css('fullcalendar.css');
		echo $this -> Html -> css('fullcalendar.print.css');
		echo $this -> Html -> css('chosen.css');
		echo $this -> Html -> css('uniform.default.css');
		echo $this -> Html -> css('colorbox.css');
		echo $this -> Html -> css('jquery.cleditor.css');
		echo $this -> Html -> css('jquery.noty.css');
		echo $this -> Html -> css('noty_theme_default.css');
		echo $this -> Html -> css('elfinder.min.css');
		echo $this -> Html -> css('elfinder.theme.css');
		echo $this -> Html -> css('jquery.iphone.toggle.css');
		echo $this -> Html -> css('opa-icons.css');
		echo $this -> Html -> css('uploadify.css');

		echo $this -> Html -> meta('icon');
		echo $this -> Html -> css('pepper-grinder/jquery-ui-1.9.1.custom.css');
		echo $this -> Html -> script('jquery/js/jquery-1.7.2.min.js');
		echo $this -> Html -> script('jquery/js/jquery-ui-1.8.21.custom.min.js');
		echo $this -> Html -> script('jquery-validation/jquery.validate.min.js');

		echo $this -> Html -> script('appointments.general.js');
		echo $this -> Html -> script('datatables/media/js/jquery.dataTables.js');
		echo $this -> Html -> script('libraries/fillthis.jquery.js');
		echo $this -> Html -> script('i18n/messages.en');
		?>


	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>

<body>
		<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Welcome</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
				<?php echo $this->fetch('content'); ?>
			</div><!--/row-->
				</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->

</body>
</html>





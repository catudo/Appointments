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

		<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- The fav icon -->
		<link rel="shortcut icon" href="img/favicon.ico">

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

	</head>

	<body>

		<div style="display:none" id="errorsDiv">
			<div id='messageDiv'>

			</div>

		</div>
		<!-- topbar starts -->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
					<a class="brand" href="index.html"> <span>Sisben</span></a>
					<!-- user dropdown starts -->

				</div>
			</div>
		</div>
		<!-- topbar ends -->
		<div class="container-fluid">
			<div class="row-fluid">

				<!-- left menu starts -->
				<div class="span2 main-menu-span">
					<div class="well nav-collapse sidebar-nav">
						<ul class="nav nav-tabs nav-stacked main-menu">
							<li class="nav-header hidden-tablet">
								Main
							</li>

							<?php echo $this -> element('User/dashboard', array("group" => $group)); ?>

						</ul>

					</div><!--/.well -->
				</div><!--/span-->
				<!-- left menu ends -->

				<noscript>
					<div class="alert alert-block span10">
						<h4 class="alert-heading">Warning!</h4>
						<p>
							You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.
						</p>
					</div>
				</noscript>

				<div id="content" class="span10">
					<!-- content starts -->

					<div class="row-fluid">
						<div class="box span12">
							<div class="box-header well">
								<h2><i class="icon-info-sign"></i> Introduction</h2>

							</div>
							<div class="box-content">
								<?php echo $this -> fetch('content'); ?>
							</div>
						</div>
					</div>

					<!-- content ends -->
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->

		</div><!--/.fluid-container-->

	</body>
</html>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>
		BoostCake -
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- urlが示すcssを利用 -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

	<style>
	body {
		padding-top: 70px; /* 70px to make the container go all the way to the bottom of the topbar */
		margin:0;
		padding:0;
		/*background-color:#dcdcdc;*/
		background: #ffffff url('http://www.unsigneddesign.com/Grunge_Pattern_Textures/pattern1.jpg');
	  	/*overflow: hidden;*/
		/*min-width: 10px;*/
		font-size: 30px;
		color: black;
	}
	.affix {
		position: fixed;
		top: 60px;
		width: 220px;
	}
	</style>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>

<body>
	<div class="container">
		<?php echo $this->Session->flash(); ?>
		

		<div class="row">
	        <div class="col-sm-9" >
				<?php echo $this->fetch('content'); ?>
	        </div>
			<div class="col-sm-3">
				<?php echo $this->fetch('right_sidebar'); ?>
	        </div>
	    </div>

	</div><!-- /container -->

	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="//google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
	<?php echo $this->fetch('script'); ?>

</body>
</html>

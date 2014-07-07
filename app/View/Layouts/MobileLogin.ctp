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
	<meta name="apple-mobile-web-app-capable" content="yes"><!-- モバイルのために追加 -->
  	<meta name="apple-mobile-web-app-status-bar-style" content="black"><!-- モバイルのために追加 -->
	
	<!-- モバイルのために追加 -->
	<link rel="stylesheet" href="https://d10ajoocuyu32n.cloudfront.net/mobile/1.3.1/jquery.mobile-1.3.1.min.css">
  
  	<!-- Extra Codiqa features --><!-- モバイルのために追加 -->
	<link rel="stylesheet" href="codiqa.ext.css">

	<!-- jQuery and jQuery Mobile --><!-- モバイルのために追加 -->
	<script src="https://d10ajoocuyu32n.cloudfront.net/jquery-1.9.1.min.js"></script>

	<!-- Ajaxに遷移しないようにするために、初期値を設定 --><!-- モバイルのために追加 -->
	<script>
		$(document).bind("mobileinit", function(){
			$.mobile.ajaxEnabled = false;
		});
	</script>

	<!-- モバイルのために追加 -->
	<script src="https://d10ajoocuyu32n.cloudfront.net/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

	<!-- Extra Codiqa features --><!-- モバイルのために追加 -->
	<script src="https://d10ajoocuyu32n.cloudfront.net/codiqa.ext.js"></script>

	<style>
	body {
		padding-top: 70px; /* 70px to make the container go all the way to the bottom of the topbar */
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

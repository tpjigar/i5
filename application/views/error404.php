<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class=""><!--<![endif]-->

<head>
	<meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Net Biz</title>

	<!-- head CSS -->	
	<?php include 'frontend/head_css.php';?>
	<!-- head CSS /- -->

</head>

<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">
	
   <!-- Header -->	
	<?php include_once 'frontend/header.php';?>
	<!-- Header /- -->
	<!-- page -->
	<div class="container-fulid no-padding error-page">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-12 error-num animated fadeInLeft">
					<p><span>4</span><span class="error-percentage">%</span><span>4</span></p>
				</div>
				<div class="col-md-5 col-sm-12 error-content animated fadeInRight">
					<h3><span> Sorry,</span> The Page Could Not be Found</h3>
					<p></p>
					<a href="<?php echo base_url(); ?>" title="Back To Home">Back To Home</a>
					<!-- <a href="#" title="Previous Page">Previous Page</a> -->
				</div>
			</div>
		</div>
	</div>
	<?php //include $page_name.'.php'; ?>
	<!-- pages / -->


	<!-- Counter Section -->
	<?php //include_once 'counter.php';?>
	<!-- Counter Section /- -->

	<!-- Footer Main -->
	<?php include_once 'frontend/footer.php';?>
	<!-- Footer /- -->
	
	<!--Fancybox-js-css
	======================================================-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/css/jquery.fancybox.css" />
	
</body>

</html>
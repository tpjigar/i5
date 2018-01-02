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
	<?php include_once 'head_css.php';?>
	<!-- head CSS /- -->

</head>

<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">
	<!-- LOADER -->
	<!-- <div id="site-loader" class="load-complete">
		<div class="loader">
			<div class="loader-inner ball-triangle-path">
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	</div> -->
	<!-- Loader /- -->
	
    
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Modal Header</h4>
	      </div>
	      <div class="modal-body">
	        <p>What is Your Location?</p>
	        <select class="form-control">
	        	<option>Dubai</option>
	        	<option>US</option>
	            <option>London</option>
	        	<option>India</option>
	            <option>Mumbai</option>
	        	<option>LA</option>
	        </select>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Save</button>
	      </div>
	    </div>

	  </div>
	</div>


	<!-- Header -->	
	<?php include_once 'header.php';?>
	<!-- Header /- -->
	<!-- page -->
	<div class="section-padding"></div>
	<?php include $page_name.'.php'; ?>
	<!-- pages / -->


	<!-- Counter Section -->
	<?php include_once 'counter.php';?>
	<!-- Counter Section /- -->

	<!-- Footer Main -->
	<?php include_once 'footer.php';?>
	<!-- Footer /- -->
	
	<!--Fancybox-js-css
	======================================================-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/css/jquery.fancybox.css" />
	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
		});
	</script>
    
    
	<script>
	// $(window).load(function(){        
	//    $('#myModal').modal('show');
	//     }); 
	</script>
</body>

</html>
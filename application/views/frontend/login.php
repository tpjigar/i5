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
	<title>Net Biz </title>

	<!-- head CSS -->	
	<?php include_once 'head_css.php'; ?>
	<!-- head CSS /- -->

</head>

<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">
	
	<!-- Header -->	
	<?php include_once 'header.php';?>
	<!-- Header /- -->
	<!-- page -->
	<div class="section-padding"></div>
	<!-- <div class="section-header">
				<h3>Login || Register</h3>
				<p>Want more?Start by Exploring the categories</p>
			</div> -->

	<div class="container featuredsignup">
		<div class="section-padding"></div>
			<div class="row">
				<div class="col-md-6 animated fadeInLeft">
					<div class="featured-section">
						<div class="section-header">
							<h3>Login with your creditional</h3>
							<!-- <p>Today's hot deals handpicked by our Team up!</p> -->
						</div>
						<div class="login-page">

				<?php echo form_open(site_url("login/pro")) ?>
    			<div class="input-group">
      				<span class="input-group-addon white-form-bg"><span class="glyphicon glyphicon-user"></span></span>
      				<input type="text" name="email" class="form-control" placeholder="<?php echo translate('email') ?>">
    			</div><br />

    			<div class="input-group">
      				<span class="input-group-addon white-form-bg"><span class="glyphicon glyphicon-lock"></span></span>
      				<input type="password" name="pass" class="form-control" placeholder="<?php echo translate("password") ?>">
    			</div>
          <p class="decent-margin"><input type="submit" class="btn btn-primary form-control" value="<?php echo translate("login") ?>"></p>
          <p class="decent-margin"><a href="<?php echo site_url("login/forgotpw") ?>"><?php echo translate("forgot_password ?") ?></a></p>

          <?php //if(!$this->settings->info->disable_social_login) : ?>
          <!-- <div class="text-center decent-margin-top">
          <div class="btn-group">
            <a href="<?php echo site_url("login/twitter_login") ?>" class="btn btn-default" >
              <img src="<?php echo base_url().'assets/'; ?>images/social/twitter.png" height="20" class='social-icon' style='padding-right: 10px; border-right: 1px solid #EEE;margin-right: 5px; height: 20px;' />
             Twitter</a>
          </div>

          <div class="btn-group">
            <a href="<?php echo site_url("login/facebook_login") ?>" class="btn btn-default" >
              <img src="<?php echo base_url().'assets/'; ?>images/social/facebook.png" height="20" class='social-icon' style='padding-right: 10px; border-right: 1px solid #EEE;margin-right: 5px; height: 20px;' />
             Facebook</a>
          </div>

          <div class="btn-group">
            <a href="<?php echo site_url("login/google_login") ?>" class="btn btn-default" >
              <img src="<?php echo base_url().'assets/'; ?>images/social/google.png" height="20" class='social-icon' style='padding-right: 10px; border-right: 1px solid #EEE;margin-right: 5px; height: 20px;' />
             Google</a>
          </div>
          </div> -->
        <?php //endif; ?>
          <hr> 
          <!-- <p class="decent-margin"><a href="<?php echo site_url("register") ?>" class="btn btn-success form-control" ><?php echo translate("register") ?></a></p>-->
    			<?php echo form_close() ?> 

		</div>

						<!-- <form class="signupform">
							<div class="row">
								
								<div class="col-md-8 col-sm-8 col-xs-6 animated fadeInLeft">
									<div class="form-group">
										<input class="form-control" id="input_unm" placeholder="Username / Email Address" type="text">
									</div>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-6">
									<div class="form-group">
										<input class="form-control" id="input_pwd" placeholder="Password" type="password">
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-6">
									<div class="form-group">
										<input value="Log In!" id="btn_submit" title="LogIn" type="submit">
									</div>
								</div>
							</div>
						</form> -->

					</div>
				</div>
				<div class="col-md-6 animated fadeInRight">
					<div class="featured-section">
						<div class="section-header">
							<h3>Register with your details</h3>
							<!-- <p>Today's hot deals handpicked by our Team up!</p> -->
						</div>
						<form class="signupform">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-6">
									<div class="form-group">
										<input required="" class="form-control" id="input_name" placeholder="Your Full NAme*" type="text">
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-6">
									<div class="form-group">
										<input required="" class="form-control" id="input_email" placeholder="Email Address*" type="email">
									</div>
								</div>
								<div class="col-md-7 col-sm-7 col-xs-6 animated fadeInLeft">
									<div class="form-group">
										<input class="form-control" id="input_unm" placeholder="Select Your User Name" type="text">
									</div>
								</div>
								<div class="col-md-5 col-xs-6 animated fadeInRight">
									<a href="#" title="Check Availability">Check Availability</a>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-6">
									<div class="form-group">
										<input class="form-control" id="input_pwd" placeholder="Password" type="password">
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-6">
									<div class="form-group">
										<input class="form-control" id="input_cfmpwd" placeholder="Confirm Password" type="password">
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-6">
									<div class="form-group">
										<input value="Sign Up!" id="btn_submit" title="SignUp" type="submit">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		<div class="section-padding"></div>
	</div>
	<!-- <?php //include $page_name.'.php'; ?> -->
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
	
</body>

</html>
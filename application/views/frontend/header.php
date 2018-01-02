	<header class="header-main container-fluid no-padding" style="background-color: #333;">
		<div class="menu-block">
			<div class="menu-left-bg"><a href="<?php echo base_url(); ?>" class="navbar-brand"><img src="<?php echo base_url();?>assets/frontend/images/logo-big.png" alt="logo" /></a></div>
			<div class="container">
				<!-- Navigation -->
				<nav class="navbar ow-navigation">
					<div class="col-md-3 no-padding">
						<div class="navbar-header">
							<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							
							<a href="index-2.html" class="mobile-logo" title="Logo"><h3>Net Biz</h3></a>
						</div>
					</div>
					<div class="col-md-9 menuinner no-padding">
						<div class="navbar-collapse collapse" id="navbar">
							<ul class="nav navbar-nav menubar">
								<li <?php if($page_name =='home') echo 'class="active"'; ?> ><a title="Home" href="<?php echo base_url(); ?>">Home</a></li>
								<li><a title="Voucher" href="#">Voucher</a></li>
								<li><a title="Brands" href="#">Brands</a></li>
								<li class="dropdown">
									<a aria-expanded="false" aria-haspopup="true" role="button" class="dropdown-toggle" title="Pages" href="#">About Us</a>
									<i class="ddl-switch fa fa-angle-down"></i>
									<ul class="dropdown-menu">
										<li><a title="Register" href="#">Register</a></li>
										<li><a title="Categories" href="#">Coupons</a></li>
										<li><a title="404" href="#">404</a></li>
									</ul>
								</li>
								<li><a title="Contact Us" href="#">Contact Us</a></li>
							</ul>
							
				              
						</div>
					</div>
				</nav><!-- Navigation /- -->
				<div class="user-cart">
					<a class="disqus" href="<?php echo base_url()."user/loginPage"; ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
					<a class="disqus" data-toggle="modal" href="#loginModal"><i class="fa fa-user" aria-hidden="true"></i></a>
                    
            		<a href="#" title="Your Cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            		<a href="<?php echo base_url()."login/userlogout/".$this->security->get_csrf_hash(); ?>" title="Logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
			</div>
		</div>
	</header>


<style type="text/css">
	.wrapper {    
	margin-top: 80px;
	margin-bottom: 20px;
}

.form-signin {
  max-width: 420px;
  padding: 30px 38px 66px;
  margin: 0 auto;
  background-color: #eee;
  border: 3px dotted rgba(0,0,0,0.1);  
  }

.form-signin-heading {
  text-align:center;
  margin-bottom: 30px;
}

.form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
}

input[type="text"] {
  margin-bottom: 0px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

input[type="password"] {
  margin-bottom: 20px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.colorgraph {
  height: 7px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}
</style>

		<div class="modal" id="loginModal">
          
          <div class="modal-body">
            	<div class="wrapper">
					<form action="" method="post" name="Login_Form" class="form-signin">       
					    <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
						  <hr class="colorgraph"><br>
						  
						  <input type="text" class="form-control" name="Username" placeholder="Username" required="" autofocus="" />
						  <input type="password" class="form-control" name="Password" placeholder="Password" required=""/>     		  
						 
						  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>  			
					</form>			
				</div>

          </div>
          
        </div>


	

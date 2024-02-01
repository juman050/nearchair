<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="description" content="Near Chair Landing Page"/>
    <meta name="keywords" content="Hair and beauty solution" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- TITLE OF SITE -->
    <title><?php echo $pageTitle; ?></title>
	
	<!-- =========================
      FAV AND TOUCH ICONS  
    ============================== -->
    <link rel="icon" href="<?php echo base_url(); ?>resource/landingPage/<?php echo base_url(); ?>resource/landingPage/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>resource/landingPage/<?php echo base_url(); ?>resource/landingPage/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>resource/landingPage/<?php echo base_url(); ?>resource/landingPage/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>resource/landingPage/<?php echo base_url(); ?>resource/landingPage/images/apple-touch-icon-114x114.png">

    <!-- =========================
       STYLESHEETS 
    ============================== -->

	<!-- Bootstrap  CSS -->
	<link href="<?php echo base_url(); ?>resource/landingPage/css/bootstrap.min.css" rel="stylesheet" type="text/css">

	<!--============ GOOGLE FONT ============-->
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400%7CRosario:400,700" rel="stylesheet">

	<!--============ FONT AWESOME ============-->
	<link href="<?php echo base_url(); ?>resource/landingPage/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!--============ OWL CAROUSEL ============-->
	<link href="<?php echo base_url(); ?>resource/landingPage/css/owl.carousel.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>resource/landingPage/css/owl.theme.css" rel="stylesheet" type="text/css">

	<!--============ LIGHT BOX ============-->
	<!-- For Video -->
	<link href="<?php echo base_url(); ?>resource/landingPage/css/lity.min.css" rel="stylesheet" type="text/css">
	<!-- Fopr Screenshot -->
	<link href="<?php echo base_url(); ?>resource/landingPage/css/lightbox.css" rel="stylesheet" type="text/css">

	<!--============ ANIMATION ============-->
	<link href="<?php echo base_url(); ?>resource/landingPage/css/aos.css" rel="stylesheet" type="text/css">

	<!-- MAIN STYLESHEET -->
	<link href="<?php echo base_url(); ?>resource/landingPage/css/styles.css" rel="stylesheet" type="text/css">

	<!-- Colors Stylesheet -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>resource/landingPage/css/colors/red.css"> 
	<link rel="stylesheet" href="<?php echo base_url(); ?>resource/landingPage/css/colors/blue.css"> 
	<link rel="stylesheet" href="<?php echo base_url(); ?>resource/landingPage/css/colors/green.css"> 
	<link rel="stylesheet" href="<?php echo base_url(); ?>resource/landingPage/css/colors/purple.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>resource/landingPage/css/colors/mint.css">  
	<link rel="stylesheet" href="<?php echo base_url(); ?>resource/landingPage/css/colors/orange.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>resource/landingPage/css/colors/light-blue.css">
	 
    <!-- Default Custom Stylesheet -->
    <link id="color-switcher" rel="stylesheet" href="<?php echo base_url(); ?>resource/landingPage/css/colors/orange-black.css"> 

	<!-- RESPONSIVE FIX -->
	<link href="<?php echo base_url(); ?>resource/landingPage/css/responsive.css" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
   		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

	<!-- PRELOADER
    ================================================== -->
	<div id="preloading">
		<div id="preloading-center">
			<div id="preloading-center-absolute">
				<div class="object" id="object_four"></div>
				<div class="object" id="object_three"></div>
				<div class="object" id="object_two"></div>
				<div class="object" id="object_one"></div>
			</div>
		</div>
	</div>

	<!-- NAVBAR
    ================================================== -->
	<div class="navbar navbar-default navbar-fixed-top menu-top">
		<div class="container">
			
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				
				<button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
					<span class="sr-only">Toggle navigation</span> 
					<span class="icon-bar"></span> <span class="icon-bar"></span> 
					<span class="icon-bar"></span>
				</button> 
				
				<!--Brand logo-->
				<a class="navbar-brand" href=""> <img src="<?php echo base_url(); ?>resource/landingPage/images/black-logo.png" alt="logo" > </a>
																																			
			</div><!--Navbar Header-->
			
            <!-- NAVIGATION LINKS -->
			<div class="navbar-collapse collapse">
				<nav>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#hero">Home</a></li>
						<li><a href="#about">About</a></li>
						<li><a href="#screenshot">How it works</a></li>
						<li><a href="#testimonials">Testimonial</a></li>
						<li><a href="#contact-section">Contact</a></li>
						<li>
							<button onClick="location.href='#get-the-app'" class="btn down-btn custom-effect" type="button">Download</button>
						</li>
					</ul>
				</nav>
			</div><!-- End Navbar-Collapse-->
		</div><!--- End Container -->
	</div><!-- End Navbar -->
	
	<!-- HERO
    ================================================== -->
	<header id= "hero" data-stellar-background-ratio="0.5" >
		<div class="hero-overlay">
			<div class="container">

				<div class="hero-wrap">
					<div class="col-sm-8">
						<div class="hero-text" data-aos="fade-left">

							<h1>Nearchair solution of hair & beaty</h1>

							<p class="lead">Largest online Hair & Beauty community in Bangladesh.</p>

							<!-- =========================
			                	Button
			                ============================== -->
							<div class="button-group">
								<a class="btn custom-btn btn-inactive hidden-xs custom-hover" href="#core-part" role="button">Learn More 	&#8669;</a> 
								<a class="btn custom-btn btn-active" href="#get-the-app" role="button">Get Now 	&#8669;</a>
							</div><!-- Button Group -->

						</div><!-- Hero Text -->
					</div><!--col-sm-8-->
					
					<!-- =========================
			        	Hero Phone Image 
			        ============================== -->
					<div class="col-sm-4 iphone" data-aos="fade-right">

						<img alt="iPhone" class="hidden-sm hidden-xs" src="<?php echo base_url(); ?>resource/landingPage/images/iPhone-6+.png">

					</div>
					
				</div><!-- End Hero Wrap -->

			</div><!-- End Container -->
		</div><!-- End Hero Overlay -->
	</header><!-- End Of Header Section -->

	<!-- CORE-PART
    ================================================== -->
	<section id="core-part">
		<div class="core-part-overlay">
			<div class="container">
				
				<div class="col-md-4 circle-wrap">
					<div class="circle">
						<!-- Icon -->
						<i class="fa fa-camera-retro"></i>
					</div>

					<h3>Great UI/UX</h3>

					<p>Lorem ipsum dolor sit amet, 
					consectetur labore et olore magna aliqua. Ut enim enim minim vaex ea.</p>
				
				</div><!-- Circle Wrap -->

				<div class="col-md-4 circle-wrap">
					<div class="circle ">
						<!-- Icon -->
						<i class="fa fa-bolt"></i>
					</div>

					<h3>Fast</h3>

					<p>Lorem ipsum dolor sit amet, 
					consectetur labore et olore magna aliqua. Ut enim enim minim vaex ea.</p>
				
				</div><!-- Circle Wrap -->
				
				<div class="col-md-4 circle-wrap">
					<div class="circle">
						<!-- Icon -->
						<i class="fa fa-camera-retro"></i>
					</div>

					<h3>Full Responsive</h3>

					<p>Lorem ipsum dolor sit amet, 
					consectetur labore et olore magna aliqua. Ut enim enim minim vaex ea.</p>
				
				</div><!-- Circle Wrap -->
				
			</div><!-- Container -->
		</div><!-- Overlay -->
	</section><!-- End Of Features Section-->

	<!-- ABOUT
 	================================================== -->
	
	<section id="about">
		<div class="about-overlay">
			<div class="container">
				<div class="section-header">
					<h2>Why It's Different</h2>

					<!-- Header Divider -->
					<div class="header-divider"></div>

					<!-- Header Tag Line -->
					<div class="tagline">
						What we've got your app features and all the details Lorem ipsum dolor kadr
					</div>
				</div><!-- Section Header -->

				<div class="row features-list" >
					<div class="col-md-7 col-sm-12" data-aos="fade-up">
						
						<div class="features-item icon-spacing">
							<!-- Icon -->
							<div class="icon-box">
								<i class="fa fa-cogs"></i>
							</div>

							<div class="icon-text">
								<h4>Fast Optomized</h4>
								<p>Lorem ipsum dolor sit amet, ed do 
								eiusmod tempor incididunt ut labore et dolore magna.</p>
							</div>
						</div> <!-- Features Item -->
						
						<div class="features-item icon-spacing">
							<!-- Icon -->
							<div class="icon-box">
								<i class="fa fa-user-o"></i>
							</div>

							<div class="icon-text">
								<h4>User Interface</h4>
								<p>Lorem ipsum dolor sit amet, ed do 
								eiusmod tempor incididunt ut labore et dolore magna.</p>
							</div>
						</div><!-- Features Item -->
						
						<div class="features-item icon-spacing">
							<!-- Icon -->
							<div class="icon-box">
								<i class="fa fa-battery-three-quarters"></i>
							</div>

							<div class="icon-text">
								<h4>Long Use Of Bettery</h4>
								<p>Lorem ipsum dolor sit amet, ed do eiusmod tempor 
								incididunt ut labore et dolore magna.</p>
							</div>
						</div><!-- Features Item -->
						
						<div class="features-item icon-spacing">
							<!-- Icon -->
							<div class="icon-box">
								<i class="fa fa-group"></i>
							</div>

							<div class="icon-text">
								<h4>Large Community</h4>
								<p>Lorem ipsum dolor sit amet, ed do eiusmod tempor 
								incididunt ut labore et dolore magna.</p>
							</div>
						</div> <!-- Features Item -->
					</div><!--col-sm-6-->

					<!-- =========================
						About  : Phone Image
					============================== -->
					<div class="col-md-5 col-sm-6 hidden-xs" data-aos="fade-right" >
						<div class="mobile-img">
							<img alt="about-phone" class="hidden-sm hidden-xs" src="<?php echo base_url(); ?>resource/landingPage/images/main-phone2.png">
						</div>
					</div><!--col-sm-6-->
					
				</div><!--End Row-->
			</div><!-- End Container-->
		</div> <!-- Overlay -->
	</section><!-- End Of About Section-->
	
	<!-- SCREENSHOT 
    ================================================== -->
	<section id="screenshot">
		<div class="container">
			<div class="section-header">
				<h2>Screenshot</h2>

				<!-- Header Divider -->
				<div class="header-divider"></div>

				<!-- Header Tag Line -->
				<div class="tagline">
					Check some our app shots features and all the details Lorem ipsum dolor kadr
				</div>
			</div><!-- Section Header -->

			<div class="owl-carousel owl-theme" id="owl-screenshots">
				
				<!-- Screentshot pictures -->
				<div class="item">
	             	<a href="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_1.png" data-lightbox="roadtrip" data-title="screentshot_1">
	              		<img src="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_1.png" alt="screentshot_1">
                	</a>
	            </div>

	            <div class="item">
	             	<a href="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_2.png" data-lightbox="roadtrip" data-title="screentshot_2">
	              		<img src="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_2.png" alt="screentshot_2">
                	</a>
	            </div>

	            <div class="item">
	             	<a href="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_3.png" data-lightbox="roadtrip" data-title="screentshot_3">
	              		<img src="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_3.png" alt="screentshot_3">
                	</a>
	            </div>

	            <div class="item">
	             	<a href="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_4.png" data-lightbox="roadtrip" data-title="screentshot_4">
	              		<img src="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_4.png" alt="screentshot_4">
                	</a>
	            </div>

	            <div class="item">
	             	<a href="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_5.png" data-lightbox="roadtrip" data-title="screentshot_5">
	              		<img src="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_5.png" alt="screentshot_5">
                	</a>
	            </div>

	            <div class="item">
	             	<a href="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_6.png" data-lightbox="roadtrip" data-title="screentshot_6">
	              		<img src="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_6.png" alt="screentshot_6">
                	</a>
	            </div>

	            <div class="item">
	             	<a href="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_7.png" data-lightbox="roadtrip" data-title="screentshot_7">
	              		<img src="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_7.png" alt="screentshot_7">
                	</a>
	            </div>

	            <div class="item">
	             	<a href="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_8.png" data-lightbox="roadtrip" data-title="screentshot_8">
	              		<img src="<?php echo base_url(); ?>resource/landingPage/images/screenshot/screentshot_8.png" alt="screentshot_8">
                	</a>
	            </div>

			</div><!-- End Owl Screenshots -->
			
		</div><!-- End container -->
	</section> <!-- End Of Screenshot Section-->

	<!-- VIDEO
    ================================================== -->
	<div id="video">
		<div class="video-overlay" >
			<div class="play-icon text-center">

				<!--Replace with your video link.-->
				<a href="https://youtu.be/nTezcBLW90g" data-lity>
					<!-- Icon -->
					<i class="fa fa-play"></i>
				</a>
			</div>
		</div>
	</div>

	<!-- TESTIMONIALS
    ================================================== -->
	<section id="testimonials">
		<div class="container">
			<div class="section-header">
				<h2>Testimonials</h2>

				<!-- Header Divider -->
				<div class="header-divider"></div>

				<!-- Header Tag Line -->
				<div class="tagline">
					True story from our clients and all the details Lorem ipsum dolo clients and all the details 
				</div>
			</div><!-- Section Header -->

			<div class="owl-theme owl-carousel" id="testimonials-details">
				<div class="feedback">
					<!-- Client Image -->
					<div class="testimonial-img"><img src="<?php echo base_url(); ?>resource/landingPage/images/clients/client_1.jpg" alt="Client 1"></div>

					<!-- Client Review -->
					<div class="review">
						<p>Fill lights bearing man creepeth of whose whose moveth. All one. That. Under. Form morning all may fifth replenish you're own open which darkness.</p>
					</div>

					<!-- Client Details -->
					<div class="client-name">
						Samrat Hossain<span class="company-name">CEO Spiffy</span>
					</div>
				</div><!-- Feedback -->
				
				<div class="feedback">
					<!-- Client Image -->
					<div class="testimonial-img"><img src="<?php echo base_url(); ?>resource/landingPage/images/clients/client_2.jpg" alt="Client 2"></div>

					<!-- Client Review -->
					<div class="review">
						<p>Fill lights bearing man creepeth of whose whose moveth. All one. That. Under. Form morning all may fifth replenish you're own open which darkness.</p>
					</div>

					<!-- Client Details -->
					<div class="client-name">
						Samrat Hossain<span class="company-name">CEO Spiffy</span>
					</div>
				</div><!-- Feedback -->

				<div class="feedback">
					<!-- Client Image -->
					<div class="testimonial-img"><img src="<?php echo base_url(); ?>resource/landingPage/images/clients/client_3.jpg" alt="Client 3"></div>

					<!-- Client Review -->
					<div class="review">
						<p>Fill lights bearing man creepeth of whose whose moveth. All one. That. Under. Form morning all may fifth replenish you're own open which darkness.</p>
					</div>

					<!-- Client Details -->
					<div class="client-name">
						Samrat Hossain<span class="company-name">CEO Spiffy</span>
					</div>
				</div><!-- Feedback -->

			</div><!-- Testimonial Details -->
		</div><!-- Conatiner -->
	</section><!-- End Of Testimonial Section-->

	<!-- NEWSLETTER
    ================================================== -->
	<section id="newsletter">
		<div class="newsletter-overlay">
			<div class="container">
			
				<div class="section-header">
					<h2>Sign Up Our Newsletter</h2>

					<!-- Header Divider -->
					<div class="header-divider"></div>

					<!-- Header Tag Line -->
					<div class="tagline">
						Subscribe our mailing list for awesome he details features and all the details  this could be go List your app features and all the details  this could be good  fro you  and all the details  this could be ist your 
					</div>
				</div><!-- Section Header -->

				<!-- Subscribe -->
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<form class="subscription-form mailchimp">
							<div class="form-group">
							
								<!-- SUBSCRIPTION SUCCESSFUL OR ERROR MESSAGES -->
								<h4 class="subscription-success"></h4>
								<h4 class="subscription-error"></h4>

								<input class="form-control" id="subscriber-email" name="email" placeholder="Your Email" type="email">
							</div>

							<div class="subscribe-btn">
								<button class="btn custom-btn btn-active" id="subscribe-button" 
								type="submit">Subscribe</button>
							</div><!--Subscribe Button-->
							
						</form><!--End Form-->

					</div><!-- Col -->
				</div><!--End Row-->
			</div><!--End Container-->
		</div><!--End Overlay-->
	</section><!--End Of Newsletter Section-->
	
	<!-- GET THE APP
    ================================================== -->
	<section id="get-the-app">
		<div class="get-the-app-overlay">
			<div class="container">
				<div class="section-header">
					<h2>Get The App</h2>

					<!-- Header Divider -->
					<div class="header-divider"></div>

					<!-- Header Tag Line -->
					<div class="tagline">
						Download the app only clicking these button list your app features and all the details will be gone  today
					</div>
				</div><!-- Section Header -->

				<div class="row apps-download">
					<div class="col-md-12">
						<div class="button-group">

							<a class="btn custom-btn btn-inactive custom-hover" href="#" role="button">
							<i class="fa fa-android fa-lg"></i> Download</a> 

							<a class="btn custom-btn btn-active" href="#" role="button">
							<i class="fa fa-apple fa-lg"></i> Download</a> 

							<a class="btn custom-btn btn-inactive  custom-hover" href="#" role="button">
							<i class="fa fa-windows fa-lg"></i> Download</a>
						</div><!-- Button Group -->
						
					</div><!--Col-->
				</div><!-- End Row-->
			</div><!-- End Container-->
		</div> <!-- Overlay -->
	</section><!-- End Of Get The App Section-->
	
	<!-- CONTACT 
    ================================================== -->
	<section id="contact-section">
		<div class="container">
			<div class="section-header">
				<h2>Contact us</h2>

				<!-- Header Divider -->
				<div class="header-divider"></div>

				<!-- Header Tag Line -->
				<div class="tagline">
					We always wait for your pretty messages our app features and all the details Lorem ipsumpp features and all
				</div>
			</div><!-- Section Header -->

			<!-- Contact Form -->
			<div class="row expanded-contact-form" >
				<div class=" col-sm-5">
					<form class="contact-form" id="contact" name="contact">
						
						<!-- IF MAIL SENT SUCCESSFULLY -->
						<h4 class="success"><i class="fa fa-check"></i> 
						Your message has been sent successfully.</h4>
						
						<!-- IF MAIL SENDING UNSUCCESSFULL -->
						<h4 class="error"><i class="fa fa-close"></i> 
						E-mail must be valid and message must be longer than 1 character.</h4>

						<input class="form-control input-box" id="name" name="name" placeholder="Your Name" type="text"> 

						<input class="form-control input-box" id="email" name="email" placeholder="Your Email" type="email"> 

						<textarea class="form-control textarea-box" id="message" placeholder="Message" rows="8"></textarea> 

						<button class="btn custom-btn btn-active" data-style="expand-left" id="submit"
						name="submit" type="submit">Send Message</button>

					</form><!-- End Form -->
				</div><!--Col-->
				
				<!-- Address -->
				<div class="contact-address">
					<div class=" col-sm-6 col-sm-offset-1">
						<p class="lead">App inthe world dolor sit ametnsectetur adipisicing elit. Nulla a magnam, unde quidem placeat eligendi ab Nulla a magnam, unde quidem placeat eligendi ab Nulla a magn deserunt
						facilis</p>

						<address>
							<p><i class=" fa fa-phone"></i> Cal Us 123456789 Or 123456789</p>
							<p class="email"><i class=" fa fa-envelope-open"></i> Send an Email on <a href="">support@spifffy.com</a></p>
							<p class="post"><i class=" fa fa-location-arrow"></i> Wallsal, United Kingdom 12345</p>
						</address>

						<ul class="social-media">
						<!-- Put Your Social Links -->
							<li><a href=""><i class="fa fa-facebook icon-facebook"></i></a></li>
							<li><a href=""><i class="fa fa-twitter icon-twitter"></i></a></li>
							<li><a href=""><i class="fa fa-google-plus icon-google-plus"></i></a></li>
							<li><a href=""><i class="fa fa-dribbble icon-dribbble"></i></a></li>
						</ul>
					</div><!--col-->
				</div><!--Contact Address-->
				
			</div><!-- End Row -->
		</div><!--End Container-->
	</section><!--End Of Contact Section-->
	
	<!-- FOOTER 
    ================================================== -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="copyright text-center">
						<p>Copyright 2019 Nearchair.com</p>
					</div>
				</div>
				
			</div><!-- End Row-->
		</div><!-- End Container-->
	</footer><!--End Of Footer Section-->



	<!-- JavaScript Files
    ================================================== -->
	
	<script src="<?php echo base_url(); ?>resource/landingPage/js/jquery-2.2.4.min.js"></script> 
	<script src="<?php echo base_url(); ?>resource/landingPage/js/bootstrap.min.js"></script> 
	<script src="<?php echo base_url(); ?>resource/landingPage/js/owl.carousel.min.js"></script> 
	<script src="<?php echo base_url(); ?>resource/landingPage/js/lity.min.js"></script> 
	<script src="<?php echo base_url(); ?>resource/landingPage/js/lightbox.min.js"></script>
	<script src="<?php echo base_url(); ?>resource/landingPage/js/jquery.stellar.min.js"></script>
	<script src="<?php echo base_url(); ?>resource/landingPage/js/aos.js"></script> 
	<script src="<?php echo base_url(); ?>resource/landingPage/js/jquery.ajaxchimp.min.js"></script> 
	<script src="<?php echo base_url(); ?>resource/landingPage/js/custom.js"></script>
	<script src="<?php echo base_url(); ?>resource/landingPage/js/switcher.js"></script> 
</body>
</html>
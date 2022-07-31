<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Basic Page Needs
    ================================================== -->
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> {{ $title }} | {{ $_ENV['APP_NAME'] }} </title>
	<meta name="description" content="KIDS is a clean, modern, and fully responsive Html Template. Take your Startup business website to the next level. It is designed for kindergarten, childcare, homeschooling, school, learning, playground businesses or any type of person or business who wants to showcase their work, services and professional way.">
	<meta name="keywords" content="business, care, childcare, children, clean, corporate, happykids, homeschool, kids, kindergarten, playground, responsive, school, learning">
	<meta name="author" content="rometheme.net">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="base_url" content="{{ base_url }}" />

	<!-- ==============================================
	Favicons
	=============================================== -->
	<link rel="shortcut icon" href="{{ asset('landing/template1/images/favicon2.ico') }}">
	<link rel="apple-touch-icon" href="{{ asset('landing/template1/images/apple-touch-icon.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('landing/template1/images/apple-touch-icon-72x72.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('landing/template1/images/apple-touch-icon-114x114.png') }}">

	<!-- ==============================================
	CSS VENDOR
	=============================================== -->
	<link rel="stylesheet" type="text/css" href="{{ asset('landing/template1/css/vendor/bootstrap.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('landing/template1/css/vendor/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('landing/template1/css/vendor/owl.carousel.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('landing/template1/css/vendor/owl.theme.default.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('landing/template1/css/vendor/magnific-popup.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('landing/template1/css/vendor/animate.min.css') }}">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.css" integrity="sha512-LKG0Zi6duJ5mwncLtQVchN0iF8fWmcxApuX9pqGq7ITgwQDWR9EqZFsrV9TXfE9pPRa1J6GVnsBl7gKxAyllaA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<!-- ==============================================
	Custom Stylesheet
	=============================================== -->
	<link rel="stylesheet" type="text/css" href="{{ asset('landing/template1/css/style.css') }}" />
	<script src="{{ asset('landing/template1/js/vendor/modernizr.min.js') }}"></script>

	<script src="{{ asset('framework/vendor/cute-alert/cute-alert.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('framework/vendor/cute-alert/style.css') }}">

</head>

<body>

	<!-- LOAD PAGE -->
	<div class="animationload">
		<div class="loader"></div>
	</div>

	<!-- BACK TO TOP SECTION -->
	<a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>

	<!-- HEADER -->
	<div class="header header-1">

		<!-- TOPBAR -->
		<div class="topbar">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-sm-8 col-md-6">
						<div class="info">
							<div class="info-item">
								<i class="fa fa-phone"></i> +6013 317 8899
							</div>
							<div class="info-item">
								<i class="fa fa-envelope-o"></i> <a href="mailto:kaviarihaas@gmail.com" title="">kaviarihaas@gmail.com</a>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col-md-6">
						<div class="sosmed-icon pull-right d-inline-flex">
							<a href="https://www.facebook.com/kaviari81/" class="in"><i class="fa fa-facebook"></i></a>
							<!-- <a href="#" class="tw"><i class="fa fa-twitter"></i></a> -->
							<a href="https://wa.me/601123668162" class="ig" style="background-color: #0E9B19;"><i class="fa fa-whatsapp"></i></a>
							<!-- <a href="#" class="in"><i class="fa fa-linkedin"></i></a> -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- NAVBAR SECTION -->
		<div class="navbar-main">
			<div class="container">
				<nav id="navbar-example" class="navbar navbar-expand-lg">
					<a class="navbar-brand" href="{{ url('home') }}">
						<img src="{{ asset('landing/template1/images/suria_intelek_logo.png') }}" alt="" style="width:100px;height:100px;">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavDropdown">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link" href="{{ url('home') }}">HOME</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ url('home/gallery') }}">GALLERY</a>
							</li>
							<li class="nav-item active">
								<a class="nav-link" href="{{ url('home/contactus') }}">CONTACT US</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ url('application/form') }}">REGISTER</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ url('auth') }}">LOGIN</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>

	</div>

	<!-- BANNER -->
	<div class="section banner-page" data-background="{{ asset('landing/template1/images/banner-single.jpg') }}">
		<div class="content-wrap pos-relative">
			<div class="d-flex justify-content-center bd-highlight mb-3">
				<div class="title-page">Contact</div>
			</div>
			<div class="d-flex justify-content-center bd-highlight mb-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb ">
						<li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Contact</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<!-- CONTACT -->
	<!--
	<div id="contact">
		<div class="content-wrap pb-0">
			<div class="container bgi-right bgi-hide-xs" data-background="images/request.jpg">
				<div class="row">
					<div class="col-12 col-md-12">

						<form action="#" class="form-contact" id="contactForm" data-toggle="validator" novalidate="true">
							<div class="row">
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="p_name" placeholder="Enter Name" required="">
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<input type="email" class="form-control" id="p_email" placeholder="Enter Email" required="">
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="p_subject" placeholder="Subject">
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="p_phone" placeholder="Enter Phone Number">
										<div class="help-block with-errors"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<textarea id="p_message" class="form-control" rows="6" placeholder="Enter Your Message"></textarea>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<div id="success"></div>
								<button type="submit" class="btn btn-primary">Send Message</button>
							</div>
						</form>
						<div class="spacer-content"></div>

					</div>

				</div>
			</div>
		</div>
	</div> -->

	<!-- MAPS -->

	<div class="themap" style="text-align:center">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.118603170392!2d101.25823861475773!3d3.320856397582495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31ccf4851c29d2b5%3A0x767f6d6a92d16ee2!2sTADIKA%20SURIA%20INTELEK%20KUALA%20SELANGOR!5e0!3m2!1sen!2smy!4v1643872446024!5m2!1sen!2smy" width="1800" height="450" style="border:1;" allowfullscreen="" loading="lazy"></iframe>

	</div>

	<!-- FOOTER SECTION -->
	<div class="footer" data-background="images/bg.jpg">
		<div class="content-wrap">
			<div class="container">

				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="footer-item">
							<img src="{{ asset('landing/template1/images/suria_intelek_logo.png') }}" alt="logo bottom" class="logo-bottom" style="width:250px;height:250px;">
							<div class="spacer-30"></div>
							<!-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy.</p> -->
						</div>
					</div>

					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="footer-item">
							<div class="footer-title" style="color: red;">
								Contact Info
							</div>
							<ul class="list-info">
								<li>
									<div class="info-icon">
										<span class="fa fa-map-marker"></span>
									</div>
									<div class="info-text">
										22A, Lorong Teratai 2/12
										Bandar Baru
										45000 Kuala Selangor
										Selangor
										Malaysia
									</div>
								</li>
								<li>
									<div class="info-icon">
										<span class="fa fa-phone"></span>
									</div>
									<div class="info-text">(+6) 013-317 8899</div>
								</li>
								<li>
									<div class="info-icon">
										<span class="fa fa-envelope"></span>
									</div>
									<div class="info-text">kaviarihaas@gmail.com</div>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-sm-12 col-md-6 col-lg-3">
						<div class="footer-item">
							<div class="footer-title" style="color: red;">
								Business Hour
							</div>

							Mon: 7:30 AM – 5:30 PM </br>
							Tue: 7:30 AM – 5:30 PM </br>
							Wed: 7:30 AM – 5:30 PM </br>
							Thu: 7:30 AM – 5:30 PM </br>
							Fri: 7:30 AM – 4:30 PM </br>
							Sat: Closed </br>
							Sun: Closed </br>

						</div>
					</div>

					<div class="col-sm-12 col-md-6 col-lg-3" style="color: red;">
						<div class="footer-item">
							<div class="footer-title" style="color: red;">
								Get in Touch
							</div>

							<div class="sosmed-icon d-inline-flex">
								<a href="https://www.facebook.com/kaviari81/" class="in"><i class="fa fa-facebook"></i></a>
								<!-- <a href="#" class="tw"><i class="fa fa-twitter"></i></a> -->
								<a href="https://wa.me/601123668162" class="ig" style="background-color: #0E9B19;"><i class="fa fa-whatsapp"></i></a>
								<!-- <a href="#" class="in"><i class="fa fa-linkedin"></i></a> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="fcopy">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<p class="ftex">Copyright 2022 &copy; <span class="color-primary">Tadika Suria Intelek</span>. Develop by <span class="color-primary">CanThink Solution</span></p>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- JS VENDOR -->
	<script src="{{ asset('landing/template1/js/vendor/jquery.min.js') }}"></script>
	<script src="{{ asset('landing/template1/js/vendor/bootstrap.min.js') }}"></script>
	<script src="{{ asset('landing/template1/js/vendor/owl.carousel.js') }}"></script>
	<script src="{{ asset('landing/template1/js/vendor/jquery.magnific-popup.min.js') }}"></script>

	<!-- SENDMAIL -->
	<script src="{{ asset('landing/template1/js/vendor/validator.min.js') }}"></script>
	<script src="{{ asset('landing/template1/js/vendor/form-scripts.js') }}"></script>

	<!-- GOOGLEMAP -->
	<script src="{{ asset('landing/template1/js/googlemap-setting.js') }}"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU&callback=initMap"> </script>

	<script src="{{ asset('landing/template1/js/script.js') }}"></script>

</body>

</html>
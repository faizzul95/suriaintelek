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
							<li class="nav-item active">
								<a class="nav-link" href="{{ url('home/gallery') }}">GALLERY</a>
							</li>
							<li class="nav-item">
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
				<div class="title-page">Gallery</div>
			</div>
			<div class="d-flex justify-content-center bd-highlight mb-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb ">
						<li class="breadcrumb-item"><a href="#">Gallery Facility</a></li>
						<li class="breadcrumb-item active" aria-current="page">Gallery Activity</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<!-- OUR GALLERY -->
	<div class="section">
		<div class="content-wrap">
			<div class="container">

				<div class="row">
					<div class="col-sm-12 col-md-12">
						<p class="supheading text-center">Our Gallery</p>
						<h2 class="section-heading text-center mb-5">
							Moment from kids
						</h2>
					</div>
				</div>

				<div class="row popup-gallery gutter-5">
					<!-- Item 1 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="{{ asset('landing/template1/images/galeri-aktiviti1.jpg') }}" title="Gallery #1">
								<img src="{{ asset('landing/template1/images/galeri-aktiviti1.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fa fa-search"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- Item 2 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="{{ asset('landing/template1/images/galeri-aktiviti2.jpg') }}" title="Gallery #2">
								<img src="{{ asset('landing/template1/images/galeri-aktiviti2.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fa fa-search"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- Item 3 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="{{ asset('landing/template1/images/galeri-aktiviti3.jpg') }}" title="Gallery #3">
								<img src="{{ asset('landing/template1/images/galeri-aktiviti3.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fa fa-search"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- Item 4 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="{{ asset('landing/template1/images/galeri-aktiviti4.jpg') }}" title="Gallery #4">
								<img src="{{ asset('landing/template1/images/galeri-aktiviti4.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fa fa-search"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- Item 5 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="{{ asset('landing/template1/images/galeri-aktiviti5.jpg') }}" title="Gallery #5">
								<img src="{{ asset('landing/template1/images/galeri-aktiviti5.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fa fa-search"></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<!-- Item 6 -->
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="box-gallery">
							<a href="{{ asset('landing/template1/images/galeri-aktiviti6.jpg') }}" title="Gallery #6">
								<img src="{{ asset('landing/template1/images/galeri-aktiviti6.jpg') }}" alt="" class="img-fluid">
								<div class="project-info">
									<div class="project-icon">
										<span class="fa fa-search"></span>
									</div>
								</div>
							</a>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

	<!-- CTA -->
	<div class="section bg-tertiary">
		<div class="content-wrap py-5">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-sm-12 col-md-12">
						<div class="cta-1">
							<div class="body-text mb-3">
								<h3 class="my-1 text-secondary">Let's join the best kindergarten now!</h3>
								<p class="uk18 mb-0 text-white">We provide high standar clean website for your business solutions</p>
							</div>
							<div class="body-action">
								<a href="{{ url('home/contactus') }}" class="btn btn-primary mt-3">CONTACT US</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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

		<script src="{{ asset('landing/template1/js/script.js') }}"></script>

</body>

</html>
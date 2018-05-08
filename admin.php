<?php
require_once('classes/Parser.php');
require_once('classes/DB.php');
 if(isset($_POST['subject'])){
     $subject=$_POST['subject'];
     $booklet=$_POST['booklet'];
     $exam_date=$_POST['exam_date'];
     $path=$_FILES['path']['name'];
     move_uploaded_file($_FILES['path']['tmp_name'],"exam/".$path);
     $path="exam/".$path;
     $result=Parser::createExam($path,$booklet,$subject,$exam_date);
     if($result==true){
         echo "<script>alert('Exam Created Succesfully and will be available for test soon.');</script>";
     }
     else echo "<script>alert('failed to create exam, an error occured');</script>";
 }
 $query="select subject,exam from subject";
 $db=new DB();
 $stmt=$db->connect()->prepare($query);
 $stmt->execute();
 $result=$stmt->get_result();
 $stmt->close();
 $subjects=false;
 $exams=false;
 $i=0;
 while($row=$result->fetch_assoc()){
     $subjects[$i]=$row['subject'];
     $exams[$i]=$row['exam'];
     $i++;
 }
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>MUKERA | Home</title>
	<!-- Meta Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Haute Cuisine Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta Tags -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/popup-box.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!--Online-fonts-->
	<link href="//fonts.googleapis.com/css?family=Catamaran:100,400,500,600,800" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:300,400,700" rel="stylesheet">
	<!--//Online-fonts-->
</head>

<body>
	<!-- Header -->
	<div class="logo-w3layouts">
		<div class="header-top-w3ls">
			<p class="left-p"><span class="fa fa-location-arrow" aria-hidden="true"></span>5 Italy St, Yerevan 0010, Armenia</p>
			<p class="right-p"><span class="fa fa-phone" aria-hidden="true"></span>096-529-0133</p>
			<div class="clearfix"></div>
		</div>
		<div class="header-mid">
			<div class="container">
				<h1><a href="index.php"><span>MUKERA </span> Previos National Exam Store </a></h1>
				<div class="w3ls_search">
					<div class="cd-main-header">
						<ul class="cd-header-buttons">
							<li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
						</ul>
						<!-- cd-header-buttons -->
					</div>
					<div id="cd-search" class="cd-search">
						<form action="#" method="post">
							<input name="Search" type="search" placeholder="Search for Exams...">
						</form>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- banner-slider -->
	<div class="w3l_banner_info" id="home">
		<div class="slider">
			<div class="callbacks_container">
				<!-- Navigation -->
				<div class="header-nav">
					<div class="container">
						<nav class="navbar navbar-default">
							<div class="navbar-header logo">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<!-- navbar-header -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav navbar-right">
									<li><a href="index.php" class="active scroll">Home</a></li>
									<li><a href="login/index.html" >Login</a></li>
									<li><a href="register.html" class="scroll">Register</a></li>
									<li><a href="#about" class="scroll">About</a></li>
									<li><a href="#contact" class="scroll">Add Exam</a></li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</nav>
						<div class="w3l-social">
							<ul>
								<li><a href="#" class="fa fa-facebook"></a></li>
								<li><a href="#" class="fa fa-twitter"></a></li>
								<li><a href="#" class="fa fa-google-plus"></a></li>
							</ul>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<!-- //Navigation -->
				<ul class="rslides" id="slider3">
					<li>
						<div class="slider-img b1">
						</div>
						<div class="slider_banner_info">
							<div class="w3ls-info">
								<h4>Ethiopian <span>National Examination</span> Papers Review</h4>
								<p> We Have Answers for all previous Grade 10 Exams in All Subjects </p>
							</div>
						</div>
					</li>
					<li>
						<div class="slider-img b2">
						</div>
						<div class="slider_banner_info">
							<div class="w3ls-info">
								<h4>You can also try our <span>Android Application</span> to Test Your-self against previous exams</h4>
								<p>Download Our Android Application from <a href='http://localhost/exam/app.apk'>Here</a> </p>
							</div>
						</div>
					</li>
					<li>
						<div class="slider-img b3">
						</div>
						<div class="slider_banner_info">
							<div class="w3ls-info">
								<h4>Yes we are always <span>the best</span></h4>
								<p>We are here to help you prepare for the upcoming national exams. </p>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<!-- //banner-slider -->
	<!-- //Header -->
	<!-- Banner bottom -->
	<!-- //gallery -->
	<!-- testimonials -->

	<!-- testimonials -->
	<!-- contact -->
	<div class="agileits-contact" id="contact">
		<div class="col-md-5 col-sm-5 col-xs-6 w3_agileits-contact-left">
		</div>
		<div class="col-md-7 col-sm-7 col-xs-6 contact-right-w3l">

			<h5 class="title-w3">Add New Exam </h5>
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="input-w3ls w3ls-left">
					<select name="subject">
                        <?php
                            if($subjects!=false){
                                $count=count($subjects);
                                for($i=0;$i<$count;$i++){
                                    echo "<option value='".$subjects[$i]."'>".$exams[$i]." SUBJECT CODE: ".$subjects[$i]."</option>";
                                }
                            }
                        ?>
                    </select>
				</div>
				<div class="input-w3ls w3ls-rght">
					<input type="text" class="name" name="booklet" placeholder="Booklet Code" required="">
				</div>
				<div class="input-w3ls w3ls-left">
					<input type="date" class="name" name="exam_date"  required="">
				</div>
				<div class="input-w3ls w3ls-rght">
					<input type="file" class="file" name="path" placeholder="Select Exam file" accept="text" required="">
				</div>
				<div class="input-w3ls">
					<input type="submit" value="Submit">
				</div>
			</form>
		</div>
		<div class="clearfix"></div>
	</div>
	<!-- //contact -->
	<!-- Map -->
	
	<!-- //Map -->
	<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="col-md-4 footerleft">
				<h3>MUKERA Android App is Coming Soon</h3>
				<p>We are making things even simpler by creating our android application. It will be released soon, keep informed for more updates.</p>
				
			</div>
			<div class="col-md-4 footermiddle">
				<h3>Keep in touch</h3>
				<p>4 Killo, Arada sub-city, Addis Ababa, Ethiopia</p>
				<p>Office,No 921</p>
				<p class="phone">phone: +251(9) 134 5678</p>
				<p class="phone">Fax: +251(9) 144 5678</p>
				<p class="phone">Mail: <a href="mailto:mukera@nae.edu.gov.et">mukera@nae.edu.gov.et</a></p>
			</div>
			<div class="col-md-4 footerright">
				<h3>Recent feedbacks</h3>
				<ul class="w3agile_footer_grid_list">
					<li>Greate Website, Now I can pass my exam more confidently<a href="#">mukera.com</a>, Thanks to MUKERA.
						<span><i class="fa fa-twitter" aria-hidden="true"></i> 02 days ago</span></li>
					<li>I just tried out the mobile app and it is great<a href="#">mukera.com</a> Thanks, You guys are really amazing.
						<span><i class="fa fa-twitter" aria-hidden="true"></i> 03 days ago</span></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //footer -->
	<!-- copyright -->
	<div class="wthree_copy_right">
		<div class="container">
			<p>© 2018 MUKERA. All rights reserved | Design by G4IT-AMU Students</p>

		</div>
	</div>
	<!-- //copyright -->
	<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- js -->
	<script type='text/javascript' src='js/jquery-2.2.3.min.js'></script>
	<!-- //js -->
	<!--gallery-popup -->
	<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>
	<!--//gallery-popup -->
	<script src="js/responsiveslides.min.js"></script>
	<script>
		// You can also use "$(window).load(function() {"
		$(function () {
			// Slideshow 4
			$("#slider3").responsiveSlides({
				auto: true,
				pager: true,
				nav: false,
				speed: 500,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script>
	<!--search-bar-->
	<script src="js/main.js"></script>
	<!--//search-bar-->
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function () {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/

			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //here ends scrolling icon -->
	<!--js for bootstrap working-->
	<script src="js/bootstrap.js"></script>
	<!-- //for bootstrap working -->
</body>

</html>
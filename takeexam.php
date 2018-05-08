<?php
session_start();
require_once('classes/DB.php');
require_once('classes/Exam.php');
require_once('classes/Subject.php');
$searchResult=false;
if(isset($_POST['subject'])){
    $subject=$_POST['subject'];
    $year=$_POST['year'];
    $query="select id from exam where subject=? and YEAR(exam_date)=?";
    $db=new DB();
    $stmt=$db->connect()->prepare($query) or die(mysqli_error($db->connect()));
    $stmt->bind_param('ss',$subject,$year);
    $stmt->execute();
    $result=$stmt->get_result();
    $stmt->close();
    $i=0;
    while($row=$result->fetch_assoc()){
        $id=$row['id'];
        $exam=Exam::fromId($id);
        $searchResult[$i]=$exam;
        $i++;
    }
    $searchResult=false;
}
 if(isset($_GET['xid'])){
    $xid=$_GET['xid'];
    $_SESSION['reload']=false;
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
    <script src="css/timer/flipclock.js"></script>
    <link href="css/timer/flipclock.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>



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
				<h1><a href="index.php"><span>MUKERA </span> Previous National Exam Store </a></h1>
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

			<h1>National Exam Mukera (Test)</h1>
            <div class="form-body">
                <form method="post"> <div class="form-group"> <label for="exampleInputEmail1">Select Exam</label> <select name="subject">
                            <?php

                            if($subjects!=false){
                                $count=count($subjects);
                                for($i=0;$i<$count;$i++){
                                    echo "<option value='".$subjects[$i]."'>".$exams[$i]." SUBJECT CODE: ".$subjects[$i]."</option>";
                                }
                            }
                            ?>
                        </select> </div>
                    <div class="form-group"> <label for="exampleInputPassword1">Exam Year</label><input type="number" name="year" placeholder="Year"></div>
                    <button type="submit" class="btn btn-default">Search</button> </form>
            </div>
            </div>
		</div>
    <div>
        <h2>Search Results</h2>
        <?php
    if(isset($searchResult) && $searchResult!=false){
        $count=count($searchResult);
        echo "<table>";
        echo "<tr><th>Exam Title</th><th>Subject Code</th><th>Booklet Code</th><th>Exam Date</th></tr>";
        for($i=0;$i<$count;$i++){
            $exam=$searchResult[$i];
            $code=$exam->subject;
            $id=$exam->id;
            $sub=Subject::fromSubjectCode($code);
            echo "<tr>";
            echo "<td>".$sub->subject."</td>";
            echo "<td>".$sub->subjectCode."</td>";
            echo "<td>".$exam->booklet."</td>";
            echo "<td>".$exam->exam_date."</td>";
            echo "<td><a href='?xid=$id' Take Exam</td>";
            echo "</tr>";
        }
        echo "</table>";

    }
?>
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
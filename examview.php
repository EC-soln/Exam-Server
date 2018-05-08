<?php
session_start();

$timer=0;
$current=0;
$reload=$_SESSION['reload'];
require_once('classes/Exam.php');
require_once('classes/Subject.php');
if(isset($_GET['xid']) && $reload=false){
    $id=$_GET['xid'];
    $exam=Exam::fromId($id);
    $sub=Subject::fromSubjectCode($exam->subject);
    $timer=$sub->maxTime;
    $_SESSION['current']=$timer;
}
else if(isset($_GET['xid']) && $reload=true){
    $timer=$_SESSION['current'];
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
    <!-- //Meta Tags -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/popup-box.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--Online-fonts-->
    <link href="//fonts.googleapis.com/css?family=Catamaran:100,400,500,600,800" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/timer/flipclock.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script src="css/timer/flipclock.js"></script>



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
    <div class="col-md-7 col-sm-7 col-xs-6 contact-right-w3l">
        <h1>National Exam Mukera (Test)</h1>
        <h3>Subject: <?php echo $_GET['subject'] ?></h3>
        <h3>Booklet: <?php echo $_GET['booklet'] ?></h3>
        <!---TIMER-->
        <div id="timer" style="position: fixed; right: 0;">
        <div class="clock" style="margin:2em;"></div>
        </div>
        <div class="message"></div>

        <script type="text/javascript">
            var clock;

            $(document).ready(function() {

                clock = $('.clock').FlipClock(<?php echo $timer; ?>, {
                    clockFace: 'HourCounter',
                    countdown: true,
                    callbacks: {
                        stop: function() {
                            $('.message').html('The clock has stopped!');
                        },
                        interval: function() {
                            var time = this.factory.getTime().time;

                            if (time) {
                                console.log('interval', time);
                                <?php $_SESSION['current']=$_SESSION['current']-1; ?>
                            }
                        }
                    }
                });

            });

        </script>
        <!---/Timer-->
        <div class="questions">
            <?php
            $i=$_SESSION['count'];
            $questions=$_SESSION['questions'];
            $question=$questions[$i];
            $_SESSION['no']=$question->no;
            $q=$question->question;
            echo "<h3>".$_SESSION['no'].". ".$q."</h3>";
            echo "<form action='' method='post'>";
            ?>
            <input type="radio" name="choice" value="A"><?php echo $question->choicea; ?><br/>
            <input type="radio" name="choice" value="B"><?php echo $question->choiceb; ?><br/>
            <input type="radio" name="choice" value="C"><?php echo $question->choicec; ?><br/>
            <input type="radio" name="choice" value="D"><?php echo $question->choiced; ?><br/>
            <button name="submit" type="submit" value="Next">Next</button>
            <?php
            echo "</form>";
            ?>
        </div>
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

<!-- //for bootstrap working -->
</body>

</html>
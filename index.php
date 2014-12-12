<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
// phpinfo();
?>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Crawl</title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/grayscale.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    	<!-- Navigation -->
    	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    		<div class="container">
    			<div class="navbar-header">
    				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
    					<i class="fa fa-bars"></i>
    				</button>
    				<a class="navbar-brand page-scroll" href="#page-top">
    					<i class="fa fa-play-circle"></i>  <span class="light">Crawl</span>
    				</a>
    				<span class="light">
    					<?php 

    					if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    						echo "<a href=\"member.php\">".$_SESSION['username']."</a>";
    					}

    					?>
    				</span>
    			</div>

    			<!-- Collect the nav links, forms, and other content for toggling -->
    			<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
    				<ul class="nav navbar-nav">
    					<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
    					<li class="hidden">
    						<a href="#page-top"></a>
    					</li>
    					<li>
    						<a class="page-scroll" href="#about">About</a>
    					</li>
    					<li>
    						<a class="page-scroll" href="#sign-up">Sign-Up</a>
    					</li>
    					<li>
    						<a href="login.php">Login</a>
    					</li>
                        <li>
                            <?php 

                                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                                    echo "<a href=\"signout.php\">Logout</a>";
                                }

                            ?>
                        </li>
    				</ul>
    			</div>
    			<!-- /.navbar-collapse -->
    		</div>
    		<!-- /.container -->
    	</nav>

    	<!-- Intro Header -->
    	<header class="intro">
    		<div class="intro-body">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-8 col-md-offset-2">
    						<h1 class="brand-heading">Crawl</h1>
    						<p class="intro-text">A free place to store some of your filesystem.<br>Created by Keegan Shudy.</p>
    						<a href="#about" class="btn btn-circle page-scroll">
    							<i class="fa fa-angle-double-down animated"></i>
    						</a>
    					</div>
    				</div>
    			</div>
    		</div>
    	</header>

    	<!-- About Section -->
    	<section id="about" class="container content-section text-center">
    		<div class="row">
    			<div class="col-lg-8 col-lg-offset-2">
    				<h2>About</h2>
    				<p>Crawl is a project that is designed to be a simple file storeage website <br> 
    					which uses PHP and MySQL to allow registered users to upload files to a server.
    				</p>
    			</div>
    		</div>
    	</section>

    	<!-- Sign-up Section -->
    	<section id="sign-up" class="content-section text-center">
    		<div class="signup-section">
    			<div class="container">
    				<div class="col-lg-8 col-lg-offset-2">
    					<h2>SIGN UP</h2>
    					<p>If you would like to sign up for this project go here <a href="signup.php">signup</a></p>
    				</div>
    			</div>
    		</div>
    	</section>

    	<!-- Map Section -->
    	<!-- <div id="map"></div>-->

    	<!-- Footer -->
    	<footer>
    		<div class="container text-center">
    			<p style="font-size:10px">Keegan Shudy 2014</p>
    		</div>
    	</footer>

    	<!-- jQuery -->
    	<script src="js/jquery.js"></script>

    	<!-- Bootstrap Core JavaScript -->
    	<script src="js/bootstrap.min.js"></script>

    	<!-- Plugin JavaScript -->
    	<script src="js/jquery.easing.min.js"></script>

    	<!-- Custom Theme JavaScript -->
    	<script src="js/grayscale.js"></script>

    </body>

    </html>

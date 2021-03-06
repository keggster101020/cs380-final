<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
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
                <a class="navbar-brand page-scroll" href="index.php">
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
                        <a class="page-scroll" href="index.php">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#">Sign-Up</a>
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
    <header class="introsign">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Sign Up</h1>
                        <p class="intro-text">
                        <!-- form to do the signup -->
                            <form role="form" method="POST">
                                <div class="form-group">
                                    <label for="signupEmail">Email Address</label>
                                    <input type="email" class="form-control" id="signupEmail" name="signupEmail" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label for="signupPassword">Password</label>
                                    <input type="password" class="form-control" id="signupPassword" name="signupPassword" placeholder="Password">
                                </div>
                                <input type="submit" name="submit" value="Signup" style="color:black" /input>
                            </form>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

   <?php 
    error_reporting(0);
    session_start();
    $servername = "127.0.0.1";
    $username = "root";
    try{
        if(isset($_POST['submit'])){
            $username = $_POST['signupEmail'];
            $password = $_POST['signupPassword'];

            $conn = mysql_connect($servername, $username, ""); //or die("unable to connect to database");
            mysql_select_db("drive", $conn) or die(mysql_error());
            $filePaths = "uploads/" . $username . "/uploads/"; //give the user a filepath and store it
            //check if the filepath exists
            if(!(file_exists($filePath))){
                mkdir($filePath, 0755, true);
            }

            $insert = "INSERT INTO `drive`.`users` (`ID`, `Email`, `Password`, `filePath`) VALUES (NULL, '$username', '$password', '$filePaths');";
            $result = mysql_query($insert);
            echo "User created successfully";
        }
    }catch(PDOException $e)
    {
        echo $e->getMessage();
    }

 ?>

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

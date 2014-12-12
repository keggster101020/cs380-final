<!DOCTYPE html>
<html lang="en">

<?php 
error_reporting(0);
session_start();

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)){
    header("Location: login.php");
    exit();
}
//double check that the users uploads folder exists, if it doesn't create it
$filePath = "uploads/" . $_SESSION['username'] . "/uploads/";
if(!(file_exists($filePath))){
    mkdir($filePath, 0755, true);
}
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
                            <a class="page-scroll" href="signup.php">Sign-Up</a>
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
        <header class="member">
            <div class="intro-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading">File Upload</h1>
                        </div>
                        <p class="intro-text">
                            <!-- put file upload here -->
                            <table bord="0">
                                <form method="post" enctype="multipart/form-data">
                                    <td>
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                    </td>
                                    <td>
                                    <input type="submit" value="Upload" name="submit" style="color:black">
                                    </td>
                                </form>
                            </table>
                            </br>
                            <div class="col-md-6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                    </tr>
                                </thead>
                                <tbod>
                                    <?php  
                                        $names = getFilenames();
                                        foreach ($names as $value) {
                                            echo "<tr><td>$value</td></tr>";
                                        }
                                        // echo $names[0];
                                        // downloadFile($names[0]);
                                    ?>

                                </tbod>

                            </table>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Map Section <div id="map"></div>-->

        <?php 
            if(isset($_POST["submit"])){

                $filenamepath = getFilepath() . basename($_FILES["fileToUpload"]["name"]);
                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filenamepath))
                    echo "file:" .  basename($_FILES["fileToUpload"]["name"]) . " | uploaded to $filenamepath | filePath: $filePath </br>";
                else
                    echo "file did not get uploaded correctly";
                
                // refresh the page to show new content
                echo "<meta http-equiv=\"refresh\" content=\"1\">";
            }

            function getFilepath(){
                $servername = "127.0.0.1";
                $serverusername = "root";
                $username = $_SESSION['username'];


                $conn = mysql_connect($servername, $serverusername, ""); //or die("unable to connect to database");
                mysql_select_db("drive", $conn) or die(mysql_error());
                $select =  "SELECT `filePath` FROM `users` WHERE `Email` = '$username'";
                $query = mysql_query($select) or die("bad query");
                $rows = mysql_num_rows($query);
                // echo "<script type='text/javascript'>alert('$rows');</script>";

                if($rows != 0){
                    while($row = mysql_fetch_assoc($query)){
                        $filePath = $row['filePath'];
                    }
                }

                return $filePath;
            }

            function getFilenames(){
                $path = getFilepath();
                $filenames = array();
                if ($handle = opendir($path)) {

                    while (false !== ($entry = readdir($handle))) {
                        //make sure its a file and not a dir
                        if ($entry != "." && $entry != "..") {
                            array_push($filenames, $entry);
                        }

                    }
                    return $filenames;
                    closedir($handle);
                }

            }

            // function downloadFile($filename){
            //     $path = getFilepath() . $filename;
            //     if(file_exists($path) && is_readable($path)){
            //         $size = filesize($path);

            //         header("Cache-Control: public");
            //         header("Content-Description: File Transfer");
            //         header("Content-Disposition: attachment; filename=\"$filename\"");
            //         header("Content-Type: application/zip");
            //         header("Content-Transfer-Encoding: binary");
            //         readfile($path);

            //         // read the file from disk
            //         // readfile($path);
            //         // echo $size;
            //         // header('Content-Type: application/octet-stream');
            //         // header('Content-Length: '.$size);
            //         // header('Content-Disposition: attachment; filename='.$filename);
            //         // header('Content-Transfer-Encoding: binary');
            //         // $file = @ fopen($path, 'rb'); //read bytes
            //         // echo "made it past headers";

            //         // //output the file for download and exit
            //         // if($file){
            //         //     echo "made it :)";
            //         //     fpassthru($file);
            //         // //     exit;
            //         // }
            //         // else{
            //         //     echo "unable to get the requested file";
            //         // }
            //     }
            // }


        ?>

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

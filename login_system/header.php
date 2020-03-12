<?php
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <link rel="stylesheet" href="style.css" type="text/css">    

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
        <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.css"> 

    </head>
    <body>
        <header>
            <nav class=" nav navbar-expand-md navbar-light  bg-warning m-1">
                <a class="navbar-brand" href="#">
                    <img src="media/VisualxPrintsLogo.jpg" alt="visualxprints logo" width="50" height="50">VxP
                </a>
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapseNavbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse navbar-expand-sm" id="collapseNavbarNav">
                    <ul class="navbar-nav mr-auto mt-0 mt-lg-0">
                        <li class=" nav-item">
                            <a class="nav-link " href="login-system.php">Home<span  class="sr-only">(current)</span></a> <!--redirecting problem-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                    </ul>

                    <?php
                    if (isset($_SESSION['idUser'])) {
                        echo ('<form action="./inc/logout.inc.php" method="post">
                                <button class="btn btn-dark m-1" type="submit" name="btnLogout-submit">Log out</button>
                               </form>');
                    } else {
                        echo ('<form class="form-inline" action="./inc/login.inc.php" method="post">
                                <input type="text" name="newUserEmail" placeholder="Username/E-mail...">
                                <input type="password" name="newUserPassword" placeholder="Password...">     
                                <button type="submit" name="btnLogin-submit">Login</button>
                                    <div class="row">
                                        <span class="col">Not registered ?<a class="btn-link" href="./sign-up.php">Sign Up</a></span>
                                    </div>
                                </form>');
                    }
                    ?>           
                </div>       
            </nav>
        </header>
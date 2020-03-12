<?php
if (isset($_SESSION['usernameUser'])) {
    header("Location: ./login-system.php"); 
    exit();
}


if (isset($_POST['btnLogin-submit'])) {
    require ('./dblogin-system.inc.php');

    $email = $_POST['newUserEmail'];
    $userPassword = $_POST['newUserPassword'];
    $username = $_POST['newUserEmail'];

    if (empty($email) || empty($userPassword)) {
        header("Location: ../login-system.php?error=emptyfields");
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9+@.]*$/", $email)) {
        header("Location: ../login-system.php?error=invalidemailorusernameId");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE usernameUsers= ? OR emailUsers =?"; //prepaired statment check for username or email on DB but no results return
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login-system.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt); //raw data
            
                if ($row = mysqli_fetch_assoc($results)) {
                    $passwordCheck = password_verify($userPassword, $row['pwdUsers']);
                    if ($passwordCheck == false) {
                        header("Location : ../login-system.php?error=invalidpassword");
                        exit();
                    } else if ($passwordCheck == true) {
                        session_start();
                        $_SESSION['idUser'] = $row['idUsers'];
                        $_SESSION['usernameUser'] = $row['usernameUsers'];

                        header("Location : ../login-system.php?signup=success");
                        exit();
                    } else {
                        //incorrect format
                        header("Location : ../login-system.php?error=invalidpassword");
                        exit();
                    }
                } else {
                    header("Location : ../login-system.php?error=invaliduser");
                    exit();
                }
            } 
//            else {
//                header("Location : ../login-system.php?error=invaliduser");
//                exit();
//            }
        }
    }  else {
    header("Location: ../login-system.php"); 
    exit();
}

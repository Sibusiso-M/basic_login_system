<?php

if (isset($_POST['btnSign-up-submit'])) {
    require ('./dblogin-system.inc.php'); //access to var conn
    $username = $_POST['usernameId'];
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];
    $confirmPassword = $_POST['userConfirmPassword'];

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        header("Location: ../sign-up.php?error=emptyfields&usernameId=" . $username . "&userEmail=" . $email);  //Sticky 
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $email)) {
        header("Location: ../sign-up.php?error=invalidemail&usernameId=$username");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../sign-up.php?error=invalidemail&usernameId=" . $username);  //Sticky 
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../sign-up.php?error=invalidUsername&userEmail=" . $email); //Sticky email field
        exit();
    } else if ($password !== $confirmPassword) {
        header("Location: ../sign-up.php?error=passwordCheck&usernameId=" . $username . "&userEmail=" . $email); //Sticky 
        exit();
    } else {
        $sql = "SELECT usernameUsers FROM users WHERE usernameUsers = ? OR emailUsers = ? "; //'AND pwdUsers' pre-paired statement in db
        $stmt = mysqli_stmt_init($connection); //attempt to open connection

        if (!mysqli_stmt_prepare($stmt, $sql)) { //check for errors
            header("Location: ../sign-up.php?error=sqlerror1"); //Sticky 
            exit();
        } else { //else if no errors in statment in db ; execute 'SAFE' with user input data
            mysqli_stmt_bind_param($stmt, "ss",$username,$email); // String = s , Integer = i, Boolean = b, Double = d
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

//Add email duplication check

            if ($resultCheck > 0) { //check for existing matching usernameUser/rows
                header("Location: ../sign-up.php?error=accounttaken"); //Sticky email field
                exit();
            } else { //INSERT new user into db
                $sql = "INSERT INTO users (usernameUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($connection);

                if (!mysqli_stmt_prepare($stmt, $sql)) { //check if we can $stmt replaced by $sql and run in the db
                    header("Location: ../sign-up.php?error=sqlerror2"); //Sticky 
                    exit();
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword); // String = s , Integer = i, Boolean = b, Double = d
                    mysqli_stmt_execute($stmt);
                    header("Location: ../sign-up.php?signup=success");
                    exit();
                }
            }
        }
    }

    //Close connection
    mysqli_stmt_close();
    mysqli_close($connection);
} else { //unauthorised access to sign-up.inc.php
    header("Location: ../sign-up.php?");
    exit();
}
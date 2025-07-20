<?php
    //@ has to run whenever someone clicks the logout button at there logged in dashboard page
    session_start();
    try{
        if (isset($_SESSION['firstName'])) {
            session_unset();
            session_destroy();
        }
        header("Location: login.php?message=" . urlencode("You have successfully logged out."));
        exit();
    }catch (ArgumentCountError $e) {
        echo $e->getMessage();
    }
?>
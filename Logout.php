<?php
// remove all session variables
session_start();
if($_SESSION["username"] == null){
    header( 'Location: signup.php' ) ;
}else{
session_unset();
// destroy the session
session_destroy();
header( 'Location: signup.php' ) ;
}
?>
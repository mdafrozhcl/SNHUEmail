<?php
$servername = "localhost:3306";
$dbuser = "root";
$dbpass = "reset!@#";
$dbname = "mydB";
session_start();
if($_SESSION["username"] == null)
{
    header("Location: signup.php");
}else
{
    if(isset($_POST['send']))
    {
        $to = $_POST['to'];
        $sub = $_POST['sub'];
        $body =$_POST['msg'];
        $from = $_SESSION["username"];
        // Create connection
        $conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
        // Check connection
        if ($conn->connect_error) {
            header("Location: index.php") ;
        }
        $sql = "INSERT INTO snhumail(username,fromuser,subject,msg,type) VALUES ('".trim($to)."','$from', '$sub', '$body','inbox')";
        $conn->query($sql);
        
        $conn->close();
        header("Location: index.php");
    }else
    {
       $to = $_POST['to'];
        $sub = $_POST['sub'];
        $body =$_POST['msg'];
        $from = $_SESSION["username"];
        // Create connection
        $conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
        // Check connection
        if ($conn->connect_error) {
            header("Location: index.php") ;
        }
        $sql = "INSERT INTO snhumail(username,fromuser,subject,msg,type) VALUES ('$to','$from', '$sub', '$body','draft')";
        $conn->query($sql);
        
        $conn->close();
        header("Location: index.php"); 
    }  
}
?>
<?php
$servername = "localhost:3306";
$dbuser = "root";
$dbpass = "reset!@#";
$dbname = "mydB";
session_start();
if($_SESSION["username"] != null){
    header( 'Location: index.php' ) ;
}else{
    if(isset($_POST['log']))
    {
    // Create connection
    $conn = mysql_connect($servername, $dbuser, $dbpass);
    // Check connection
    if (!$conn) {
        echo "Connection failed echo ". "<a href='signup.php'>Back</a>";
    }
        $username = $_POST['semail'];
        $userpass = $_POST['spassword'];
    $sql = "select * from users where username='$username' and password='$userpass'";
    
mysql_select_db($dbname);
$retval = mysql_query( $sql, $conn );
    
    if ($retval) {
        session_start();
        while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
        {
            $_SESSION["username"] = $row["username"]; 
        } 
        mysql_free_result($retval);
        header("Location: index.php");
        die();
    } else { ?>
<html>
<head>
    <meta charset="utf-8">
    <title>SNHUemail-Signin</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="jquery-ui.css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <style>            
        label{
            font-family: 'Lobster', cursive;
            font-size: xx-large;
            color: #808080;
        }

        .ui-menu {
            width: 150px;
        }

        .ui-li .ui-btn-text a.ui-link-inherit {
            white-space: nowrap;
        }

        body {
            font-size: 62.5%;
            background-position: center center;
            background-color: lightgoldenrodyellow;
            background-image: url(../Content/themes/base/images/3lg.jpg);
            -moz-background-size: cover;
            -webkit-background-size: cover;
            background-size: cover;
            background-position: top center !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed;
        }

        div.transbox {
            width: 400px;
            height: 180px;
            margin: 30px 50px;
            background-color: #ffffff;
            border: 1px solid black;
            opacity: 0.8;
            filter: alpha(opacity=60); /* For IE8 and earlier */
        }

        label, input {
            display: block;
        }

            input.text {
                margin-bottom: 12px;
                width: 95%;
                padding: .4em;
            }

        fieldset {
            padding: 0;
            border: 0;
            margin-top: 25px;
        }

        h1 {
            font-size: xx-large;
            margin: .6em 0;
            text-align:center

        }

        div#users-contain {
            width: 350px;
            margin: 20px 0;
        }

            div#users-contain table {
                margin: 1em 0;
                border-collapse: collapse;
                width: 100%;
            }

                div#users-contain table td, div#users-contain table th {
                    border: 1px solid #eee;
                    padding: .6em 10px;
                    text-align: left;
                }

        .ui-dialog .ui-state-error {
            padding: .3em;
        }

        .validateTips {
            border: 1px solid transparent;
            padding: 0.3em;
        }

        .h1b {
            color: green;
            font-family: 'Times New Roman', Times, serif;
            font-size: xx-large;
        }

        .h1a {
            color: darkred;
            font-family: 'Times New Roman', Times, serif;
            font-size: xx-large;
        }
    </style>
</head>
    <body>
<?php
        echo "<center>Error: ";
        echo "<a href='signup.php'>Back</a></center>";
    }
    mysql_close($conn);
}
}
?>
    <label style="position: fixed; width: auto; height: auto; top: 10px; left: 500px">Southern New Hampshre mail</label>
    <label style="position: fixed; width: auto; height: auto; top: 10px; right: 50px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:small;"><?php echo $_SESSION["username"] ?></label>
    </body>
    </html>
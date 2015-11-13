<html>
<head>
    <meta charset="utf-8">
    <title>SNHUemail-newUser</title>
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
    if($_SESSION["username"] ==null)
    {
    if(isset($_POST['add']))
    {
        $dbhost = 'localhost:3306';
        $dbuser = 'root';
        $dbpass = 'reset!@#';
        $conn = mysql_connect($dbhost, $dbuser, $dbpass);
        if(! $conn )
        {
           echo  "<h1 class='h1a'>Error!! with database connections</h1>";
           echo "<a href='signup.php'>Back</a>";  
        }

        if(! get_magic_quotes_gpc() )
        {
            $username = addslashes ($_POST['email']);
            $userpass = addslashes ($_POST['password']);
        }
        else
        {
            $username = $_POST['email'];
            $userpass = $_POST['password'];
        }
        

        $sql = "INSERT INTO users ".
               "(username,password) ".
               "VALUES('$username','$userpass')";
        mysql_select_db('mydb');
        $retval = mysql_query( $sql, $conn );
        if(! $retval )
        {
            echo "<h1 class='h1a'>Error!! can not insert duplicate user</h1>";  
            echo "<a href='signup.php'>Back</a>";
            
            
        }else{
        echo "<h1 class='h1b'>Entered data successfully</h1>";
        echo "<a href='index.php'>Continue signin</a>";
        session_start();
        $_SESSION["username"] = $username;
        }
        
        mysql_close($conn);
    }else
        header("Location: index.php") ;
    }else{
        header("Location: index.php") ;
    }
    ?>
</body>
</html>

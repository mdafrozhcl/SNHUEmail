<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SNHUemail-draft</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
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
background-position: center center; 
background-color:lightgoldenrodyellow; 
background-image:url(../Content/themes/base/images/3lg.jpg); 
-moz-background-size: cover;
-webkit-background-size: cover;
background-size: cover;
background-position: top center !important;
background-repeat: no-repeat !important;
background-attachment: fixed;
}
                table{
            border: none;
        }
        th, td {
    border: 1px solid black;
    border-color: darkgoldenrod;
}
        textarea {
            resize: none;
        }
    </style>
     <script>
         $(function () {
             $("#menu").menu();
         });
</script>
</head>
<body>
    <?php 
    session_start();
    if($_SESSION["username"] == null){
    header( 'Location: signup.php' ) ;
    }else{ ?>
    <ul id="menu" class="ui-menu" style="font-family: &quot;Trebuchet MS&quot;, &quot;Lucida Sans Unicode&quot;, &quot;Lucida Grande&quot;, &quot;Lucida Sans&quot;, Arial, sans-serif; font-size: medium">
        <li><span class="ui-icon ui-icon-home"></span>Home
            <ul>
                <li><span class="ui-icon ui-icon-mail-open"></span><a href="index.php">Inbox</a></li>
                <li><span class="ui-icon ui-icon-pencil"></span><a href="compose.php">Compose</a></li>
                <li><span class="ui-icon ui-icon-mail-closed"></span><a href="sent.php">Sent</a></li>
                <li><span class="ui-icon ui-icon-note"></span><a href="#">Draft</a></li>
                <li><span class="ui-icon ui-icon-trash"></span><a href="trash.php">Trash</a></li>
                <li><span class="ui-icon ui-icon-stop"></span><a href="Logout.php">Logout</a></li>
                
            </ul>
        </li>
    </ul>
    <?php
    
        
        $dbhost = 'localhost:3306';
        $dbuser = 'root';
        $dbpass = 'reset!@#';
        $conn = mysql_connect($dbhost, $dbuser, $dbpass);
        if(! $conn )
        {
            echo "<h1>Connection Error...</h1>";
        }
        $sql = "SELECT * from snhumail where id=".$_GET["id"];
        mysql_select_db('mydb');
        $retval = mysql_query( $sql, $conn );
        if(! $retval )
        {
            echo "<h1>SQL Error...</h1>";
        }
        
        echo "<br/><br/><br/><br/><center>";
        while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
        {
            
            echo '<input type="text" class="input" style="width: 500px; height: 30px;" value="'.$row["username"].'" readonly/><br/>';
            echo '<input type="text" class="input" style="width: 500px; height: 30px;" value="'.$row["fromuser"].'" readonly/><br/>';
            echo '<input type="text" class="input" style="width: 500px; height: 30px;" value="'.$row["subject"].'" readonly/><br/>';
            echo '<textarea  name="msg" style="width: 500px; height: 300px" readonly >'.$row["msg"].'</textarea><br/>';
        } 
        echo "</center>";
        
        mysql_close($conn);
    
    }
    ?>
    
    <label style="position: fixed; width: auto; height: auto; top: 10px; left: 500px">Southern New Hampshre mail</label>
    <label style="position: fixed; width: auto; height: auto; top: 10px; right: 50px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:small;"><?php echo $_SESSION["username"] ?></label>
</body>
</html>

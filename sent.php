<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SNHUemail -sent</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
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
                table{
            border: none;
        }
        th, td {
    border: 1px solid black;
    border-color: darkgoldenrod;
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
    <ul id="menu" class="ui-menu" style="font-family: &quot; trebuchet ms&quot; , &quot; lucida sans unicode&quot; , &quot; lucida grande&quot; , &quot; lucida sans&quot; , arial, sans-serif; font-size: medium">
        <li><span class="ui-icon ui-icon-home"></span>Home
            <ul>
                <li><span class="ui-icon ui-icon-mail-open"></span><a href="index.php">Inbox</a></li>
                <li><span class="ui-icon ui-icon-pencil"></span><a href="compose.php">Compose</a></li>
                <li class="ui-state-disabled"><span class="ui-icon ui-icon-mail-closed"></span><a href="#">Sent</a></li>
                <li><span class="ui-icon ui-icon-note"></span><a href="Draft.php">Draft</a></li>
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
        $sql = "SELECT id,username,subject from snhumail where fromuser='".$_SESSION["username"]."' and type='inbox'";

        mysql_select_db('mydb');
        $retval = mysql_query( $sql, $conn );
        if(! $retval )
        {
            echo "<h1>SQL Error...</h1>";
        }
        
        echo "<br/><br/><br/><br/><center><table><col width='15'><col width='255'><col width='350'><tr><th></th><th>To</th><th>Subject</th></tr>";
        while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
        {
            echo '<tr><td><a href="delete.php?id=' . $row['id'] . '&type=sent"><input type="button" value="Delete"></a></td>'."<td>".$row["username"]."</td><td><a href='readmail.php?id=".$row["id"]."'>".$row["subject"]."</a></td></tr>";
        } 
        echo "</table></center>";
       
        mysql_close($conn);
        
    
    }
    ?>
    
    <label style="position: fixed; width: auto; height: auto; top: 10px; left: 500px">Southern New Hampshre mail</label>
    <label style="position: fixed; width: auto; height: auto; top: 10px; right: 50px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:small;"><?php echo $_SESSION["username"] ?></label>
</body>
</html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SNHUemail-trash</title>
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
                <li><span class="ui-icon ui-icon-note"></span><a href="Draft.php">Draft</a></li>
                <li ><span class="ui-icon ui-icon-trash"></span><a href="#">Trash</a></li>
                <li><span class="ui-icon ui-icon-stop"></span><a href="Logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
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
              
                $from = $_SESSION["username"];
                // Create connection
                $conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    header("Location: index.php") ;
                }
                if($_GET["type"]== "inbox")
                    $sql = "update snhumail set type='trash' where id=".$_GET["id"];
                if($_GET["type"]== "trash")
                    $sql = "delete from snhumail where id=".$_GET["id"];
                if($_GET["type"]== "sent")
                    $sql = "update snhumail set type='trash' where id=".$_GET["id"];
                if($_GET["type"]== "draft")
                    $sql = "update snhumail set type='trash' where id=".$_GET["id"]." and fromuser='".$_SESSION["username"]."'";   
                $conn->query($sql);
                
                $conn->close();
                if($_GET["type"]== "sent")
                header("Location: sent.php");
                if($_GET["type"]== "draft")
                    header("Location: draft.php");
                if($_GET["type"]== "trash")
                    header("Location: trash.php");
                if($_GET["type"]== "inbox")
                    header("Location: index.php");
            
        }
    }
    ?>

    <label style="position: fixed; width: auto; height: auto; top: 10px; left: 500px">Southern New Hampshre mail</label>
    <label style="position: fixed; width: auto; height: auto; top: 10px; right: 50px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:small;"><?php echo $_SESSION["username"] ?></label>
    </body>
</html>

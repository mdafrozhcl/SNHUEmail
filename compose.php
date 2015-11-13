<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SNHUemail-Compose</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <style>
        label {
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

        textarea {
            resize: none;
        }
    </style>
    <script>
        $(function () {

            $("#menu").menu();
            var characters = 230;
            $("#counter").append(characters);
            $("#text").keyup(function () {
                if ($(this).val().length > characters) {
                    $(this).val($(this).val().substr(0, characters));
                }
                var remaining = characters - $(this).val().length;
                $("#counter").html(remaining);
                if (remaining <= 10) {

                    $("#counter").css("color", "red");
                }
                else {
                    $("#counter").css("color", "0094ff");
                }
            });

        });
        $("#input").keydown(function (e) {
            if (e.keyCode == 13) { // enter key was pressed
                // run own code
                return false; // prevent execution of rest of the script + event propagation / event bubbling + prevent default behaviour
            }
        });
    </script>
</head>
<body>
    <?php 
    session_start();
    if($_SESSION["username"] == null){
        header( 'Location: signup.php' ) ;
    }else{  ?>
    <ul id="menu" class="ui-menu" style="font-family: &quot; trebuchet ms&quot; , &quot; lucida sans unicode&quot; , &quot; lucida grande&quot; , &quot; lucida sans&quot; , arial, sans-serif; font-size: medium">
        <li><span class="ui-icon ui-icon-home"></span>Home
            <ul>
                <li><span class="ui-icon ui-icon-mail-open"></span><a href="index.php">Inbox</a></li>
                <li class="ui-state-disabled"><span class="ui-icon ui-icon-pencil"></span><a href="#">Compose</a></li>
                <li><span class="ui-icon ui-icon-mail-closed"></span><a href="Sent.php">Sent</a></li>
                <li><span class="ui-icon ui-icon-note"></span><a href="Draft.php">Draft</a></li>
                <li><span class="ui-icon ui-icon-trash"></span><a href="Trash.php">Trash</a></li>
                <li><span class="ui-icon ui-icon-stop"></span><a href="Logout.php">Logout</a></li>

            </ul>
        </li>
    </ul>
    <br />
    <br />
    <br />
    <br />
    <center>
    <form  id="input_form"  method="POST" action="/send.php">
    <input type="text" class="input" name="to" style="width: 500px; height: 30px;" value="to address" /><br/>
    <input type="text" class="input" name="sub" style="width: 500px; height: 30px;" value="Subject" /><br/>
    <textarea  name="msg" id="text" style="width: 500px; height: 300px" >Message</textarea><br/>
    <button type="submit" name="send" style="position: fixed; top: 450px; right: 440px">Send</button>
    <button type="submit" name="save" style="position: fixed; top: 450px; right: 500px">Save</button>
    </form>
    <div  id="counter" style="position: fixed; top: 450px; right: 570px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:small; color: #0094ff"></div>
    </center>
    <?php 
    }
    ?>

    <label style="position: fixed; width: auto; height: auto; top: 10px; left: 500px">Southern New Hampshire mail</label>
    <label style="position: fixed; width: auto; height: auto; top: 10px; right: 50px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: small;"><?php echo $_SESSION["username"] ?></label>
</body>
</html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SNHUemail-signup</title>
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
            font-size: 1.2em;
            margin: .6em 0;
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
            font-size: x-large;
        }

        .h1a {
            color: darkred;
            font-family: 'Times New Roman', Times, serif;
            font-size: x-large;
        }
    </style>
    <script>
        $(function () {
            var dialog, form,

            emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
            email = $("#email"),
            password = $("#password"),
            allFields = $([]).add(email).add(password),
            tips = $(".validateTips");
            function updateTips(t) {
                tips
                .text(t)
                .addClass("ui-state-highlight");
                setTimeout(function () {
                    tips.removeClass("ui-state-highlight", 1500);
                }, 500);
            }
            function checkLength(o, n, min, max) {
                if (o.val().length > max || o.val().length < min) {
                    o.addClass("ui-state-error");
                    updateTips("Length of " + n + " must be between " +
                    min + " and " + max + ".");
                    return false;
                } else {
                    return true;
                }
            }
            function checkRegexp(o, regexp, n) {
                if (!(regexp.test(o.val()))) {
                    o.addClass("ui-state-error");
                    updateTips(n);
                    return false;
                } else {
                    return true;
                }
            }

            dialog = $("#dialog-form").dialog({
                autoOpen: false,
                height: 300,
                width: 350,
                modal: true,
                buttons: [
       {
           text: "Create User",
           click: function () {
               var valid = true;
               allFields.removeClass("ui-state-error");

               valid = valid && checkLength(email, "email", 6, 80);
               valid = valid && checkLength(password, "password", 5, 16);

               valid = valid && checkRegexp(email, emailRegex, "eg. ui@snhutest.edu");
               valid = valid && checkRegexp(password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9");

               if (valid) {
                   dialog.dialog("close");
                   form.submit();
               }
               return valid;

           },
           type: "submit",
           name: "add",
           form: "dialog-form"
       },
       {
           text: "Close",
           click: function () {
               $(this).dialog("close");
           }
       }
                ],
                close: function () {
                    form[0].reset();
                    allFields.removeClass("ui-state-error");
                }
            });

            $("#create-user").button().on("click", function () {
                dialog.dialog("open");
            });
            $("#login").button().on("click", function () {

            });
        });
        
    </script>
</head>
<body>
    <?php 
    session_start();
    if($_SESSION["username"] != null){
    header( 'Location: index.php' ) ;
    }else{?>
    <form method="post" action="newuser.php" id="dialog-form" title="User Signup">
        <p class="validateTips">All form fields are required.</p>
        <fieldset>
            <label for="email" style="font-family:'Times New Roman', Times, serif; font-size: medium;" >username</label>
            <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
            <label for="password" style="font-family:'Times New Roman', Times, serif; font-size: medium;">password</label>
            <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all">

            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input type="submit" name="add" tabindex="-1" style="position: absolute; top: -1000px">
        </fieldset>
    </form>

    <div id="users-contain" class="transbox" style="position: fixed; top: 150px; right: 500px; bottom: 500px; left: 500px">
        <form name="login" action="login.php" method="post">
        <h1 style="text-align: center; font-size:x-large" class="msg">SignIn</h1>
        <table id="users" class="ui-widget ui-widget-content">
            <tbody>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="semail" id="semail" class="text ui-widget-content ui-corner-all"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="spassword" id="spassword" class="text ui-widget-content ui-corner-all"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button id="login" type="submit" name="log">Login</button>&nbsp;&nbsp;
                        <button type="button" id="create-user">New User</button>
                    </td>
                </tr>
            </tbody>
        </table>
            </form>
    </div>

   <?php }
    ?>
    <label style="position: fixed; width: auto; height: auto; top: 10px; left: 500px">Southern New Hampshre mail</label>
</body>
</html>

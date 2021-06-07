<?php
session_start();
?>
<html>
<head>
    <title>Login Screen</title>
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
    <meta charset="utf-8">
    <style type="text/css">
        input {margin: 5px;}
        body {text-align: center;}
        h3 {font-family: 'Fjalla One', sans-serif;
    	    font-size: 25px;}
    </style>
</head>
<body>
    <div id="header">
        <center><span class="logo" style="font-family: 'Fjalla One', sans-serif; font-size: 50px;"><a href="index.php" style="color:black; text-decoration:none;"> To Do List</a></span></center>
    </div><!--header-->

    <h3>Your credentials for your identification</h3>
    <form action="php/loggingHandler.php" method="POST">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="pswd" placeholder="Password"><br>
        <input type="submit" value="Login">
    </form>
    <h3><?php
    if (isset($_SESSION["loginError"])) {
        echo $_SESSION["loginError"] . "<br>";
    unset($_SESSION["loginError"]);
    }

     ?></h3>
     <span style="font-size:20px;">If you are not registered, you can register <a style="color:blue; text-decoration:none;" href="Register.php">here</a>.
</body>
</html>

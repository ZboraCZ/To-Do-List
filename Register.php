<?php
session_start();
?>
<html>
<head>
    <title>Register Screen</title>
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <style type="text/css">
        input {margin: 5px;}
        body {text-align: center;}
        h3 {font-family: 'Fjalla One', sans-serif;
    	    font-size: 25px;
        }
    </style>
</head>
<body>
    <div id="header">
        <!-- <center><span class="logo" style="font-family: 'Fjalla One', sans-serif; font-size: 50px;"><a href="index.php" style="color:black; text-decoration:none;"> To Do List</a></span></center> -->
    </div><!--header-->
	
	<script src="js/RegisterValidation.js"></script> <!-- Client-side validation of inputs -->	

<h3>Your credentials for successfull registration</h3><br>
<span>All fields required</span>
    <form name="registeringForm">
        <input type="text" name="firstName" placeholder="First Name"><br>
        <input type="text" name="lastName" placeholder="Last Name"><br>
        <input type="text" id="username" name="username" placeholder="Username"><br>
		<input type="email" name="email" placeholder="E-mail"><br>
        <input type="password" name="pswd_1" placeholder="Password"><br>
		<input type="password" name="pswd_2" placeholder="Repeat password"><br>
    </form>
	<button name="submit_form" onclick="submitRegisterForm()">Register</button>
	
	<h3 id="error_message"></h3>
			
	<h3 name="registerError">
    <h3><?php
			if (isset($_SESSION["registerError"])) {
				echo $_SESSION["registerError"];
				unset($_SESSION["registerError"]);
			}
			?>
	 </h3>
     <span style="font-size:20px;">For possible communication between admin and you, use valid email.</span><br><br>
     <span style="font-size:20px;">If you are registered already, you can <a style="color:blue; text-decoration:none;" href="login.php">login</a> instead.
</body>
</html>

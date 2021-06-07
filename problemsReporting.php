<?php
session_start();
if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
    $username= $_SESSION["username"];
    $email = $_SESSION["email"];
?>
<html>
<head>
    <title>Main Page</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css"
	
	  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>
<body style="text-align:center;">
    <div id="header">
        <center><span class="logo" style="font-family: 'Fjalla One', sans-serif; font-size: 50px;"><a href="index.php" style="color:black; text-decoration:none;"> To Do List</a></span></center>
    </div><!--header-->
        <div class="user-info">
            <?php echo '<span class="email">'.$email.'</span>
                        <span class="username">('.$username.')</span>
                        <a href="exec/logout.php" style="margin-right:30px; margin-left:15px;"> Logout</a>'
            ?>
        </div><!--user-info-->
    <div id="header-menu">
        <ul class="menu-list">
            <li class="menu_item"><a href="index.php">Dashboard</a></li>
            <li class="menu_item" style="margin-left:2.5%; margin-right:2.5%;"><a href="createTask.php">Create Task</a></li>
            <li class="menu_item" style="margin-left:2.5%; margin-right:2.5%;"><a href="privateTasks.php">Private Tasks</a></li>
            <li class="menu_item" style="margin-left:2.5%; margin-right:2.5%;"><a href="publicTasks.php">Public Tasks</a></li>
            <li class="menu_item"><a  class="active" href="problemsReporting.php">Report Problem</a></li>
        </ul><!--menu-list-->
    </div><!--header-menu-->
    <hr>
    <div class="main-news">
<?php
        }
else {
        $_SESSION["kicked"]="You were kicked by the web. Please, login again";
        header('Location: login.php');
}
?>

        <h3>Please, fill in all the fields.</h3>
            <form action="exec/problemsReport.php" method="POST">
                Subject: <input type="text" cols="30" name="subject"><br><br>
                Message: <br>
                <textarea rows="5" name="problem_message" cols="30"></textarea><br><br>
                <input type="submit" Svalue="Send report">
            </form>
            Possible reply will be sent on your email registered on this web.<br><br>
    </div>
</body>
</html>

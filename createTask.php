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
            <li class="menu_item" style="margin-left:2.5%; margin-right:2.5%;"><a class="active" href="createTask.php">Create Task</a></li>
            <li class="menu_item" style="margin-left:2.5%; margin-right:2.5%;"><a href="privateTasks.php">Private Tasks</a></li>
            <li class="menu_item" style="margin-left:2.5%; margin-right:2.5%;"><a href="publicTasks.php">Public Tasks</a></li>
            <li class="menu_item"><a href="problemsReporting">Report Problem</a></li>
        </ul><!--menu-list-->
    </div><!--header-menu-->
    <hr>
    <div class="create-Task">
        <center><h2>Create Task</h2></center>

        <form action="exec/tasksCreator.php" method="POST">
            Date of Completion:<br>
            <input type="date" name="completionDate" min="<?php echo DateTime; ?>"><br><br>
            Task name:<br>
            <input type="text" name="taskName" placeholder="Task name..."><br><br>
            Task description: (Max 255 characters)<br>
            <textarea rows="5" cols="35" name="taskDescription" placeholder="Description..."></textarea><br><br>
            <input type="radio" name="taskType" value="private" checked> Private Task<br>
            <input type="radio" name="taskType" value="public"> Public Task<br><br>
            <center><input type="submit" value="Create"></center>
        </form>
    </div>
    <?php
        if (isset($_SESSION["taskVerification"])) {
            echo $_SESSION["taskVerification"] . "<br>";
        unset($_SESSION["taskVerification"]);
        }

        if (isset($_SESSION["taskCreateError"])) {
            echo $_SESSION["taskCreateError"] . "<br>";
        unset($_SESSION["taskCreateError"]);
        }
    ?>

</body>

</html>
<?php
}
else {
    $_SESSION["kicked"]="You were kicked by the web. Please, login again";
    header('Location: login.php');
}

?>

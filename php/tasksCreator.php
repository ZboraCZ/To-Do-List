<?php
session_start();
if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {

    if (!(isset($_POST["completionDate"])) || !(isset($_POST["taskName"])) || !(isset($_POST["taskDescription"])) || !(isset($_POST["taskType"]))) {
        $_SESSION["taskCreateError"] = "You have some empty fields there!";
        header("Location: ../createTask.php");
    }
    if (!empty($_POST["completionDate"]) && !empty($_POST["taskName"]) && !empty($_POST["taskDescription"]) && !empty($_POST["taskType"])) {

        $servername = "localhost";
        $database = "usersLogging";
        $username = "root";
        $password = "";

        try {
            $db = new PDO("mysql:host=$servername; dbname=$database", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            // set the PDO error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }

            /* Execute a prepared statement by passing an array of values */
        $sql = "INSERT INTO tasks (user, taskName, taskDescription, completionDate, taskCreated, taskType)
                          VALUES (:user, :taskName, :taskDescription, :completionDate, :taskCreated, :taskType)";
        $query = $db->prepare($sql);
        $query->execute(array(':user' => $_SESSION["username"], ':taskName' => $_POST["taskName"],
                                ':taskDescription' => $_POST["taskDescription"], ':completionDate' => $_POST["completionDate"],
                                  ':taskCreated' => date("Y-m-d H:i:s"), ':taskType' => $_POST["taskType"]));
        $_SESSION["taskVerification"]="Your task has been created correctly";
        $db = null;
        header("Location: ../createTask.php");
        }
        }

else {
    $_SESSION["loginError"] = "You were kicked by the web. Please, login again!";
    header("Location: ../login.php");
}


 ?>

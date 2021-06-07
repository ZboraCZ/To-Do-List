<?php
session_start();
if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {	//check the email if its valid first
  $_SESSION["registerError"] = "You typed invalid e-mail!";
  header("Location: ../Register.php");
  exit;
}

if (!empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["username"])	//if user typed valid inputs
    && !empty($_POST["pswd_1"]) && (!empty($_POST["email"]))) {

        $hashed_pswd = hash('sha512', $_POST["pswd"]);      //HASHED USER PASSWORD

        $servername = "localhost";
        $database = "usersLogging";
        $username = "root";
        $password = "";

        try {
                $db = new PDO("mysql:host=$servername; dbname=$database", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                // set the PDO error mode to exception
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully";

                $sql = "SELECT * FROM users WHERE username= :username OR email= :email";	// chceck in database if username or email already exists
                $query = $db->prepare($sql);
                $query->execute(array(':username' => $_POST["username"], ':email' => $_POST["email"]));
                $result=$query->fetch(PDO::FETCH_ASSOC);
                if (!($result==null)){      //IF THERE IS USERNAME OR EMAIL IN THE TABLE ALREADY
                    $_SESSION['registerError']="User with this username or email already exists.";
                    header("Location: ../Register.php");
                    exit;
                }

                /* Execute a prepared statement by passing an array of values */
                $sql = "INSERT INTO users (firstName, lastName, username, password, email)
                                  VALUES (:firstName, :lastName, :username, :password, :email)";
                $query = $db->prepare($sql);
                $query->execute(array(':firstName' => $_POST["firstName"], ':lastName' => $_POST["lastName"],
                                        ':username' => $_POST["username"], ':password' => $hashed_pswd,
                                          ':email' => $_POST["email"]));
                $db = null;
                $_SESSION["loginError"] = "You are registered successfully! Now you can log in.";
                header("Location: ../index.php");
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();

        }
}

else	//if user did not type valid inputs
{
    $_SESSION["registerError"] = "You have some empty fields there!";
    header("Location: ../Register.php");
}
?>

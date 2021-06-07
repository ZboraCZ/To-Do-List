<?php
session_start();
if (empty($_POST["username"]) || (empty($_POST["pswd"]))) {
    $_SESSION["loginError"]='Wrong credentials';
    header("Location: ../login.php");
  exit;
}

if (!empty($_POST["username"]) && (!empty($_POST["pswd"]))) {

    $hashed_pswd = hash('sha512', $_POST["pswd"]);

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
$sql = "SELECT * FROM users WHERE username= :username AND password= :pswd";
$query = $db->prepare($sql);
$query->execute(array(':username' => $_POST["username"], ':pswd' => $hashed_pswd));
$result=$query->fetch(PDO::FETCH_ASSOC);
if ($result==null){
    $_SESSION['loginError']="You entered invalid username or password";
    header("Location: ../login.php");
    exit;
}
if(!($result==null)){
$_SESSION["firstName"] = $result["firstName"]; $_SESSION["lastName"] = $result["lastName"];
$_SESSION["username"] = $result["username"];   $_SESSION["email"] = $result["email"];
$db = null;
header("Location: ../index.php");
}
}
else
{
    $_SESSION["loginError"] = "You have some empty fields there!";
    header("Location: ../login.php");
    exit;
}
?>

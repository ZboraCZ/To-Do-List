
<?php
session_start();
$to = "jirkazboril1997@gmail.com";
$subject = $_POST["subject"];
$txt = $_POST["problem_message"];
$header = "From: " . $_SESSION["lastName"]. ", ". $_SESSION["firstName"]. "<". $_SESSION["email"] . ">". "; ". "\r\n"
          . "Username: ". $_SESSION["username"]. "\r\n";

mail($to,$subject,$txt,$header);
?>

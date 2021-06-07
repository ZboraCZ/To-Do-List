<?php
$servername = "localhost";
$dbname = "userslogging";
$username="root";
$password = "";

try {
$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $db->prepare("SELECT * FROM Tasks WHERE taskType='public'");
$query->execute();
$rows= $query->rowCount();
$result = $query->FetchAll();
if (!(empty($result))) {

  foreach ($result as $res) {
      if ($res['done']==1){
          echo "<li class='item-done'>"."<b>User</b>: ".$res['user']." | "."<b>Task Created: </b>".$res['taskCreated']." | "
                 ."<b>Completion Date: </b>".$res['completionDate']." "
                 ."<a class='done-button' href='exec/mark.php?section=public&as=done&item=".$res["ID"]."'>Mark as done</a>"
                 ."<a class='delete-button' href='exec/deleteTask.php?section=public&item=".$res["ID"]."'>Delete</a><br>"
                 ."<b>Task Name: </b>".$res["taskName"]." <br> "."<b>Task Description: </b>".$res["taskDescription"]
          ."</li>".'<br>';
     }
     else {
         echo "<li>"."<b>User</b>: ".$res['user']." | "."<b>Task Created: </b>".$res['taskCreated']." | "
                ."<b>Completion Date: </b>".$res['completionDate']." "
                ."<a class='done-button' href='exec/mark.php?section=public&as=done&item=".$res["ID"]."'>Mark as done</a>"."<br>"
                ."<b>Task Name: </b>".$res["taskName"]." <br> "."<b>Task Description: </b>".$res["taskDescription"]
         ."</li>".'<br>';
         }
  }
}
else {
    echo "<h3>You have no Tasks at this moment.<h3>";
}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$db = null;
?>

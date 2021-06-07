<?php
session_start();
$servername = "localhost";
$dbname = "userslogging";
$username="root";
$password = "";

$admin=false;
if ($_SESSION["username"]=='admin'){        //if ADMIN is logged in
    $admin=true;
}

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($admin) {
                if ($_GET["section"]=="private" && isset($_GET['item'])) {
                    $item = $_GET['item'];
                            $sql = "DELETE FROM Tasks WHERE id = :item";
                            $doneQuery = $db->prepare($sql);
                            $doneQuery->execute([':item' => $item]);
                            header('Location: ../privateTasks.php');
                            exit;
                }

                elseif ($_GET["section"]=="public" && isset($_GET["item"])) {
                    $item = $_GET["item"];
                            $sql = "DELETE FROM Tasks WHERE id = :item";
                            $doneQuery = $db->prepare($sql);
                            $doneQuery->execute([':item' => $item]);
                            header('Location: ../publicTasks.php');
                            exit;
                }
    }

    else {  //if NOT admin
            if ($_GET["section"]=="private" && isset($_GET['item'])) {
                $item = $_GET['item'];
                        $sql = "DELETE FROM Tasks WHERE id = :item AND user= :username";
                        $doneQuery = $db->prepare($sql);
                        $doneQuery->execute([':item' => $item, ':username' => $_SESSION['username']]);
                        header('Location: ../privateTasks.php');
                        exit;
            }

            elseif ($_GET["section"]=="public" && isset($_GET['item'])) {
                $item = $_GET['item'];
                        $sql = "DELETE FROM Tasks WHERE id = :item AND user= :username";
                        $doneQuery = $db->prepare($sql);
                        $doneQuery->execute([':item' => $item, ':username' => $_SESSION['username']]);
                        header('Location: ../publicTasks.php');
                        exit;
            }
}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

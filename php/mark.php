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
                    if ($_GET['section']=='private' & isset($_GET['as'], $_GET['item'])) {
                        $as   =   $_GET['as'];
                        $item =   $_GET['item'];
                        switch ($as) {
                            case 'done':
                                $doneQuery = $db->prepare("UPDATE tasks SET done=1 WHERE ID = :item");
                                $doneQuery->execute([':item' => $item]);
                                break;
                        }
                        header('Location: ../privateTasks.php');
                    }

                    elseif ($_GET['section']=='public' & isset($_GET['as'], $_GET['item'])) {
                        $as   =   $_GET['as'];
                        $item =   $_GET['item'];

                        switch ($as) {
                            case 'done':
                                $doneQuery = $db->prepare("UPDATE tasks SET done=1 WHERE ID = :item");
                                $doneQuery->execute([':item' => $item]);
                                break;
                        }
                        header('Location: ../publicTasks.php');
                    }
        }

        if ($_GET['section']=='private' & isset($_GET['as'], $_GET['item'])) {
            $as   =   $_GET['as'];
            $item =   $_GET['item'];

            switch ($as) {
                case 'done':
                    $doneQuery = $db->prepare("UPDATE tasks SET done=1 WHERE ID = :item AND user=:user");
                    $doneQuery->execute([':item' => $item, ':user' => $_SESSION['username'] ]);
                    break;
            }
            header('Location: ../privateTasks.php');
        }

        elseif ($_GET['section']=='public' & isset($_GET['as'], $_GET['item'])) {
            $as   =   $_GET['as'];
            $item =   $_GET['item'];

            switch ($as) {
                case 'done':
                    $doneQuery = $db->prepare("UPDATE tasks SET done=1 WHERE ID = :item AND user=:user");
                    $doneQuery->execute([':item' => $item, ':user' => $_SESSION['username'] ]);
                    break;
            }
            header('Location: ../publicTasks.php');
        }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

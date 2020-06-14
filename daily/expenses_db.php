<?php
    include '../config.php';
    include '../classes/DB.php';
    session_start();

    if(isset($_GET["date"], $_GET["typeExpenses"], $_GET["note"], $_GET["moneyExpenses"], $_SESSION['users'])) {
        $date = $_GET["date"];
        $typeExpenses = $_GET["typeExpenses"];
        $note = $_GET["note"];
        $money1 = $_GET["moneyExpenses"];
        $money2 = str_replace(',','', $money1);
        $moneyExpenses = round($money2,2);
        $user_id = $_SESSION['users']['user_id'];
        $month = intval(explode('-',$date)[1]);

        $conn = DB::getInstance();
        $sql = "INSERT INTO `saving` (`user_id`, `typemoney_id`, `saving_detail`, `saving_value`, `saving_date`, `month_id`) 
                VALUES ('$user_id', '$typeExpenses', '$note', '$moneyExpenses', '$date', '$month')
                ";
        $stmt = $conn->dbh->prepare( $sql );
        $chk_stmt = $stmt->execute();
        $conn = null;
        // $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
        // print_r($result); 
    
        if($chk_stmt) {
            echo "<script>alert('[Insert สำเร็จ]')</script>";
            header("Refresh:0.3; url=http://localhost/zocute/index.php");
        } else {
            echo "Error<br>";
            print_r ($stmt->errorInfo());
            echo $sql;
        }
    }
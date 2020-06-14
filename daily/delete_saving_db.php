<?php
    include '../config.php';
    include '../classes/DB.php';
    session_start();
    
    if(isset($_REQUEST["saving_id"],$_SESSION['users'])) {
        $savingid = $_REQUEST["saving_id"];
        $user_id = $_SESSION['users']['user_id'];
     
        $sql = " DELETE  FROM saving 
                 WHERE user_id = '$user_id' AND saving.saving_id = '$savingid'
                ";
        $conn = DB::getInstance();
        $stmt = $conn->dbh->prepare( $sql );
        $chk_stmt = $stmt->execute();
    
        if($chk_stmt) {
            $results = $stmt->fetchAll( PDO::FETCH_ASSOC );
            //DB::printArray($results);
            echo "<script>alert('ลบข้อมูลสำเร็จ!')</script>";
            header("Refresh:0.5; url=./summarydaily.php");
        } else {
        echo "Error<br>";
        print_r ($stmt->errorInfo());
        echo $sql;
        }
    }
    $conn = null;             
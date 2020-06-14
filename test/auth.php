<?php
    include '../config.php';
    include '../classes/DB.php';

    session_start();

    if(isset($_POST['user'], $_POST['pass'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $conn = DB::getInstance();
        $sql = "SELECT *
                FROM usersaccount
                WHERE user_name = '$user' AND user_pass = '$pass';
             ";
        $stmt = $conn->dbh->prepare( $sql );
        $stmt->execute();
        $results_user = $stmt->fetchAll( PDO::FETCH_ASSOC );
        $conn = null;

        if(sizeof($results_user) != 0) {
            echo "เข้าสู่ระบบสำเร็จ";
            $_SESSION['users'] = $results_user[0];
            echo "<pre>";
            print_r($_SESSION['users']);
            echo "</pre>";
        } else {
            echo "เข้าสู่ระบบไม่สำเร็จ ลองอีกครั้ง";
            header("Refresh:0.5; url=login.php");
        }
    }
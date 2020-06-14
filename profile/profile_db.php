<?php
    include '../config.php';
    include '../classes/DB.php';
    session_start();


    if(isset(
            $_SESSION['users'], 
            $_POST['user_fname'],
            $_POST['user_sname'],
            $_POST['user_gen'],
            $_POST['user_bd'],
            $_POST['user_email'],
            $_POST['user_pass'],
            $_POST['user_rnpass'],
            $_POST['editprofile']
        ) && $_POST['editprofile'] === '1'
        && $_POST['user_pass'] === $_POST['user_rnpass'] ) {

        unset($_POST['editprofile'], $_POST['user_rnpass']);

        $users = $_SESSION['users'];
        $user_id = $users['user_id'];
        
        $npass = ($_POST['user_pass'] !== "")? $_POST['user_pass'] : $users['user_pass'];


        
        $nval_users = array_diff($_POST, $users);

        if(sizeof($nval_users) == 1) {
            echo "<script>alert('ไม่พบการแก้ไขข้อมูล!')</script>";
            header("Refresh:0.5; url=./profile.php");
            die;
        }

        $sql = "UPDATE usersaccount SET ";

        foreach ( $nval_users as $key => $value ) {
            if($value != "") {
                $sql .= $key . " = '" . $value . "', ";
            }
        }
        
        $sql = rtrim( $sql, ", ");
        $sql .= " WHERE user_id = '$user_id'";
        

        $conn = DB::getInstance();
        $stmt = $conn->dbh->prepare( $sql );
        $chk_stmt = $stmt->execute(); // ลองปริ้นค่า $chk_stmt เป็น 1 เท่ากับว่า คิวรี่สำเร็จ

        if($chk_stmt) {
            
            $conn = DB::getInstance();
            $sql = "SELECT *
                    FROM usersaccount
                    WHERE user_name = '".$users["user_name"]."' AND user_pass = '$npass';
            ";
        
            $stmt = $conn->dbh->prepare( $sql );
            $stmt->execute();
            $results_user = $stmt->fetchAll( PDO::FETCH_ASSOC );
            $conn = null;
            $_SESSION['users'] = $results_user[0];

            echo "<script>alert('อัพเดทข้อมูลสำเร็จ!')</script>";
            header("Refresh:0.5; url=./profile.php");
        } else {
            echo "<script>alert('เสียใจ! มีบางอย่างผิดผลาด')</script>";
            DB::printArray($stmt->errorInfo());
            echo $sql;
        }

        $conn = null;
    }


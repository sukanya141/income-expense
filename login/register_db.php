<?php
    include '../config.php';
    include '../classes/DB.php';

    session_start();
    //echo "<pre>";
    //print_r($_POST);
    //echo "</pre>";

    if( isset($_POST["user_fname"]) &&   
        isset($_POST["user_sname"]) &&
        isset($_POST["user_gen"]) &&  
        isset($_POST["user_bd"]) && 
        isset($_POST["user_name"]) &&   
        isset($_POST["user_pass"]) &&   
        isset($_POST["user_cpass"] )&&   
        isset($_POST["user_email"]) )
     {
        $user_email = $_POST["user_email"];
        $user_fname = $_POST["user_fname"];
        $user_sname = $_POST["user_sname"];
        $user_gen = $_POST["user_gen"];
        $user_bd = $_POST["user_bd"];
        $user_name = $_POST["user_name"];
        $user_pass = $_POST["user_pass"];
        $user_cpass = $_POST["user_cpass"];
        $user_email = $_POST["user_email"];
        
        // validate
        if (strlen($user_name) < 6) {
            echo "<script>alert('ชื่อผู้ใช้งานสั้นเกินไป อย่างน้อย 6 ตัวอักษร')</script>";
            header("Refresh:0.5; url=http://localhost/zocute/login/register_1.php");
        }

        elseif (strlen($user_name) > 12) {
            echo "<script>alert('ชื่อผู้ใช้งานยาวเกินไป สูงสุด 12 ตัวอักษร')</script>";
            header("Refresh:0.5; url=http://localhost/zocute/login/register_1.php");
          
        } 

        elseif (strlen($user_pass) < 6) {
            echo "<script>alert('รหัสผ่านสั้นเกินไป อย่างน้อย 6 ตัวอักษร')</script>";
            header("Refresh:0.5; url=http://localhost/zocute/login/register_1.php");
        }

        elseif (strlen($user_pass) > 12) {
            echo "<script>alert('รหัสผ่านยาวเกินไป สูงสุด 12 ตัวอักษร')</script>";
            header("Refresh:0.5; url=http://localhost/zocute/login/register_1.php");
        }

        elseif ($user_pass != $user_cpass) {
            echo "<script>alert('รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่')</script>";
            header("Refresh:0.5; url=http://localhost/zocute/login/register_1.php");
        }
         
        else {
            $conn = DB::getInstance();
            $sql =   "INSERT INTO usersaccount (user_name, user_pass, user_fname, user_sname, user_email, user_gen, user_bd)
                    VALUES (  '$user_name', '$user_pass', '$user_fname', '$user_sname', '$user_email', '$user_gen','$user_bd')
                    "; 
            //echo $sql;
            // print_r($_POST);
            // die;

            $stmt = $conn->dbh->prepare( $sql );
            $chk_stmt = $stmt->execute(); // ลองปริ้นค่า $chk_stmt เป็น 1 เท่ากับว่า คิวรี่สำเร็จ
            if($chk_stmt) {

                $_SESSION['user_registed'] = [
                    'user_name' => $user_name,
                    'user_pass' => $user_pass
                ];

                echo "<script>alert('[Insert สำเร็จ]')</script>";
                header("Refresh:0.5; url=http://localhost/zocute/login/login_1.php");
            } else {
                echo "<script>alert('ชื่อผู้ใช้งานนี้มีอยู่แล้วในระบบ กรุณาลองใหม่')</script>";
                header("Refresh:0.5; url=http://localhost/zocute/login/register_1.php");
                //print_r ($stmt->errorInfo());
                //echo $sql;
            }
            $conn = null; 
        } 
     }
        
    
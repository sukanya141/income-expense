
<?php
 include '../config.php';
 include '../classes/DB.php';

 session_start();
 //echo "<pre>";
//print_r($_POST);
  // echo "</pre>";
 if( isset($_POST["pass"])&& isset($_POST["email"])&&isset($_POST["cpass"])) {
    //$user = $_POST["user"];
    $pass = $_POST["pass"];
    $cpass = $_POST["cpass"];
    $email =$_POST["email"];
   

    if (strlen($pass) < 6) {
        echo "<script>alert('ชื่อผู้ใช้งานสั้นเกินไป อย่างน้อย 6 ตัวอักษร')</script>";
        header("Refresh:0.5; url=http://localhost/zocute/login/forget.php");
    }

    elseif (strlen($pass) > 12) {
        echo "<script>alert('ชื่อผู้ใช้งานยาวเกินไป สูงสุด 12 ตัวอักษร')</script>";
        header("Refresh:0.5; url=http://localhost/zocute/login/forget.php");
      
    }
    elseif ($pass != $cpass) {
        echo "<script>alert('รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่')</script>";
        header("Refresh:0.5; url=http://localhost/zocute/login/forget.php");
    }else {
    $conn = DB::getInstance();
    $sql = "UPDATE usersaccount
            SET user_pass = '$pass';
            WHERE  user_email = '$email';
         ";
         //echo $sql;
         //print_r($_POST);
         //die;
        $stmt     = $conn->dbh->prepare( $sql ); // <-- สร้าง
        $chk_stmt = $stmt->execute(); // ลองปริ้นค่า $chk_stmt เป็น 1 เท่ากับว่า คิวรี่สำเร็จ
        if($chk_stmt) {
            echo "<h3>เปลี่ยนรหัสสำเร็จ</h3>";
            header( "Refresh:0.5; url=http://localhost/zocute/login/login_1.php" );
        } else {
            echo "มีบางอย่างผิดพลาด";
           // print_r ($stmt->errorInfo());
            //echo $sql;
        }
    $conn = null;
    }
}
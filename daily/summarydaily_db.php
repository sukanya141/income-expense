<?php
    include '../config.php';
    include '../classes/DB.php';

    session_start();

    if(isset($_GET["date"],$_SESSION['users'])) {
        $date = $_GET["date"];
        $user_id = $_SESSION['users']['user_id'];

        $conn = DB::getInstance();

        $sql = "SELECT saving.saving_date as savedate,
                       saving.saving_id,
                       saving.saving_detail, 
                       saving.saving_value, 
                       typemoney.type_tran as 'type_trans'
                FROM saving
                INNER JOIN typemoney 
                ON saving.typemoney_id = typemoney.typemoney_id
                WHERE date(saving.saving_date) = '$date' AND saving.user_id = '$user_id' 
                ";
    
        $stmt = $conn->dbh->prepare( $sql );
        $chk_stmt = $stmt->execute();

        if($chk_stmt) {
            $results = $stmt->fetchAll( PDO::FETCH_ASSOC );
            array_push($results, ['input_date' => $date]);
            $_SESSION['results'] = $results;
            header("Refresh:0.3; url=./summarydaily.php");
        } else {
            echo "Error<br>";
            print_r ($stmt->errorInfo());
            echo $sql;
        }
    
    }

    $conn = null;

    
   
    //ส่วนปริ้นสำหรับตรวจสอบ result จากทั้ง 2 คิวรี่
        // echo "<pre>";
        // echo "results_income";
        // print_r($results_income);
        // echo "<hr>";
        // echo "results_expenses";
        // print_r($results_expenses);
        // echo "</pre>";
    // end 


        // echo "<script>alert('สำเร็จ')</script>";
        //         header("Refresh:0.5; url=../daily/income.php");
        //$admin = mysqli_query($user,$pass)     
    
        //$row = mysqli_fetch_array($admin);
        // echo print_r($user,true);
        // echo print_r($pass,true); //เอาไว้ปริ้น ดูค่าที่ select มา
        //count($result);
       // if (sizeof($result) != 0) {
            //$_SESSION["type"] = $result["in_type"];
            //$_SESSION["amount"] = $result["in_amount"];
            //print_r($_SESSION["type"]);
           // print_r($_SESSION["amount"]);
           // die;
           
                // echo "<script>alert('สำเร็จ')</script>";
                // header("Refresh:0.5; url=register_1.php");
            
        //}
    
       
            
        
        /*else {
            $result = mysqli_query($user,$pass);
        ($user = 'admin' && $pass = '1234')
        
        }

       

        }
         else echo '....';
            

            
    /*if(sizeof($result) != 0) {
        $userad = $_GET["uname"];
        $passad = $_GET["psw"];

        $userad = 'admin';
        $passad = '1234';

        header("Refresh:0.5; url=Insert.php");
    }*/
    
        //DB::checkResult($result);
       /* if(isset($result) && sizeof($result) != 0) {
                $_SESSION["name"] = $result["0"]["sup_Name"];
                $_SESSION["email"] = $result["0"]["sup_Email"];
                $_SESSION["phone"] = $result["0"]["sup_Phone"];
                $_SESSION["id"] = $result["0"]["sup_ID"];
                $_SESSION["address"] = $result["0"]["sup_Address"];
        }*/
       // echo json_encode($result);
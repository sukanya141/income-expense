<?php
    include '../config.php';
    include '../classes/DB.php';
    session_start();
    if(isset($_SESSION['users'])) {
        $user_id = $_SESSION['users']['user_id'];

        if(isset($_GET['saving_id'])) {
            $saveid = $_GET['saving_id'];
            $conn = DB::getInstance();
            if(isset($_GET['update'], 
                     $_GET['typeTrans'], 
                     $_GET['saving_date'], 
                     $_GET['typemoney_id'], 
                     $_GET['saving_detail'], 
                     $_GET['saving_value'], 
                     $_GET['saving_id'])) {
                // update when action submit in edit_saving_db.php
                $saving_id = $_GET['saving_id'];
                unset($_GET['typeTrans'], $_GET['saving_id']);
                $_GET['month_id'] = intval(explode('-',$_GET['saving_date'])[1]);
                $_GET['saving_value'] = round(str_replace(',','', $_GET['saving_value']),2);
                
                // print_r($_GET);
                // die;

                $sql = "UPDATE saving SET ";

                foreach ( $_GET as $key => $value ) {
                    if($value != "") {
                        $sql .= $key . " = '" . $value . "', ";
                    }
                }
                
                $sql = rtrim( $sql, ", ");
                $sql .= " WHERE user_id = '$user_id' AND saving_id = '$saving_id'";
        
                $conn = DB::getInstance();
                $stmt = $conn->dbh->prepare( $sql );
                $chk_stmt = $stmt->execute(); // ลองปริ้นค่า $chk_stmt เป็น 1 เท่ากับว่า คิวรี่สำเร็จ

                if($chk_stmt) {
                    echo "<script>alert('อัพเดทข้อมูลสำเร็จ!')</script>";
                    header("Refresh:0.5; url=./edit_saving_db.php?saving_id=".$saving_id);
                } else {
                    echo "Error<br>";
                    print_r ($stmt->errorInfo());
                    echo $sql;
                }

            } else {
                // select and show result in edit_saving.php
                $sql = "SELECT saving.user_id,
                               saving.saving_id,
                               saving.saving_date,
                               saving.typemoney_id,
                               saving.saving_detail, 
                               saving.saving_value,
                               typemoney.type_tran as 'type_trans'
                        FROM saving
                        INNER JOIN typemoney 
                        ON saving.typemoney_id = typemoney.typemoney_id 
                        WHERE saving.saving_id = '$saveid' AND saving.user_id = '$user_id' 
                    ";

                $stmt = $conn->dbh->prepare( $sql );
                $chk_stmt = $stmt->execute();

                if($chk_stmt) {
                    $_SESSION['saving'] = $stmt->fetchAll( PDO::FETCH_ASSOC );
                    //DB::printArray($_SESSION['saving']);
                    header("Refresh:0.3; url=./edit_saving.php");
                }
            }

        } else if(isset($_GET['changetype'])) {
            //for ajax when change select type_trans
            require_once '../classes/TypeSaving.php';
            $conn = DB::getInstance();
            $gts = new TypeSaving($conn, $_GET['changetype']);
            $gts->getOptionHTML();
        }
    }
    $conn = null;
    
        
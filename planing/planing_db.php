<?php
include '../config.php';
include '../classes/DB.php';

session_start();

if(isset($_SESSION['users'])) {
  $user_id    = $_SESSION['users']['user_id'];
  $conn = DB::getInstance();

  if (isset($_GET['m'], $_GET['show_plan'])) {
    //section query for show
    $m   = $_GET["m"]; //เดือน
    $y   = date('Y');
    $sql = "SELECT  u1.uplan_id,
                    u1.typemoney_id,  
                    TRUNCATE(( sum(u1.uplan_value)*100/(SELECT sum(u2.uplan_value) FROM userplan as u2 
                                                        WHERE u2.month_id = '$m' 
                                                          AND u2.user_id = '$user_id'
                                                          AND year(u2.create_at) = '$y')), 2) as pv_percent,
                    u1.uplan_value as uplan_value,
                    u1.month_id
            FROM userplan as u1
            WHERE u1.month_id = '$m' AND u1.user_id = '$user_id' AND year(u1.create_at) = '$y'
            GROUP BY u1.typemoney_id";

    $stmt = $conn->dbh->prepare( $sql );
    $chk_stmt = $stmt->execute();

    if($chk_stmt) {
      $results = $stmt->fetchAll( PDO::FETCH_ASSOC );

      echo json_encode($results);
    } else {
        echo json_encode( $stmt->errorInfo(), "query"->$sql);
    }
    
  } else if ( isset(
                  $_GET['insert'], 
                  $_GET["savings"],
                  $_GET["bill"], 
                  $_GET['fami_per'],
                  // $_GET["fami"], 
                  // $_GET["personal"], 
                  $_GET["recreation"], 
                  $_GET["debt"], 
                  $_GET["other"], 
                  $_GET["m"]) 
    ) {
    //section insert
    $s1 = $_GET["savings"];
    $s2 = str_replace(',','', $s1);
    $savingid = round($s2,2);
    
    $b1 = $_GET["bill"];
    $b2 = str_replace(',','', $b1);
    $billid = round($b2,2);
    
    $f1 = $_GET['fami_per'];
    $f2 = str_replace(',','', $f1);
    $famiperid = round($f2,2);
    
    $r1 = $_GET["recreation"];
    $r2 = str_replace(',','', $r1);
    $recreationid = round($r2,2);
    
    $d1 = $_GET["debt"];
    $d2 = str_replace(',','', $d1);
    $debtid = round($d2,2);
    
    $o1 = $_GET["debt"];
    $o2 = str_replace(',','', $o1);
    $otherid = round($o2,2);
    
    


    $plan_ids   = [
      $_GET["savings_id"]     => $savingid,
      $_GET["bill_id"]        => $billid,
      $_GET["fami_per_id"]        => $famiperid,
      // $_GET["fami_id"]        => $_GET["fami"],
      // $_GET["personal_id"]    => $_GET["personal"],
      $_GET["recreation_id"]  => $recreationid,
      $_GET["debt_id"]        => $debtid,
      $_GET["other_id"]       => $otherid
    ];
    
   $m    = $_GET["m"]; //เดือน
   $sql  = " INSERT INTO `userplan` 
                (`typemoney_id`, 
                `uplan_value`, 
                `month_id`, 
               `user_id`)
              VALUES ";

    foreach ($plan_ids as $plan_id => $value) {
      $sql .= "('$plan_id', '$value', '$m', '$user_id'),";
   }

    $sql = rtrim($sql,",");

    // echo $sql;
    // die;
    $conn = DB::getInstance();
    $stmt = $conn->dbh->prepare( $sql );
    $chk_stmt = $stmt->execute();
  
    if($chk_stmt) {
      echo "<script>alert('[Insert สำเร็จ]')</script>";
      header( "Refresh:0.5; url=./planing.php" );
    } else {
      echo "<script>alert('Error')</script>";
      DB::printArray($stmt->errorInfo());
      echo $sql;
    }
  } else if (isset($_GET['update'])
  ) {
    //section update
    $m = $_GET['m'];
    $y = date('Y');

    $update_plan_ids   = [
      $_GET["update_savings_id"]     => $savingid,
      $_GET["update_bill_id"]        => $billid,
      $_GET["update_fami_per_id"]        => $famiperid,
      // $_GET["fami_id"]        => $_GET["fami"],
      // $_GET["personal_id"]    => $_GET["personal"],
      $_GET["update_recreation_id"]  => $recreationid,
      $_GET["update_debt_id"]        => $debtid,
      $_GET["update_other_id"]       => $otherid
    ];

    $sql = "INSERT INTO userplan (`uplan_id`, `uplan_value`) VALUES ";

    foreach ($update_plan_ids as $update_plan_id => $update_value) {
      $sql .= "('$update_plan_id', '$update_value'),";
    }

    $sql = rtrim( $sql, ", ");
    $sql .= " ON DUPLICATE KEY UPDATE `uplan_value`= VALUES(`uplan_value`)";
    
    /*

    INSERT INTO userplan (`uplan_id`, `uplan_value`) VALUES (29,100),(30,200),(31,300),(32,400)
    ON DUPLICATE KEY UPDATE `uplan_value`=VALUES(`uplan_value`)

    */

    $conn = DB::getInstance();
    $stmt = $conn->dbh->prepare( $sql );
    $chk_stmt = $stmt->execute(); // ลองปริ้นค่า $chk_stmt เป็น 1 เท่ากับว่า คิวรี่สำเร็จ

    if($chk_stmt) {
        echo "<script>alert('อัพเดทข้อมูลสำเร็จ!')</script>";
        header("Refresh:0.5; url=./planing.php");
    } else {
        echo "<script>alert('เสียใจ! มีบางอย่างผิดผลาด')</script>";
        DB::printArray($stmt->errorInfo());
        echo $sql;
    }
  }
  $conn = null;
}

 
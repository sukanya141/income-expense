<?php
include '../config.php';
include '../classes/DB.php';
session_start();

if ( isset( $_SESSION['users'], $_GET['month_start'], $_GET['month_end']) ) {

    $user_id = $_SESSION['users']['user_id'];
    $month_start = intval(explode("-", $_GET['month_start'])[1]);
    $month_end = intval(explode("-", $_GET['month_end'])[1]);
    $year = intval(explode("-", $_GET['month_end'])[0]);
    
	$sql = "SELECT u.typemoney_id,
                   t.typemoney_name,
                   COALESCE(SUM(u.uplan_value), 0) as exp_target, 
                   COALESCE(SUM(s.saving_value), 0) as exp_real, 
                   u.user_id
            FROM userplan AS u
            LEFT JOIN saving AS s
            ON s.typemoney_id = u.typemoney_id 
                AND s.month_id = u.month_id 
                AND s.user_id = u.user_id 
                AND YEAR(s.saving_date) = YEAR(u.create_at)
            INNER JOIN typemoney AS t
            ON t.typemoney_id = u.typemoney_id
            WHERE (u.month_id BETWEEN '$month_start' AND '$month_end') 
                AND u.user_id = '$user_id' 
                AND YEAR(u.create_at) = '$year'
            GROUP BY u.typemoney_id";

	// create connection db
	$conn = DB::getInstance();
	// prepare sql ส่วนนี้สามารถตรวจสอบได้ว่า sql เรา syntax ผิดไหม
	$stmt = $conn->dbh->prepare( $sql );
    // run คำสั่ง sql ของเราใน database
    $chk_stmt = $stmt->execute();
	//get data from database
    
    if($chk_stmt) {
        $results = $stmt->fetchAll( PDO::FETCH_ASSOC );
    } else {
        echo json_encode( $stmt->errorInfo(), "query"->$sql);
        die;
    }

	//close connection
	$conn = null;

    echo json_encode( $results );
} else {
    echo json_encode( ['error!'=>'user not found!'] );
}


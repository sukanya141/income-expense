<?php
include '../config.php';
include '../classes/DB.php';
session_start();

if ( isset( $_SESSION['users'] ) ) {
	$user_id = $_SESSION['users']['user_id'];
	
	$sql = " SELECT 
                ROW_NUMBER() OVER(ORDER BY year,month) AS num,
				year(saving_date) year,
				month(saving_date) month,
				SUM(saving_value) as sumval, 
				saving.user_id
			FROM saving
			WHERE user_id = '$user_id' AND typemoney_id BETWEEN 4 and 9
			GROUP BY year,month 
			ORDER BY year,month ASC";

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
	
	// DB::printArray($results); //สำปรับปริ้นดูค่า array $results

	$forecast=[];

	function forecast(int $a, int $b,int $c) {
		return  ($a*0.17)+($b*0.33)+($c*0.50);
  	}

	
	for ($i = 0; $i < count($results)-2 ; $i++) {
		//สร้าง array เปล่าสำหรับเก็บค่า month และ forecastval
		$arr = [];
		//สร้าง key month และเก็บ value เป็นเดือนที่ทำนาย
		$arr['user_id'] = $results[$i+2]["user_id"];

		//focecast ในเดือนที่ month(i+2)+1 ex. เดือน 3 + 1 = เดือน 4
		$fcstMonthly = ($results[$i+2]["month"]+1);
		
		$arr['month'] = ($fcstMonthly%12 == 0) ? 12: $fcstMonthly%12;
		$arr['year'] = ($fcstMonthly-1 == 12) ? $results[$i+2]["year"]+1: $results[$i+2]["year"];
		//สร้าง key forecastval และเก็บค่า ทำนาย
		$arr['forecastval'] = forecast(($results[$i]["sumval"]),($results[$i+1]["sumval"]),($results[$i+2]["sumval"]));
		// push เข้า array forecast ที่สร้างไว้นอก loop
		array_push($forecast,$arr);
	}
	      
	// ตอนนี้ array forecast เก็บข้อมูลลักษณะ array 2d โดยมี key คือ month และ forecast เป็น key ย่อย
	// echo "forecast<br>";
	// DB::printArray($forecast); //สำปรับปริ้นดูค่า array $forecast

	//loop นี้สำหรับ add ค่า forecastval ใน array forecast เข้าไป array results โดยเช็กจาก key month ว่าเท่ากันไหม
	foreach ($results as $indRes => $res) {
		foreach ($forecast as $indFrct => $frct) {
			if($res['month'] == $frct['month'] && $res['year'] == $frct['year']) {
				$results[$indRes]['forecastval'] = $frct['forecastval'];
			}
		}
    }

	//เหมือนเสร็จ loop จะเหลือข้อมูล forecast ตัวสุดท้าย เพราะเดือนมันจะมากกว่าเดือนใน result 
	//เลยต้องใช้คำสั่ง array_pop เพื่อส่งออกข้อมูลสุดท้ายจาก array forecast แล้ว push เข้าไปใน result อีกครั้ง
    array_push($results, array_pop($forecast));
    // DB::printArray($results);
    echo json_encode( $results );
} else {
    echo json_encode( ['error!'=>'user not found!'] );
}


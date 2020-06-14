<?php
    define('ROOT', "http://" . $_SERVER['HTTP_HOST'] . '/zocute');
    define( 'CLASS_PATH', realpath( dirname( __FILE__ ) . '/classes' ) );
    require CLASS_PATH . '/Config.php';

// DB Config
    try {

        //ส่วนนี้คือส่วนสำหรับ ใช้งาน database
        Config::write( 'db.host', 'localhost' ); // if build to server, Please [ DON'T FORGET CHANGE HERE ] to Domain of Server.
        Config::write( 'db.port', '3306' ); // check in xampp control panel Port(s)
        Config::write( 'db.basename', 'project' ); // choose your database in mysql 
        Config::write( 'db.user', 'root' ); //your username (Default: root) or if not exist let enter ""
        Config::write( 'db.password', '' ); // your password (Default: "") or if not exist let enter ""
        // กรณีที่ รหัส error เป็น 2002 คือ port ผิด
        // กรณีที่ รหัส error เป็น 1049 คือ ชื่อ database ไม่่มีใน dabast server
        // กรณีที่ รหัส error เป็น 1045 คือ ชื่อ user ไม่ถูกต้อง หรือ pass ไม่ถูก
        date_default_timezone_set('asia/bangkok'); // set timezone

    } catch (\Throwable $th) {
        echo "
            <h1>Error Config!!</h1>
            <h2>เนื่องจาก config database ไม่ถูกต้อง! <br><u>ลองใส่ ค่า config db ใหม่อีกครั้ง ถ้าใส่ถูกหรือมี db นั้นอยู่ จะไม่เห็น error</u></h2>
        ";
        echo $th;
        die;
    }
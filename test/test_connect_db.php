<pre>
Let Connect MySql DB 

*********************
การสร้าง database
    1. เข้าหน้า phpmyadmin
    2. มองไปที่ menubar ซ้ายมือจะมีคำว่า new 
    3. กรอกชื่อ db(eng) และ เลือก "utf8_general_ci" <-- สำคัญนะ ถ้าเลือกอันอื่น เวลาใส่ข้อมูลภาษา Thai มันจะเป็นภาษาต่างด้าว
    4. กด create
    5. รอสักครู่ จะเห็นเป็นหน้าที่ไม่มี table ให้เรา โดยจะมีช่องให้กรอก ชื่อ table พร้อมกำหนดแอตทิบิวต์เริ่มต้นของ table นั้นเป็น 4 
*********************
การ import database
    1. เข้าหน้า phpmyadmin
    2. มองไปที่ menubar บน จะเห็นคำว่า import กดเข้าไป
    *2.1 แนะนำให้สร้าง database เปล่าๆไว้ก่อน จากนั้นกดที่ import อีกทีนะ
    *2.2 ถ้าไม่สร้างไว้ก่อน เวลา import อาจจะ error ได้นะ
    3. กดเลือกไฟล์ ใสได้แค่ไฟล์ .sql นะ!! เลือก type เป็น utf8
    4. เลื่อนลงมาล่างสุด กดปุ่ม "GO" ขวามือ
    5. รอสักครู่จนกว่าจะเสร็จ
*********************
Tip การสร้าง table
    1. เมื่อกำลังสร้างแอตทิบิวต์ (column) ที่เป็น Primary Key ให้ติ๊กที่คำว่า A_I เพื่อให้มัน รันเลขอัตโนมัติ (ต้องเลือก datatype เป็น INT กำหนดขนาดหรือไม่ก็ได้ ไม่งั้นทำ A_I ไม่ได้นะ) 
    2. แนะนำชื่อ column ควรตั้งด้วยรูปแบบ tablename_columnname (eng) เพื่อความไม่ซับซ้อนเวลาเขียนคิวรี 
    2.1 แนะนำชื่อ column ที่เป็น Forien Key เชื่อมกับตารางอื่น ใช้ชื่อ colummn เป็น tablename_tablenameOfFk_columnname
    2.2 ชื่อ column สามารถเปลี่ยนได้ แต่ถ้าเปลี่ยนแล้วต้องตามแก้ทั้งตัว code และ table ที่เชื่อมกัน
    3. ถ้า column ไหนสามารถปล่อยว่างได้ เวลา insert data ให้หาคำว่า Default แล้วเลือก Null หรือ ถ้าอยากใส่เลข 0 เป็น defaul ก็กด As Defined:
    4. การเลือก type ของ column ผิด ย่อมทำให้เวลา insert data ไม่เข้า
    5. ถ้าต้องการให้ insert data เป็น ตัวอักษร ถ้าไม่ยาวมากให้เลือก varchar และกำหนดขนาด เนื่องจากไม่ทำให้ db หนักเกินไป ถ้าเลือก text เหมาะสำหรับข้อมูลยาวๆ เช่น เนื้อเรื่อง
    6. ถ้ต้องการให้ insert data เป็นตัวเลขแบบทศนิยมที่ไม่เยอะมาก หลักหน่วยถึงแสน ให้ใช้ FLOAT จะได้ทศนิยม 6 หลัก default
    *6.1 ถ้ารู้ว่าตัวเลขนั้นเกินหลักล้านแน่ๆ ให้ใช้ Decimal(จำนวนหลักตัวเลขรวมทศนิยม, จำนวนทศนิยม) เช่น Decimal(5,2) จะเป็นขอบเขตระหว่าง -999.99 to 999.99
    7.ถ้าอยากเก็บเวลาของข้อมูลนั้นๆสร้างตอนไหน แนะนำให้ใช้ชื่อ create_at ชนิด Timestamp โดย Default เป็น Current_timestamp แค่นี้ก็จะมี column ไว้เก็บเวลาตอนสร้างข้้อมูลละ
    8.ถ้าอยากให้เก็บเวลามีการแก้ไข Update ข้อมูล แนะนำให้ชื่อ update_at ชริด timeStamp โดย defualt เหือน ข้อ 7 แต่เพิ่มในช่อง Attributes เป็น on Update Current_timestamp เป็นอันเสร็จ
*********************
การสร้าง Export Database ไว้ส่งให้เพื่อนๆ
    1. เลือก DB ที่ต้องการ export กด Export เมนูด้านบน แล้วกด GO เลย แนะนำให้ตั้งชื่อไฟล์รูปแบบ tablename_31122020_ชือคนexport ตัวเลขด้านหลังเป้นวันที่ export
    ป.ล เราสามารถเลือก export เป็น table ได้ แต่ไม่แนะนำ เพราะเวลาเพื่อนนำไป import อาจงงได้ แนะนำให้ export ทั้ง db เวลา import ก็ให้สร้าง db ใหม่แทน โดยตามด้วยวันที่สร้าง db นะ เดี๋ยวชื่อซ้ำละมันจะไม่ได้
    ปล2 อย่าพยายามลบ db เก่า เพราะอาจใช้ทำประโยชนได้ในอนาคต เช่น db ตัวใหม่ ผิดปกติ หรือใช้เทียบกับตัวเก่าได้
*********************
รหัส Error การเชื่อมต่อ Database
    กรณีที่ รหัส error เป็น "2002" คือ port ผิด
    กรณีที่ รหัส error เป็น "1049" คือ ชื่อ database ไม่่มีใน dabast server
    กรณีที่ รหัส error เป็น "1045" คือ ชื่อ user ไม่ถูกต้อง หรือ pass ไม่ถูก

<hr>

Step 1: import Database ใน Folder zocute/database/test/test.sql 
Step 2: ไปที่ไฟล์ config.php แล้วใส่ข้อมูลที่ในไฟล์นั้นบอก 
step 3: กลับมา web นี้ แล้วลอง

</pre>

<hr>
<?php
    require_once '../config.php'; //<-- ห้ามลืม import!!!
    require_once '../classes/DB.php'; //<-- ห้ามลืม import!!! เพราะถ้าลืมจะเรียกใช้ DB ไม่ได้ import เฉพาะเป็นหน้าที่ใช้งาน DB นะ
    try {
        $conn = DB::getInstance(); // <-- ขั้นตอนแรก ประกาศตัว connect db
        echo "<h3>เชื่อม DB สำเร็จ! <br> ต่อไปกดปุ่ม ดึงข้อมูลดู</h3>";
    } catch (PDOException $exception) {
        echo "<h3>ERROR ไม่สามารถต่อดาต้าเบสได้ ดูสาเหตุด้านล่างนี้เลย</h3>";
        echo "<pre>";
        DB::printArray($exception);
        echo "</pre>";
        exit;
    }

    $sql = "SELECT * FROM users"; // <-- เขียน query สำหรับดึงข้อมูล
    
    
    $stmt     = $conn->dbh->prepare( $sql ); // <-- สร้าง
    $chk_stmt = $stmt->execute(); // ลองปริ้นค่า $chk_stmt เป็น 1 เท่ากับว่า คิวรี่สำเร็จ
    $result = $stmt->fetchAll( PDO::FETCH_ASSOC ); // บรรทัดนี้ใช้สำหรับ select เท่านั้น insert, update, delete จะไม่ส่งคืนค่า
?>
<h3>Step1: selete ข้อมูล</h3>
<form action="" method="get">
    <button type="submit" name="q">ดึงข้อมูล</button>
    <button type="submit" name="">รีเฟซ</button>
    <?php 
        if(isset($_GET['q'])) {
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        }
    ?>
</form>

<hr>

<?php

if(isset($_GET['user']) && $_GET['user'] != '' && isset($_GET['pass']) && $_GET['pass'] != '') {
    $sql = "INSERT INTO `users` 
                (`user_name`, `user_pass`) 
            VALUES ('".$_GET['user']."', '".$_GET['pass']."')
            "; // <-- เขียน query สำหรับเพิ่มข้อมูล
    $stmt     = $conn->dbh->prepare( $sql ); // <-- สร้าง
    $chk_stmt = $stmt->execute(); // ลองปริ้นค่า $chk_stmt เป็น 1 เท่ากับว่า คิวรี่สำเร็จ
    if($chk_stmt) {
        echo "<h3>เพิ่มข้อมูลสำเร็จ! ลองกด ดีงข้อมูลดู!</h3>";
    } else {
        echo "มีบางอย่างผิดพลาด ชื่อ username ห้ามซ้ำนะ เพราะตั้ง ยูนิคไว้<br>";
        print_r ($stmt->errorInfo());
        echo $sql;
    }

}


?>
<h3>Step2: insert ข้อมูล</h3>
<form action="" method="get">
    ใส่ username: <input type="text" name='user' required ><br>  
    ใส่ password: <input type="text" name='pass' required ><br>  
    <button type="submit">เพิ่มข้อมูล</button>
    <button type="submit" name="r">รีเฟซ</button>
</form>

<hr>
ที่เหลือไปลองศึกษาเอาเองนะ update กับ delete


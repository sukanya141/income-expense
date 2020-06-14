<?php
    $_GET['isShowNav'] = 0;
    require_once '../config.php';
    include_once '../includes/header.php';
?>
    
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content" style="max-width: none !important">
                <div class="login-logo">
                    <div align="center">
                        <img src="<?= ROOT ?>/images/new.png">
                    </div>
                    <h1 class="text-light"> เปลี่ยนรหัสผ่าน </h1>
                </div>
                <div class="login-form">
                    <form action="forget_db.php" method="POST">
                                <div class="form-group">
                                    <label>อีเมล</label>
                                    <input type="email" name="email" class="form-control" placeholder="อีเมล" >
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>รหัสผ่าน</label>&nbsp;<label>(อย่างน้อย 6-12 ตัวอักษร)</label>
                                            <input type="password" name="pass" class="form-control" placeholder="รหัสผ่าน" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>ยืนยันรหัสผ่าน</label>
                                            <input type="password" name="cpass"class="form-control" placeholder="ยืนยันรหัสผ่าน">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <button class="btn btn-info btn-block" type="submit">ยืนยัน</button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<?php
    include_once '../includes/footer.php';
?>

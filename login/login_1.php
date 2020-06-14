<?php
    $_GET['isShowNav'] = 0;
    require_once '../config.php';
    include_once '../includes/header.php';
?>
<body class="bg-dark small-device">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <div align="center">
                            <img src="<?= ROOT ?>/images/new.png">
                    </div>
                    <h1 class="text-light">เข้าสู่ระบบ</h1>
                </div>
                <div class="login-form">
                    <form name="formlogin_1" action="login_db.php" method="POST" id="login">
                        <div class="form-group">
                            <label>ชื่อผู้ใช้งาน</label>
                            <input type="text" name ="user" class="form-control" placeholder="ชื่อผู้ใช้งาน">
                        </div>
                        <div class="form-group">
                            <label>รหัสผ่าน</label>
                            <input type="password" name="pass" class="form-control" placeholder="รหัสผ่าน">
                        </div>
                        <div class="checkbox">
                            <label class="pull-right">
                                <a href="http://localhost/zocute/login/forget.php">ลืมรหัสผ่าน?</a>
                            </label>
                        </div>
                        <button class="btn btn-info btn-block" type="submit">เข้าสู่ระบบ</button>
                        <div class="register-link m-t-15 text-center">
                            <p>คุณมีบัญชีหรือไม่? <a href="http://localhost/zocute/login/register_1.php">ลงทะเบียน</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>



</body>
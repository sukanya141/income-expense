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
                    <h1 class="text-light">สมัครสมาชิก</h1>
                </div>
                <div class="login-form">
                    
                    <div class="row mb-3">
                        <h3 class="col-lg-6">ข้อมูลส่วนตัว&nbsp;&nbsp;(ต้องกรอกทุกช่อง)</h3>
                       
                    </div>
                    <form action="register_db.php" method="POST">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>ชื่อ</label>
                                            <input type="text" class="form-control" placeholder="ชื่อ" name="user_fname"required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>นามสกุล</label>
                                            <input type="text" class="form-control" placeholder="นามสกุล" name="user_sname"required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>เพศ</label>
                                    <div class="row" style="padding: 7px 0px 7px 0px;">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="gMale" name="user_gen" class="custom-control-input" value="ชาย">
                                                <label class="custom-control-label d-block" for="gMale">ชาย</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="gFemale" name="user_gen" class="custom-control-input" value="หญิง">
                                                <label class="custom-control-label d-block" for="gFemale" >หญิง</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>วันเกิด</label>
                                    <input type="date" min="1900-01-02" max="2100-01-01" class="form-control" name="user_bd"required>
                                </div>

                                <div class="form-group">
                                    <label>ชื่อผู้ใช้งาน</label>&nbsp;<label>(อย่างน้อย 6-12 ตัวอักษร)</label>
                                    <input type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" name="user_name"required>
                                </div>

                                <div class="form-group">
                                    <label>อีเมล</label>
                                    <input type="email" class="form-control" placeholder="อีเมล" name="user_email"required>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>รหัสผ่าน</label>&nbsp;<label>(อย่างน้อย 6-12 ตัวอักษร)</label>
                                            <input type="password" class="form-control" placeholder="รหัสผ่าน" name="user_pass"required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>ยืนยันรหัสผ่าน</label>
                                            <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="user_cpass"required>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <button class="btn btn-info btn-block" type="submit">ลงทะเบียน</button>
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

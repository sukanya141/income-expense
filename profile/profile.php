<?php
    $_GET['isShowNav'] = 0;
    require_once '../config.php';
    include_once '../includes/header.php';

    $actEdit = -1;
    $users = $_SESSION['users'];
    if(isset($_POST['editprofile'])) {
        $actEdit = intval($_POST['editprofile']);
        $actEdit = $actEdit*(-1);
    }

?>
<body class="bg-dark small-device">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <h1 class="text-light"><?=($actEdit === -1)?'ข้อมูลส่วนตัว ('.ucfirst($users['user_name']).')':'Edit My Profile ('.ucfirst($users['user_name']).')'?></h1>
                </div>
            <div class="register-link m-t-50 text-center">
                <p> <a href="http://localhost/zocute/index.php"> <h4><i class="fa fa-link"></i> กลับหน้าหลัก</h4> </a></p>
            </div>
                <div class="login-form">
                    <form method="POST" id='<?=($actEdit === -1)?'formProfile':'formEditProfile'?>' action='<?=($actEdit === -1)?'':'./profile_db.php'?>'>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>ชื่อ</label>
                                    <div class="wrapper-detail">
                                        <input type="text" class="form-control" section='sec-edit' placeholder="ชื่อ" name="user_fname" value='<?= $users['user_fname'] ?>'> 
                                        <p class='h4' id='showFname' section='sec-show'><?= strtoupper($users['user_fname']) ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>นามสกุล</label>
                                    <div class="wrapper-detail">
                                        <input type="text" class="form-control" section='sec-edit' placeholder="นามสกุล" name="user_sname" value='<?= $users['user_sname'] ?>'>
                                        <p class='h4' id='showSname' section='sec-show'><?= strtoupper($users['user_sname']) ?></p>
                                    </div>  
                                </div>
                            </div>
                        </div>            

                        <div class="form-group">
                            <label>เพศ</label>
                            <div class="wrapper-detail">
                                <div class="row" section='sec-edit' style="padding: 7px 0px 7px 0px;">
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
                                <p class="h4" section='sec-show' id="showGen"><?= $users['user_gen'] ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>วันเกิด</label>
                            <div class="wrapper-detail">
                                <input type="date" min="1900-01-02" max="2100-01-01" section='sec-edit' class="form-control" name="user_bd" value='<?= $users['user_bd'] ?>'>
                                <p class='h4' id='showBD' section='sec-show'><?= $users['user_bd'] ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>อีเมล</label>
                            <div class="wrapper-detail">
                                <input type="email" class="form-control" section='sec-edit' placeholder="อีเมล" name="user_email" value="<?= $users['user_email'] ?>">
                                <p class='h4' id='showEmail' section='sec-show'><?= $users['user_email'] ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>ชื่อผู้ใช้งาน</label>
                            <div class="wrapper-detail">
                                <p class='h4' id='showUsername'><?= ucfirst($users['user_name']) ?></p>
                            </div>
                        </div>

                        <div class="form-group" section='sec-edit'>
                            <label>เปลี่ยนรหัสผ่าน</label>
                            <div class="row">
                                <div class="col">
                                    <input type="password" class="form-control" placeholder="เปลี่ยนรหัสผ่าน" name="user_pass">
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="user_rnpass">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-6">
                                <input type="hidden" name="editprofile" value='<?= $actEdit ?>'>
                                <button class="btn <?=($actEdit === -1)?'btn-info':'btn-success'?> btn-block" type="submit"><?=($actEdit === -1)?'แก้ไขข้อมูล':'ยืนยันการแก้ไข'?></button>
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


<script>

    jQuery(document).ready(function($) {
        const actEdit = <?= $actEdit ?>;
        if(actEdit === -1) {
            $('[section=sec-edit]').remove();
        } else {
            $('[section=sec-show]').remove();
            $('label.custom-control-label').each(function (ind, elmt) {
                if($(elmt).text() === "<?= $users['user_gen']?>") {
                    $(elmt).click();
                }
            });
        }

        $('#formEditProfile').submit(function (e) {
            let editvals = {};
            $.each($(this).serializeArray(), function(i, field) {
                editvals[field.name] = field.value;
            });

            let valrepass = $('')
            if(editvals['user_pass'] !== editvals['user_rnpass']) {
                alert('รหัสผ่านไม่ตรงกัน:กรุณากรอกใหม่อีกครั้ง!')
                e.preventDefault();
            }

        });
        
    });

</script>

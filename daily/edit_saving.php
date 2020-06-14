<?php
    $_GET['isShowNav'] = 0;
    require_once '../config.php';
    require_once '../classes/DB.php';
    include_once '../includes/header.php';
    
    $savings = $_SESSION['saving'];
?>

<style>
    .login-form .btn.dropdown-toggle {
        font-size: 1rem; 
        padding: .375rem .75rem; 
        border:1px solid transparent;
    }
</style>

<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <h1 class="text-light">แก้ไขรายการ </h1>
                </div>
                <div class="login-form">
                    <form action="./edit_saving_db.php" method="get">
                        <div class="row form-group">
                                <div class="input-group col-lg-12">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <?php
                                        $getdate = date("Y-m-d", strtotime($savings[0]['saving_date']));                                        
                                        ?>
                                        <input type="date"  min="1900-01-02" max="2100-01-01" section='sec-edit' name="saving_date" class="form-control" value='<?= $getdate ?>' >
                                </div>
                        </div>
                        <div class="row form-group">
                            <div class="input-group col-lg-12">
                                <div class="input-group-addon"><i class="fa fa-circle"></i></div>
                                <select name="typeTrans" id="select-type-trans" class="form-control selectpicker" required>
                                    <?php
                                        $chk_type_trans = ($savings[0]['type_trans'] === 'รายรับ') ? 0 : 1;
                                    ?>
                                    <option value="">เลือกประเภทรายรับ-รายจ่าย</option>
                                    <option value="รายรับ" <?= ($chk_type_trans == 0) ? "selected":"" ?> >รายรับ</option>
                                    <option value="รายจ่าย" <?= ($chk_type_trans == 1) ? "selected":"" ?> >รายจ่าย</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="input-group col-lg-12">
                                <div class="input-group-addon"><i class="fa fa-circle"></i></div>
                                <select name="typemoney_id" 
                                        id="select-type-<?= ($chk_type_trans == 0) ? "income":"expenses"?>" 
                                        class="form-control selectpicker" required>
                                    <option value="">เลือกประเภท</option>
                                    <?php 
                                        require_once '../classes/TypeSaving.php';
                                        $conn = DB::getInstance();
                                        $typeIncome = new TypeSaving($conn, $savings[0]['type_trans']);
                                        $typeIncome->getOptionHTML($savings[0]['typemoney_id']);
                                        // print_r($typeIncome->getOptionHTML($savings[0]['typemoney_id']));
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="input-group col-lg-12">
                                <div class="input-group-addon"><i class="fa fa-pencil"></i></div>
                                <input type="text" id="input-note" name="saving_detail" class="form-control" placeholder="จดบันทึก" value='<?= $savings[0]['saving_detail'] ?>' required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="input-group col-lg-12">
                                <div class="input-group-addon"><strong>THB</strong></div>
                                <input type="text" step="0.01" min="" id="input-money-income" name="saving_value"  onkeyup="this.value=Comma(this.value);"  maxlength="14"  class="form-control" placeholder="จำนวนเงิน" value='<?= $savings[0]['saving_value'] ?>' required> 
                                    <script LANGUAGE="JavaScript">
                                        function Comma(Num)
                                        {
                                            Num += '';
                                            Num = Num.replace(/,/g, '');

                                            x = Num.split('.');
                                            x1 = x[0];
                                            x2 = x.length > 1 ? '.' + x[1] : '';
                                            var rgx = /(\d+)(\d{3})/;
                                            while (rgx.test(x1))
                                            x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                            return x1 + x2;
                                        } 
                                    </script>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <input type="hidden" name="saving_id" value='<?= $savings[0]['saving_id'] ?>'>
                                <button class="btn btn-success btn-block" name ="update" type="submit">ยืนยันการแก้ไข</button>
                            </div>
                            <div class="col-lg-6">
                                <a class="btn btn-primary btn-block" href='./summarydaily.php'>ย้อนกลับ</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
    include_once '../includes/footer.php';
?>

<script type="text/javascript">
        jQuery(document).ready(function($) {
            "use strict";

            function callServices(type, dataType, url, async, data, callBack) {
                $.ajax({
                    type: type,
                    dataType: dataType,
                    beforeSend: function (jqXHR, settings) {
                        //ใส่ Effect loading
                    },
                    url: url,
                    data: data,
                    contentType: "application/json; charset=utf-8",
                    async: async,
                    success: function (msg) {
                        return callBack(msg);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(errorThrown);
                        //fix bug error not set false

                    },
                    complete: function (jqXHR, textStatus) {
                        // console.log("complete",textStatus,jqXHR);
                    }
                });
            }

            $('#select-type-trans').change(function (e) {
                let typeTrans = $(this).val(); 
                let selectTypeMoney = $('#select-type-income, #select-type-expenses');
                let optionsNotFirst = selectTypeMoney.find(':not(:first-child)');
                if(typeTrans != "") {
                    callServices('GET', "", './edit_saving_db.php', false, {changetype: typeTrans}, function (results) {
                        // console.log(optionsNotFirst);
                        optionsNotFirst.remove()
                        selectTypeMoney.append(results);
                        selectTypeMoney.selectpicker('refresh');
                    });
                } else {
                    optionsNotFirst.remove()
                    selectTypeMoney.selectpicker('refresh');
                }
            });
            
        });
</script>
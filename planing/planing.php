<?php 
    $_GET["isShowNav"] = 1;
    require_once '../config.php';
    include_once '../includes/header.php';
?>
  
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>วางแผนเป้าหมาย</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">วางแผนเป้าหมาย</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body card-block">
        <div class="col">
            <div class="col-lg-12">
                <div class="card">
                    <form action="planing_db.php" id="form-record-income" method="GET" >
                    <!-- start form -->
                        <div class="card-header">
                            <div class="row">
                                <label class="col-sm-3 col-lg-3 col-form-label font-weight-bold">วางแผนเป้าหมายเดือน</label>
                                <div class="col-sm-5 col-lg-5">
                                    <select class="selectpicker form-control" name="m" id="selectMonthly">
                                        <option>เลือกเดือน</option>
                                        <option value="1" <?= (date('m') == '1')? "selected":"" ?>>มกราคม</option>
                                        <option value="2" <?= (date('m') == '2')? "selected":"" ?>>กุมภาพันธ์</option>
                                        <option value="3" <?= (date('m') == '3')? "selected":"" ?>>มีนาคม</option>
                                        <option value="4" <?= (date('m') == '4')? "selected":"" ?>>เมษายน</option>
                                        <option value="5" <?= (date('m') == '5')? "selected":"" ?>>พฤษภาคม</option>
                                        <option value="6" <?= (date('m') == '6')? "selected":"" ?>>มิถุนายน</option>
                                        <option value="7" <?= (date('m') == '7')? "selected":"" ?>>กรกฎาคม</option>
                                        <option value="8" <?= (date('m') == '8')? "selected":"" ?>>สิงหาคม</option>
                                        <option value="9" <?= (date('m') == '9')? "selected":"" ?>>กันยนยน</option>
                                        <option value="10 <?= (date('m') == '10')? "selected":"" ?>">ตุลาคม</option>
                                        <option value="11 <?= (date('m') == '11')? "selected":"" ?>">พฤศจิกายน</option>
                                        <option value="12 <?= (date('m') == '12')? "selected":"" ?>">ธันวาคม</option>
                                    </select>
                                
                                </div>
                            </div>
                        </div>
                        
                    <div align="center">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <h4>**กรุณากรอกเป็นตัวเลข**</h4> 
                        <div class="card-body list-group section-inputplan">
                            <div class="row form-group">

                                <div class="input-group col-lg-5 col-sm-6">
                                    <div class="input-group-addon"><i class="fa fa-save"></i></div>
                                    <label class="col col-form-label text-left">การออม&การลงทุน</label>
                                </div>
                                <div class=" col-lg-2 col-sm-2">
                                    <input type="hidden" name="savings_id" value="4">
                                    <input  type="text"  name="savings" class="form-control input-planing" onkeyup="this.value=Comma(this.value);"  maxlength="14" placeholder="" required>
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
                                <div class="input-group col-lg-5 col-sm-6">
                                    <div class="input-group-addon"><i class="fa fa-barcode"></i></div>
                                    <label class="col col-form-label text-left">สาธารณูปโภค(ค่าน้ำ ค่าไฟ ค่าโทรศัพท์
                                        บิลอื่นๆ)</label>
                                </div>
                                <div class=" col-lg-2 col-sm-2">
                                    <input type="hidden" name="bill_id" value="5">
                                    <input type="text" name="bill" class="form-control input-planing" onkeyup="this.value=Comma(this.value);"  maxlength="14"placeholder="" required> 
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
                                <div class="input-group col-lg-5 col-sm-6">
                                    <div class="input-group-addon"><i class="fa fa-group (alias)"></i></div>
                                    <label class="col col-form-label text-left">ครอบครัว&ส่วนตัว</label>
                                </div>
                            
                                <div class=" col-lg-2 col-sm-2">
                                    <input type="hidden" name="fami_per_id" value="6">
                                    <input type="text" name="fami_per" class="form-control input-planing" onkeyup="this.value=Comma(this.value);"  maxlength="14"placeholder="" required>
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
                                <div class="input-group col-lg-5 col-sm-6">
                                    <div class="input-group-addon"><i class="fa fa-coffee"></i></div>
                                    <label class="col col-form-label text-left">สันทนาการ(ช้อปปิ้ง สังสรรค์ ท่องเที่ยว)</label>
                                </div>
                                <div class="col-lg-2 col-sm-2">
                                    <input type="hidden"name="recreation_id" value="7">
                                    <input type="text" name="recreation" class="form-control input-planing"onkeyup="this.value=Comma(this.value);"  maxlength="14" placeholder="" required>
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
                                <div class="input-group col-lg-5 col-sm-6">
                                    <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                    <label class="col col-form-label text-left">หนี้สิน</label>

                                </div>
                                <div class=" col-lg-2 col-sm-2">
                                    <input type="hidden" name="debt_id" value="8">                                
                                    <input type="text" name="debt" class="form-control input-planing"onkeyup="this.value=Comma(this.value);"  maxlength="14" placeholder="" required>
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
                                <div class="input-group col-lg-5 col-sm-6">
                                    <div class="input-group-addon"><i class="fa fa-circle"></i></div>
                                    <label class="col col-form-label text-left">อื่นๆ</label>
                                </div>
                                <div class=" col-lg-2 col-sm-2">
                                    <input type="hidden" name="other_id" value="9">                                  
                                    <input type="text" name="other" class="form-control input-planing"onkeyup="this.value=Comma(this.value);"  maxlength="14" placeholder="" required>
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
                                <div class="input-group col-lg-5 col-sm-6">
                                    
                                    <label class="col col-form-label text-left"><h4>รวม</h4></label>
                                </div>
                                <div class=" col-lg-2 col-sm-2">
                                    <p class='h6 font-weight-bold' id='sumplan-total'>sadas</p>
                                </div>
                            </div>
                    
                           
                            </div>  
                        </div>
                            <div class="row form-group">
                                <div class="col-lg-8">
                                    <button id="btnFormPlaning" class="btn btn-info btn-block" type="submit" name="insert">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end form -->
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
    include_once '../includes/footer.php';
?>

>
<script>

    jQuery(document).ready(function ($) {

        function Comma(Num) {
            Num += '';
            Num = Num.replace(/,/g, '');

            let x = Num.split('.');
            let x1 = x[0];
            let x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
            return x1 + x2;
        }

        function callServices(type, typeData, url, async, data, callBack) {
            $.ajax({
                type: type,
                dataType: typeData,
                beforeSend: function (jqXHR, settings) {
                },
                url: url,
                data: data,
                contentType: "application/json; charset=utf-8",
                async: async,
                success: function (msg) {
                    return callBack(msg);
                },
                error: function (jqXHR) {
                    console.error(jqXHR);
                    console.error(jqXHR.responseText);
                    //fix bug error not set false

                },
                complete: function (jqXHR, textStatus) {
                    $('.section-inputplan').fadeIn();
                    // console.log("complete",textStatus,jqXHR);
                }
            });
        }

        $('#selectMonthly').on('changed.bs.select, rendered.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            let month = $(this).val();
            const inputPlaningId = $('input[name=userplan_id]');
            const inputPlanings = $(".input-planing");
            const wrapperInputPlaning = inputPlanings.closest('div');
            callServices('GET', "JSON", './planing_db.php', false, {m: month, show_plan: ""}, function(results) {
                console.log(results);
                let sumplan = 0;
                $('.label-percent, .update-hide-planing').remove();
                //style="padding-right: 8%;"
                const strTagLabelPercent = '<label class="label-percent col-sm-2 col-md-2 col-lg-2 col-form-label col-form-label-sm text-right pr-5 pl-1"></label>';
                const labelPercent = $( strTagLabelPercent );
                const btnFormPlanning = $("#btnFormPlaning");
                if(results.length != 0) {
                    btnFormPlanning.attr('name', 'update');
                    results.forEach((element, ind) => {
                        const inputHidePlaning = $(inputPlanings[ind]).prev('input[type=hidden]');
                        const clonInputHidePlaning = inputHidePlaning.clone();
                        let keyInputHidePlaning = clonInputHidePlaning.attr('name');
                        clonInputHidePlaning.attr('name','update_'+keyInputHidePlaning);
                        clonInputHidePlaning.addClass('update-hide-planing');
                        clonInputHidePlaning.val(element['uplan_id']);
                        $(clonInputHidePlaning).insertBefore(inputHidePlaning);
                        let plan_id = inputHidePlaning.val();
                        if(plan_id == element['typemoney_id']) {
                            const cloneLabelPercent = labelPercent.clone();
                            let str_format = parseFloat(element['uplan_value']);
                            $(inputPlanings[ind]).val(str_format);
                            cloneLabelPercent.text(element['pv_percent']+"%");
                            $(cloneLabelPercent).insertAfter($(wrapperInputPlaning[ind]));
                        }
                        sumplan = sumplan + parseFloat(element['uplan_value']);
                    });

                    let str_format = Comma(sumplan.toFixed(2))+" บาท";
                    $('#sumplan-total').text(str_format);
                } else {
                    btnFormPlanning.attr('name', 'insert');
                    $(inputPlanings).val('');
                    $('#sumplan-total').text('-');
                }
            });
        });



    });
</script>
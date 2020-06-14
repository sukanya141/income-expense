<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-select/dist/css/bootstrap-select.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form">
                    <form>
                        <p class='h4'>Test Dynamic Selectbox</h4>
                            <div class="form-group">
                                <label>จังหวัด</label>
                                <select class="selectpicker form-control" name="PROVINCE_ID" id="selectProvince"
                                    data-size="7" data-live-search="true">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>อำเภอ</label>
                                <select class="selectpicker form-control" name="DISTRICT_ID" id="selectDistct"
                                    data-size="7" data-live-search="true">
                                    <option value="" selected>เลือกอำเภอ</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
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
    <script src="../assets/bootstrap-select/dist/js/bootstrap-select.js"></script>

    <script>
        $(document).ready(function ($) {

            $("select#selectProvince").load('location_controller.php', { "name": "provinces"} , function (data) {
                console.log(data);
                // let selectorProvince = $(this);
                // let provinces = JSON.parse(data);

                // let strOption = "<option value='' selected>เลือกจังหวัด</option>";

                // selectorProvince.text("");

                // provinces.forEach(v => {
                //     strOption = strOption + "<option value='" + v['PROVINCE_ID'] + "' >" + v[
                //         'PROVINCE_NAME'] + "</option>";
                // });

                // selectorProvince.append(strOption);
            });

            $('select').change(function () {
                const selectCurrent = $(this);
                const selectList = selectCurrent
                                    .closest('body')
                                    .find('select');

                let selectNext;
                
                $(selectList).each(function (ind, element) {
                    if ($(element).attr('id') == selectCurrent.attr('id')) {
                        selectNext = $(selectList[ind + 1]);
                        return false;
                    }
                });
                
                 if (selectCurrent.val() != '' && selectNext.length != 0) {

                     let selectId = selectCurrent.val();
                     let areaName = selectCurrent.attr('name');
                     let areaNextName = selectNext.attr('name');

                     $.ajax({
                         url: "./data/districts.json",
                         method: "GET",
                         data: {
                            select: selectId,
                            curr_name: areaName,
                            next_name: areaNextName,
                         },
                         success: function (result) {
                             $(selectNext).append(result);
                         }
                     });

                 } else {
                     let boxSelect = $(selectCurrent).closest('div');
                     let selectNextList = boxSelect.nextAll().find('select');
                    selectNextList.find('option:not(:first-child)').remove();
                } 
            });
        });
    </script>

    <script src="../assets/js/main.js"></script>



</body>

</html>
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
                        <h1>การเปรียบเทียบเป้าหมายกับรายจ่าย</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">การเปรียบเทียบเป้าหมายกับรายจ่าย</a></li>
                            <li class="active">รายเดือน</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">โปรดเลือก</strong>
                        <form id="formSummaryMonthly" action="./monthly_db.php" method="post">
                            <div class="row form-group">
                                <div class="input-group col-lg-4">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="month" id="input-month_start" name="month_start" class="form-control" value="<?= date('Y-m') ?>" required>
                                </div>
                                 <strong class="card-title">ถึง</strong>
                                <div class="input-group col-lg-4">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="month" id="input-month_end" name="month_end" min="<?= date('Y-m') ?>" class="form-control" value="<?= date('Y-m') ?>" required>
                                </div>
                                <div class="col-lg-1">
                                    <button class="btn btn-primary" type="submit">เรียกดู</button>
                                 </div>
                            </div>
                            <div align="center">
                            <H4>กราฟแสดงการเปรียบเทียบระหว่างค่าใช้จ่ายจริงกับเป้าหมาย</H4>
                            </div>
                        </form>
                    </div>
                    <div class="card-body card-block">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10">
                            <canvas id="monthlyBarChart"></canvas>
                        </div>
                        <div class="col-lg-4 col-md-2">
                            <table id='tableTypeMoneyDetail'  class='table table-bordered '>
                                <thead>
                                    <tr class='text-center'>
                                        <th>สัญลักษณ์</th>
                                        <th>หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class='text-center'></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once '../includes/footer.php';
?>

<!--  Chart js -->
<script src="https://cdn.jsdelivr.net/npm/google-palette@1.1.0/palette.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
<!--Chartist Chart-->
<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

<!--Local Stuff-->
<script>
    jQuery(document).ready(function ($) {
        "use strict";

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

        function unicodeToChar(text) {
            return text.replace(/\\u[\dA-F]{4}/gi, 
            function (match) {
                return String.fromCharCode(parseInt(match.replace(/\\u/g, ''), 16));
            });
        }

        function callServices(type, typeData, url, async, data, callBack) {
            $.ajax({
                type: type,
                dataType: typeData,
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
                error: function (jqXHR) {
                    console.error(jqXHR);
                    console.error(jqXHR.responseText);
                    //fix bug error not set false

                },
                complete: function (jqXHR, textStatus) {
                    // console.log("complete",textStatus,jqXHR);
                }
            });
        }

        function createTableLabelTypeMoney(labelsTypemoney) {
            const table = $('#tableTypeMoneyDetail');
            const tbody = table.find('tbody');
            const row = tbody.find('tr:eq(0)');
            tbody.find('tr').remove();
            labelsTypemoney['compact'].forEach((element, ind) => {
                const cloneRows = row.clone();
                const tdCompLabels = cloneRows.find('td:eq(0)');
                const tdExtendLabels = cloneRows.find('td:eq(1)');
                tdCompLabels.text(labelsTypemoney['compact'][ind]);
                tdExtendLabels.text(labelsTypemoney['extend'][ind]);
                tbody.append(cloneRows);
            });

        }

        var chart;
        callServices('GET', "JSON", './monthly_db.php', false, {
            'month_start': $('#input-month_start').val(), 
            'month_end': $('#input-month_start').val(), 
        }, function (results) {
            let labelTypeMoney = {"compact": [], "extend": []};
            let data = {"exp_real": [], "exp_target": []};
            
            results.forEach((element, ind )=> {
                let chr = String.fromCharCode(65+ind)
                labelTypeMoney.compact.push(chr)
                labelTypeMoney.extend.push(element['typemoney_name'])
                data['exp_real'].push(element['exp_real']);
                data['exp_target'].push(element['exp_target']);
            });

            createTableLabelTypeMoney(labelTypeMoney);
            chart = createChart(labelTypeMoney['compact'], data)
        });

        $('#input-month_start').change(function (e) {
            const input_month_end = $("#input-month_end");
            if(input_month_end.val() != "") {
                input_month_end.val("")
            }
            let month_val = parseInt($(this).val().split('-')[1])
            input_month_end.attr('min', $(this).val());
        });


        $('#formSummaryMonthly').submit(function (e) {
            let form_values = $(this).serializeArray();
            let data = { 
                month_start: form_values[0]['value'], 
                month_end: form_values[1]['value'] 
            }

            callServices('GET', "JSON", './monthly_db.php', false, data, function (results) {
                let labelTypeMoney = {"compact": [], "extend": []};
                let data = {"exp_real": [], "exp_target": []};
                results.forEach((element, ind) => {
                    let chr = String.fromCharCode(65+ind)
                    labelTypeMoney.compact.push(chr)
                    labelTypeMoney.extend.push(element['typemoney_name'])
                    data['exp_real'].push(element['exp_real']);
                    data['exp_target'].push(element['exp_target']);
                });
                createTableLabelTypeMoney(labelTypeMoney);
                removeData(chart);
                addData(chart, labelTypeMoney['compact'], data);
            });
            e.preventDefault();

        });

        function removeData(chart) {
            chart.data.labels = [];
            chart.data.datasets.forEach((dataset) => {
                dataset.data = [];
            });
            chart.update();
        }

        function addData(chart, labels, data) {
            chart.data.labels = labels;
            chart.data.datasets.forEach((dataset, ind) => {
                if(ind == 0) {
                    dataset.data = data['exp_target'];
                } else if(ind == 1) {
                    dataset.data = data['exp_real'];
                }
            });
            chart.update();
        }

        //bar chart
        function createChart(labels, data) {
            var ctx = $("#monthlyBarChart")[0];
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            data: data['exp_target'],
                            label: "เป้าหมาย",
                            borderColor: "rgba(0, 194, 146, 0.9)",
                            borderWidth: "0",
                            backgroundColor: "rgba(0, 194, 146, 0.5)"
                        },
                        {
                            data: data['exp_real'],
                            label: "ค่าใช้จ่ายจริง",
                            borderColor: "rgba(0,0,0,0.09)",
                            borderWidth: "0",
                            backgroundColor: "rgba(255, 142, 122, 0.88)"
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: ''
                    },
                    responsive: true,
                    legend: {
                        position: "top",
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    return Comma(value);
                                },
                                fontSize: 16,
                                fontColor: 'black',
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontSize: 16,
                                fontColor: 'black',
                            }
                        }]
                    }
                }
            });
            return myChart
        }
            

    });
</script>
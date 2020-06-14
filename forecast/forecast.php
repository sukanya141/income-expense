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
                        <h1>การพยากรณ์รายจ่าย</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">การพยากรณ์รายจ่าย</a></li>
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
                        <strong class="card-title">การพยากรณ์</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-10">
                                <div class="card-body">
                                    <canvas id="forecastLineChart"></canvas>
                                    <form id="formSummaryMonthly" action="" method="post">
                                    </form>
                                </div>
                                <h5 align = 'center' >***ข้อมูลในการพยากรณ์อย่างน้อย 3 เดือน***</h5>
                                <h5 align = 'center' >***กรุณากรอกข้อมูลทุกเดือน***</h5>
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

<script>
    jQuery(document).ready(function ($) {
        "use strict";

        function getMonthnames(monthId, lang) {
            const en_monthnames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const th_monthnames = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ษ.', 'พ.ค.', 'มิ.ย', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
            if(lang == 'th') {
                return th_monthnames[monthId];
            } else {
                return en_monthnames[monthId];
            }
        }

        function callServices(type, url, async, data, callBack) {
            $.ajax({
                type: type,
                dataType: "JSON",
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

        callServices('GET', './forecast_db.php', false, {}, function (results) {
            let labelMonths = [];
            let data = {"exp": [], "frcst": []};
            results.forEach(element => {
                if(element['sumval'] !== undefined) {
                    data['exp'].push(parseFloat(element['sumval']).toFixed(2))
                }
                data['frcst'].push((element['forecastval'] == undefined) ? 0 : parseFloat(element['forecastval']).toFixed(2))
                labelMonths.push(getMonthnames(element['month']-1,'th')+"-"+(element['year'].slice(-2)))
            });
            renderChart(data, labelMonths)
        });

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

        function renderChart(data, labels) {
            var ctx = $("#forecastLineChart")[0];
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    type: 'line',
                    datasets: [{
                            label: "Expense",
                            data: data['exp'],
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(220,53,69,0.75)',
                            borderWidth: 3,
                            pointStyle: 'circle',
                            pointRadius: 5,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'rgba(220,53,69,0.75)',
                        },
                        {
                            label: "Focecast",
                            data: data['frcst'],
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(40,167,69,0.75)',
                            borderWidth: 3,
                            pointStyle: 'circle',
                            pointRadius: 5,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'rgba(40,167,69,0.75)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: 0.8,
                    legend: {
                        display: true,
                        labels: {
                            usePointStyle: true,
                            fontFamily: 'Montserrat',
                        },
                    },

                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Montserrat',
                        bodyFontFamily: 'Montserrat',
                        cornerRadius: 3,
                        intersect: false,
                    },

                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    return Comma(value);
                                }
                            }
                        }],
                    },

                    title: {
                        display: false,
                        text: 'Normal Legend'
                    },
                    animation :{
                        duration :500    
                    }
                }
            });
        }

    });
</script>
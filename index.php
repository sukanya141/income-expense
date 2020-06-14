<?php session_start();?>
<?php
    $_GET["isShowNav"] = 1;
    require_once './config.php';
    require_once 'classes/DB.php';  
    include_once './includes/header.php';
?>

<?php
    if ( isset( $_SESSION['users'] ) ) {
        $user_id = $_SESSION['users']['user_id'];
        $sql1 = "SELECT 
                    saving.user_id,
                    SUM(saving_value) as sumvalIn 
                FROM saving
                WHERE  saving.user_id = '$user_id' AND saving.typemoney_id BETWEEN 1 and 3
                ";
            $conn = DB::getInstance();
             $stmt = $conn->dbh->prepare( $sql1);
            $chk_stmt = $stmt->execute();

            if($chk_stmt) {
                $_SESSION['sumvalIn'] = $stmt->fetchAll( PDO::FETCH_ASSOC );
                //DB::printArray($_SESSION['sumvalIn']);
                //header("Refresh:0.3; url=./edit_saving.php");
            } 

        $sql2 = "SELECT 
                    saving.user_id,
                    SUM(saving_value) as sumvalEx 
                FROM saving
                WHERE  saving.user_id = '$user_id' AND saving.typemoney_id BETWEEN 4 and 9
                ";
            $conn = DB::getInstance();
            $stmt = $conn->dbh->prepare( $sql2);
            $chk_stmt = $stmt->execute();

            if($chk_stmt) {
                $_SESSION['sumvalEx'] = $stmt->fetchAll( PDO::FETCH_ASSOC );
                //$_SESSION['newIncome'] = 0;
                //DB::printArray($_SESSION['newIncome']);
                //header("Refresh:0.3; url=./edit_saving.php");
            
            } 
    }
    $Income = $_SESSION['sumvalIn'];
    //$nIncome = $_SESSION['newIncome'];
    $sumIn = ($Income[0]['sumvalIn']);
    //$nIncome = [];
  
    
    
    
    $Expense = $_SESSION['sumvalEx'];
    //$nExpense = $_SESSION['newExpense']
    $sumEx = ($Expense[0]['sumvalEx']);

    $balance = $sumIn- $sumEx;
    //print_r ($sumIn);
    //print_r ($sumEx);
    //print_r ($balance);
?>
<?php
    if ( isset( $_SESSION['users'] ) ) {
        $user_id = $_SESSION['users']['user_id'];
        $sql1 = " SELECT date(saving.saving_date) as day
                FROM saving
                WHERE  saving.user_id = '$user_id' 
                "; 

            $conn = DB::getInstance();
            $stmt = $conn->dbh->prepare( $sql1);
            $chk_stmt = $stmt->execute();
            if($chk_stmt) {
                $_SESSION['date'] = $stmt->fetchAll( PDO::FETCH_ASSOC );
                $date = $_SESSION['date'];
            }
            $count = count($date);
            //DB::printArray($_SESSION['date']);
            $first = ( $date[0]['day']);
            //$firstday = date('d/m/y',strtotime('$date[0]['day']');
            $last = ( $date[$count-1]['day']);
            $firstday = date("d/m/yy",strtotime($first));
            $lastday = date("d/m/yy",strtotime($last));
            //echo $firstday;
            //echo $lastday;
    } 

?>


<style>
    #weatherWidget .currentDesc {
        color: #ffffff !important;
    }

    .traffic-chart {
        min-height: 335px;
    }

    #flotPie1 {
        height: 150px;
    }

    #flotPie1 td {
        padding: 3px;
    }

    #flotPie1 table {
        top: 20px !important;
        right: -10px !important;
    }

    .chart-container {
        display: table;
        min-width: 270px;
        text-align: left;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    #flotLine5 {
        height: 105px;
    }

    #flotBarChart {
        height: 150px;
    }

    #cellPaiChart {
        height: 160px;
    }
</style>


<div class="card-header">
    <div align="right">
        <div class="input-group col-lg-6">
            <strong class="card-title col-md-4">ข้อมูลตั้งแต่</strong>
            <input type="text" id='sum-expenses'  class="form-control font-weight-bold" value= '<?=  "วันที่ ". ($firstday) ?>'disabled>
            &nbsp; &nbsp;<strong class="card-title">  ถึง  </strong> &nbsp; &nbsp;
            <input type="text" id='sum-expenses'  class="form-control font-weight-bold" value= '<?=  "วันที่ ". ($lastday) ?>'disabled>
        </div>
    </div>      
</div>
<div class="content">
    <!-- Animated -->
    
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"> <?php echo  number_format((float)$sumIn, 2, '.', ','). " บาท" ?> </div>
                                    <h4 class="font-weight-bold">รายรับ</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><?php echo  number_format((float)$sumEx, 2, '.', ','). " บาท" ?></div>
                                    <h4 class="font-weight-bold">รายจ่าย</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="pe-7s-browser"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><?php echo  number_format((float)$balance, 2, '.', ','). " บาท" ?></div>
                                    <h4 class="font-weight-bold">ยอดคงเหลือ</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /Widgets -->
        <!--  Traffic  -->
        <!--  /Traffic -->
        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div align="center">
                        <img src="<?= ROOT ?>/images/index.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
    <?php
        include_once './includes/footer.php';
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
        jQuery(document).ready(function($) {
            "use strict";

            //Traffic chart chart-js
            // if ($('#TrafficChart').length) {
            //     let ctx = $('#TrafficChart')[0];
            //     let dataForPieChart = {
            //         data: [150, 400, 250],
            //         label: [
            //                 'รายรับ',
            //                 'รายจ่าย',
            //                 'ยอดคงเหลือ'
            //             ]
            //     };
            //     ctx.height = 150;
            //     let chart = new Chart(ctx, {
            //         type: 'pie',
            //         data: {
            //             datasets: [{
            //                 data: dataForPieChart.data,
            //                 backgroundColor: palette('tol', dataForPieChart.data.length).map(function(hex) {
            //                     return '#' + hex; 
            //                 })
            //             }],
            //             labels: dataForPieChart.label
            //         },
            //         options: {
            //             responsive: true,
            //             legend: {
            //                 position: 'right'
            //             },
            //             tooltips: {
            //                 callbacks: {
            //                     label: function (tooltipItem, data) {
            //                         let label = data.labels[tooltipItem.index]
            //                         let val = data.datasets[0].data[tooltipItem.index];
                                    
            //                         return label + ": ฿" + val;
            //                     }
            //                 }
            //             }
            //         }
            //     });
            // }
            // //Traffic chart chart-js  End
            // // Bar Chart #flotBarChart
            // $.plot("#flotBarChart", [{
            //     data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
            //     bars: {
            //         show: true,
            //         lineWidth: 0,
            //         fillColor: '#ffffff8a'
            //     }
            // }], {
            //     grid: {
            //         show: false
            //     }
            // });
            // Bar Chart #flotBarChart End
        });
    </script>
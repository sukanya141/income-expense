<?php 
    $_GET["isShowNav"] = 1;
   
    require_once '../config.php';
    require_once '../classes/DB.php';
    include_once '../includes/header.php';
    
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>สรุปธุรกรรมประจำวัน</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">บันทึกประจำวัน</a></li>
                            <li class="active">สรุปธุรกรรมประจำวัน</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">สรุปธุรกรรมประจำวัน<strong>
                </div>
                
                <div class="card-body card-block">
                    <div class="row justify-content-start">
                        <form action="summarydaily_db.php" id="form-record-income" method="get" class='col-12'>
                            <div class="form-row">
                                <div class="col-sm-12 col-md-8 col-lg-5 form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <?php
                                            $input_date = (isset($_SESSION['results'])) ? date("Y-m-d", strtotime(array_pop($_SESSION['results'])['input_date'])):date("Y-m-d");                                        
                                        ?>
                                        <input type="date" id="input-date" name="date" class="form-control" value="<?= $input_date ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-8 col-lg-2 form-group">
                                    <button type="submit" id='btn-s-date' class="btn btn-block btn-primary" name="send">เรียกดู</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <h3>รายรับ</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการ</th>
                                        <th>จำนวนเงิน</th>
                                        <th>แก้ไข</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!--start php code -->
                                <?php
                                $sum_incomes = 0;
                                if(isset($_SESSION['results'])) {
                                    $results = $_SESSION['results'];
                                    $cnt = 0;
                                    foreach ($results as $index => $list_incomes) {
                                        if($list_incomes['type_trans'] == 'รายรับ') {
                                ?>
                                    <tr>
                                        <td>
                                        <!--start php code -->
                                        <?php $cnt+=1; echo $cnt; ?>
                                        <!--end php code -->
                                        </td>
                                        <td>
                                        <!--start php code -->
                                        <?php echo $list_incomes['saving_detail'] ?>
                                        <!--end php code -->
                                        </td>
                                        <td>
                                        <!--start php code -->
                                        <?php 
                                            echo number_format((float)$list_incomes['saving_value'], 2, '.', ',');
                                            $sum_incomes += doubleval($list_incomes['saving_value']);
                                        ?>
                                        <!--end php code -->
                                        </td>
                                        <td>
                                            <a class='btn btn-warning' href="./edit_saving_db.php?saving_id=<?php echo $list_incomes['saving_id']?>">แก้ไข</a>
                                            <a class='btn btn-danger delete-saving'href="./delete_saving_db.php?saving_id=<?php echo $list_incomes['saving_id']?>" >ลบ</a>
                                        </td>
                                    </tr>
                                <?php
                                        }
                                    }

                                    if($cnt == 0) { 
                                ?>
                                        <tr><td colspan="100%" class='text-center'>ไม่พบข้อมูลรายรับในวันที่ดังกล่าว!</td></tr>
                                <?php
                                    }
                                }   
                                ?>
                                <!--end php code -->
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <h3>รายจ่าย</h3> 
                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการ</th>
                                        <th>จำนวนเงิน</th> 
                                        <th>แก้ไข</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!--start php code -->
                                <?php
                                $sum_expenses = 0;
                                if(isset($_SESSION['results'])) {
                                    $results = $_SESSION['results'];
                                    $cnt = 0;
                                    foreach ($results as $index => $list_expenses) {
                                        if($list_expenses['type_trans'] == 'รายจ่าย') {
                                ?>
                                    <tr>
                                        <td>
                                        <!--start php code for ลำดับ -->
                                        <?php $cnt+=1; echo $cnt; ?>
                                        <!--end php code -->
                                        </td>
                                        <td>
                                        <!--start php code for รายการ -->
                                        <?php 
                                            echo $list_expenses['saving_detail']; 
                                        ?>
                                        <!--end php code -->
                                        </td>
                                        <td>
                                        <!--start php code for จำนวนเงิน -->
                                        <?php 
                                            echo number_format((float)$list_expenses['saving_value'], 2, '.', ',') ;
                                            $sum_expenses += doubleval($list_expenses['saving_value']);
                                        ?>
                                        <!--end php code -->
                                        </td>
                                        <td>
                                            <a class='btn btn-warning' href="./edit_saving_db.php?saving_id=<?php echo $list_expenses['saving_id']?>">แก้ไข</a>
                                            <a class='btn btn-danger delete-saving' href="./delete_saving_db.php?saving_id=<?php echo $list_expenses['saving_id']?>">ลบ</a>
                                        </td>
                                    </tr>

                                <?php
                                        }
                                    }
                                
                                    if($cnt == 0) { 
                                ?>
                                        <tr><td colspan="100%" class='text-center'>ไม่พบข้อมูลรายจ่ายในวันที่ดังกล่าว!</td></tr>
                                <?php
                                    }
                                }   
                                ?>
                                <!--end php code -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                <input type="text" id='sum-incomes' class="form-control font-weight-bold" value='<?=  number_format((float)$sum_incomes, 2, '.', ','). " บาท" ?>'
                                    placeholder="Total" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                <input type="text" id='sum-expenses'  class="form-control font-weight-bold" value='<?=  number_format((float)$sum_expenses, 2, '.', ',')." บาท" ?>'
                                    placeholder="Total" disabled>
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

<script src="<?= ROOT ?>/assets/js/lib/data-table/datatables.min.js"></script>
<script src="<?= ROOT ?>/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="<?= ROOT ?>/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="<?= ROOT ?>/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="<?= ROOT ?>/assets/js/lib/data-table/jszip.min.js"></script>
<script src="<?= ROOT ?>/assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="<?= ROOT ?>/assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="<?= ROOT ?>/assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="<?= ROOT ?>/assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="<?= ROOT ?>/assets/js/init/datatables-init.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.delete-saving').click(function (e) { 
            let tdButton = $(this).parent();
            let tr = tdButton.parent();
            let saving_detail = tr.find(":eq(1)").text().trim();
            let saving_value = tr.find(":eq(2)").text().trim();
            if(!confirm(`คุณต้องการลบ\nรายการ : \"${saving_detail}\" \nจำนวนเงิน :\"${saving_value}\" หรือไม่?`)) {
                e.preventDefault();
            }
        });

        <?php
        if(!isset($_SESSION['results'])) {
        ?>
            $('#btn-s-date').click();
        <?php
        } else {
            unset($_SESSION['results']);
        }
        ?>
    });
</script>


</body>
</html>


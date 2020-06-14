<?php

ob_start();
include_once 'infofooter.php';
$contents = ob_get_contents();
ob_end_clean();


if(isset($_GET["isShowNav"])) {
    $isShow = boolval($_GET["isShowNav"]);
    echo ($isShow) ? $contents : "";
} else {
    echo "<h1><b>Error!! </b><br>Something in footer wrong please check include footer!!</h1>";
    die;
}

unset($contents);

?>




<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="<?= ROOT ?>/assets/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script src="<?= ROOT ?>/assets/js/main.js"></script>
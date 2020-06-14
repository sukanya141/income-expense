<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>INCOME-EXPENSE :: money manager </title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/zocute/images/money.ico" rel="shortcut icon" type="image/x-icon" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/bootstrap-select/dist/css/bootstrap-select.css">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

</head>

<body>

<?php
    ob_start();
    session_start();
    if( !isset($_SESSION["users"]) && isset($_SESSION["go_login"]) &&  $_SESSION["go_login"] == 0 ){
        header("Refresh:0.5; url=http://localhost/zocute/login/login_1.php");
    }
    include_once 'menubar.php';
    include_once 'navbar.php';
    $contents = ob_get_contents();
    ob_end_clean();
    if(isset($_GET["isShowNav"])) {
        $isShow = boolval($_GET["isShowNav"]);
        echo ($isShow) ? $contents : "";
    } else {
        echo "<h1><b>Error!! </b><br>Something in header wrong please check include header!!</h1>";
        die;
    }

    unset($contents);

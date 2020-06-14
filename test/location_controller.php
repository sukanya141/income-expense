<?php

$str_name = file_get_contents("./data/".$_POST['name'].".json");

$json_data = json_decode($str_name, true);
if ($json_data === null) {
    echo "JSON ERROR";
    die;
}

foreach ($json_data as $data => $prop) {
    print_r($pro);
}
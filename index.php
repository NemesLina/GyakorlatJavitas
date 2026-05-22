<?php

session_start();


include('./includes/config.inc.php');
if (file_exists('./config.php')) {
    include('./config.php'); 
}


$oldal = '';
if (!empty($_GET['page'])) {
    $oldal = $_GET['page'];
} elseif (!empty($_SERVER['QUERY_STRING'])) {
    
    $parts = explode('&', $_SERVER['QUERY_STRING']);
    $oldal = explode('=', $parts[0])[0];
}


if ($oldal == '') {
    $oldal = '/';
}


if ($oldal != '/') {
    if (isset($oldalak[$oldal]) && file_exists("./templates/pages/{$oldalak[$oldal]['fajl']}.tpl.php")) {
        $keres = $oldalak[$oldal];
    } else { 
        $keres = $hiba_oldal;
        header("HTTP/1.0 404 Not Found");
    }
} else {
    $keres = $oldalak['/'];
}


include('./templates/index.tpl.php'); 
?>
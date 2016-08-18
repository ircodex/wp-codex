<?php

include 'include/config.php';
include 'include/functions.php';

define('SITE_URL', base_url());
define("SITE_ROOT",$_SERVER['DOCUMENT_ROOT'].'/codex');


function __autoload($class){
    if(file_exists('include/' . $class . '.php')){
        include 'include/' . $class . '.php';
    }
}

$db = new DB($database);

date_default_timezone_set('Asia/Tehran');

$postPerPage = 20;

$translate = true;


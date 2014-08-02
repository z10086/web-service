<?php
//包含提供服务的类进来
require_once('TestInfo.php');

$server = new SoapServer(null,array("uri"=>"Server.php"));
$server -> setClass("TestInfo");

$server -> handle();
?>
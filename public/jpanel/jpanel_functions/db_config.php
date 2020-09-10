<?php
error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED);
require_once('dbi.php');

$mysql = new MySQL('127.0.0.1', 'root', '', 'resume');
<?php


$lang_array = array(


    "Jan" => "Yanvar",
    "Feb" => "Fevral",
    "Mar" => "Mart",
    "Apr" => "Aprel",
    "May" => "May",
    "Jun" => "İyun",
    "Jul" => "İyul",
    "Aug" => "Avqust",
    "Sep" => "Sentyabr",
    "Oct" => "Oktyabr",
    "Nov" => "Noyabr",
    "Dec" => "Dekabr",

);


function SqlInjectFilter($str) {

    //$str = str_replace(" ",'',$str);
    $str = str_replace("\n",'',$str);
    $str = str_replace("\t",'',$str);
    $str = str_replace("\r",'',$str);
    $str = str_replace("\0",'',$str);
    $str = str_replace("\x0B",'',$str);
    $str = str_replace("'",'',$str);
    $str = str_replace('"','',$str);
    $str = str_replace('\\','',$str);
    $str = str_replace('/','',$str);
    $str = str_ireplace ("and","",$str);
    $str = str_ireplace ("execute","",$str);
    $str = str_ireplace ("update","",$str);
    $str = str_ireplace ("count","",$str);
    $str = str_ireplace ("chr","",$str);
    $str = str_ireplace ("mid","",$str);
    $str = str_ireplace ("master","",$str);
    $str = str_ireplace ("truncate","",$str);
    $str = str_ireplace ("char","",$str);
    $str = str_ireplace ("declare","",$str);
    $str = str_ireplace ("select","",$str);
    $str = str_ireplace ("create","",$str);
    $str = str_ireplace ("delete","",$str);
    $str = str_ireplace ("insert","",$str);
    $str = str_ireplace ("union","",$str);
    $str = str_replace ("\"","",$str);
    $str = str_replace ('"',"",$str);
    //$str = str_replace (" ","",$str);
    $str = str_replace ("$","",$str);
    $str = str_ireplace ("or ","",$str);
    $str = str_replace ("=","",$str);
    $str = str_replace ("% 20 ","",$str);
    $str = addslashes($str);
    $str = htmlspecialchars($str);
    $str = trim($str);

    return $str;
}
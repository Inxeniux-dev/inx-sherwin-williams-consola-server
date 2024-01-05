<?php
$url = explode('/', filter_var(rtrim(isset($_GET['url']) ? $_GET["url"] : '', '/'), FILTER_SANITIZE_URL));
$path = "";
for($x = 0; $x < count($url); $x++)
{
    $path .= "../";
}

if($url[0] == null || $url[0] == "")
{
    $path = "";
}

define('PATH', $path);

if(!isset($_SESSION["datauser"]))
{
    if($_GET["url"] != "login/"){
        header("location:".PATH."login/");
      //echo PATH."login/";
    }
}

?>

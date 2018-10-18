<?php
function GetIP(){
if(!empty($_SERVER["HTTP_CLIENT_IP"])){
$cip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
elseif(!empty($_SERVER["REMOTE_ADDR"])){
$cip = $_SERVER["REMOTE_ADDR"];
}
else{
$cip = "无法获取！";
}
return $cip;
}

var_dump($_SERVER);
echo GetIP();
?> 
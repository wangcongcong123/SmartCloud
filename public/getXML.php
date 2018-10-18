<?php
$xml =$GLOBALS['HTTP_RAW_POST_DATA'];

file_put_contents("rev.txt", $xml);
echo $xml;

?>
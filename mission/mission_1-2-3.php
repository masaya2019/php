<?php
$hensu = "hello world";
$filename = "mission_1-2.txt";
$fp = fopen($filename, "a");
fwrite($fp, $hensu);
fclose($fp);
//mission_1-2.txtの内容が「hello worldhello world」のように前回のものに追加される

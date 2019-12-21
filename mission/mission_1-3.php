<?php
$fileName = "mission_1-2.txt";
$fp = fopen($fileName, "r");
$txt = fgets($fp);
echo $txt;
fclose($fp);

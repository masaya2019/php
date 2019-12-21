<?php
$hensu = "hello world";
$filename = "mission_1-2.txt";
$fp = fopen($filename, "w");
fwrite($fp, $hensu);
fclose($fp);
//mission_1-2.txtが作成される+変えた言葉がtxt内に書き込まれる

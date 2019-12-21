<?php
$hensu = "hello world";
$filename = "mission_1-2.txt";
$fp = fopen($filename, "w");
fwrite($fp, $hensu);
fclose($fp);
// mission_1-2.txtがの中身は「hello world」

/*
$fp = fopen($filename, "w");
=>ファイルの作成&初期文章をセット（追加しない）
$fp = fopen($filename, "a");
=>ファイルの作成&初期文章の追加
*/

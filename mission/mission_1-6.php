<?php
// 1-6-1
$start_year = 2000;
// 現在の西暦を取得
$nowYear = date("Y");

// for(初期値;繰り返し条件;)
for ($i = $start_year;$i < $nowYear;$i += 4) {
    echo $i."<br>";
}

// 1-6-2
// 配列の書き方 https://www.sejuku.net/blog/11981
// var_dump()について https://wp-p.info/tpl_rep.php?cat=php-biginner&fl=r8
$Shiritori = ["しりとり","りんご","ごりら","らっぱ","ぱんだ"];
echo $Shiritori[2]."<br>";

// 1-6-3
$currentWord = "";
// foreach https://www.sejuku.net/blog/47603
foreach ($Shiritori as $value) {
    $currentWord = $currentWord.$value;
    echo $currentWord."<br>";
}

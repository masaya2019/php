<?php
// 現在の西暦を取得
// https://wepicks.net/phpsample-date-date_y/
$nowYear = date("Y");
echo "今は西暦".$nowYear."年です";

$max = 2019;
$min = 1990;
// min~maxの範囲の乱数を生成
// https://www.sejuku.net/blog/24159
$bornYear = mt_rand($min, $max);
echo $bornYear."年生まれの人は...<br>";

// 1-4-1
$age = $nowYear - $bornYear;
echo $age."歳です<br>";

// 1-4-2
$turnsAge = $age + 12;
echo "干支で一回り上の年齢は".$turnsAge."歳です<br>";

// 1-4-3
$twoTurnsAge = $age + 12*2;
echo "干支で二回り上の年齢は".$twoTurnsAge."歳です<br>";

// 1-4-4
$amari = $age % 4;
echo "オリンピックを".(($age - $amari) / 4)."回経験しました";
// floorで小数点を切り捨てれば余りを出したりする必要はなさげ
// https://blog.codecamp.jp/php-floor-ceil-round
// echo "オリンピックを".(floor($age / 4))."回経験しました";

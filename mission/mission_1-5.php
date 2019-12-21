<?php
// 年齢を0~100の間で生成
$min = 0;
$max = 100;
$age = mt_rand($min, $max);
echo "私の年齢は".$age."歳です<br>";

// 判断
if ($age >= 85) {
    echo "免許を返納しませんか？<br>";
} elseif ($age >= 18) {
    echo "自動車免許が取れます！<br>";
} else {
    echo "自動車免許はまだ取得できません...<br>";
}

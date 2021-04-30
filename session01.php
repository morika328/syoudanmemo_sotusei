<?php
// session変数を定義して値を入れよう

// session変数を使用する場合も必須！
session_start();

// session変数の宣言
$_SESSION['num'] = 100;
echo $_SESSION['num'];
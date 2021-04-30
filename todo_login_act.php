<?php

// var_dump($_POST);
// exit();

// セッションの開始
session_start();

// 関数ファイル読み込み
include('functions.php');

// DB接続
$pdo = connect_to_db();

// データ受け取り→変数に入れる
$mail = $_POST['mail'];
$password = $_POST['password'];

// DBにデータがあるかどうか検索
$sql = 'SELECT * FROM users_table
WHERE mail=:mail
AND password=:password
AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// DBのデータ有無で条件分岐
// 該当レコードだけ取得
$val = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$val) { // 該当データがないときはログインページへのリンクを表示
echo "<p>ログイン情報に誤りがあります．</p>";
echo '<a href="index.php">login</a>';
exit();

} elseif($val['is_admin'] != '1') {
$_SESSION = array(); // セッション変数を空にする
$_SESSION["session_id"] = session_id();
$_SESSION["is_admin"] = $val["is_admin"];
$_SESSION["user_id"] = $val["id"];
header("Location:memo_create.php"); // メモ入力ページへ移動
//echo 'hello';
exit();
}else{
$_SESSION = array(); // セッション変数を空にする
$_SESSION["session_id"] = session_id();
$_SESSION["is_admin"] = $val["is_admin"];
$_SESSION["user_id"] = $val["id"];
header("Location:admin.php"); // 管理者ページへ移動
}

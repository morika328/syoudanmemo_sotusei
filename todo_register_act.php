<?php

// var_dump($_POST);
// exit();

// 関数ファイル読み込み
include('functions.php');

// データ受け取り
$name = $_POST["name"];
$belongs = $_POST["belongs"];
$mail = $_POST["mail"];
$password = $_POST["password"];
// var_dump($_POST);
// exit();
// DB接続関数
$pdo = connect_to_db();

// ユーザ存在有無確認
$sql = 'SELECT COUNT(*) FROM users_table WHERE mail=:mail';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
}

if ($stmt->fetchColumn() > 0) {
  // usernameが1件以上該当した場合はエラーを表示して元のページに戻る
  // $count = $stmt->fetchColumn();
  echo "<p>すでに登録されているユーザです．</p>";
  echo '<a href="../index.html">ログイン画面へ戻る</a>';
  exit();
}

// ユーザ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO users_table(id, name, belongs, mail, password, is_admin, is_deleted, created_at, updated_at) VALUES(NULL, :name, :belongs, :mail, :password, 0, 0, sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':belongs', $belongs, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header("Location:../index.html");

  exit();
}

<?php

//送信データのチェック
// var_dump($_GET['id']);
// exit();

// 関数ファイルの読み込み
session_start();
include("functions.php");
check_session_id();

// データ受け取り
$id = $_GET["id"];
$comment = $_GET["comment"];

// DB接続
$pdo = connect_to_db();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = "UPDATE memo_table SET comment=:comment, updated_at=sysdate() WHERE id=:id";

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
}

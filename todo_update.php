<?php

// 送信データのチェック
// var_dump($_POST);
// exit();

// 関数ファイルの読み込み
session_start();
include("functions.php");
check_session_id();

// 送信データ受け取り
$id = $_POST["id"];
$user_id = $_SESSION['user_id'];
$customer_name = $_POST['customer_name'];
$interest = $_POST['interest'];
$Dr = $_POST['Dr'];
$DH = $_POST['DH'];
$other = $_POST['other'];
$maker = $_POST['maker'];
$how_long = $_POST['how_long'];
$problem = $_POST['problem'];
$point = $_POST['point'];

// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = "UPDATE memo_table SET user_id=:user_id, customer_name=:customer_name,  interest=:interest, Dr=:Dr, DH=:DH, other=:other, maker=:maker, how_long=:how_long, problem=:problem, point=:point,updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':customer_name', $customer_name, PDO::PARAM_STR);
$stmt->bindValue(':interest', $interest, PDO::PARAM_STR);
$stmt->bindValue(':Dr', $Dr, PDO::PARAM_STR);
$stmt->bindValue(':DH', $DH, PDO::PARAM_STR);
$stmt->bindValue(':other', $other, PDO::PARAM_STR);
$stmt->bindValue(':maker', $maker, PDO::PARAM_STR);
$stmt->bindValue(':how_long', $how_long, PDO::PARAM_STR);
$stmt->bindValue(':problem', $problem, PDO::PARAM_STR);
$stmt->bindValue(':point', $point, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header("Location:todo_read.php");
  exit();
}

<?php
session_start();
include("functions.php");
check_session_id(); // idチェック関数の実行

// 送信確認
// var_dump($_POST);
// exit();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
// if (
//   !isset($_POST['todo']) || $_POST['todo'] == '' ||
//   !isset($_POST['deadline']) || $_POST['deadline'] == ''
// ) {
//   // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
//   echo json_encode(["error_msg" => "no input"]);
//   exit();
// }

// 受け取ったデータを変数に入れる
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

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO memo_table(id, user_id,customer_name, interest, Dr, DH, other, maker, how_long, problem, point, created_at, updated_at, is_deleted) VALUES(NULL, :user_id, :customer_name, :interest, :Dr, :DH, :other, :maker,  :how_long, :problem, :point,sysdate(), sysdate(), 0)';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
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
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header("Location:todo_read.php");
  exit();
}

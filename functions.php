<?php


// ログイン状態のチェック関数
function check_session_id()
{
  if(!isset($_SESSION['session_id']) || // session_idがない
$_SESSION['session_id'] != session_id()// idが一致しない
) {
header('Location: index.php'); // ログイン画面へ移動
} else {
session_regenerate_id(true); // セッションidの再生成
$_SESSION['session_id'] = session_id(); // セッション変数上書き
}
}

function connect_to_db()
{
  // DB接続の設定
  // DB名は`gsacf_x00_00`にする
  // $dbn = 'mysql:dbname=be6a39d5aa58b9fb3984d3afb1e7b01c;charset=utf8;port=3306;host=mysql-2.mc.lolipop.lan';
 $dbn = 'mysql:dbname=final_product;charset=utf8;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';

  // $user = 'be6a39d5aa58b9fb3984d3afb1e7b01c';
  // $pwd = 'Morika328@gmail';

  try {
    // ここでDB接続処理を実行する
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}


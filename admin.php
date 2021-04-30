<?php

session_start(); // セッションの開始
include("functions.php");
check_session_id();

// DB接続
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM users_table';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
//   var_dump($result);
// exit();

  $output = "";
  foreach ($result as $record) {
      if($record['is_admin'] == 0){
    $output .= "<tr>";
    $output .= "<td><a href='todo_read_admin.php?user_id={$record["id"]}'>{$record["name"]}</a></td>";
    $output .= "<td>{$record["belongs"]}</td>";
    $output .= "</tr>";
  }
}
  unset($value);
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー選択一覧画面</title>
</head>
<body>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

     <table>
      <thead>
        <tr>
          <th>名前</th>
          <th>所属</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
    
<a href= '../index.html' >ログイン画面へ戻る</a>

</body>
</html>
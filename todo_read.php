<?php
session_start(); // セッションの開始
include("functions.php");
check_session_id();

// DB接続
$pdo = connect_to_db();

$user_id = $_SESSION['user_id'];

// データ取得SQL作成
$sql = 'SELECT * FROM memo_table WHERE user_id = :user_id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
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
  $memoData = json_encode($result);
  // $output = "";
  // // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // // `.=`は後ろに文字列を追加する，の意味
  // foreach ($result as $record) {
  //   $output .= "<tr>";
  //   $output .= "<td>{$record["customer_name"]}</td>";
  //   $output .= "<td>{$record["interest"]}</td>";
  //   $output .= "<td>{$record["Dr"]}</td>";
  //   $output .= "<td>{$record["DH"]}</td>";
  //   $output .= "<td>{$record["other"]}</td>";
  //   $output .= "<td>{$record["maker"]}</td>";
  //   $output .= "<td>{$record["how_long"]}</td>";
  //   $output .= "<td>{$record["problem"]}</td>";
  //   $output .= "<td>{$record["point"]}</td>";

  //   // edit deleteリンクを追加
  //   $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
  //   $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
  //   $output .= "</tr>";
  // }
  // // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // // 今回は以降foreachしないので影響なし
  // unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="memo.css">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商談メモ（一覧画面）</title>
</head>

<body>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <fieldset>
    <legend>商談メモ（一覧画面）</legend>
    <a href="memo_create.php">入力画面</a>
    <a href="todo_logout.php">ログアウト</a>

<div class="main">
  <div class="h1">
                <h1>商談メモ</h1>
            </div>
            <!-- 入力場所 -->

            <dl class="dl1">
                <div class="namearea">
                    <dt><label for="customer_name">医院名</label></dt>
                    <dd id='customer_name'></dd>
                </div>
                <div class="interestarea">
                    <dt><label for="interest">問合せ内容(きっかけ)</label></dt>
                    <dd id="interest"></dd>
                </div>
            </dl>

            <div class="kihon">
                <h2>基本情報</h2>
                <div class="staff">
                    <p>スタッフ</p>
                    <div class="staffkind">
                        <ul>
                            <div class="list">
                                <li class="Dr"> <label for="Dr">Dr</label>
                                    <dd id="Dr"></dd>
                                </li>
                                <li class="DH"> <label for="DH">DH</label>
                                    <dd id="DH"></dd>
                                </li>
                                <li class="other"> <label for="other">その他</label>
                                    <dd id="other"></dd>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="system">
                <h2>使用中システム</h2>
                <ul>
                    <div class="list">
                        <li class="maker"> <label for="maker">メーカー</label>
                            <dd id="maker"></dd>
                        </li>
                        <li class="how_long"> <label for="how_long">使用歴</label>
                            <dd id="how_long"></dd>
                        </li>
                    </div>
                </ul>
            </div>

            <div class="problem_point">
                <div class="problembox">
                    <h2>問題点</h2>
                    <dd id="problem" cols="50" rows="5"></dd>
                </div>

                <div class="pointbox">
                    <h2>ポイント</h2>
                    <dd id="point" cols="50" rows="5"></dd>
                </div>
            </div>
            <button type="button" id="back">前へ<button>
            <button type="button" id="next">次へ<button>

</div>
  </fieldset>

  <script>
  $(function(){
    const memoData = <?=$memoData?>;
    let cnt = 0
     console.log(memoData)
          $('#customer_name').text(memoData[cnt].customer_name);
          $('#interest').text(memoData[cnt].interest)
          $('#Dr').text(memoData[cnt].Dr)
          $('#DH').text(memoData[cnt].DH)
          $('#other').text(memoData[cnt].other)
          $('#maker').text(memoData[cnt].maker)
          $('#how_long').text(memoData[cnt].how_long)
          $('#problem').text(memoData[cnt].problem)
          $('#point').text(memoData[cnt].point)
    $('#next').on('click',function(){
      cnt++
          $('#customer_name').text(memoData[cnt].customer_name);
          $('#interest').text(memoData[cnt].interest)
          $('#Dr').text(memoData[cnt].Dr)
          $('#DH').text(memoData[cnt].DH)
          $('#other').text(memoData[cnt].other)
          $('#maker').text(memoData[cnt].maker)
          $('#how_long').text(memoData[cnt].how_long)
          $('#problem').text(memoData[cnt].problem)
          $('#point').text(memoData[cnt].point)
    })
    $('#back').on('click',function(){
      cnt--
          $('#customer_name').text(memoData[cnt].customer_name);
          $('#interest').text(memoData[cnt].interest)
          $('#Dr').text(memoData[cnt].Dr)
          $('#DH').text(memoData[cnt].DH)
          $('#other').text(memoData[cnt].other)
          $('#maker').text(memoData[cnt].maker)
          $('#how_long').text(memoData[cnt].how_long)
          $('#problem').text(memoData[cnt].problem)
          $('#point').text(memoData[cnt].point)
    })    
  })
  </script>
</body>

</html>
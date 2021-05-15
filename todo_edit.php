<?php
// 送信データのチェック
// var_dump($_GET);
// exit();



// 関数ファイルの読み込み
session_start();
include("functions.php");
check_session_id(); // idチェック関数の実行

$id = $_GET["id"];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM memo_table WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<div class="main">
<head>
  <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="memo.css">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>商談メモ（編集画面）</title>
</head>

 <body>
<form action="todo_update.php" method="POST">
            <div class="h1">
                <h1>商談メモ</h1>
            </div>
            <!-- 入力場所 -->

            <dl class="dl1">
                <div class="namearea">
                    <dt><label for="customer_name">医院名</label></dt>
                    <dd><input class="namebox" type="text" name="customer_name" value="<?= $record["customer_name"]?>"></dd>
                </div>
                <div class="interestarea">
                    <dt><label for="interest">問合せ内容(きっかけ)</label></dt>
                    <dd><input class="interestbox" type="text" name="interest" value="<?= $record["interest"]?>"></dd>
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
                                    <input type="text" name="Dr" value="<?= $record["Dr"]?>">
                                </li>
                                <li class="DH"> <label for="DH">DH</label>
                                    <input type="text" name="DH" value="<?= $record["DH"]?>">
                                </li>
                                <li class="other"> <label for="other">その他</label>
                                    <input type="text" name="other" value="<?= $record["other"]?>">
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
                            <input type="text" name="maker" value="<?= $record["maker"]?>">
                        </li>
                        <li class="how_long"> <label for="how_long">使用歴</label>
                            <input type="text" name="how_long" value="<?= $record["how_long"]?>">
                        </li>
                    </div>
                </ul>
            </div>

            <div class="problem_point">
                <div class="problembox">
                    <h2>問題点</h2>
                    <textarea name="problem" cols="50" rows="5" ><?= $record["problem"]?></textarea>
                </div>

                <div class="pointbox">
                    <h2>ポイント</h2>
                    <textarea name="point" cols="50" rows="5" ><?= $record["point"]?></textarea>
                </div>

                <div class="pointbox">
                    <h2>コメント</h2>
                    <textarea name="comment" cols="50" rows="5" ><?= $record["comment"]?></textarea>
                </div>
            </div>

                    <input type="hidden" name="id" value="<?= $record["id"]?>">

            <div class="buttonarea">
                
                <div class="save">
                    <button id="send" type="submit">更新</button>
                </div>
                <div class="open">
                    <a href="todo_read.php">メモ一覧</a>
                </div>
            </div>


</form>


</body>
</div>



</html>
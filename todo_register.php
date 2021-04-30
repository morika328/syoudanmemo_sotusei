<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規アカウント登録画面</title>
</head>

<body>
  <form action="todo_register_act.php" method="POST">
    <fieldset>
      <legend>新規アカウント登録画面</legend>
      <div>
        名前: <input type="text" name="name">
      </div>
      <div>
        所属: <input type="text" name="belongs">
      </div>
      <div>
        ID(メールアドレス): <input type="text" name="mail">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        <button>アカウント作成</button>
      </div>
      <a href="../index.html">ログイン画面へ戻る</a>
    </fieldset>
  </form>

</body>

</html>
<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <!--IEでは最新バージョンのレンダリングモード（edge）を使用-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>終電キャッチャー</title>
    <!--スマホ対応-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--外部CSS-->
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
<div class="header">
    <div class="header-logo"><a href="index.php">終電キャッチャー</a></div>
    <div class="header-list">
        <ul>
					<?php if ($_SESSION["LOGGED_IN"] != true) : ?>
              <li><a href="./register.php">会員登録</a></li>
              <li><a href="./login.php">ログイン</a></li>
              <li>ゲスト様</li>
					<?php else : ?>
              <li><a href="./logout.php">ログアウト</a></li>
              <li><?php echo($_SESSION["NAME"] . "様") ?></li>
					<?php endif; ?>
        </ul>
    </div>
</div>
      <div class="main">
        <div class="contact-form">
          <div class="form-title">ログイン</div>
          <form method="post" action="./login_session.php">
            <div class="form-item">名前</div>
            <input type="text" name="name">
            <div class="form-item">パスワード</div>
            <input type="password" name="password">
            <p>
              <input type="submit" value="ログイン">
            </p>
          </form>
        </div>
      </div>

    </body>
</html>

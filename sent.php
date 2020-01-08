<!DOCTYPE html>
<?php
    session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <!--IEでは最新バージョンのレンダリングモード（edge）を使用-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LTcatch</title>
    <!--スマホ対応-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--外部CSS-->
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
  <div class="header">
    <div class="header-logo">LT catch app</div>
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
    <div class="thanks-message">会員登録ありがとうございます。</div>
    <div class="display-contact">
      <div class="form-title">入力内容</div>

      <div class="form-item">■ 名前</div>
      <?php echo $_POST['name']; ?>

      <div class="form-item">■ パスワード</div>
      <?php echo $_POST['password']; ?>

      <div class="form-item">最寄り駅</div>
      <?php echo $_POST['home_station']; ?>

    </div>
  </div>
</body>
</html>
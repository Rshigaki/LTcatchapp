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
    <div class="header-logo"><a href="index.php">LTcatchapp</a></div>
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
    <div id="map" style="height: 600px; width: 50%; margin: 2rem auto 0;"></div>
    <button id="getcurrentlocation">リロード</button>


    <!-- jquery読み込む -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?php if ($_SESSION["LOGGED_IN"] != true) : ?>
	    <script src="map_guest.js" async></script>
    <?php else: ?>
        <script src="map_user.js" async></script>
    <?php endif; ?>
    <!-- google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATwxT2KS_POdUo0O06ub1EPhmO5OoorzI&libraries=places&callback=initMap"></script>
</div>

<div class="footer">
</div>
</body>
</html>
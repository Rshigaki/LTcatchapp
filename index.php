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
    <div id="description">
現在地から1.5km圏内の各駅への徒歩でのルートを表示します。 <br />
会員の方は、それに加え、各駅から自宅の最寄り駅までの電車の最終時刻を知ることができます。 <br />
    </div>
    <div id="map" style="height: 600px; width: 50%; margin: 2rem auto 0;"></div>
    <button id="getcurrentlocation">リロード</button>


    <!-- jquery読み込む -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATwxT2KS_POdUo0O06ub1EPhmO5OoorzI&libraries=places"></script>
    <?php if ($_SESSION["LOGGED_IN"] != true) : ?>
	    <script src="map_guest.js" async></script>
    <?php else: ?>
        <script src="map_user.js" async></script>
    <?php endif; ?>
</div>

<div class="footer">
</div>
</body>
</html>
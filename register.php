<!DOCTYPE html>

<html lang="ja">

<head>

    <!--文字コード-->
    <meta charset="utf-8">

    <!--IEでは最新バージョンのレンダリングモード（edge）を使用-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--ページタイトル-->
    <title>会員登録</title>

    <!--スマホ対応-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--外部CSS-->
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>

<div class="header">
    <div class="header-logo">LTcatchapp</div>
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
        <div class="form-title">新規登録</div>
        <form method="post" action="sent.php">

            <div class="form-item">年齢</div>
            <select name="age">
                <option value="未選択">選択してください</option>
              <?php
                for ($i = 20; $i <= 100; $i++) {
                  echo "<option value='{$i}'>{$i}</option>";
                }
              ?>
            </select>


            <div class="form-item">名字</div>
            <input type="text" name="family-name">
            <div class="form-item">名前</div>
            <input type="text" name="first-name">
            <div class="form-item">Eメールアドレス</div>
            <input type="text" name="Email">
            <div class="form-item">パスワード</div>
            <input type="text" name="password">
            <!-- この下にselectタグを書く -->

            <p>
            <p class="form-item">職業(選択してください)</p>
            <select name="profession">

                <option>学生</option>
                <option>会社員・自営業</option>
                <option>アルバイト</option>
                <option>専業主婦/夫</option>
                <option>その他</option>
            </select>
            </p>

            <p>
                <input type="submit" value="登録">
            </p>
        </form>
    </div>
</div>

<div class="footer">
    <div class="footer-left">
        <ul>
            <li>会社概要</li>
            <li>採用</li>
            <li>お問い合わせ</li>
        </ul>
    </div>
</div>
</body>

<!-- 外部javascript -->
<script type="text/javascript" src=""></script>

</body>
</html>

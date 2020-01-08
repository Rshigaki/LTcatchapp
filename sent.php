<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>LT catch app</title>
  <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
  <div class="header">
    <div class="header-left">LT catch app</div>
    <div class="header-right">
      <ul>
        <li>会社概要</li>
        <li>採用</li>
        <li class="selected">お問い合わせ</li>
      </ul>
    </div>
  </div>

  <div class="main">
    <div class="thanks-message">会員登録ありがとうございます。</div>
    <div class="display-contact">
      <div class="form-title">入力内容</div>

      <div class="form-item">■ 名前</div>
      <?php echo $_POST['family-name']; ?>
      <?php echo $_POST['first-name'];?>
 
      <div class="form-item">■ 年齢</div>
      <?php echo $_POST['age']; ?>

      <div class="form-item">■ その他</div>
      <!-- この下でcategoryを受け取りechoする -->
      <?php 
      echo $_POST['age'];
      echo $_POST['profession'];
      echo $_POST['Email'];
      echo $_POST['password']; ?>
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
</html>
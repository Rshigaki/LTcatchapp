<?php
	session_start();

	$dsn = "pgsql:host=ec2-54-163-234-44.compute-1.amazonaws.com;port=5432;dbname=dc7o0q71ppj44d;";
	$user_name = "hocrgjjexhgqex";
	$password = "5e9482b0b333e810d2dda163ed524eed0de4a376f7a1bca74160378d5a59aca8";
	try{
        $pdo = new PDO($dsn,$user_name,$password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
				$stmt = $pdo->prepare('select * from users where name = ? and password = ?');
				$stmt->bindValue(1, $_POST["name"]);
				$stmt->bindValue(2, $_POST["password"]);
				$stmt->execute();
				foreach($stmt as $row){
					$_SESSION["NAME"] = $_POST["name"];
					$_SESSION["HOME_STATION"] = $_POST["home-station"];
					$_SESSION["PASSWORD"] = $_POST["password"];
					$_SESSION["LOGGED_IN"] = true;
					header("location: ./index.php");
				}
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
	名前かパスワードが違います。 <br>
	<a href="login.php"> ログインページに戻る </a>
</body>


</html> <?php
	} catch (PDOException $e) {
		echo "登録に失敗しました(´・ω・｀)";
		echo $e;
		print '<br /> <a href="./index.html">'."トップページに戻る".'</a>';
		exit;
	}

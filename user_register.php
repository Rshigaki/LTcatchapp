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
				$result = $pdo->exec('insert into users (name, password, home_station) values('.$_POST["name"].','.$_POST["password"].','.$_POST["home_station"].')');
	} catch (PDOException $e) {
		echo "登録に失敗しました。";
		echo $e;
		print '<a href="./index.html">'."トップページに戻る".'</a>';
		exit;
	}
	$_SESSION["NAME"] = $_POST["name"];
	$_SESSION["HOME_STATION"] = $_POST["home-station"];
	$_SESSION["LOGGED_IN"] = true;
	header("location: ./sent.php");

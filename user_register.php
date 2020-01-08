<?php
	session_start();

	$dsn = "pgsql:host=ec2-54-163-234-44.compute-1.amazonaws.com;port=5432;dbname=dc7o0q71ppj44d;user=hocrgjjexhgqex;password=5e9482b0b333e810d2dda163ed524eed0de4a376f7a1bca74160378d5a59aca8";
	try{
        $pdo = new PDO($dsn,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
	} catch (PDOException $e) {
		header('Content-Type: text/plain; charset=UTF-8', true, 500);
		?>
		<html>
			<body>
            エラーが発生しました。<br />
                <?php echo $e; ?>
			</body>
		</html>
        <?php
	}
	?>
    <html>
        <body>
            表示成功！
        </body>
    </html>


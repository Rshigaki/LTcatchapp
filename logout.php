<?php
	session_start();
	unset($_SESSION["NAME"]);
	unset($_SESSION["PASSWORD"]);
	unset($_SESSION["HOME_STATION"]);
	unset($_SESSION["LOGGED_IN"]);
	header("location: ./logouted.php");

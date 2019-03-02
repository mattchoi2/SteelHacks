<?php

	include "header.php";
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$sql = "INSERT INTO `users` (name, email, password_hash) VALUES ('".$fullname."', '".$email."', '".$password."')";
		$result = $conn -> query($sql);
		$_SESSION['uid'] = $conn -> insert_id;

	}?>
	Redirecting...
	<script>
		window.location.replace("my_profile.php");
	</script>

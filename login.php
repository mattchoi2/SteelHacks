

<?php include 'header.php'; 
	if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['submit'])){
		$sql = "SELECT * FROM `users` WHERE email = '".$_POST['email']."'"; 
		$result = $conn -> query($sql);
		if($result -> num_rows > 0){
			$row = $result -> fetch_assoc();
			echo $row;
			if($row['password_hash'] === $_POST['password']){
				/*we're in*/
				$_SESSION['uid'] = $row['uid'];
				echo '<script>
					window.location.replace("index.php");
					</script>';
			}
		}
	}
?>

<div class="container">
  <div class="row">
    <div class="col s12">
      <h1 class="title">Login</h1>
      <form action="login.php" method="post">
        <div class="input-field">
          <input placeholder="someone@somewhere" type="text" class="validate" name="email">
          <label for="first_name">Email:</label>
		  <input type="password" name="password">

		  <input type="submit" value="Sign in">
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<?php include 'header.php'; ?>

<body>
  <div class="welcomeContain">
      <img class="welcomeLogoImg" src="assets/structure/logo.png">
    <h1 class="welcomeTitle">&lt;datingBase/&gt;</h1>
    <?php if (isset($_SESSION['uid'])) { ?>
      <p class="welcomeSubtitle">Welcome user <?php echo $_SESSION['uid']; ?>!</p>
    <?php } else{
		echo '<div class="welcomeBtnContain">
      <a href="login.php" class="waves-effect waves-light btn-large welcomeBtn"><i class="material-icons left">search</i>Login</a>
      <a href="sign_up.php" class="waves-effect waves-light btn-large welcomeBtn"><i class="material-icons left">create_new_folder</i>Sign Up</a>
    </div>';
	}	?>
		<p style="text-align:center;font-family: 'Consolas';">SELECT * FROM `singles` WHERE `interests` = 'Systems Design and Development';</p>
  </div>
</body>

<?php include 'footer.php'; ?>

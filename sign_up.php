<?php

	include "header.php";


?>

<body>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h1 class="title">Sign Up</h1>
      	<form action="cgi_sign_up.php" method="POST">
          <div class="input-field">
            <i class="material-icons prefix">account_circle</i>
        		<input autofocus id="full_name" type="text" name="fullname">
            <label for="full_name">Full Name</label>
          </div>
          <div class="input-field">
            <i class="material-icons prefix">mail</i>
            <input id="email" type="text" name="email">
            <label for="email">Email</label>
          </div>
          <div class="input-field">
            <i class="material-icons prefix">account_circle</i>
            <input id="password" type="password" name="password">
            <label for="password">Password</label>
          </div>

      		<input class="btn formSubmit" type="submit" value="Submit">
      	</form>
      </div>
    </div>
  </div>
</body>
<?php include 'footer.php'; ?>

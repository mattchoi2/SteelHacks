<?php
  $conn = new mysqli('REDACTED', 'REDACTED' , 'REDACTED', 'REDACTED');
  /* check connection */
  if ($conn->connect_errno) {
    echo "Connect failed: %s\n", $mysqli->connect_error;
    exit();
  }
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

?>

<!doctype html>
<html>
<head>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <!-- Google Icons & Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400" rel="stylesheet">
  <!-- style sheets -->
  <link rel="stylesheet" href="style.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>datingBase</title>
</head>

<?php if (isset($_SESSION['uid'])) { ?>
<div class="nav">
  <a href="matches.php"><div class="navItem"><i class="medium material-icons">favorite</i></div></a>
  <a href="index.php"><div class="navItem"><i class="medium material-icons">message</i></div></a>
  <a href="my_profile.php"><div class="navItem"><i class="medium material-icons">account_box</i></div></a>
</div>
<?php } ?>

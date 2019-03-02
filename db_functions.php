<?php
  $conn = new mysqli('localhost', 'pittdelt_pitt' , 'password123', 'pittdelt_datingbase');
  if ($_GET["function"] == "insert_interest") {
    $interest = $_GET["i"];
    $uid = $_GET["uid"];
    $sql = "INSERT INTO interests VALUES ('" . $uid . "', '" . $interest . "')";
    if (mysqli_query($conn, $sql)) {
      echo "1";
    } else {
      echo "0";
    }
  }

  if ($_GET["function"] == "delete_interest") {
    $interest = $_GET["i"];
    $uid = $_GET["uid"];
    $sql = "DELETE FROM interests WHERE  `iid`='" . $uid . "' && `int`='" . $interest . "'";
    if (mysqli_query($conn, $sql)) {
      echo "1";
    } else {
      echo "0";
    }
  } 

  if($_GET['function'] == "insert_match"){
	  $matchuid = $_GET['i'];
	  $uid = $_GET['uid'];
	  $sql = "INSERT INTO matches VALUES ('".$matchuid."', '".$uid."')";
	  if(mysqli_query($conn, $sql)){
		  echo "1";

	  }else{
		  echo "0";
	  }
  }
  mysqli_close($conn);
?>

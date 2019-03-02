<?php
	include "header.php";
	$row = null;
	$sql = "SELECT * FROM users WHERE uid = ".$_SESSION['uid'];
	$result = $conn -> query($sql);
	if($result -> num_rows > 0){
		$row = $result -> fetch_assoc();
	}
	else{
		echo '<script>
				window.location.replace("login.php");
			</script>';
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prof_update'])) {
		$sql = "UPDATE `users` SET bio = '".$_POST['bio']."', url = '".$_POST['url']."', fos = '".$_POST['fos']."'";
		$result = $conn -> query($sql);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload']['name'])){
		$total = count($_FILES['upload']['name']);
		for($i = 0; $i < $total; $i++){
			$tmpFilePath = $_FILES['upload']['tmp_name'][$i];

			if($tmpFilePath != ""){
				$newFilePath = "images/".$_FILES['upload']['name'][$i];
				if(move_uploaded_file($tmpFilePath, $newFilePath)){
					//Do the database
					$sql = "INSERT INTO `images` VALUES ('".$_SESSION['uid']."', '".$newFilePath."')";
					if($result = $conn -> query($sql)){
						echo "Upload success";
					}else{
						echo "Bad db update";
					}
				}else{
					echo "Bad file move.";
				}
			}
		}
	}
?>
<body>
	<!-- for submitting our profile-->
	<div class="container">
		<form action="my_profile.php" method="POST">
			<h1 class="profileTitle"><?php echo $row['name']; ?></h1>
			<!-- images will go here -->
			<h2 class="profileTitle">Your pictures:</h2>
			<?php
				$img_query = "SELECT * FROM `images` WHERE image_id = '".$row['uid']."'";
				$result = $conn -> query($img_query);
				if($result -> num_rows > 0){
					while($image = $result -> fetch_assoc()){
						echo '<img src='.$image['path'].'>';
					}
				}else{
					echo 'No images!';
				}
			?>

			<input type="file" name="upload[]" accept="image/*" multiple>
			<input type="submit" name="add_image" value="Push images">

			<h2 class="profileTitle">Personal Information:</h2>
			<br/>
			<div class="input-field">
				<i class="material-icons prefix">assignment</i>
				<label for="bio">Biography</label>
				<textarea id="bio" type="text" name="bio" class="materialize-textarea"><?php echo $row['bio']; ?></textarea>
			</div>
			<div class="input-field">
				<i class="material-icons prefix">web</i>
				<label for="url">Project Website</label>
				<input id="url" type="text" name="url" value="<?php echo $row['url']; ?>">
			</div>
			<div class="input-field">
				<i class="material-icons prefix">school</i>
				<label for="fos">Field of Study</label>
				<input type="text" id="fos" name="fos" value="<?php echo $row['fos']; ?>">
			</div>
			<div class="input-field">
				<select class="formSelect" name="gender">
		      <option value="" disabled selected>Gender...</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
					<option value="other">Other</option>
				</select>
			</div>

			<h2 class="profileTitle">Interests:</h2>
			<ul class="collection" id="interestList"><?php fetch_interests($conn); ?></ul>
			<div class="input-field">
				<i class="material-icons prefix">star_rate</i>
				<label for="interest">Interest</label>
				<input type="text" id="interest" name="interest">
			</div>
			<a onclick="add_interest_asynch(this)" class="btn formSubmit">Interests ++</a>

			<h2 class="profileTitle">Languages:</h2>
			<ul class="collection" id="languageList"></ul>
			<div class="input-field">
				<i class="material-icons prefix">code</i>
        <input type="text" id="autocomplete-input" class="autocomplete">
        <label for="autocomplete-input">Languages</label>
		  </div>
			<a onclick="add_language_asynch(this)" class="btn formSubmit">Languages ++</a>

			<br/><br/>

			<input type="submit" class="btn formSubmit" name="prof_update" value="Commit">
		</form>
	</div>
</body>

<?php

function fetch_interests($conn) {
	$sql = "SELECT * FROM interests WHERE iid = " . $_SESSION['uid'];
	$result = $conn -> query($sql);
	if ($result -> num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($row["int"] != "") {
				echo "<li class='collection-item' data-int='" . $row["int"] . "'>" . $row["int"] . "<i onclick='delete_interest(this)' class='material-icons right delInterest'>delete_forever</i></li>";
			}
		}
	}
}

function load_languages($conn) {
	$sql = "SELECT * FROM language_list";
	$result = $conn->query($sql);
	if ($result -> num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($row["lang"] != "") {
				echo '"' . $row["lang"] . '": null,';
			}
		}
	}
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems);
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.autocomplete');
  var instances = M.Autocomplete.init(elems, {
    data: {
			<?php load_languages($conn); ?>
    },
  });
});
</script>

<?php include 'footer.php'; ?>

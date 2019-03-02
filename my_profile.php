<?php
	include "header.php";
	$row = null;
	$sql = "SELECT * FROM users WHERE uid = ".$_SESSION['uid'];
	$result = $conn -> query($sql);
	echo "UID: ".$_SESSION['uid'];
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
		echo '<script>
				window.location.replace("my_profile.php");
			</script>';
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_image'])){
		/*code to add images*/
		if(isset($_FILES['pic'])){
			foreach($_FILES['pic'] as &$image){
				/*path information comes later?*/
				$addimg_query = "INSERT INTO `images` (image_id, path) VALUES ('".$_SESSION['uid']."', '.images/".basename($image['name'])."' ) ";
				/*save file using i/o calls*/
				move_uploaded_file($image['tmp_name'], ".images/".basename($image['name']));
			}
		}
		echo '<script>
				window.location.replace("my_profile.php");
			</script>';
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

			<input type="file" name="pic" accept="image/*" multiple>
			<input type="submit" name="add_image" value="Push images">

			<h2 class="profileTitle">Personal Information:</h2>
			<br/>
			<div class="input-field">
				<label for="bio">Biography</label>
				<textarea id="bio" type="text" name="bio" class="materialize-textarea"><?php echo $row['bio']; ?></textarea>
			</div>
			<div class="input-field">
				<label for="url">Project Website</label>
				<input id="url" type="text" name="url" value="<?php echo $row['url']; ?>">
			</div>
			<div class="input-field">
				<label for="fos">Field of Study</label>
				<input type="text" id="fos" name="fos" value="<?php echo $row['fos']; ?>">
			</div>
			<h2 class="profileTitle">Interests:</h2>
			<div class="input-field">
				<?php fetch_interests($conn); ?>
			</div>

			<h2 class="profileTitle">Languages:</h2>


			<input type="submit" class="btn" name="prof_update" value="Commit">
		</form>
	</div>
</body>

<?php

function fetch_interests($conn) {
	$sql = "SELECT * FROM users";
	$result = $conn -> query($sql);
}

?>

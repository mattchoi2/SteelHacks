<?php
	include "header.php";
	$sql = "SELECT * FROM `interests` WHERE iid = '".$_SESSION['uid']."'";
	$result = $conn -> query($sql);
	$interests = [];
	while($row = $result -> fetch_assoc()){
		$interests[] = $row['int'];//problem line
	}
	$uids = [];
	foreach($interests as &$interest){
		$sql = "SELECT * FROM `interests` WHERE `int` = '".$interest."'";
		$result = $conn -> query($sql);
		if ($result->num_rows === 0) {
			echo "no matches :(";
		} else {
			while($row = $result -> fetch_assoc()){
				$uids[] = $row['iid'];
			}
		}
	}
	$sql = "SELECT * FROM `languages` WHERE lid = '".$_SESSION['uid']."'";
	$result = $conn -> query($sql);
	$languages = [];
	while($row = $result -> fetch_assoc()){
		$languages[] = $row['lang'];
	}
	foreach($languages as &$lang){
		$sql = "SELECT * FROM `languages` WHERE lang = '".$lang."'";
		$result = $conn -> query($sql);
		while($row = $result -> fetch_assoc()){
			$uids[] = $row['lid'];
		}
	}
	$names = [];
	foreach($uids as &$uid){
		$sql = "SELECT * FROM `users` WHERE uid = '".$uid."'";
		$result = $conn -> query($sql);
		while($row = $result -> fetch_assoc()){
			$names[] = $row['name'];
		}
	}
?>
<body>
	<div class="container">
		<div class="row">
			<div class="col s12">
			<?php
				$matchNum = 0;
				foreach($uids as &$uid){
					if ($uid == $_SESSION['uid']) { continue; }
					$sql = "SELECT * FROM `users` WHERE uid = '".$uid."'";
					$user_result = $conn -> query($sql);
					$matchInfo = $user_result -> fetch_assoc();

					$sql = "SELECT * FROM `images` WHERE image_id = '".$uid."'";
					$result = $conn -> query($sql);
					$images = [];
					while($row = $result -> fetch_assoc()){
						$images[] = $row['path'];
					}
			?>
				<div data-num="<?php echo $matchNum; ?>" class="profileContain <?php if ($matchNum == 0) { echo "profileActive"; } ?>">
					<p class='swipeTitle'><?php echo $matchInfo['name']; ?></p>
					<div class="swipeImgContain">
						<?php
						$num = 0;
						foreach($images as &$ipath){
							$active = "";
							if ($num == 0) { $active = "swipeActive"; }
							echo "<img onclick='nextImg(this)' data-order='" . $num . "' class='swipeImg " . $active . "' src='".$ipath."'>";
							$num ++;
						}
						?>
					</div>
					<div class="matchBtnContain">
						<a onclick="match(this)" class="matchBtn waves-effect waves-light formSubmit btn">Match</a>
						<a onclick="next(this)" class="matchBtn waves-effect waves-light formSubmit btn">Next</a>
					</div>
					<h2 class="profileTitle">Bio:</h2>
					<p><?php echo $matchInfo["bio"]; ?></p>
					<h2 class="profileTitle">Interests:</h2>
					<ul class="collection" id="interestList"><?php fetch_interests($conn, $uid); ?></ul>
					<h2 class="profileTitle">Languages:</h2>
					<ul class="collection" id="languageList"><?php fetch_languages($conn, $uid); ?></ul>
				</div>

			<?php
					$matchNum += 1;
				}
			?>
			</div>
		</div>
	</div>

</body>
<?php
function fetch_interests($conn, $uid) {
	$sql = "SELECT * FROM interests WHERE iid = " . $uid;
	$result = $conn -> query($sql);
	if ($result -> num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($row["int"] != "") {
				echo "<li class='collection-item'>" . $row["int"] . "</li>";
			}
		}
	}
}

function fetch_languages($conn, $uid) {
	$sql = "SELECT * FROM language_list WHERE `lid`='" . $uid . "'";
	$result = $conn->query($sql);
	if ($result -> num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($row["lang"] != "") {
				echo "<li class='collection-item'>" . $row["lang"] . "</li>";
			}
		}
	}
}
?>

<script>

function nextImg(elem) {
	$(elem).removeClass("swipeActive");
	var total = $(elem).parent().children("img").length;
	var next = ($(elem).data("order") + 1) % total;
	var nextImg = null;
	$(elem).parent().children("img").each(function() {
		if (parseInt($(this).data("order")) == next) {
			nextImg = this;
		}
	});
	$(nextImg).addClass("swipeActive");
}

function match(elem) {
	nextProfile(elem);
}

function next(elem) {
	nextProfile(elem);
}

function nextProfile(elem) {
	var profile = $(elem).parent().parent();
	var total = $(profile).parent().children("div.profileContain").length;
	var nextProfileNum = ($(profile).data("num") + 1) % total;
	var nextProfile = null;
	$(profile).parent().children("div.profileContain").each(function() {
		if (parseInt($(this).data("num")) == nextProfileNum) {
			nextProfile = this;
		}
	});
	$(nextProfile).addClass("profileActive");
	$(profile).removeClass("profileActive");
}
</script>
<?php include "footer.php";?>

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
		$sql = "SELECT * FROM `interests` WHERE int = '".$interest."'";
		$result = $conn -> query($sql);
		while($row = $result -> fetch_assoc()){
			$uids[] = $row['iid'];
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
				<div class="profileContain">
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
				</div>

			<?php
				}
			?>
			</div>
		</div>
	</div>

</body>

<script>
var instance = M.Carousel.init({
  fullWidth: true
});

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

	//alert($(next_to_show).data("order"));

}
</script>
<?php include "footer.php";?>

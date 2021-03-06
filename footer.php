
</html>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-135475345-1"></script>
<script>
 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'UA-135475345-1');
</script>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  function add_interest_asynch(elem) {
    var new_interest = $("#interest").val().trim();
    if (new_interest != "") {
      $("#interestList").append("<li class='collection-item'>" + new_interest + "</li>");
    }
    // add to the interest table of the database
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { // executes on success
          var results = this.responseText;
        }
    };
    xmlhttp.open("GET", "db_functions.php?i=" + new_interest + "&uid=" + <?php echo $_SESSION['uid']?> + "&function=insert_interest", true);
    xmlhttp.send();
  }

  function match_with(elem){
	  var add_uid = $("#muid").val().trim();
	  if(add_uid == ""){
		  //something
	  }else{
		  var xmlgttp = new XMLHttpRequest();
		  xmlhttp.onreadystatechange = function() {
			  if(this.readyState == 4 && this.status == 200){
				  var results = this.responseText;
				  alert(results);
			  }
		  };
	  }
  	xmlhttp.open("GET", "db_functions.php?i="+add_uid+"&uid="+<?php echo $_SESSION['uid'];?> + "&function=delete_interest", true);
  	xmlhttp.send();
  }

  function add_language_asynch(elem) {
    var add_uid = $("#autocomplete-input").val().trim();
    $("#autocomplete-input").val("");
    $("#languageList").append("<li class='collection-item'>" + add_uid + "</li>");
  }
</script>

<?php mysqli_close($conn); ?>

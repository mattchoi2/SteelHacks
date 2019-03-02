
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
            alert(results);
        }
    };
    xmlhttp.open("GET", "db_functions.php?i=" + new_interest + "&uid=" + <?php echo $_SESSION['uid']; ?>, true);
    xmlhttp.send();
  }
</script>

<?php mysqli_close($conn); ?>

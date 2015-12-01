
<?php
session_start();
//tesaaaa

if (isset($_SESSION['twitter-status'])){
	echo "<script>window.open('http://www.twitter.com/logout', 'testing', 'height=400,width=1000')</script>";
}

session_destroy();

echo "<meta http-equiv=\"Refresh\" content=\"0; url=./\">";
// echo "<script>window.location.href='./'</script>";
?>

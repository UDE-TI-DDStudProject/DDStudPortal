<?php 
session_start();
session_destroy();
unset($_SESSION['userid']);

//Remove Cookies
setcookie("identifier","",time()-(3600*24*365)); 
setcookie("securitytoken","",time()-(3600*24*365)); 

require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

header("location: login.php");
exit;

// include("templates/header.inc.php");
?>
<!-- <div class="main">
	<div class="container main-container">
		<div class="container main-container registration-form">
		Der Logout war erfolgreich. <a href="test.php">Zurück zum Login</a>.
		</div>
	</div>
</div> -->
<?php 
//include("templates/footer.inc.php")
?>
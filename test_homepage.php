<?php
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();

    if(isset($user)){
        include("templates/testheaderLogin.php");
    }else{
        include("templates/testheader.php");
    }
?>

<main class="container-fluid flex-fill">
    <div class="card homepage-form">
        
    </div>
</main>


<?php
    include("templates/testfooter.php");
?>
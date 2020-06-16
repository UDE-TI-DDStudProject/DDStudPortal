<?php
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();

    if(isset($user)){
        include("templates/headerlogin.inc.php");
    }else{
        include("templates/header.inc.php");
    }

    if(isset($_GET['error'])){
        $error_msg = $_GET['error'];
    }else if(isset($_GET['success'])){
        $success_msg = $_GET['success'];
    }
?>

<main class="container-fluid flex-fill">
    <div class="card message-only-form">
        <!-- page title -->
        <div class="page-title">
            <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Message
        </div>

        <!-- show message -->
        <?php 
            if(isset($success_msg) && !empty($success_msg)):
            ?>
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $success_msg; ?>
        </div>
        <?php 
            endif;
            ?>

        <?php 
            if(isset($error_msg) && !empty($error_msg)):
            ?>
        <div class="alert alert-danger">
            <?php echo $error_msg; ?>
        </div>
        <?php 
            endif;
            ?>

    </div>
</main>


<?php
    include("templates/footer.inc.php");
?>
<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");
    
    //redirect user to homepage if the user has already login
    $user = check_user();

    if(isset($user)){
        if($user['user_group_id']==1){
            header("location: status.php");
        }else if($user['user_group_id']==2){
            header("location: admin/index.php");
        }
        exit;
    }

    $userid = $_GET['userid'];
    $code = $_GET['code'];

    if(!isset($userid) || !isset($code)){
        header("location: login.php");
        exit;
    }

    //get user
    $statement = $pdo->prepare("SELECT * FROM user WHERE user_id = :userid");
    $result = $statement->execute(array('userid' => $userid));
    $user = $statement->fetch();

    if(empty($user)){
        $error_msg =  "Der Benutzer ist nicht gefunden.";
    }else if($user['activated']==1){
        $error_msg =  "Dein Account ist bereits aktiviert. <a href=\"login.php\">Login hier</a>";
    }else{
    //get activation code
    $statement = $pdo->prepare("SELECT * FROM email_activation WHERE user_id = :userid ORDER BY created_at DESC limit 1");
    $result = $statement->execute(array('userid' => $userid));
    $activation = $statement->fetch();
        
    //if activation code does not exist
    if(empty($activation)) {
        $error_msg =  "Der Benutzer hat kein Activation-Code angefordert. <a href=\"resend_confirmation_email.php\">Confirmation E-Mail erneut senden.</a> ";
        
    }else if(strtotime($activation['created_at']) < (time()-24*3600) ) {
        //if activation code is expired.
        $error_msg =  "Dein Code ist leider abgelaufen. <a href=\"resend_confirmation_email.php\">Confirmation E-Mail erneut senden.</a> ";
        
    }else if(sha1($code) != $activation['activation_code']) {
        // if code in url does not match the code in the database
        $error_msg = "Der übergebene Code war ungültig. Stell sicher, dass du den genauen Link in der URL aufgerufen hast. ";
        
    }else{

        //set user activated = 1 
        $statement = $pdo->prepare("UPDATE user SET activated = 1 WHERE user_id = :userid");
        $result = $statement->execute(array('userid' => $userid));
        
        // then remove email activation code if successfully activated
        if($result){
            $statement = $pdo->prepare("DELETE FROM email_activation WHERE user_id = :userid");
            $result = $statement->execute(array('userid' => $userid));
        }

        $success_msg = "Dein Account ist aktiviert. <a href=\"login.php\">Login hier</a>.";
    }
    }
?>


<?php  include("templates/header.inc.php"); ?>

<main class="container-fluid flex-fill">
    <div class="card resetpassword-form">
        <!-- page title -->
        <div class="page-title">
            <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Account aktivieren
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
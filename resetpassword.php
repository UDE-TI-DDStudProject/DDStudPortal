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

    //Abfrage des Nutzers
    $statement = $pdo->prepare("SELECT * FROM reset_password WHERE user_id = :userid ORDER BY created_at DESC limit 1");
    $result = $statement->execute(array('userid' => $userid));
    $user = $statement->fetch();
        
    //Überprüfe dass ein Nutzer gefunden wurde und dieser auch ein Passwortcode hat
    if($user === null || $user['password_code'] === null) {
    	error("Der Benutzer wurde nicht gefunden oder hat kein neues Passwort angefordert.");
    }
    
    if($user['created_at'] === null || strtotime($user['created_at']) < (time()-24*3600) ) {
    	error("Dein Code ist leider abgelaufen. Bitte benutze die Passwort vergessen Funktion erneut.");
    }
    
    
    //Überprüfe den Passwortcode
    if(sha1($code) != $user['password_code']) {
    	error("Der übergebene Code war ungültig. Stell sicher, dass du den genauen Link in der URL aufgerufen hast. Solltest du mehrmals die Passwort-vergessen Funktion genutzt haben, so ruf den Link in der neuesten E-Mail auf.");
    }
?>

<?php 
    if(isset($_POST['newpassword'])) {
        $passwort = $_POST['passwort'];
        $passwort2 = $_POST['repeatpasswort'];
        
        if($passwort != $passwort2) {
            $error_msg =  "Bitte identische Passwörter eingeben";
        } else { //Speichere neues Passwort und lösche den Code
            $passworthash = password_hash($passwort, PASSWORD_DEFAULT);
            $statement = $pdo->prepare("UPDATE user SET password = :passworthash WHERE user_id = :userid");
            $result = $statement->execute(array('passworthash' => $passworthash, 'userid'=> $userid ));
            
            if($result) {
                $success_msg = "Dein Passwort wurde erfolgreich geändert! <a href=\"login.php\">Login hier</a>";
            }
        }
    }
?>

<?php  include("templates/header.inc.php"); ?>

<main class="container-fluid flex-fill">
    <div class="card resetpassword-form">
        <!-- page title -->
        <div class="page-title">
            <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Passwort zurückzusetzen
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

        <small>Neues Passwort vergeben</small>

        <form action="<?php echo $_SERVER['PHP_SELF']."?userid=$userid&code=$code";?>" method="post" class="needs-validation" novalidate>
            <div class="form-group">
                <input type="password" name="passwort" class="form-control" id="inputPassword"
                    placeholder="Neues Passwort" data-toggle="tooltip" data-placement="top"
                    title="Das Passwort muss mindestens acht Zeichen lang sein und mindestens einen Großbuchstaben, einen Kleinbuchstaben, eine Ziffer und ein Sonderzeichen enthalten!">
                <!-- <small id="passwordHelpBlock" class="form-text text-muted">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </small> -->
                <div id="passwordFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <input type="password" name="repeatpasswort" class="form-control" id="inputPasswordAgain"
                    placeholder="Passwort wiederholen">
                <div id="repeatpasswordFeedback" class="invalid-feedback"></div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="btnnewpassword" name="newpassword">Neues
                Passwort</button>
        </form>
    </div>
</main>


<?php 
    include("templates/footer.inc.php");
?>
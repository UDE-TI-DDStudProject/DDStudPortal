<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");
    
    //redirect user to homepage if the user has already login
    $user = check_user();

    if(isset($user)){
        header("location: status.php");
        exit;
    }
?>

<?php 
    if(isset($_POST['newpassword']) ) {
        if(!isset($_POST['email']) || empty($_POST['email'])) {
            $error_msg = "Bitte eine E-Mail-Adresse eintragen!";
        } else {
            $statement = $pdo->prepare("SELECT * FROM user WHERE email = :email");
            $result = $statement->execute(array('email' => $_POST['email']));
            $user = $statement->fetch();		
     
            if($user === false) {
                $error_msg = "Kein Benutzer gefunden.";
            } else {
                
                $passwortcode = random_string();
                $statement = $pdo->prepare("INSERT INTO reset_password(user_id, password_code) VALUES( :userid, :passwortcode) ");
                $result = $statement->execute(array('passwortcode' => sha1($passwortcode), 'userid' => $user['user_id']));
                
                $empfaenger = $user['email'];
                $betreff = "Neues Passwort für deinen Account auf www.php-einfach.de"; //Ersetzt hier den Domain-Namen
                $from = "From: Vorname Nachname <absender@domain.de>"; //Ersetzt hier euren Name und E-Mail-Adresse
                $url_passwortcode = getSiteURL().'resetpassword.php?userid='.$user['user_id'].'&code='.$passwortcode; //Setzt hier eure richtige Domain ein
                $text = 'Hallo '.$user['firstname'].',
    für deinen Account auf www.php-einfach.de wurde nach einem neuen Passwort gefragt. Um ein neues Passwort zu vergeben, rufe innerhalb der nächsten 24 Stunden die folgende Website auf:
    '.$url_passwortcode.'
     
    Sollte dir dein Passwort wieder eingefallen sein oder hast du dies nicht angefordert, so ignoriere bitte diese E-Mail.
     
    Viele Grüße,
    dein Bewerbungs-Team';
                
                //echo $text;
                 
                mail($empfaenger, $betreff, $text, $from);
     
                echo "Ein Link um dein Passwort zurückzusetzen wurde an deine E-Mail-Adresse gesendet.";	
                $showForm = false;
            }
        }
    }
?>

<?php  include("templates/header.inc.php"); ?>

<main class="container-fluid flex-fill">
    <div class="card forgetpassword-form">
        <!-- page title -->
        <div class="page-title">
            <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Passwort vergessen
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

        <small>Gib hier deine E-Mail-Adresse ein, um ein neues Passwort anzufordern.</small>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="needs-validation" novalidate>
            <div class="form-group">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-Mail"
                    value="<?php if(isset($email)) echo $email?>" required>
                <div id="emailFeedback" class="invalid-feedback"></div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="btnnewpassword" name="newpassword">Neues
                Passwort</button>
        </form>
        <br>
        <small><a href="login.php">Login</a></small>
        <small><a href="register.php">Registieren</a></small>
    </div>
</main>


<?php 
    include("templates/footer.inc.php");
?>
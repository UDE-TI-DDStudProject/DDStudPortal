<?php 
    session_start();
    require_once("../inc/config.inc.php");
    require_once("../inc/functions.inc.php");
    require_once("../PHPMailer/PHPMailer.php");
    require_once("../PHPMailer/SMTP.php");
    require_once("../PHPMailer/Exception.php");
    require_once("../PHPMailer/POP3.php");
    require_once("../PHPMailer/OAuth.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //redirect user to homepage if the user has already login
    $user = check_admin();

    if(!empty($user)){
        header("location: index.php");
        exit;
    }

    $showForm = true;
?>

<?php 
    if(isset($_POST['send'])) {

        $email = strtolower(trim($_POST['email']));

        //get user
        $statement = $pdo->prepare("SELECT * FROM user WHERE email = :email and user_group_id = 2");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        // if user deosnt exist
        if(empty($user)){
            $error_msg = "E-Mail-Adresse ist nicht vorhanden.";
        // if user is already activated
        }else if($user['activated']==1){
            $error_msg = "Dein Account ist schon aktiviert. Bitte <a href=\"login.php\">Login hier</a>";
        }else{
            //delete existing email activation
            $statement = $pdo->prepare("DELETE FROM email_activation WHERE user_id = :userid");
            $result = $statement->execute(array('userid' => $user['user_id']));

            // create email activation code
            $activationcode = random_string();
            $statement = $pdo->prepare("INSERT INTO email_activation(user_id, activation_code) VALUES( :userid, :activationcode) ");
            $result = $statement->execute(array('activationcode' => sha1($activationcode), 'userid' => $user['user_id']));

            //send email activation
            $empfaenger = $user['email'];
			$betreff = "Email Activation für deinen Account auf ".getSiteURL(); //Ersetzt hier den Domain-Namen
			$from = "From: Vorname Nachname <absender@domain.de>"; //Ersetzt hier euren Name und E-Mail-Adresse
			$url_activation = getSiteURL().'email_activation.php?userid='.$user['user_id'].'&code='.$activationcode; //Setzt hier eure richtige Domain ein
            $text = 'Sehr geehrte Damen und Herren,<br><br> 
            herzlich Willkommen im Bewerberportal für ein Auslandssemester in Südostasien. Wir freuen uns, dass Sie da sind. Jetzt ist es nur noch ein kleiner Schritt. Bestätigen Sie die Registrierung durch einen Klick auf den folgenden Link:<br><br>
            <a href="'.$url_activation.'">'.$url_activation.'</a> 
            <br><br>Freundliche Grüße<br><br>Ihr Team von<br>SCIES – Support Center for (International) Engineering Studies';
            
            $mail = new PHPMailer;
        
            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'ddstudportal';          // SMTP username
            $mail->Password = 'admin123!';              // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;        // TCP port to connect to
            $mail->CharSet ="UTF-8";                      
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                         
            
            $mail->setFrom('ddstudportal@gmail.com', 'admin');
            $mail->addReplyTo('ddstudportal@gmail.com', 'admin');
            $mail->addAddress($empfaenger);   // Add a recipient
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            
            $mail->isHTML(true);  // Set email format to HTML
             
            $mail->Subject = $betreff;
            $mail->Body    = $text;
            
            if(!$mail->send()) {
                $error_msg = $mail->ErrorInfo;
            } else {
                $success_msg = 'Wir haben dir einen Bestätigungslink geschickt. Bitte öffne die Mail und klicke auf den Link, um dein neues Konto zu aktivieren.';
                $showForm = false;
            }
        }
        
    }
?>

<?php  include("templates/header.inc.php"); ?>

<main class="container-fluid flex-fill">
    <div class="card resetpassword-form">
        <!-- page title -->
        <div class="page-title">
            <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Activation E-Mail erneut Senden
        </div>

        <!-- show message -->
        <?php 
            if(isset($success_msg) && !empty($success_msg)):
            ?>
        <div class="alert alert-success">
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

        <?php if($showForm) : ?>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="needs-validation" novalidate>
            <div class="form-group">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-Mail eingeben"
                    value="<?php if(isset($email)) echo $email?>">
                <div id="emailFeedback" class="invalid-feedback"></div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="send" name="send">Senden</button>
        </form>

        <?php endif; ?>
    </div>
</main>


<?php 
    include("templates/footer.inc.php");
?>
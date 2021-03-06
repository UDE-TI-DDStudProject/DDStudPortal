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

    //redirect admin to login page if the user is not login
    $user = check_admin();

    if(!empty($user)){
        header("location: index.php");
        exit;
    }


    if(isset($_POST['register'])) {
      $error = false;
      $salutationid = trim($_POST['salutation']);
      $vorname = trim($_POST['firstname']);
      $nachname = trim($_POST['lastname']);
      $email = strtolower(trim($_POST['email'])); //capital and small letter
      $passwort = $_POST['passwort'];
      $passwort2 = $_POST['repeatpasswort'];

      //not neccessary
      if(empty($vorname) || empty($nachname) || empty($email) || empty($salutationid)) {
        $error_message =  'Bitte alle Felder ausfüllen';
        $error = true;
      }
      //check password strength (defined in functions.inc.php)
      if(!password_strength($passwort)) {
        // $error_message =  'Password must contain at least one upper case, one lower case, a number, a special character and at least 8 characters!';
        $error_message =  'Das Passwort muss mindestens acht Zeichen lang sein und mindestens einen Großbuchstaben, einen Kleinbuchstaben, eine Ziffer und ein Sonderzeichen enthalten!';
        $error = true;
      }
      //check repeated password
      if($passwort != $passwort2) {
        $error_message = 'Die Passwörter müssen übereinstimmen';
        $error = true;
      }

      //Überprüfe, dass die E-Mail-Adresse in der admin_liste ist.
      if(!$error) {
          $statement = $pdo->prepare("SELECT * FROM admin_list WHERE admin_email = :email");
          $result = $statement->execute(array('email' => $email));
          $user = $statement->fetch();
      
          if(empty($user)) {
            $error_message = 'Diese E-Mail-Adresse ist nicht gültig. Bitte ein Admin kontaktieren, um deine Zugang freizugeben.';
            $error = true;
          }
        }

      //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
      if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM user WHERE email = :email and user_group_id = 2");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {
          $error_message = 'Diese E-Mail-Adresse ist bereits vergeben. Bitte login!';
          $error = true;
        }
      }

      if(!$error) {
        if(!isset($_POST['agreeToTerms'])){
          $error_message = 'Du musst erst die allgemeinen Geschäftsbedingungen akzeptieren!';
          $error = true;
        }
      }

      //Keine Fehler, wir können den Nutzer registrieren
      if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO user(user_group_id, salutation_id, firstname, lastname, email, password) VALUES (2, :salutationid, :vorname, :nachname, :email, :passwort)");
        $result = $statement->execute(array('salutationid' => $salutationid, 'email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname));

        //get user (user_group_id = 2)
        $statement = $pdo->prepare("SELECT * FROM user WHERE email = :email and user_group_id = 2");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if(!empty($user)) {
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
                $success_message = 'Wir haben dir einen Bestätigungslink geschickt. Bitte öffne die Mail und klicke auf den Link, um dein neues Konto zu aktivieren.';
                $showForm = false;
            }
        }else{
          $error_message = 'Beim Abspeichern ist leider ein Fehler aufgetreten';
        }
      }
    }

?>

<?php
    include("templates/header.inc.php");
?>

<main class="container-fluid flex-fill">
    <div class="card register-form">

        <!-- page title -->
        <div class="page-title">
            <span><img src="../screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Admin Registrieren
        </div>

        <!-- show message -->
        <?php 
        if(isset($success_message) && !empty($success_message)):
        ?>
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $success_message; ?>
        </div>
        <?php 
        endif;
        ?>

        <?php 
        if(isset($error_message) && !empty($error_message)):
        ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $error_message; ?>
        </div>
        <?php 
        endif;
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="registerForm">
            <div class="form-group">
                <select class="form-control" id="inputSalutation" name="salutation" placeholder="salutation">
                    <?php
							  $statement = $pdo->prepare("SELECT * FROM salutation");
							  $result = $statement->execute();
							  while($row = $statement->fetch()) { ?>
                    <option value="<?php echo ($row['salutation_id'])?>"
                        <?php if(isset($salutationid) and $salutationid == $row['salutation_id']) echo "selected"; ?>
                        readonly><?php echo ($row['name'])?></option>
                    <?php } ?>
                </select>
                <div id="salutationFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <input type="text" name="firstname" class="form-control" id="inputFirstname" placeholder="Vorname"
                    value="<?php if(isset($vorname)) echo $vorname?>">
                <div id="firstnameFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <input type="text" name="lastname" class="form-control" id="inputLastname" placeholder="Nachname"
                    value="<?php if(isset($nachname)) echo $nachname?>">
                <div id="lastnameFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-Mail"
                    value="<?php if(isset($email)) echo $email?>">
                <div id="emailFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <input type="password" name="passwort" class="form-control" id="inputPassword" placeholder="Passwort"
                    data-toggle="tooltip" data-placement="top"
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
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input form-control-sm" id="agreeToTerms"
                        name="agreeToTerms" checked>
                    <label class="custom-control-label col-form-label-sm" for="agreeToTerms"><a href="#">allgemeinen
                            Geschäftsbedingungen</a> lesen und akzeptieren</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="btnregister"
                name="register">Registrieren</button>
        </form>
        <br>
        <small><a href="login.php">Login hier</a></small>
    </div>
</main>

<script>
$(document).ready(function() {
    //form validation
    $("#registerForm").submit(function(e) {

        var validateFirstname = required("inputFirstname", "firstnameFeedback",
            "Firstname cannot be empty");
        var validateLastname = required("inputLastname", "lastnameFeedback",
            "Lastname cannot be empty");
        var validateSalutation = required("inputSalutation", "salutationFeedback",
            "Salutation cannot be empty");
        var validateEmail = required("inputEmail", "emailFeedback", "Email cannot be empty");
        var validatePassword = required("inputPassword", "passwordFeedback",
            "Password cannot be empty");
        var validateRepeatPassword = required("inputPasswordAgain", "repeatpasswordFeedback",
            "Must repeat password!");

        if (validateEmail == false || validatePassword == false || validateRepeatPassword == false ||
            validateFirstname == false ||
            validateLastname == false || validateSalutation == false) {
            e.preventDefault();
        }
    });

    $("#inputPassword").focus(function() {
        $('#inputPassword').tooltip('show');
    });
});
</script>

<?php
    include("templates/footer.inc.php");
?>
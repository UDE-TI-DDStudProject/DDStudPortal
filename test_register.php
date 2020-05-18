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

    if(isset($_POST['register'])) {
      $error = false;
      $salutationid = trim($_POST['salutation']);
      $vorname = trim($_POST['firstname']);
      $nachname = trim($_POST['lastname']);
      $email = trim($_POST['email']);
      $passwort = $_POST['passwort'];
      $passwort2 = $_POST['repeatpasswort'];

      //not neccessary
      if(empty($vorname) || empty($nachname) || empty($email) || empty($salutationid)) {
        $error_message =  'Bitte alle Felder ausfüllen';
        $error = true;
      }
      //check password strength (defined in functions.inc.php)
      if(!password_strength($passwort)) {
        $error_message =  'Password must contain at least one upper case, one lower case, a number, a special character and at least 8 characters!';
        $error = true;
      }
      //check repeated password
      if($passwort != $passwort2) {
        $error_message = 'Die Passwörter müssen übereinstimmen';
        $error = true;
      }

      //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
      if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {
          $error_message = 'Diese E-Mail-Adresse ist bereits vergeben';
          $error = true;
        }
      }

      //Keine Fehler, wir können den Nutzer registrieren
      if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO user(user_group_id, salutation_id, firstname, lastname, email, password) VALUES (1, :salutationid, :vorname, :nachname, :email, :passwort)");
        $result = $statement->execute(array('salutationid' => $salutationid, 'email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname));

        if($result) {
          $success_message = 'Du wurdest erfolgreich registriert. <a href="testlogin.php">Zum Login</a>';
        } else {
          $error_message = 'Beim Abspeichern ist leider ein Fehler aufgetreten';
        }
      }
    }

?>

<?php
    include("templates/testheader.php");
?>

<main class="container-fluid flex-fill">
    <div class="card register-form">
        <?php if(isset($error_message)) echo
        "<div class=\"alert alert-danger\" role=\"alert\">
          $error_message
        </div>"; else if(isset($success_message))  echo
        "<div class=\"alert alert-success\" role=\"alert\">
        $success_message
        </div>";
        ?>
        <img class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" >
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="needs-validation" id="registerForm" novalidate>
            <div class="form-group">
              <select class="form-control" id="inputSalutation" name="salutation" placeholder="salutation">
                <?php
							  $statement = $pdo->prepare("SELECT * FROM salutation");
							  $result = $statement->execute();
							  while($row = $statement->fetch()) { ?>
							  	<option value="<?php echo ($row['salutation_id'])?>" <?php if(isset($salutationid) and $salutationid == $row['salutation_id']) echo "selected"; ?> readonly><?php echo ($row['name'])?></option>
							  <?php } ?>
              </select>
              <div id="salutationFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <input type="text" name="firstname" class="form-control" id="inputFirstname" placeholder="Vorname" value="<?php if(isset($vorname)) echo $vorname?>">
              <div id="firstnameFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <input type="text" name="lastname" class="form-control" id="inputLastname" placeholder="Nachname" value="<?php if(isset($nachname)) echo $nachname?>">
              <div id="lastnameFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-Mail" value="<?php if(isset($email)) echo $email?>">
              <div id="emailFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <input type="password" name="passwort" class="form-control" id="inputPassword" placeholder="Passwort" data-toggle="tooltip" data-placement="top" title="Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.">
              <!-- <small id="passwordHelpBlock" class="form-text text-muted">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </small> -->
              <div id="passwordFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <input type="password" name="repeatpasswort" class="form-control" id="inputPasswordAgain" placeholder="Passwort wiederholen">
              <div id="repeatpasswordFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input form-control-sm" id="agreeterms" name="agreeterms" checked>
                  <label class="custom-control-label col-form-label-sm" for="agreeToTerms">Agree To Terms and Condition</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="btnregister" name="register">Registrieren</button>
        </form>
        <br>
        <small><a href="testlogin.php">Login hier</a></small>
    </div>
</main>

<script>
$(document).ready(function(){
    //form validation
    $("#registerForm").submit(function(e){

        var validateFirstname = required("inputFirstname", "firstnameFeedback", "Firstname cannot be empty");
        var validateLastname = required("inputLastname", "lastnameFeedback", "Lastname cannot be empty");
        var validateSalutation = required("inputSalutation", "salutationFeedback", "Salutation cannot be empty");
        var validateEmail = required("inputEmail", "emailFeedback", "Email cannot be empty");
        var validatePassword = required("inputPassword", "passwordFeedback", "Password cannot be empty");
        var validateRepeatPassword = required("inputPasswordAgain", "repeatpasswordFeedback", "Must repeat password!");

        if(validateEmail == false || validatePassword==false || validateRepeatPassword == false || validateFirstname == false ||
        validateLastname == false || validateSalutation == false ){
            e.preventDefault();
        }
    });

    $("#inputPassword").focus(function(){
      $('#inputPassword').tooltip('show');
    });
});
</script>

<?php
    include("templates/testfooter.php");
?>
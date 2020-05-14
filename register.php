<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

include("templates/header.inc.php")
?>
<div class="main">
<div class="container main-container">
<div class="container main-container registration-form">
<h1>Registrierung</h1>
<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) {
	$error = false;
	$salutationid = trim($_POST['salutation']);
	$vorname = trim($_POST['vorname']);
	$nachname = trim($_POST['nachname']);
	$email = trim($_POST['email']);
	$passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];
	
	if(empty($vorname) || empty($nachname) || empty($email) || empty($salutationid)) {
		echo 'Bitte alle Felder ausfüllen<br>';
		$error = true;
	}
  
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
		$error = true;
	} 	
	if(strlen($passwort) == 0) {
		echo 'Bitte ein Passwort angeben<br>';
		$error = true;
	}
	if($passwort != $passwort2) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error = true;
	}
	
	//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
	if(!$error) { 
		$statement = $pdo->prepare("SELECT * FROM user WHERE email = :email");
		$result = $statement->execute(array('email' => $email));
		$user = $statement->fetch();
		
		if($user !== false) {
			echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
			$error = true;
		}	
	}
	
	//Keine Fehler, wir können den Nutzer registrieren
	if(!$error) {	
		$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
		
		$statement = $pdo->prepare("INSERT INTO user(user_group_id, salutation_id, firstname, lastname, email, password) VALUES (1, :salutationid, :vorname, :nachname, :email, :passwort)");
		$result = $statement->execute(array('salutationid' => $salutationid, 'email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname));
		
		if($result) {		
			echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
			$showFormular = false;
		} else {
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
		}
	} 
}
 
if($showFormular) {
?>

<form action="?register=1" method="post">

<!-- <label for="inputVorname">Salutation:</label>
<div class="form-group">
<label class="radio-inline">
      <input type="radio" name="salutation" value="1">Frau
    </label>
    <label class="radio-inline">
      <input type="radio" name="salutation" value="2">Herr
    </label>
	</div> -->

<div class="form-group">
<label for="inputVorname">Salutation:</label>
<select type="text" size="1" name="salutation" class="form-control" id="selectSalutation" required>
		<?php
		$statement = $pdo->prepare("SELECT * FROM salutation");
		$result = $statement->execute();
		while($row = $statement->fetch()) { ?>
            <!--show selected option after selection 06.04.2020 by lin-->
			<option value="<?php echo ($row['salutation_id'])?>"><?php echo ($row['name'])?></option>
		<?php } ?>
	</select>
</div>

<div class="form-group">
<label for="inputVorname">Vorname:</label>
<input type="text" id="inputVorname" size="40" maxlength="250" name="vorname" class="form-control" required>
</div>

<div class="form-group">
<label for="inputNachname">Nachname:</label>
<input type="text" id="inputNachname" size="40" maxlength="250" name="nachname" class="form-control" required>
</div>

<div class="form-group">
<label for="inputEmail">E-Mail (nur @stud.uni-due.de):</label>
<input type="email" id="inputEmail" size="40" maxlength="250" name="email" class="form-control" required>
</div>

<div class="form-group">
<label for="inputPasswort">Dein Passwort:</label>
<input type="password" id="inputPasswort" size="40"  maxlength="250" name="passwort" class="form-control" required>
</div> 

<div class="form-group">
<label for="inputPasswort2">Passwort wiederholen:</label>
<input type="password" id="inputPasswort2" size="40" maxlength="250" name="passwort2" class="form-control" required>
</div> 
<button type="submit" class="btn btn-lg btn-primary btn-block">Registrieren</button>
</form>
 
<?php
} //Ende von if($showFormular)
	

?>
</div>
</div>
</div>
<?php 
include("templates/footer.inc.php")
?>
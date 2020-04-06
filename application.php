<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

include("templates/header.inc.php");


// ab hier anpassen 
if(isset($_GET['save'])) {
	$save = $_GET['save'];
	
	
	
	
	
	// erster Reiter
	if($save == 'personal_data') {
		$vorname = trim($_POST['vorname']);
		$nachname = trim($_POST['nachname']);
		
		if($vorname == "" || $nachname == "") {
			$error_msg = "Bitte Vor- und Nachname ausfüllen.";
		} else {
			$statement = $pdo->prepare("UPDATE users SET vorname = :vorname, nachname = :nachname, updated_at=NOW() WHERE id = :userid");
			$result = $statement->execute(array('vorname' => $vorname, 'nachname'=> $nachname, 'userid' => $user['id'] ));
						
			$success_msg = "Daten erfolgreich gespeichert.";
		}
	
	
	
	
	
	
	
	// zweiter Reiter 
	} else if($save == 'email') {
		$passwort = $_POST['passwort'];
		$email = trim($_POST['email']);
		$email2 = trim($_POST['email2']);
		
		if($email != $email2) {
			$error_msg = "Die eingegebenen E-Mail-Adressen stimmten nicht überein.";
		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error_msg = "Bitte eine gültige E-Mail-Adresse eingeben.";
		} else if(!password_verify($passwort, $user['passwort'])) {
			$error_msg = "Bitte korrektes Passwort eingeben.";
		} else {
			$statement = $pdo->prepare("UPDATE users SET email = :email WHERE id = :userid");
			$result = $statement->execute(array('email' => $email, 'userid' => $user['id'] ));
			
			$success_msg = "E-Mail-Adresse erfolgreich gespeichert.";
		}
	





	// dritter Reiter
	} else if($save == 'passwort') {
		$passwortAlt = $_POST['passwortAlt'];
		$passwortNeu = trim($_POST['passwortNeu']);
		$passwortNeu2 = trim($_POST['passwortNeu2']);
		
		if($passwortNeu != $passwortNeu2) {
			$error_msg = "Die eingegebenen Passwörter stimmten nicht überein.";
		} else if($passwortNeu == "") {
			$error_msg = "Das Passwort darf nicht leer sein.";
		} else if(!password_verify($passwortAlt, $user['passwort'])) {
			$error_msg = "Bitte korrektes Passwort eingeben.";
		} else {
			$passwort_hash = password_hash($passwortNeu, PASSWORD_DEFAULT);
				
			$statement = $pdo->prepare("UPDATE users SET passwort = :passwort WHERE id = :userid");
			$result = $statement->execute(array('passwort' => $passwort_hash, 'userid' => $user['id'] ));
					
			$success_msg = "Passwort erfolgreich gespeichert.";
		}
		
	}
}

$user = check_user();

?>

<div class="main">
<div class="container main-container">

<h1>Bewerbungsformular</h1>

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
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	<?php echo $error_msg; ?>
	</div>
<?php 
endif;
?>



  <!-- Nav tabs -->
  <!-- aus data: personaldata, email: homeaddress, password: homestudy-->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" id="tab1" class="active"><a href="#personaldata" role="tab" data-toggle="tab">Persönliche Angaben</a></li>
    <li role="presentation" id="tab2"><a href="#homeaddress" role="tab" data-toggle="tab">Heimat-Adresse</a></li>
    <li role="presentation" id="tab3"><a href="#homestudy" role="tab" data-toggle="tab">Aktuelles Studium</a></li>
    <li role="presentation" id="tab4"><a href="#foreignstudy" role="tab" data-toggle="tab">Austauschprogramm</a></li>
    <li role="presentation" id="tab5"><a href="#attachments" role="tab" data-toggle="tab">Anhänge</a></li>
	<li role="presentation" id="tab6"><a href="#courselist" role="tab" data-toggle="tab">Fächerwahl</a></li>
  </ul>

  <div class="tab-content">
  
  
  <!-- erster Reiter: Persönliche Daten-->		
		<div role="tabpanel" class="tab-pane active" id="personaldata">
			<br>
			<form action="?save=personal_data" method="post">
			<!-- erster Reiter NEU-->
			<!--<form action="?application=1" method="post" name="application"> <!-- register anpassen! -->
			<div class="form-horizontal">
				<div class="form-group">
					<label for="inputSalutation" class="col-sm-3 control-label">Anrede (salutation):</label>
					<div class="col-sm-7">
					<select type="text" id="inputSalutation" size="1" name="salutation" class="form-control" required>
						<option></option>
						<option value="Mr">Herr (Mr)</option>
						<option value="Ms">Frau (Ms)</option>
					</select>
					</div>
				</div>
		
				<div class="form-group">
					<label for="inputFirstName" class="col-sm-3 control-label">Vorname (first name):</label>
					<div class="col-sm-7">
						<input type="text" id="inputFirstName" name="firstname" class="form-control" value=<?php echo htmlentities($user['vorname']); ?>>
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputSurname" class="col-sm-3 control-label">Nachname (surname):</label>
					<div class="col-sm-7">
						<input type="text" id="inputSurname" name="surname" class="form-control" value=<?php echo htmlentities($user['nachname']); ?>>
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail" class="col-sm-3 control-label">E-Mail (only @stud.uni-due.de):</label>
					<div class="col-sm-7">
						<input type="email" id="inputEmail" name="email" class="form-control" value=<?php echo htmlentities($user['email']); ?>>
					</div>
				</div>
					
				<div class="form-group">
					<label for="inputNationality" class="col-sm-3 control-label">Nationalität (nationality): </label>
					<div class="col-sm-7">
						<select type="text" id="inputNationality" size="1"  name="nationality" class="form-control" required>
						<!-- Eingefügt start-->
							<?php 
								$statement = $pdo->prepare("SELECT * FROM countries ORDER BY countryid");
								$result = $statement->execute();
								$count = 1;
								while($row = $statement->fetch()) { ?>
									<option><?php echo ($row['country']);?></option>
							<?php } ?>		
						<!--Eingefügt ende --> 
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="inputBday" class="col-sm-3 control-label">Geburtsdatum (birthday): </label>
					<div class="col-sm-7">
						<input type="date" id="inputBday" size="40" maxlength="20" name="birthday" class="form-control" style="valign: middle; padding-top: 0px" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
						<a href="#homeaddress" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Weiter</button></a>
					</div>
				</div>
			</div>
		</div>
		
	<!-- zweiter Reiter: Homeaddress-->
		<div role="tabpanel" class="tab-pane" id="homeaddress">
			<br>
			<div class="form-horizontal">
				<div class="form-group">
					<label for="inputStreet" class="col-sm-3 control-label">Straße und Haus-Nr. (street and no.): </label>
					<div class="col-sm-7">
						<input type="text" id="inputStreet" size="40" maxlength="40" name="home_street" class="form-control" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputZip" class="col-sm-3 control-label">PLZ (zip): </label>
					<div class="col-sm-7">
						<input type="text" id="inputZip" size="40" maxlength="10" name="home_zip" class="form-control" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputCity" class="col-sm-3 control-label">Ort (city): </label>
					<div class="col-sm-7">
						<input type="text" id="inputCity" size="40" maxlength="40" name="home_city" class="form-control" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputState" class="col-sm-3 control-label">Bundesland (state): </label>
					<div class="col-sm-7">
						<input type="text" id="inputState" size="40" maxlength="40" name="home_state" class="form-control" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputCountry" class="col-sm-3 control-label">Land (country): </label>
					<div class="col-sm-7">
						<select type="text" id="inputCountry" size="1"  name="home_country" class="form-control" required>
							<!-- Eingefügt start-->
							<?php 
								$statement = $pdo->prepare("SELECT * FROM countries ORDER BY countryid");
								$result = $statement->execute();
								$count = 1;
								while($row = $statement->fetch()) { ?>
									<option><?php echo ($row['country']);?></option>
							<?php } ?>		
							<!--Eingefügt ende --> 
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputPhone" class="col-sm-3 control-label">Telefonnummer (phone): </label>
					<div class="col-sm-7">
						<input type="text" id="inputPhone" size="40" maxlength="15" name="home_phone" class="form-control" required>
					</div>
				</div>
				
			
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
						<a href="#personaldata" role="tab" data-toggle="tab1"><button type="button" class="btn btn-primary">Zurück</button></a>
						<a href="#homestudy" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Weiter</button></a>
					</div>
				</div>
			</div>
		</div>
		
	<!-- dritter Reiter: Homestudy -->
		<div role="tabpanel" class="tab-pane" id="homestudy">
			<br>
			<div class="form-horizontal">	
				<div class="form-group"> <!-- Tabelle in ddstud vorhanden -->
					<label for="inputHomeDegree" class="col-sm-3 control-label">Derzeit angestrebter Abschluss <br>(home degree): </label>
					<div class="col-sm-7">
						<select type="value" id="inputHomeDegree" size="1" maxlength="30" name="home_degree" class="form-control" required>
							<option></option>
							<option value="1">Bachelor of Science</option>
							<option value="2">Master of Science</option>
						</select>
					</div>
				</div>

				<div class="form-group"> <!-- Tabelle in ddstud vorhanden -->
					<label for="inputHomeCourse" class="col-sm-3 control-label">Aktueller Studiengang <br> (home program): </label>
					<div class="col-sm-7">
						<select type="value" id="inputHomeCourse" size="1"  name="home_course" class="form-control" required>
						<!-- Eingefügt start-->
							<?php 
								$statement = $pdo->prepare("SELECT * FROM courses ORDER BY course ASC");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['courseid'])?>"><?php echo ($row['course']);?></option> <!-- value="<?php //echo $row['courseid']?>" -->
							<?php } ?>		
						<!--Eingefügt ende --> 
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="inputMatrNo" class="col-sm-3 control-label">Matrikelnummer (matr.-no.): </label>
						<div class="col-sm-7">
						<input type="number" id="inputMatrNo" maxlength="10"  name="home_matno" class="form-control" required>
					</div>
				</div>
					
				<div class="form-group"> <!-- existiert in ddstud noch nicht -->
					<label for="inputEnrollment" class="col-sm-3 control-label">Monat/Jahr der Einschreibung in aktuellen Studiengang <br>(month/year of enrollment): </label>
					<div class="col-sm-7">
						<input type="text" id="inputEnrollment" maxlength="7" name="home_enrollment" class="form-control" placeholder="MM/YYYY" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputHomeSemester" class="col-sm-3 control-label">Fachsemester aktueller Studiengang (semester): </label>
					<div class="col-sm-7">
						<select type="text" id="inputHomeSemester" size="1" maxlength="1" name="home_semester" class="form-control" required>
							<option></option>
							<option value="1">1. Semester</option>
							<option value="2">2. Semester</option>
							<option value="3">3. Semester</option>
							<option value="4">4. Semester</option>
							<option value="5">5. Semester</option>
							<option value="6">6. Semester</option>
							<option value="7">7. Semester</option>
							<option value="8">8. Semester</option>
						</select>	
					</div>
				</div>

				<div class="form-group"> 
					<label for="inputHomeCredits" class="col-sm-3 control-label">Summe bisher erworbener Kreditpunkte laut beigefügtem Transkript (Credits):</label>
					<div class="col-sm-7">
						<input type="number" id="inputHomeCredits" min="0" step="1" max="300" maxlength="3" name="home_credits" class="form-control" required>
					</div>
				</div>

				<div class="form-group"> <!-- nochmal die "steps" checken und nur punkt- ODER komma-trennung erlauben -->
					<label for="inputHomeCGPA" class="col-sm-3 control-label">Durchschnittsnote laut beigefügtem Transkript (CGPA/ Average Grade)):</label>
					<div class="col-sm-7">
						<input type="text" id="inputHomeCGPA" min="1" max="4" step="0.1" maxlength="3" name="home_cgpa" class="form-control" required>
					</div>
				</div><br>
				
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
						<a href="#homeaddress" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Zurück</button></a>
						<a href="#foreignstudy" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Weiter</button></a>
					</div>
				</div>
			</div>
		</div>
		
	<!-- vierer Reiter: Foreignstudy -->
		<div role="tabpanel" class="tab-pane" id="foreignstudy">
			<br>
			<div class="form-horizontal">
				
				<div class="form-group">
					<label for="inputIntention" class="col-sm-3 control-label">Programm (type of transfer):</label>
					<div class="col-sm-7">
						<select type="text" id="inputIntention" size="1" maxlength="20" name="intention" class="form-control" >
							<option></option>
							<option>Exchange</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="inputStart" class="col-sm-3 control-label">Beginn des Austauschs (start of transfer):</label>
					<div class="col-sm-7">
						<select type="number" id="inputStart" size="1" maxlength="7" name="starting_semester" class="form-control" >
							<option></option>
							<option value="2019.5">WS19/20</option>
							<option value="2020.5">WS20/21</option>
						</select>
					</div>
				</div>
					
				<div class="form-group"> <!-- existiert in ddstud noch nicht -->
					<label for="inputForeignDegree" class="col-sm-3 control-label">Während des geplanten Auslandsemester werde ich
					voraussichtlich Student sein in (abroad degree):</label>
					<div class="col-sm-7">
						<select type="text" id="inputForeignDegree" size="1" name="foreign_degree" class="form-control" >
							<option></option>
							<option>einem Bachelorstudiengang an der UDE</option>
							<option>einem Masterstudiengang an der UDE</option>
						</select>
					</div>
				</div>
					
					
				<div class="form-group">
					<label for="inputFirstPrio" class="col-sm-3 control-label">1. Priorität (1. priority):</label>
					<div class="col-sm-7">
						<select type="number" id="inputFirstPrio" size="1" maxlength="20" name="firstprio" class="form-control" >
							<option></option>
							<option value="2">UKM, Malaysia</option>
							<option value="3">UI, Indonesia</option>
							<option value="5">NTU, Singapur</option>
						</select>
					</div>
				</div>
					
				<div class="form-group">
					<label for="inputSecondPrio" class="col-sm-3 control-label">2. Priorität (2. priority):</label>
					<div class="col-sm-7">
						<select type="number" id="inputSecondPrio" size="1" maxlength="20" name="secondprio" class="form-control">
							<option></option>
							<option value="2">UKM, Malaysia</option>
							<option value="3">UI, Indonesia</option>
							<option value="5">NTU, Singapur</option>
						</select>
					</div>
				</div>
					
				<div class="form-group">
					<label for="inputThirdPrio" class="col-sm-3 control-label">3. Priorität (3. priority):</label>
					<div class="col-sm-7">
						<select type="number" id="inputThirdPrio" size="1" maxlength="20" name="thirdprio" class="form-control">
							<option></option>
							<option value="2">UKM, Malaysia</option>
							<option value="3">UI, Indonesia</option>
							<option value="5">NTU, Singapur</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
						<a href="#homestudy" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Zurück</button></a>
						<a href="#attachments" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Weiter</button></a>
					</div>
				</div>
				
			</div>
		</div>
		
	<!-- fünfter Reiter: Attachments -->
		<div role="tabpanel" class="tab-pane" id="attachments">
			<br>
			<div class="form-horizontal">
				
				<div class="form-group"> 
					<label for="CourseList" class="col-sm-3 control-label"> Ausgefüllte Fächerwahlliste [Excel Format]</label>	
					<div class="col-sm-7">
						<input type="file" size="75" class="btn btn-primary" name="Fächerwahlliste" accept="text/*" required><br>
					</div>
				</div>
				
				<div class="form-group"> 
					<label for="CourseList" class="col-sm-3 control-label"> Motivationsschreiben [In Englisch und PDF]</label>	
					<div class="col-sm-7">
						<input type="file" size="75" class="btn btn-primary" name="Motivationsschreiben" accept="text/*" ><br>
					</div>
				</div>
				
				<div class="form-group"> 
					<label for="CourseList" class="col-sm-3 control-label"> Lebenslauf [In Englisch und PDF]</label>	
					<div class="col-sm-7">
						<input type="file" size="75" class="btn btn-primary" name="Lebenslauf" accept="text/*" ><br>
					</div>
				</div>
				
				<div class="form-group"> 
					<label for="CourseList" class="col-sm-3 control-label"> Aktuelles Transkript/Zeugnis [PDF]</label>	
					<div class="col-sm-7">
						<input type="file" size="75" class="btn btn-primary" name="Transkript" accept="text/*" ><br>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
						<a href="#foreignstudy" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary">Zurück</button></a>
						<button type="submit" class="btn btn-success" style="width: 340px">Bewerbung abschicken</button>
					</div>
				</div>
			</div>
		</div>


	<!-- sechster Reiter: Fächerwahl -->
		<div role="tabpanel" class="tab-pane" id="courselist">
			<br>
			<div class="form-horizontal">
			
			<form action="?university=1" method="post">

				<div class="form-group" style="background-color: #003D76; color: white"> 
					<table class="table" rules="none">
						<tr>
							<td width="50%" align="center"><label for="Home_uni"><font size="5">Heim-Universität </font><br>(Home-University)</label></th>
							<td width="50%" align="center"><label for="Foreign_uni"><font size="5">Partner-Universität </font><br>(Foreign-University)</label></th>
						</tr>
						<tr>
							<td>				
								<select type="text" size="1"  name="home_locationid" class="form-control" required>
									<?php 
									$statement = $pdo->prepare("SELECT location, locationid FROM university ORDER BY locationid");
									$result = $statement->execute();
									while($row = $statement->fetch()) { ?>
										<option value="<?php echo ($row['locationid'])?>"><?php echo ($row['location'])?></option>
									<?php } ?>		
								</select>
							</td>
							<td>
								<select type="text" size="1"  name="foreign_locationid" class="form-control">
									<?php 
									$statement = $pdo->prepare("SELECT location, locationid FROM university ORDER BY locationid");
									$result = $statement->execute();
									while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['locationid'])?>"><?php echo ($row['location'])?></option>
									<?php } ?>		
								</select>
							</td>
						</tr>
					</table>

					<button type="submit" name="university" class="btn btn-lg btn-primary btn-block">Äquivalenzliste laden</button>
				</div><br>
			</form>
				
			
					
			</div>
		</div>
	</form>
	
	</div>
	
</div>
</div>

<?php 
include("templates/footer.inc.php")
?>
<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user(); //zur Prüfung des users in der "user"-Datenbank
$user1 = check_user(); //zur Prüfung des users in der "student_new"-Datenbank
$studentDB = 'student_new';
$homeaddressDB = 'home_address';
$homestudyDB = 'study_home';
$priorityDB = 'priority';

include("templates/header.inc.php");


$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['application'])) {
	$error = false;
	//ab hier Student_new DB
	$salutation = $_POST['salutation'];
	$firstname = trim($_POST['firstname']);
	$surname = trim($_POST['surname']);
	$email = trim($_POST['email']);
	$nationality = trim($_POST['nationality']);
	$birthday = $_POST['birthday'];
	
	//ab hier Home_Address DB
	$home_street = $_POST['home_street'];
	$home_zip = trim($_POST['home_zip']);
	$home_city = trim($_POST['home_city']);
	$home_state = trim($_POST['home_state']);
	$home_country = trim($_POST['home_country']);
	$home_phone = trim($_POST['home_phone']);
	$user_id = $user['id'];
		//fixed parameters
		$overall_status = "Interested";
	
	//ab hier Home_study DB
	$home_degree = trim($_POST['home_degree']);
	$home_course = trim($_POST['home_course']);
	$home_matno = trim($_POST['home_matno']);
	$home_enrollment = trim($_POST['home_enrollment']);
	$home_semester = trim($_POST['home_semester']);
	$home_credits = trim($_POST['home_credits']);
	$home_cgpa = Namen_bereinigen(trim($_POST['home_cgpa']));
		//fixed parameters
		$home_university = "4"; //Universität Duisburg-Essen
	
	//ab hier Foreign_study für Student_new DB
	$intention = trim($_POST['intention']);
	$starting_semester = $_POST['starting_semester']; 
	$foreign_degree = $_POST['foreign_degree'];
	
	//ab hier priority DB
	$firstprio = trim($_POST['firstprio']);
	$secondprio = trim($_POST['secondprio']);
	$thirdprio = trim($_POST['thirdprio']);
	$noexams_firstuni = trim($_POST['noexams_firstuni']);
	
	
	//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
	if(!$error) { 
		$statement = $pdo->prepare("SELECT * FROM $studentDB WHERE user_id = :user_id");
		$result = $statement->execute(array('user_id' => $user_id));
		$user1 = $statement->fetch();

		if($user1 !== false) {
			?><div class="alert alert-danger"><?php
			echo 'Sie haben sich bereits beworben. <br> Bei Fragen wenden Sie sich bitten an den ';
			?><a href="mailto:iw-auslandssemester@uni-due.de">Projektverantwortlichen</a>!<?php
			$error = true;
			?></div><?php
		}	
	}

	//Keine Fehler, wir können den Nutzer in die ***student_new*** DB registrieren
	if(!$error) {	
		$statement = $pdo->prepare("INSERT INTO $studentDB (
			surname, 
			firstname, 
			email, 
			birthday, 
			nationality, 
			salutation, 
			overall_status,
			intention,
			user_id) 
		VALUES (
			:surname, 
			:firstname, 
			:email, 
			:birthday, 
			:nationality, 
			:salutation,
			:overall_status,
			:intention,
			:user_id
		)");
		$result = $statement->execute(array(
			'surname' => $surname, 
			'firstname' => $firstname, 
			'email' => $email, 
			'birthday' => $birthday, 
			'nationality' => $nationality, 
			'salutation' => $salutation,
			'overall_status' => $overall_status,
			'intention' => $intention,
			'user_id' => $user_id
		));
		
		if($result) {		
			//echo 'Du wurdest erfolgreich registriert. <a href="internalCourses.php">Zur Fächerwahl</a>';
			//$showFormular = false;
		} else {
			?><div class="alert alert-danger"><?php
			echo 'Beim Abspeichern der persönlichen Daten ist leider ein Fehler aufgetreten<br>';
			?></div><?php
		}
	} 
	
	//Keine Fehler, wir können die PersonalID abfragen 
	if(!$error) {	
		
		//student_id feststellen
		$statement = $pdo->prepare("SELECT * FROM $studentDB ORDER BY last_update DESC limit 1");
		$result = $statement->execute();
		while($row = $statement->fetch()) {
			$personalid = $row['personalid'];
		}
		
		if($result) {
			//
		}
		else {
			?><div class="alert alert-danger"><?php
			echo 'Beim Feststellen der StudentID ist leider ein Fehler aufgetreten<br>';
			?></div><?php
			$error = true;
		}	
		//student_id feststellen ende
	}
	
	//Keine Fehler, wir können den Nutzer in die ***home_address*** DB registrieren
	if(!$error) {	
		$statement = $pdo->prepare("INSERT INTO $homeaddressDB (
			studentid, 
			home_street, 
			home_zip, 
			home_city, 
			home_state, 
			home_country, 
			home_phone) 
		VALUES (
			:studentid, 
			:home_street, 
			:home_zip, 
			:home_city, 
			:home_state, 
			:home_country, 
			:home_phone
		)");
		$result = $statement->execute(array(
			'studentid' => $personalid, 
			'home_street' => $home_street, 
			'home_zip' => $home_zip, 
			'home_city' => $home_city, 
			'home_state' => $home_state, 
			'home_country' => $home_country, 
			'home_phone' => $home_phone
		));
		
		if($result) {		
			//echo 'Du wurdest erfolgreich registriert. <a href="internalCourses.php">Zur Fächerwahl</a>';
			//$showFormular = false;
		} else {
			?><div class="alert alert-danger"><?php
			echo 'Beim Abspeichern der Heimadresse ist leider ein Fehler aufgetreten<br>';
			?></div><?php
			$error = true;
		}
	}	
	
	//Keine Fehler, wir können den Nutzer in die ***home_study*** DB registrieren
	if(!$error) {	
		$statement = $pdo->prepare("INSERT INTO $homestudyDB (
			home_university,
			home_matno,
			home_degree, 
			home_course,
			studentid,
			home_cgpa,
			home_enrollment,
			home_semester,
			home_credits
			) 
		VALUES (
			:home_university,
			:home_matno,
			:home_degree, 
			:home_course,
			:studentid,
			:home_cgpa,
			:home_enrollment,
			:home_semester,
			:home_credits
			)");
		$result = $statement->execute(array(
			'home_university' => $home_university, //
			'home_matno' => $home_matno,			
			'home_degree' => $home_degree,
			'home_course' => $home_course,
			'studentid' => $personalid,
			'home_cgpa' => $home_cgpa,
			'home_enrollment' => $home_enrollment,
			'home_semester' => $home_semester,
			'home_credits' => $home_credits
		));

		if($result) {		
			//echo 'Du wurdest erfolgreich registriert. <a href="internalCourses.php">Zur Fächerwahl</a>';
			//$showFormular = false;
		} else {
			?><div class="alert alert-danger"><?php
			echo 'Beim Abspeichern des Heimstudiums ist leider ein Fehler aufgetreten<br>';
			echo htmlentities($personalid);
			?></div><?php
			$error = true;
		}
	}

	//Keine Fehler, wir können den Nutzer in die ***priority*** DB registrieren
	if(!$error) {	
		$statement = $pdo->prepare("INSERT INTO $priorityDB (
			studentid,
			first_uni,
			second_uni,
			third_uni,
			noexams_firstuni)
		VALUES (
			:studentid,
			:first_uni,
			:second_uni,
			:third_uni,
			:noexams_firstuni
			)");
		$result = $statement->execute(array(
			'studentid' => $personalid, //
			'first_uni' => $firstprio,
			'second_uni' => $secondprio,
			'third_uni' => $thirdprio,
			'noexams_firstuni' => $noexams_firstuni
		));

		if($result) {		
			?><div class="alert alert-success"><?php
			echo 'Du wurdest erfolgreich registriert. <a href="upload.php">zum Dateiupload</a>';
			?></div><?php
			$showFormular = false;
		} else {
			?><div class="alert alert-danger"><?php
			echo 'Beim Abspeichern der Universitäts-Prioritäten ist leider ein Fehler aufgetreten<br>';
			echo htmlentities($personalid);
			?></div><?php
			$error = true;
		}
	} 

	
}

if($showFormular) {
?>
<div class = "main">

	<div class = "container main-container">

		<div class="head">
			<h1>Bewerbungsformular</h1>
		</div>
		
			<div class = "container main-container registration-form">
				
				<div style="text-align: center; font-family: Times New Roman, Arial; background-color: lightyellow">

					<font size="4">
						<p><i>Hallo <b><?php echo htmlentities($user['vorname']); ?></b>!<br>
						Hier kannst du deine Bewerberdaten für die Teilnahme an einem Austauschprogramm in <b> Malaysia, Indonesien oder Singapur </b> eingeben und dich für ein Austauschprogramm bewerben. </i></p>
					</font> 

				</div>
				
				<form action="?application=1" method="post" name="application"> <!-- register anpassen! -->
			
					<p><h3>Persönliche Angaben (personal data)</h3><p>
					
					<div class="form-group">
					<label for="inputSalutation">Anrede (salutation):</label>
					<select type="text" id="inputSalutation" size="1" maxlength="20" name="salutation" class="form-control" required>
						<option></option>
						<option value="Mr">Herr (Mr)</option>
						<option value="Ms">Frau (Ms)</option>
					</select>
					</div>
					
					<div class="form-group">
					<label for="inputFirstName">Vorname (first name):</label>
					<input type="text" id="inputFirstName" size="40" maxlength="50" name="firstname" class="form-control" value=<?php echo htmlentities($user['vorname']); ?>>
					</div>
							
					<div class="form-group">
					<label for="inputSurname">Nachname (surname):</label>
					<input type="text" id="inputSurname" size="40" maxlength="50" name="surname" class="form-control" value=<?php echo htmlentities($user['nachname']); ?>>
					</div>
					
					<div class="form-group">
					<label for="inputEmail">E-Mail (only @stud.uni-due.de):</label>
					<input type="email" id="inputEmail" size="40" maxlength="50" name="email" class="form-control" value=<?php echo htmlentities($user['email']); ?>>
					</div>
					
					<div class="form-group">
					<label for="inputNationality">Nationalität (nationality): </label>
					<select type="text" id="inputNationality" size="1"  name="nationality" class="form-control">
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

					<div class="form-group">
					<label for="inputBday">Geburtsdatum (birthday): </label>
					<input type="date" id="inputBday" size="40" maxlength="20" name="birthday" class="form-control" style="valign: middle; padding-top: 0px" required>
				</div><br>
			
				<p><h3>Heimat-Adresse (home address)</h3></p>	

				<div class="form-group">
				<label for="inputStreet">Straße und Hausnummer (street and number): </label>
				<input type="text" id="inputStreet" size="40" maxlength="40" name="home_street" class="form-control" required>
				</div>
				
				<div class="form-group">
				<label for="inputZip">PLZ (zip): </label>
				<input type="text" id="inputZip" size="40" maxlength="10" name="home_zip" class="form-control" required>
				</div>
				
				<div class="form-group">
				<label for="inputCity">Ort (city): </label>
				<input type="text" id="inputCity" size="40" maxlength="40" name="home_city" class="form-control" required>
				</div>
				
				<div class="form-group">
				<label for="inputState">Bundesland (state): </label>
				<input type="text" id="inputState" size="40" maxlength="40" name="home_state" class="form-control" required>
				</div>
				
				<div class="form-group">
				<label for="inputCountry">Land (country): </label>
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
				
				<div class="form-group">
				<label for="inputPhone">Telefonnummer (phone): </label>
				<input type="text" id="inputPhone" size="40" maxlength="15" name="home_phone" class="form-control" required>
				</div><br>

				<p><h3>Aktuelles Studium (home study)</h3></p>	

				<div class="form-group"> <!-- Tabelle in ddstud vorhanden -->
				<label for="inputHomeDegree">Derzeit angestrebter Abschluss (home degree): </label>
				<select type="value" id="inputHomeDegree" size="1" maxlength="30" name="home_degree" class="form-control" required>
					<option></option>
					<option value="1">Bachelor of Science</option>
					<option value="2">Master of Science</option>
				</select>
				</div>

				<div class="form-group"> <!-- Tabelle in ddstud vorhanden -->
				<label for="inputHomeCourse">Aktueller Studiengang (home program): </label>
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

				<div class="form-group">
				<label for="inputMatrNo">Matrikelnummer (matr.-no.): </label>
				<input type="number" id="inputMatrNo" size="40" maxlength="10"  name="home_matno" class="form-control" required>
				</div>
						
				<div class="form-group"> <!-- existiert in ddstud noch nicht -->
				<label for="inputEnrollment">Monat/Jahr der Einschreibung in aktuellen Studiengang (month/year of enrollment): </label>
				<input type="text" id="inputEnrollment" size="40" maxlength="7" name="home_enrollment" class="form-control" placeholder="MM/YYYY" required>
				</div>
							
				<div class="form-group">
				<label for="inputHomeSemester">Fachsemester aktueller Studiengang (semester): </label>
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

				<div class="form-group"> 
				<label for="inputHomeCredits">Summe bisher erworbener Kreditpunkte laut beigefügtem Transkript (Credits):</label>
				<input type="number" id="inputHomeCredits" size="40" min="0" step="1" max="300" maxlength="3" name="home_credits" class="form-control" required>
				</div>

				<div class="form-group"> <!-- nochmal die "steps" checken und nur punkt- ODER komma-trennung erlauben -->
				<label for="inputHomeCGPA">Durchschnittsnote laut beigefügtem Transkript (CGPA/ Average Grade)):</label>
				<input type="text" id="inputHomeCGPA" size="40" min="1" max="4" step="0.1" maxlength="3" name="home_cgpa" class="form-control" required>
				</div><br>
				
				<p><h3>Geplantes Austauschprogramm (planned study abroad)</h3></p>	
				
				<div class="form-group">
				<label for="inputIntention">Programm (type of transfer):</label>
				<select type="text" id="inputIntention" size="1" maxlength="20" name="intention" class="form-control" >
					<option></option>
					<option>Exchange</option>
				</select>
				</div>

				<div class="form-group">
				<label for="inputStart">Beginn des Austauschs (start of transfer):</label>
				<select type="number" id="inputStart" size="1" maxlength="7" name="starting_semester" class="form-control" >
					<option></option>
					<option value="2019.5">WS19/20</option>
					<option value="2020.5">WS20/21</option>
				</select>
				</div>
				
				<div class="form-group"> <!-- existiert in ddstud noch nicht -->
				<label for="inputForeignDegree">Während des geplanten Auslandsemester werde ich
				voraussichtlich Student sein in (abroad degree):</label>
				<select type="text" id="inputForeignDegree" size="1" name="foreign_degree" class="form-control" >
					<option></option>
					<option>einem Bachelorstudiengang an der UDE</option>
					<option>einem Masterstudiengang an der UDE</option>
				</select>
				</div>
				
				
				<div class="form-group">
				<label for="inputFirstPrio">1. Priorität (1. priority):</label>
				<select type="number" id="inputFirstPrio" size="1" maxlength="20" name="firstprio" class="form-control" >
					<option></option>
					<option value="2">UKM, Malaysia</option>
					<option value="3">UI, Indonesia</option>
					<option value="5">NTU, Singapur</option>
				</select>
				</div>
				
				<div class="form-group">
				<label for="inputSecondPrio">2. Priorität (2. priority):</label>
				<select type="number" id="inputSecondPrio" size="1" maxlength="20" name="secondprio" class="form-control">
					<option></option>
					<option value="2">UKM, Malaysia</option>
					<option value="3">UI, Indonesia</option>
					<option value="5">NTU, Singapur</option>
				</select>
				</div>
				
				<div class="form-group">
				<label for="inputThirdPrio">3. Priorität (3. priority):</label>
				<select type="number" id="inputThirdPrio" size="1" maxlength="20" name="thirdprio" class="form-control">
					<option></option>
					<option value="2">UKM, Malaysia</option>
					<option value="3">UI, Indonesia</option>
					<option value="5">NTU, Singapur</option>
				</select>
				</div>
			
				<div class="form-group"> <!-- existiert in ddstud noch nicht -->
				<label for="inputForeignExams">Geben Sie bitte für ihre Partnerhochschule in erster Wahl an,
				wie viele Fächer laut beigefügter Fächerwahlliste der
				Partnerhochschule für Ihren Aufenthalt in Frage kommen <br>(no of exams):</label>
				<input type="number" id="inputForeignExams" size="40" max="15" maxlength="2" name="noexams_firstuni" class="form-control" >
				</div><br>
				
				<!--<input type="checkbox" name="AGB" value="AGB" >
				Ich habe die <a href="#">AGB's</a> gelesen und akzeptiere diese.<br>-->
				<div  style="text-align: justify">
				<input type="checkbox" name="Datenschutz" value="Datenschutz">
				<b>Ich stimme der <a href="#">Datenschutzerklärung</a> zu und bin damit einverstanden, dass meine Daten im Rahmen des Austauschprogramms gespeichert und ausgewertet werden. </b><br><br>
				</div>
						
				<button type="submit" class="btn btn-lg btn-primary btn-block">Bewerbung abschicken</button>
		
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
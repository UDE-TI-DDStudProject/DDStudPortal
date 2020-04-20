<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

include("templates/header.inc.php");
?>

<div class="main">
<div class="container main-container">

<?php
//set database table variables
$studentDB = "student_new";
$homeaddressDB = "home_address";
$homestudyDB = "study_home";
$priorityDB = "priority";

//bewerbung abgeschickt
if(isset($_POST['abschicken'])) {
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
	$first_uni = trim($_POST['firstprio']);
	$second_uni = trim($_POST['secondprio']);
	$third_uni = trim($_POST['thirdprio']);
	//$noexams_firstuni = trim($_POST['noexams_firstuni']);
	
	
	//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
	if(!$error) { 
		$statement = $pdo->prepare("SELECT * FROM $studentDB WHERE user_id = $user_id");
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

	//Data validation
	if(!$error){
		//Check if all required fields are filled
		if(!isset($salutation) or !isset($firstname) or !isset($surname) or !isset($email) or !isset($nationality) or !isset($birthday)
		or !isset($home_street) or !isset($home_zip) or !isset($home_city) or !isset($home_state) or !isset($home_country) or !isset($home_phone)
		or !isset($home_degree) or !isset($home_course) or !isset($home_matno) or !isset($home_enrollment) or !isset($home_semester) or !isset($home_credits) or !isset($home_cgpa)
		or !isset($intention) or !isset($starting_semester) or !isset($foreign_degree) or !isset($first_uni) or !isset($second_uni) or !isset($third_uni)){
			$error = true;
			?><div class="alert alert-danger"><?php
			echo 'Please fill in all require fields!';
			?></div><?php
			$error = true;
		}
	}

	//if user hasn't applied yet
	if(!$error){
	
		try {
			//check error in qeuries and throw exception if error found
			$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    		$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
			$pdo->beginTransaction();

			$statement1 = $pdo->prepare("INSERT INTO $studentDB (
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
				'$surname', 
				'$firstname', 
				'$email', 
				'$birthday', 
				'$nationality', 
				'$salutation',
				'$overall_status',
				'$intention',
				'$user_id'
			)");
		
			$statement2 = $pdo->prepare("SELECT personalid FROM $studentDB ORDER BY last_update DESC limit 1");

			$statement1->execute();

			$result = $statement2->execute();
			$row = $statement2->fetch();
			$studentid = $row['personalid'];

			$statement3 = $pdo->prepare("INSERT INTO $homeaddressDB (
				studentid, 
				home_street, 
				home_zip, 
				home_city, 
				home_state, 
				home_country, 
				home_phone) 
			VALUES (
				'$studentid', 
				'$home_street', 
				'$home_zip', 
				'$home_city', 
				'$home_state', 
				'$home_country', 
				'$home_phone'
			)");
		
			$statement4 = $pdo->prepare("INSERT INTO $homestudyDB (
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
				'$home_university',
				'$home_matno',
				'$home_degree', 
				'$home_course',
				'$studentid',
				'$home_cgpa',
				'$home_enrollment',
				'$home_semester',
				'$home_credits'
				)");
		
			//noexams_firstuni is not null in database, but what does it stand for?
			$statement5 = $pdo->prepare("INSERT INTO $priorityDB (
				studentid,
				first_uni,
				second_uni,
				third_uni,
				noexams_firstuni)
			VALUES (
				'$studentid',
				'$first_uni',
				'$second_uni',
				'$third_uni',
				'0' 
				)");

			$statement3->execute();
			$statement4->execute();
			$statement5->execute();
			$pdo->commit();
			
			/*Alert successful message after transaction committed */
			?><div class="alert alert-success"><?php
			echo 'Bewerbung abgeschickt'."<br>";
			?></div><?php
	
		}catch (PDOException $e){
			$pdo->rollback();
			
			/*Alert Error message after transaction rollbacked (cancelled) */
			?><div class="alert alert-danger"><?php
			echo $e->get_message();
			echo "<br>";
			?></div><?php
		}
	}
}	
?>

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


  <!-- Nav tabs -->
  <!-- aus data: personaldata, email: homeaddress, password: homestudy-->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" id="tab1" class="active"><a href="#personaldata" role="tab" data-toggle="tab">Persönliche Angaben</a></li>
    <li role="presentation" id="tab2"><a href="#homeaddress" role="tab" data-toggle="tab">Heimat-Adresse</a></li>
    <li role="presentation" id="tab3"><a href="#homestudy" role="tab" data-toggle="tab">Aktuelles Studium</a></li>
    <li role="presentation" id="tab4"><a href="#foreignstudy" role="tab" data-toggle="tab">Austauschprogramm</a></li>
    <li role="presentation" id="tab5"><a href="#attachments" role="tab" data-toggle="tab">Anhänge</a></li>
	<!-- <li role="presentation" id="tab6"><a href="#courselist" role="tab" data-toggle="tab">Fächerwahl</a></li> -->
  </ul>

  <form role="form" data-toggle="validator" novalidate="true" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

  <div class="tab-content">
  <!-- erster Reiter: Persönliche Daten-->		
		<div role="tabpanel" class="tab-pane active" id="personaldata">
			<br>
			<!-- erster Reiter NEU-->
			<!--<form action="?application=1" method="post" name="application"> <!-- register anpassen! -->
			<div class="form-horizontal">
				<div class="form-group row">
					<label for="inputSalutation" class="col-sm-3 control-label">Anrede (salutation):</label>
					<div class="col-sm-7">
					<select data-error="Please choose a salutation!" type="text" id="inputSalutation" size="1" name="salutation" class="form-control" required>
						<option></option>
						<option value="Mr">Herr (Mr)</option>
						<option value="Ms">Frau (Ms)</option>
					</select>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group row">
					<label for="inputFirstName" class="col-sm-3 control-label">Vorname (first name):</label>
					<div class="col-sm-7">
						<input data-error="Please fill in your first name!" type="text" id="inputFirstName" name="firstname" class="form-control" value=<?php echo htmlentities($user['vorname']); ?> readonly>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				
				<div class="form-group row">
					<label for="inputSurname" class="col-sm-3 control-label">Nachname (surname):</label>
					<div class="col-sm-7">
						<input data-error="Please fill in your surname!" type="text" id="inputSurname" name="surname" class="form-control" value=<?php echo htmlentities($user['nachname']); ?> readonly>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group row">
					<label for="inputEmail" class="col-sm-3 control-label">E-Mail (only @stud.uni-due.de):</label>
					<div class="col-sm-7">
						<input type="email" id="inputEmail" name="email" class="form-control" value=<?php echo htmlentities($user['email']); ?> readonly>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
					
				<div class="form-group row">
					<label for="inputNationality" class="col-sm-3 control-label">Nationalität (nationality): </label>
					<div class="col-sm-7">
						<select data-error="Please select your nationality!" type="text" id="inputNationality" size="1"  name="nationality" class="form-control" required>
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
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<!-- input="date" is not supported by IE so additional regEx is added to validate the input text in IE to avoid data type error while inserting value to database -->
				<div class="form-group row">
					<label for="inputBday" class="col-sm-3 control-label">Geburtsdatum (birthday): </label>
					<div class="col-sm-7">
						<input data-error="Please input your birth date in format YYYY-MM-DD!" type="date" pattern="\d{4}-\d{1,2}-\d{1,2}"  id = "inputBday" size="40" maxlength="20" name="birthday" class="form-control" style="valign: middle; padding-top: 0px" placeholder="YYYY-MM-DD" required>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group row">
					<div class="col-sm-offset-3 col-sm-10">
						<a href="#homeaddress" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary" id="weiter1">Weiter</button></a>
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
						<input data-error="Street cannot be empty!" type="text" id="inputStreet" size="40" maxlength="40" name="home_street" class="form-control" required>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputZip" class="col-sm-3 control-label">PLZ (zip): </label>
					<div class="col-sm-7">
						<input data-error="Zipcode cannot be empty!" type="text" id="inputZip" size="40" maxlength="10" name="home_zip" class="form-control" required>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputCity" class="col-sm-3 control-label">Ort (city): </label>
					<div class="col-sm-7">
						<input data-error="City cannot be empty!" type="text" id="inputCity" size="40" maxlength="40" name="home_city" class="form-control" required>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputState" class="col-sm-3 control-label">Bundesland (state): </label>
					<div class="col-sm-7">
						<input data-error="State cannot be empty!" type="text" id="inputState" size="40" maxlength="40" name="home_state" class="form-control" required>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputCountry" class="col-sm-3 control-label">Land (country): </label>
					<div class="col-sm-7">
						<select data-error="Country cannot be empty!" type="text" id="inputCountry" size="1"  name="home_country" class="form-control" required>
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
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputPhone" class="col-sm-3 control-label">Telefonnummer (phone): </label>
					<div class="col-sm-7">
						<input data-error="Phone number cannot be empty!" type="text" id="inputPhone" size="40" maxlength="15" name="home_phone" class="form-control" required>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
			
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
						<a href="#personaldata" role="tab" data-toggle="tab1"><button type="button" class="btn btn-primary" id="zurück2">Zurück</button></a>
						<a href="#homestudy" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary" id="weiter2">Weiter</button></a>
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
						<select data-error="Please select your home degree!" type="value" id="inputHomeDegree" size="1" maxlength="30" name="home_degree" class="form-control" required>
							<option></option>
							<option value="1">Bachelor of Science</option>
							<option value="2">Master of Science</option>
						</select>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group"> <!-- Tabelle in ddstud vorhanden -->
					<label for="inputHomeCourse" class="col-sm-3 control-label">Aktueller Studiengang <br> (home program): </label>
					<div class="col-sm-7">
						<select data-error="Please select your home course!" type="value" id="inputHomeCourse" size="1"  name="home_course" class="form-control" required>
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
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group">
					<label for="inputMatrNo" class="col-sm-3 control-label">Matrikelnummer (matr.-no.): </label>
						<div class="col-sm-7">
						<input data-error="Please enter your matriculation number!" type="number" id="inputMatrNo" maxlength="10"  name="home_matno" class="form-control" required>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
					
				<div class="form-group"> <!-- existiert in ddstud noch nicht -->
					<label for="inputEnrollment" class="col-sm-3 control-label">Monat/Jahr der Einschreibung in aktuellen Studiengang <br>(month/year of enrollment): </label>
					<div class="col-sm-7">
						<input data-error="Please enter your enrollment month/year!" type="text" id="inputEnrollment" pattern="\d{1,2}/\d{4}" maxlength="7" name="home_enrollment" class="form-control" placeholder="MM/YYYY" required>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputHomeSemester" class="col-sm-3 control-label">Fachsemester aktueller Studiengang (semester): </label>
					<div class="col-sm-7">
						<select data-error="Please select your current semester!" type="text" id="inputHomeSemester" size="1" maxlength="1" name="home_semester" class="form-control" required>
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
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group"> 
					<label for="inputHomeCredits" class="col-sm-3 control-label">Summe bisher erworbener Kreditpunkte laut beigefügtem Transkript (Credits):</label>
					<div class="col-sm-7">
						<input data-error="Please enter your current credits!" type="number" id="inputHomeCredits" min="0" step="1" max="300" maxlength="3" name="home_credits" class="form-control" required>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group"> <!-- nochmal die "steps" checken und nur punkt- ODER komma-trennung erlauben -->
					<label for="inputHomeCGPA" class="col-sm-3 control-label">Durchschnittsnote laut beigefügtem Transkript (CGPA/ Average Grade)):</label>
					<div class="col-sm-7">
						<input data-error="Please enter your current grade!" type="text" id="inputHomeCGPA" min="1" max="4" step="0.1" maxlength="3" name="home_cgpa" class="form-control" required>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div><br>
				
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
						<a href="#homeaddress" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary" id="zurück3">Zurück</button></a>
						<a href="#foreignstudy" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary" id="weiter3">Weiter</button></a>
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
						<select data-error="Please select a valid type of transfer!" type="text" id="inputIntention" size="1" maxlength="20" name="intention" class="form-control" required>
							<option></option>
							<option>Exchange</option>
						</select>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group">
					<label for="inputStart" class="col-sm-3 control-label">Beginn des Austauschs (start of transfer):</label>
					<div class="col-sm-7">
						<select data-error="Please select a valid starting semester for the transfer!" type="number" id="inputStart" size="1" maxlength="7" name="starting_semester" class="form-control" required>
							<option></option>
							<option value="2019.5">WS19/20</option>
							<option value="2020.5">WS20/21</option>
						</select>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
					
				<div class="form-group"> <!-- existiert in ddstud noch nicht -->
					<label for="inputForeignDegree" class="col-sm-3 control-label">Während des geplanten Auslandsemester werde ich
					voraussichtlich Student sein in (abroad degree):</label>
					<div class="col-sm-7">
						<select data-error="Please select a valid type of degree for the transfer!" type="text" id="inputForeignDegree" size="1" name="foreign_degree" class="form-control" required>
							<option></option>
							<option>einem Bachelorstudiengang an der UDE</option>
							<option>einem Masterstudiengang an der UDE</option>
						</select>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
					
					
				<div class="form-group">
					<label for="inputFirstPrio" class="col-sm-3 control-label">1. Priorität (1. priority):</label>
					<div class="col-sm-7">
						<select data-error="Please select a valid University!" type="number" id="inputFirstPrio" size="1" maxlength="20" name="firstprio" class="form-control" required>
							<option></option>
							<option value="2">UKM, Malaysia</option>
							<option value="3">UI, Indonesia</option>
							<option value="5">NTU, Singapur</option>
						</select>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
					
				<div class="form-group">
					<label for="inputSecondPrio" class="col-sm-3 control-label">2. Priorität (2. priority):</label>
					<div class="col-sm-7">
						<select data-error="Please select a valid University!" type="number" id="inputSecondPrio" size="1" maxlength="20" name="secondprio" class="form-control" required>
							<option></option>
							<option value="2">UKM, Malaysia</option>
							<option value="3">UI, Indonesia</option>
							<option value="5">NTU, Singapur</option>
						</select>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
					
				<div class="form-group">
					<label for="inputThirdPrio" class="col-sm-3 control-label">3. Priorität (3. priority):</label>
					<div class="col-sm-7">
						<select data-error="Please select a valid University!" type="number" id="inputThirdPrio" size="1" maxlength="20" name="thirdprio" class="form-control" required>
							<option></option>
							<option value="2">UKM, Malaysia</option>
							<option value="3">UI, Indonesia</option>
							<option value="5">NTU, Singapur</option>
						</select>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
						<a href="#homestudy" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary" id="zurück4">Zurück</button></a>
						<a href="#attachments" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary" id="weiter4">Weiter</button></a>
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
						<input data-error="Please upload the filled course selection form in Excel format!" type="file" size="75" class="btn btn-primary" name="Fächerwahlliste" accept="text/*" required><br>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
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
						<a href="#foreignstudy" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary" id="zurück5">Zurück</button></a>
						<button type="submit" name="abschicken" class="btn btn-success" style="width: 340px">Bewerbung abschicken</button>
					</div>
				</div>
			</div>
		</div>


	<!-- sechster Reiter: Fächerwahl -->
		<!-- <div role="tabpanel" class="tab-pane" id="courselist">
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
									<?php }?>		
								</select>
							</td>
						</tr>
					</table>

					<button type="submit" name="university" class="btn btn-lg btn-primary btn-block">Äquivalenzliste laden</button>
				</div><br> 
			</form>
				
			
					
			</div>
		</div> -->
	</form>
	
	</div>
	
</div>
</div>
<script>
$(document).ready(function(){

	//Button 'Weiter' clicked: To next tab based on buttonid
    $("#weiter1").click(function(){
		$('.nav-tabs a[href="#homeaddress"]').tab('show');
	});

	$("#weiter2").click(function(){
		$('.nav-tabs a[href="#homestudy"]').tab('show');
	});

	$("#weiter3").click(function(){
		$('.nav-tabs a[href="#foreignstudy"]').tab('show');
	});

	$("#weiter4").click(function(){
		$('.nav-tabs a[href="#attachments"]').tab('show');
	});

	//Button 'Zurück' clicked: To previous tab based on buttonid
	$("#zurück2").click(function(){
		$('.nav-tabs a[href="#personaldata"]').tab('show');
	});

	$("#zurück3").click(function(){
		$('.nav-tabs a[href="#homeaddress"]').tab('show');
	});

	$("#zurück4").click(function(){
		$('.nav-tabs a[href="#homestudy"]').tab('show');
	});

	$("#zurück5").click(function(){
		$('.nav-tabs a[href="#foreignstudy"]').tab('show');
	});
});
</script>

<?php 
include("templates/footer.inc.php")
?>
<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$user_id = $user['user_id'];

echo "<script>console.log($user_id);</script>";

//set database table variables
$studentDB = "student";
$applicationDB = "application";
$homeaddressDB = "address";
$homestudyDB = "study_home";
$priorityDB = "priority";

//set server location
$file_server = "uploads";

//set form readonly variable
$readonly = false;

include("templates/header.inc.php");
?>

<div class="main">
<div class="container main-container" id="maincontainer">

<?php
$statement = $pdo->prepare("SELECT * FROM $studentDB WHERE $studentDB.user_id = $user_id ");
$result = $statement->execute(array('user_id' => $user_id));
$personaldata = $statement->fetch();

$statement = $pdo->prepare("SELECT * FROM $homeaddressDB WHERE address_id = :homeaddressid ");
$result = $statement->execute(array('homeaddressid' => $personaldata['home_address_id']));
$homeaddress = $statement->fetch();

$statement = $pdo->prepare("SELECT * FROM $applicationDB WHERE student_id = :studentid ");
$result = $statement->execute(array('studentid' => $personaldata['student_id']));
$application = $statement->fetch();

$statement = $pdo->prepare("SELECT * FROM $homestudyDB WHERE application_id = :applicationid ");
$result = $statement->execute(array('applicationid' => $application['application_id']));
$homestudy = $statement->fetch();

$statement = $pdo->prepare("SELECT * FROM $priorityDB WHERE application_id = :applicationid ");
$result = $statement->execute(array('applicationid' => $application['application_id']));
$priority = $statement->fetch();

// $statement = $pdo->prepare("SELECT * FROM $studentDB
// 							LEFT JOIN $applicationDB ON $applicationDB.student_id = $studentDB.student_id 
// 							LEFT JOIN $homeaddressDB ON $homeaddressDB.address_id = $studentDB.home_address_id 
// 							LEFT JOIN $homestudyDB ON $homestudyDB.application_id = $applicationDB.application_id 
// 							LEFT JOIN $priorityDB ON $priorityDB.application_id = $applicationDB.application_id 
// 							WHERE $studentDB.user_id = $user_id ");
// $result = $statement->execute(array('user_id' => $user_id));
// $student = $statement->fetch();

//
if($user !== false) {
	//set all data from query result
	$salutation = $user['salutation_id'];
	$firstname = $user['firstname'];
	$surname =$user['lastname'];
	$email = $user['email'];
	$nationality = $personaldata['nationality_country_id'];
	$birthday = $personaldata['birthdate'];
	// $overall_status = $personaldata['overall_status'];
	$intention = $application['intention_id'];
	$starting_semester = $application['exchange_period_id'];
	$foreign_degree = $application['applied_degree_id'];

	// $hhome_no = $homeaddress['house_no'];
	$home_street = $homeaddress['street'];
	$home_zip = $homeaddress['zipcode'];
	$home_city = $homeaddress['city'];
	$home_state = $homeaddress['state'];
	$home_country = $homeaddress['country_id'];
	$home_phone = $homeaddress['phone_no'];

	$home_university = $homestudy['home_university_id'];
	$home_degree =  $homestudy['home_degree_id'];
	$home_course =  $homestudy['home_course_id'];
	$home_matno =  $homestudy['home_matno'];
	$home_enrollment =  $homestudy['home_enrollment_date'];
	$home_semester =  $homestudy['home_semester'];
	$home_credits =  $homestudy['home_credits'];
	$home_cgpa =  $homestudy['home_cgpa'];

	$first_uni = $priority['first_uni_id'];
	$second_uni = $priority['second_uni_id'];
	$third_uni = $priority['third_uni_id'];

	$readonly = false;
}	

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
	
	//fixed parameters
	// $overall_status = "Interested";
	
	//ab hier Home_study DB
	$home_university = trim($_POST['home_university']);
	$home_degree = trim($_POST['home_degree']);
	$home_course = trim($_POST['home_course']);
	$home_matno = trim($_POST['home_matno']);
	$home_enrollment = trim($_POST['home_enrollment']);
	$home_semester = trim($_POST['home_semester']);
	$home_credits = trim($_POST['home_credits']);
	$home_cgpa = Namen_bereinigen(trim($_POST['home_cgpa']));
	
	//fixed parameters
	// $home_university = "4"; //Universität Duisburg-Essen
	
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
	/*
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
	}*/

	//Data validation
	if(!$error){
		//Check if all required fields are filled
		if(!isset($salutation) or !isset($firstname) or !isset($surname) or !isset($email) or !isset($nationality) or !isset($birthday)
		or !isset($home_street) or !isset($home_zip) or !isset($home_city) or !isset($home_state) or !isset($home_country) or !isset($home_phone)
		or !isset($home_degree) or !isset($home_university) or !isset($home_course) or !isset($home_matno) or !isset($home_enrollment) or !isset($home_semester) or !isset($home_credits) or !isset($home_cgpa)
		or !isset($intention) or !isset($starting_semester) or !isset($foreign_degree) or !isset($first_uni) or !isset($second_uni) or !isset($third_uni)){
			$error = true;
			echo "<br>";
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

			$statement1 = $pdo->prepare("INSERT INTO $studentDB (birthdate, nationality_country_id, user_id) VALUES ('$birthday', $nationality, $user_id)");
			$statement1->execute();

			$statement2 = $pdo->prepare("SELECT student_id FROM $studentDB WHERE user_id = $user_id");
			$result = $statement2->execute();
			$student = $statement2->fetch();
			$studentid = $student['student_id'];

			echo "<script>console.log($studentid);</script>";

			$statement3 = $pdo->prepare("INSERT INTO $homeaddressDB (
				student_id,
				street, 
				zipcode, 
				city, 
				state, 
				country_id, 
				phone_no) 
			VALUES (
				'$studentid', 
				'$home_street', 
				'$home_zip', 
				'$home_city', 
				'$home_state', 
				'$home_country', 
				'$home_phone')");
			$statement3->execute();

			$statement8 = $pdo->prepare("SELECT LAST_INSERT_ID(address_id) as address_id FROM $homeaddressDB");
			$statement8->execute();
			$homeaddress = $statement8->fetch();
			$homeaddressid = $homeaddress['address_id'];

			$statement4 = $pdo->prepare("UPDATE $studentDB SET home_address_id = $homeaddressid WHERE student_id = $studentid");
			$statement4->execute();

			$statement5 = $pdo->prepare("INSERT INTO $applicationDB (
				student_id,
				exchange_period_id, 
				intention_id, 
				applied_degree_id) 
			VALUES (
				'$studentid', 
				'$starting_semester', 
				'$intention', 
				'$foreign_degree'
			)");
			$statement5->execute();

			$statement9 = $pdo->prepare("SELECT LAST_INSERT_ID(application_id) as application_id FROM $applicationDB");
			$statement9->execute();
			$application =  $statement9->fetch();
			$applicationid = $application['application_id'];
		
			$statement6 = $pdo->prepare("INSERT INTO $homestudyDB (
				home_university_id,
				home_matno,
				home_degree_id, 
				home_course_id,
				application_id,
				home_cgpa,
				home_enrollment_date,
				home_semester,
				home_credits
				) 
			VALUES (
				'$home_university',
				'$home_matno',
				'$home_degree', 
				'$home_course',
				'$applicationid',
				'$home_cgpa',
				'$home_enrollment',
				'$home_semester',
				'$home_credits'
				)");
				
			$statement6->execute();

			//noexams_firstuni is not null in database, but what does it stand for?
			$statement7 = $pdo->prepare("INSERT INTO $priorityDB (
				application_id,
				first_uni_id,
				second_uni_id,
				third_uni_id)
			VALUES (
				'$applicationid',
				'$first_uni',
				'$second_uni',
				'$third_uni'
				)");
			$statement7->execute();

			$pdo->commit();
			
			/*Alert successful message after transaction committed */
			echo "<br>";
			?><div class="alert alert-success"><?php
			echo 'Bewerbung abgeschickt'."<br>";
			?></div><?php
	
		}catch (PDOException $e){
			$pdo->rollback();
			$error = true;
			echo "<br>";
			/*Alert Error message after transaction rollbacked (cancelled) */
			?><div class="alert alert-danger"><?php
			echo $e->getMessage();
			?></div><?php
		}

		// check PDOException first before upload files to server
		if(!$error){
			//get student data
			$statement = $pdo->prepare("SELECT university.name FROM $priorityDB 
			LEFT JOIN university on university.university_id = $priorityDB.first_uni_id 
			WHERE application_id = $applicationid ");
			$result = $statement->execute();
			$priority = $statement->fetch();

			$statement = $pdo->prepare("SELECT home_matno FROM $homestudyDB WHERE application_id = $applicationid ");
			$result = $statement->execute();
			$matno = $statement->fetch();

			$firstname_short = $user["firstname"];

			//get three characters of first name
			if(strlen($firstname_short) >= 3) {
				$firstname_short = substr($firstname_short, 0, 3);
			}

			//create first_uni directory if not exists
			if(!is_dir("$file_server/".$priority["name"] ."/")) {
    			mkdir("$file_server/".$priority["name"] ."/");
			}	

			//create student directory if not exists
			if(!is_dir("$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/")) {
    			mkdir("$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/");
			}

			//check if file size > 2MB before save
			if($_FILES['Fächerwahlliste']['size'] <=  2 * 1024 * 1024){
				move_uploaded_file($_FILES["Fächerwahlliste"]["tmp_name"], "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/".$matno["home_matno"]."_"  .$_FILES['Fächerwahlliste']['name']);
			}else{
				//
			}

			if($_FILES['Motivationsschreiben']['size'] <=  2 * 1024 * 1024){
				move_uploaded_file($_FILES["Motivationsschreiben"]["tmp_name"], "$file_server/".$priority["name"]."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/".$matno["home_matno"]."_"  .$_FILES['Motivationsschreiben']['name']);
			}else{
				//
			}

			if($_FILES['Lebenslauf']['size'] <=  2 * 1024 * 1024){
				move_uploaded_file($_FILES["Lebenslauf"]["tmp_name"], "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/".$matno["home_matno"]."_"  .$_FILES['Lebenslauf']['name']);
			}else{
				//
			}

			if($_FILES['Transkript']['size'] <=  2 * 1024 * 1024){
				move_uploaded_file($_FILES["Transkript"]["tmp_name"], "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/".$matno["home_matno"]."_"  .$_FILES['Transkript']['name']);
			}else{
				//
			}
		}
	}
}	
?>

<h1>Bewerbungsformular</h1>

<!-- <?php 
if(isset($success_msg) && !empty($success_msg)):
?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	<?php echo "<br>"; echo $success_msg; ?>
	</div>
<?php 
endif;
?> -->


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

  <form role="form" id="mainForm" data-toggle="validator" novalidate="true" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

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
					<select data-error="Please choose a salutation!" type="text" id="inputSalutation" size="1" name="salutation" class="form-control" disabled>
						<option></option>
						<?php
							$statement = $pdo->prepare("SELECT * FROM salutation");
							$result = $statement->execute();
							while($row = $statement->fetch()) { ?>
        					    <!--show selected option after selection 06.04.2020 by lin-->
								<option value="<?php echo ($row['salutation_id'])?>" <?php if(isset($salutation) and $salutation == $row['salutation_id']) echo "selected"; ?> readonly><?php echo ($row['name'])?></option>
							<?php } ?>
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
						<input data-error="Please fill in your first name!" type="text" id="inputFirstName" name="firstname" class="form-control" value="<?php if(isset($firstname)) echo $firstname;?>" readonly>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				
				<div class="form-group row">
					<label for="inputSurname" class="col-sm-3 control-label">Nachname (surname):</label>
					<div class="col-sm-7">
						<input data-error="Please fill in your surname!" type="text" id="inputSurname" name="surname" class="form-control" value="<?php if(isset($surname)) echo $surname;?>" readonly>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group row">
					<label for="inputEmail" class="col-sm-3 control-label">E-Mail (only @stud.uni-due.de):</label>
					<div class="col-sm-7">
						<input type="email" id="inputEmail" name="email" class="form-control" value="<?php  if(isset($email)) echo $email;?>" readonly>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
					
				<div class="form-group row">
					<label for="inputNationality" class="col-sm-3 control-label">Nationalität (nationality): </label>
					<div class="col-sm-7">
						<select data-error="Please select your nationality!" type="text" id="inputNationality" size="1"  name="nationality" class="form-control"  <?php if($readonly) echo "disabled"; else echo "required"; ?>>
						<!-- Eingefügt start-->
							<?php 
								$statement = $pdo->prepare("SELECT * FROM country ORDER BY country_id");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['country_id']);?>" <?php if(isset($nationality) and $nationality == $row['country_id']) echo "selected";?>><?php echo ($row['name']);?></option>
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
						<input data-error="Please input your birth date in format YYYY-MM-DD!" type="date" pattern="\d{4}-\d{1,2}-\d{1,2}"  id = "inputBday" size="40" maxlength="20" name="birthday" class="form-control" style="valign: middle; padding-top: 0px" placeholder="YYYY-MM-DD" <?php if(isset($birthday)) echo "value=\"$birthday\""; ?>  <?php if($readonly) echo "readonly"; else echo "required"; ?>>
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
						<input data-error="Street cannot be empty!" type="text" id="inputStreet" size="40" maxlength="40" name="home_street" class="form-control"  <?php if(isset($home_street)) echo "value=\"$home_street\"";?> <?php if($readonly) echo "readonly"; else echo "required"; ?>>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputZip" class="col-sm-3 control-label">PLZ (zip): </label>
					<div class="col-sm-7">
						<input data-error="Zipcode cannot be empty!" type="text" id="inputZip" size="40" maxlength="10" name="home_zip" class="form-control" <?php if(isset($home_zip)) echo "value=\"$home_zip\"";?> <?php if($readonly) echo "readonly"; else echo "required"; ?>>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputCity" class="col-sm-3 control-label">Ort (city): </label>
					<div class="col-sm-7">
						<input data-error="City cannot be empty!" type="text" id="inputCity" size="40" maxlength="40" name="home_city" class="form-control" <?php if(isset($home_city)) echo "value=\"$home_city\""; ?>  <?php if($readonly) echo "readonly"; else echo "required"; ?>>
					</div>
					<label for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputState" class="col-sm-3 control-label">Bundesland (state): </label>
					<div class="col-sm-7">
						<input data-error="State cannot be empty!" type="text" id="inputState" size="40" maxlength="40" name="home_state" class="form-control" <?php if(isset($home_state)) echo "value=\"$home_state\""; ?> <?php if($readonly) echo "readonly"; else echo "required"; ?>>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputCountry" class="col-sm-3 control-label">Land (country): </label>
					<div class="col-sm-7">
						<select data-error="Country cannot be empty!" type="text" id="inputCountry" size="1"  name="home_country" class="form-control"  <?php if($readonly) echo "disabled"; else echo "required"; ?>>
							<!-- Eingefügt start-->
							<?php 
								$statement = $pdo->prepare("SELECT * FROM country ORDER BY country_id");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['country_id']);?>" <?php if(isset($home_country) and $home_country == $row['country_id']) echo "selected"; ?>><?php echo ($row['name']);?></option>
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
						<input data-error="Phone number cannot be empty!" type="text" id="inputPhone" size="40" maxlength="15" name="home_phone" class="form-control" <?php if(isset($home_phone)) echo "value=\"$home_phone\""; ?> <?php if($readonly) echo "readonly"; else echo "required"; ?>>
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
					<label for="inputHomeUniversity" class="col-sm-3 control-label">Aktuelle Universität <br> (home university): </label>
					<div class="col-sm-7">
						<select data-error="Please select your home university!" type="value" id="inputHomeUniversity" size="1"  name="home_university" class="form-control" <?php if($readonly) echo "disabled"; else echo "required"; ?>>
						<!-- Eingefügt start-->
							<?php 
								$statement = $pdo->prepare("SELECT * FROM university ORDER BY name ASC");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['university_id']);?>" <?php if(isset($home_university) and $home_university == $row['university_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> <!-- value="<?php //echo $row['courseid']?>" -->
							<?php } ?>		
						<!--Eingefügt ende --> 
						</select>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group"> <!-- Tabelle in ddstud vorhanden -->
					<label for="inputHomeDegree" class="col-sm-3 control-label">Derzeit angestrebter Abschluss <br>(home degree): </label>
					<div class="col-sm-7">
						<select data-error="Please select your home degree!" type="value" id="inputHomeDegree" size="1" maxlength="30" name="home_degree" class="form-control" <?php if($readonly) echo "disabled"; else echo "required"; ?>>
							<?php 
								$statement = $pdo->prepare("SELECT * FROM degree ");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['degree_id']);?>" <?php if(isset($home_degree) and $home_degree == $row['degree_id']) echo "selected"; ?>><?php echo ($row['name']);?></option>
							<?php } ?>	
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
						<select data-error="Please select your home course!" type="value" id="inputHomeCourse" size="1"  name="home_course" class="form-control" <?php if($readonly) echo "disabled"; else echo "required"; ?>>
						<!-- Eingefügt start-->
							<?php 
								$statement = $pdo->prepare("SELECT * FROM course ORDER BY name ASC");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['course_id']);?>" <?php if(isset($home_course) and $home_course == $row['course_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> <!-- value="<?php //echo $row['courseid']?>" -->
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
						<input data-error="Please enter your matriculation number!" type="number" id="inputMatrNo" maxlength="10"  name="home_matno" class="form-control" <?php if(isset($home_matno)) echo "value=\"$home_matno\""; ?>  <?php if($readonly) echo "readonly"; else echo "required"; ?>>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
					
				<!-- <div class="form-group"> 
					<label for="inputEnrollment" class="col-sm-3 control-label">Monat/Jahr der Einschreibung in aktuellen Studiengang <br>(month/year of enrollment): </label>
					<div class="col-sm-7">
						<input data-error="Please enter your enrollment month/year!" type="text" id="inputEnrollment" pattern="\d{1,2}/\d{4}" maxlength="7" name="home_enrollment" class="form-control" placeholder="MM/YYYY" <?php if(isset($home_enrollment)) echo "value=\"$home_enrollment\""; ?>  <?php if($readonly) echo "readonly"; else echo "required"; ?>>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div> -->

				<div class="form-group"> <!-- existiert in ddstud noch nicht -->
					<label for="inputEnrollment" class="col-sm-3 control-label">Monat/Jahr der Einschreibung in aktuellen Studiengang <br>(month/year of enrollment): </label>
					<div class="col-sm-7">
						<input data-error="Please enter your enrollment month/year!" pattern="\d{4}-\d{1,2}-\d{1,2}"  type="date" id="inputEnrollment"  name="home_enrollment" class="form-control" <?php if(isset($home_enrollment)) echo "value=\"$home_enrollment\""; ?>  <?php if($readonly) echo "readonly"; else echo "required"; ?>>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputHomeSemester" class="col-sm-3 control-label">Fachsemester aktueller Studiengang (semester): </label>
					<div class="col-sm-7">
						<select data-error="Please select your current semester!" type="text" id="inputHomeSemester" size="1" maxlength="1" name="home_semester" class="form-control" <?php if($readonly) echo "disabled"; else echo "required"; ?>>
							<option></option>
							<option value="1" <?php if(isset($home_semester) and $home_semester == "1") echo "selected"; ?>>1. Semester</option>
							<option value="2" <?php if(isset($home_semester) and $home_semester == "2") echo "selected"; ?>>2. Semester</option>
							<option value="3" <?php if(isset($home_semester) and $home_semester == "3") echo "selected"; ?>>3. Semester</option>
							<option value="4" <?php if(isset($home_semester) and $home_semester == "4") echo "selected"; ?>>4. Semester</option>
							<option value="5" <?php if(isset($home_semester) and $home_semester == "5") echo "selected"; ?>>5. Semester</option>
							<option value="6" <?php if(isset($home_semester) and $home_semester == "6") echo "selected"; ?>>6. Semester</option>
							<option value="7" <?php if(isset($home_semester) and $home_semester == "7") echo "selected"; ?>>7. Semester</option>
							<option value="8" <?php if(isset($home_semester) and $home_semester == "8") echo "selected"; ?>>8. Semester</option>
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
						<input data-error="Please enter your current credits!" type="number" id="inputHomeCredits" min="0" step="1" max="300" maxlength="3" name="home_credits" class="form-control" <?php if(isset($home_credits)) echo "value=\"$home_credits\""; ?> <?php if($readonly) echo "readonly"; else echo "required"; ?>>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>

				<div class="form-group"> <!-- nochmal die "steps" checken und nur punkt- ODER komma-trennung erlauben -->
					<label for="inputHomeCGPA" class="col-sm-3 control-label">Durchschnittsnote laut beigefügtem Transkript (CGPA/ Average Grade)):</label>
					<div class="col-sm-7">
						<input data-error="Please enter your current grade!" type="text" id="inputHomeCGPA" min="1" max="4" step="0.1" maxlength="3" name="home_cgpa" class="form-control" <?php if(isset($home_cgpa)) echo "value=\"$home_cgpa\""; ?> <?php if($readonly) echo "readonly"; else echo "required"; ?>>
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
						<select data-error="Please select a valid type of transfer!" type="text" id="inputIntention" size="1" maxlength="20" name="intention" class="form-control" <?php if($readonly) echo "disabled"; else echo "required"; ?>>
							<option></option>
							<?php 
								$statement = $pdo->prepare("SELECT * FROM intention");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['intention_id']);?>" <?php if(isset($intention) and $intention == $row['intention_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
							<?php } ?>
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
						<select data-error="Please select a valid starting semester for the transfer!" type="number" id="inputStart" size="1" maxlength="7" name="starting_semester" class="form-control" <?php if($readonly) echo "disabled"; else echo "required"; ?>>
							<option></option>
							<?php 
								$statement = $pdo->prepare("SELECT * FROM exchange_period");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['period_id']);?>" <?php if(isset($starting_semester) and $starting_semester == $row['period_id']) echo "selected"; ?>><?php echo ($row['exchange_semester']);?></option> 
							<?php } ?>
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
						<select data-error="Please select a valid type of degree for the transfer!" type="text" id="inputForeignDegree" size="1" name="foreign_degree" class="form-control" <?php if($readonly) echo "disabled"; else echo "required"; ?>>
							<?php 
								$statement = $pdo->prepare("SELECT * FROM degree");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['degree_id']);?>" <?php if(isset($foreign_degree) and $foreign_degree == $row['degree_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
							<?php } ?>
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
						<select data-error="Please select a valid University!" type="number" id="inputFirstPrio" size="1" maxlength="20" name="firstprio" class="form-control" <?php if($readonly) echo "disabled"; else echo "required"; ?>>
							<option></option>
							<?php 
								$statement = $pdo->prepare("SELECT * FROM university where university_id in (2,3,4)");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['university_id']);?>" <?php if(isset($first_uni) and $first_uni == $row['university_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
							<?php } ?>
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
						<select data-error="Please select a valid University!" type="number" id="inputSecondPrio" size="1" maxlength="20" name="secondprio" class="form-control" <?php if($readonly) echo "disabled";  ?>>
							<option></option>
							<?php 
								$statement = $pdo->prepare("SELECT * FROM university where university_id in (2,3,4)");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['university_id']);?>" <?php if(isset($second_uni) and $second_uni == $row['university_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
							<?php } ?>
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
						<select data-error="Please select a valid University!" type="number" id="inputThirdPrio" size="1" maxlength="20" name="thirdprio" class="form-control" <?php if($readonly) echo "disabled";  ?>>
							<option></option>
							<?php 
								$statement = $pdo->prepare("SELECT * FROM university where university_id in (2,3,4)");
								$result = $statement->execute();
								while($row = $statement->fetch()) { ?>
									<option value="<?php echo ($row['university_id']);?>" <?php if(isset($third_uni) and $third_uni == $row['university_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
							<?php } ?>
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
				<div id="group1" class="form-group"> 
					<label for="CourseList" class="col-sm-3 control-label"> Ausgefüllte Fächerwahlliste [Excel Format]</label>	
					<div class="col-sm-7">
						<?php 
							if($readonly){
								?><a href="#filepath">filename</a><?php
							}else{
								?>
								<input data-error="Please upload the filled course selection form in Excel format!"  type="file" size="75"  name="Fächerwahlliste" class="form-control" id="excelfile" accept=".xls, .xlsx" required>
								<?php 
							}
						?>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				
				<div class="form-group"> 
					<label for="CourseList" class="col-sm-3 control-label"> Motivationsschreiben [In Englisch und PDF]</label>	
					<div class="col-sm-7">
					<?php 
							if($readonly){
								?><a href="#filepath">filename</a><?php
							}else{
								?><input  data-error="Only pdf file type is allowed!" type="file" size="75"  name="Motivationsschreiben" id="pdffile" class="form-control" accept=".pdf" ><br>
								<?php
							}
						?>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group"> 
					<label for="CourseList" class="col-sm-3 control-label"> Lebenslauf [In Englisch und PDF]</label>	
					<div class="col-sm-7">
					<?php 
							if($readonly){
								?><a href="#filepath">filename</a><?php
							}else{
								?><input  data-error="Only pdf file type is allowed!" type="file" size="75"  name="Lebenslauf" id="pdffile" accept=".pdf" class="form-control" ><br>
								<?php
							}
						?>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group"> 
					<label for="CourseList" class="col-sm-3 control-label"> Aktuelles Transkript/Zeugnis [PDF]</label>	
					<div class="col-sm-7">
					<?php 
							if($readonly){
								?><a href="#filepath">filename</a><?php
							}else{
								?><input data-error="Only pdf file type is allowed!" type="file" size="75"  name="Transkript" class="form-control" id="pdffile" accept=".pdf" ><br>
								<?php
							}
						?>
					</div>
					<label  for="errorText" class="col-sm-3 control-label"></label>
					<div class="col-sm-7">
						<div class="help-block with-errors"></div>					
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
						<a href="#foreignstudy" role="tab" data-toggle="tab"><button type="button" class="btn btn-primary" id="zurück5">Zurück</button></a>
						<button type="submit" id="abschicken" name="abschicken" class="btn btn-success" style="width: 340px">Bewerbung abschicken</button>
					</div>
				</div>
			</div>
		</div>

	</form>
	
	</div>
	
</div>
</div>

<!-- hide sent button if readonly -->
<?php
if($readonly){
	?>
	<script>
		var x = document.getElementById("abschicken");
  		if (x.style.display === "none") {
    		x.style.display = "block";
  		} else {
    		x.style.display = "none";
  			}
	</script>
	<?php
}

?>

<!-- next and back button click -->
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

<!-- check correct file type -->
<script>
$(document).ready(function(){
	$("#excelfile").change(function(){
        var ext = this.value.match(/\.(.+)$/)[1];

		switch(ext){
			case "xls":
				if(this.files[0].size > 2 * 1024 * 1024){
					alert("File size cannot be larger than 2MB!");
					$('#abschicken').attr('disabled', true); 
				}else{
					$('#abschicken').attr('disabled', false); 
				}
				break;
			case "xlsx":
				if(this.files[0].size > 2 * 1024 * 1024){
					alert("File size cannot be larger than 2MB!");
					$('#abschicken').attr('disabled', true); 
				}else{
					$('#abschicken').attr('disabled', false); 
				}
				break;
			default:
				alert("Please upload a correct file type!");
				$('#abschicken').attr('disabled', true); 
				$('#group1').addClass("has-error"); 
				// $('#group1').addClass("has-error"); 
				//$('#maincontainer').prepend("<br><div class=\"alert alert-danger\" role=\"alert\">Please upload a correct file type!</div>"); 
		}
    }); 

	$("#pdffile").change(function(){
        var ext = this.value.match(/\.(.+)$/)[1];

		switch(ext){
			case "pdf":
				if(this.files[0].size > 2 * 1024 * 1024){
					alert("File size cannot be larger than 2MB!");
					$('#abschicken').attr('disabled', true); 
				}else{
					$('#abschicken').attr('disabled', false); 
				}
				break;
			default:
				alert("Please upload a correct file type!");
				$('#abschicken').attr('disabled', true); 
				//$('#maincontainer').prepend("<br><div class=\"alert alert-danger\" role=\"alert\">Please upload a correct file type!</div>"); 
				break;
		}
    }); 
});
</script>

<?php 
include("templates/footer.inc.php")
?>
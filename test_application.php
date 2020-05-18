<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();

    if(!isset($user)){
        header("location: testlogin.php");
        exit;
    }

    $salutationid = $user["salutation_id"];
    $firstname = $user["firstname"];
    $lastname = $user["lastname"];
    $email = $user["email"];

    if(isset($salutationid)){
      $statement = $pdo->prepare("SELECT * FROM salutation WHERE salutation_id = :id");
      $result = $statement->execute(array('id' => $salutationid));
      $salutation = $statement->fetch();
    }

?>

<?php 
    include("templates/testheaderlogin.php");
?>

<main>
<div class="application">
        <div class="card application-form">
            <!-- page title -->
            <div class="page-title">
                <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Bewerbungsformular
            </div>
            <!-- tab navigation -->
            <nav class="nav-application-form">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="tab1" data-toggle="tab" href="#personaldata" role="tab" aria-controls="personaldata" aria-selected="true">Persönliche Angaben</a>
                <a class="nav-item nav-link" id="tab2" data-toggle="tab" href="#homeaddress" role="tab" aria-controls="homeaddress" aria-selected="false">Heimat-Adresse</a>
                <a class="nav-item nav-link" id="tab3" data-toggle="tab" href="#homestudy" role="tab" aria-controls="homestudy" aria-selected="false">Aktuelles Studium</a>
                <a class="nav-item nav-link" id="tab4" data-toggle="tab" href="#foreignstudy" role="tab" aria-controls="foreignstudy" aria-selected="false">Austauschprogramm</a>
                <a class="nav-item nav-link" id="tab5" data-toggle="tab" href="#attachments" role="tab" aria-controls="attachments" aria-selected="false">Anhänge</a>
              </div>
            </nav>
            <!-- form -->
            <form id="applicationForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                <!-- tab content -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- personaldata -->
                    <div class="tab-pane fade show active" id="personaldata" role="tabpanel" aria-labelledby="tab1">
                        <div class="form-group row">
                          <label for="inputSalutation" class="col-sm-3 col-form-label">Salutation</label>
                          <div class="col-sm-9">
                            <input type="text" name="salutation" class="form-control-plaintext" id="inputSalutation"  value="<?php if(isset($salutation)) echo $salutation['name']?>" readonly>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputFirstname" class="col-sm-3 col-form-label">Vorname</label>
                            <div class="col-sm-9">
                              <input type="text" name="firstname" class="form-control-plaintext" id="inputFirstname" placeholder="Vorname" value="<?php if(isset($firstname)) echo $firstname?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputLastname" class="col-sm-3 col-form-label">Nachname</label>
                            <div class="col-sm-9">
                              <input type="text" name="lastname" class="form-control-plaintext" id="inputLastname" placeholder="Nachname" value="<?php if(isset($lastname)) echo $lastname?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputLastname" class="col-sm-3 col-form-label">E-Mail</label>
                            <div class="col-sm-9">
                              <input type="email" name="email" class="form-control-plaintext" id="inputEmail" placeholder="E-Mail" value="<?php if(isset($email)) echo $email?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputNationality" class="col-sm-3 col-form-label">Nationalität</label>
                          <div class="col-sm-9">
                            <select id="inputNationality"  name="nationality" class="form-control" required>
						                	<?php 
						                		$statement = $pdo->prepare("SELECT * FROM country ORDER BY country_id");
						                		$result = $statement->execute();
						                		while($row = $statement->fetch()) { ?>
						                			<option value="<?php echo ($row['country_id']);?>" <?php if(isset($nationality) and $nationality == $row['country_id']) echo "selected";?>><?php echo ($row['name']);?></option>
						                	<?php } ?>		
                            </select>
                            <div id="nationalityFeedback" class="invalid-feedback"></div>    
                          </div>                        
                        </div>
                        <div class="form-group row">
                          <label for="inputLastname" class="col-sm-3 col-form-label">Geburtsdatum</label>
                            <div class="col-sm-9">
                              <input type="date" pattern="\d{4}-\d{1,2}-\d{1,2}"  id = "inputBday" name="birthday" class="form-control" placeholder="YYYY-MM-DD" <?php if(isset($birthday)) echo "value=\"$birthday\""; ?>>
                              <div id="birthdayFeedback" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="text-right">
                          <button type="button" class="btn btn-primary" id="weiter1">Weiter</button>
                        </div>
                    </div>
                    <!-- homeaddress -->
                    <div class="tab-pane fade" id="homeaddress" role="tabpanel" aria-labelledby="tab2">
                        <div class="form-group row">
                          <label for="inputStreet" class="col-sm-3 col-form-label">Straße und Haus-Nr.</label>
                            <div class="col-sm-9">
                              <input type="text" maxlength="40" name="home_street" class="form-control" id="inputStreet" placeholder="street, house no" value="<?php if(isset($home_street)) echo $home_street?>" >
                              <div id="streetFeedback" class="invalid-feedback"></div>    
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputZip" class="col-sm-3 col-form-label">PLZ</label>
                            <div class="col-sm-9">
                              <input type="text" maxlength="10" name="home_zip" class="form-control" id="inputZip" placeholder="postcode" value="<?php if(isset($home_zip)) echo $home_zip?>" >
                              <div id="zipFeedback" class="invalid-feedback"></div>    
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputCity" class="col-sm-3 col-form-label">Ort</label>
                            <div class="col-sm-9">
                              <input type="text" maxlength="40" name="home_city" class="form-control" id="inputCity" placeholder="city" value="<?php if(isset($home_city)) echo $home_city?>" >
                              <div id="cityFeedback" class="invalid-feedback"></div>    
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputState" class="col-sm-3 col-form-label">Bundesland</label>
                            <div class="col-sm-9">
                              <input type="text" maxlength="40" name="home_state" class="form-control" id="inputState" placeholder="state" value="<?php if(isset($home_state)) echo $home_state?>" >
                              <div id="stateFeedback" class="invalid-feedback"></div>    
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputCountry" class="col-sm-3 col-form-label">Land</label>
                          <div class="col-sm-9">
                            <select id="inputCountry"  name="home_country" class="form-control" placeholder="country" required>
						                	<?php 
						                		$statement = $pdo->prepare("SELECT * FROM country ORDER BY country_id");
						                		$result = $statement->execute();
						                		while($row = $statement->fetch()) { ?>
						                			<option value="<?php echo ($row['country_id']);?>" <?php if(isset($home_country) and $home_country == $row['country_id']) echo "selected";?>><?php echo ($row['name']);?></option>
						                	<?php } ?>		
                            </select>
                            <div id="countryFeedback" class="invalid-feedback"></div>    
                          </div>                        
                        </div>
                        <div class="form-group row">
                          <label for="inputPhone" class="col-sm-3 col-form-label">Telefonnummer</label>
                            <div class="col-sm-9">
                              <input type="text" maxlength="15" name="home_phone" class="form-control" id="inputPhone" placeholder="phone number" value="<?php if(isset($home_phone)) echo $home_phone?>" >
                              <div id="phoneFeedback" class="invalid-feedback"></div>    
                            </div>
                        </div>
                        <div class="text-right">
                          <button type="button" class="btn btn-secondary" id="zurück2">Zurück</button>
                          <button type="button" class="btn btn-primary" id="weiter2">Weiter</button>
                        </div>
                    </div>
                    <!-- homestudy -->
                    <div class="tab-pane fade" id="homestudy" role="tabpanel" aria-labelledby="tab3">
                    
                      <div class="form-group row"> 
				              	<label for="inputHomeUniversity" class="col-sm-3 control-label">Aktuelle Universität</label>
				              	<div class="col-sm-9">
				              		<select type="value" id="inputHomeUniversity"  name="home_university" class="form-control">
				              			<?php 
				              				$statement = $pdo->prepare("SELECT * FROM university ORDER BY name ASC");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
				              					<option value="<?php echo ($row['university_id']);?>" <?php if(isset($home_university) and $home_university == $row['university_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
				              			<?php } ?>		
                          </select>
                          <div id="phoneFeedback" class="invalid-feedback"></div>    
				              	</div>
                      </div>
                    
                      <div class="form-group row"> 
				              	<label for="inputHomeDegree" class="col-sm-3 control-label">Derzeit angestrebter Abschluss</label>
				              	<div class="col-sm-9">
				              		<select type="value" id="inputHomeDegree"  name="home_degree" class="form-control">
				              			<?php 
				              				$statement = $pdo->prepare("SELECT * FROM degree");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
				              					<option value="<?php echo ($row['degree_id']);?>" <?php if(isset($home_degree) and $home_degree == $row['degree_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
				              			<?php } ?>		
                          </select>
                          <div id="degreeFeedback" class="invalid-feedback"></div>    
				              	</div>
                      </div>
                    
                      <div class="form-group row"> 
				              	<label for="inputHomeCourse" class="col-sm-3 control-label">Aktueller Studiengang</label>
				              	<div class="col-sm-9">
				              		<select type="value" id="inputHomeCourse"  name="home_course" class="form-control">
				              			<?php 
				              				$statement = $pdo->prepare("SELECT * FROM course ORDER BY name ASC");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
				              					<option value="<?php echo ($row['course_id']);?>" <?php if(isset($home_course) and $home_course == $row['course_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
				              			<?php } ?>		
                          </select>
                          <div id="courseFeedback" class="invalid-feedback"></div>    
				              	</div>
                      </div>
                    
                      <div class="form-group row">
                        <label for="inputMatrNo" class="col-sm-3 col-form-label">Matrikelnummer</label>
                          <div class="col-sm-9">
                            <input type="number" maxlength="10"  name="home_matno" class="form-control" id="inputMatrNo" placeholder="matriculation number" value="<?php if(isset($home_matno)) echo $home_matno?>" >
                            <div id="matnoFeedback" class="invalid-feedback"></div>    
                          </div>
                      </div>

                      <div class="form-group row"> 
				              	<label for="inputEnrollment" class="col-sm-3 control-label">Monat/Jahr der Einschreibung in aktuellen Studiengang <br>(month/year of enrollment): </label>
				              	<div class="col-sm-9">
				              		<input pattern="\d{4}-\d{1,2}-\d{1,2}"  type="date" id="inputEnrollment"  name="home_enrollment" class="form-control" <?php if(isset($home_enrollment)) echo "value=\"$home_enrollment\""; ?> >
                          <div id="enrollmentFeedback" class="invalid-feedback"></div>
                        </div>
                      </div>
                    
                      <div class="form-group row">
				              	<label for="inputHomeSemester" class="col-sm-3 control-label">Fachsemester aktueller Studiengang (semester): </label>
				              	<div class="col-sm-9">
				              		<select type="text" id="inputHomeSemester" name="home_semester" class="form-control">
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
                          <div id="semesterFeedback" class="invalid-feedback"></div>
				              	</div>
                      </div>
                                
                      <div class="form-group row"> 
				              	<label for="inputHomeCredits" class="col-sm-3 control-label">Summe bisher erworbener Kreditpunkte laut beigefügtem Transkript (Credits):</label>
				              	<div class="col-sm-9">
				              		<input type="number" id="inputHomeCredits" min="0" step="1" max="300" maxlength="3" name="home_credits" class="form-control" <?php if(isset($home_credits)) echo "value=\"$home_credits\""; ?>>
                          <div id="creditsFeedback" class="invalid-feedback"></div>
                        </div>
                      </div>
                    
                      <div class="form-group row">
				              	<label for="inputHomeCGPA" class="col-sm-3 control-label">Durchschnittsnote laut beigefügtem Transkript (CGPA/ Average Grade)):</label>
				              	<div class="col-sm-9">
				              		<input type="text" id="inputHomeCGPA" min="1" max="4" step="0.1" maxlength="3" name="home_cgpa" class="form-control" <?php if(isset($home_cgpa)) echo "value=\"$home_cgpa\""; ?> >
                          <div id="cgpaFeedback" class="invalid-feedback"></div>
                        </div>
                      </div>
                                
                      <div class="text-right">
                        <button type="button" class="btn btn-secondary" id="zurück3">Zurück</button>
                        <button type="button" class="btn btn-primary" id="weiter3">Weiter</button>
                      </div>

                    </div>
                    <!-- foreignstudy -->
                    <div class="tab-pane fade" id="foreignstudy" role="tabpanel" aria-labelledby="tab4">
                      
                      <div class="form-group row">
				              	<label for="inputIntention" class="col-sm-3 control-label">Programm (type of transfer):</label>
				              	<div class="col-sm-9">
				              		<select type="text" id="inputIntention" size="1" maxlength="20" name="intention" class="form-control" >
				              			<option></option>
				              			<?php 
				              				$statement = $pdo->prepare("SELECT * FROM intention");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
				              					<option value="<?php echo ($row['intention_id']);?>" <?php if(isset($intention) and $intention == $row['intention_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
				              			<?php } ?>
                          </select>
                          <div id="intentionFeedback" class="invalid-feedback"></div>
				              	</div>
                      </div>
                      
                      <div class="form-group row">
				              	<label for="inputStart" class="col-sm-3 control-label">Beginn des Austauschs (start of transfer):</label>
				              	<div class="col-sm-9">
				              		<select type="number" id="inputStart" size="1" maxlength="7" name="starting_semester" class="form-control" >
				              			<option></option>
				              			<?php 
				              				$statement = $pdo->prepare("SELECT * FROM exchange_period");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
				              					<option value="<?php echo ($row['period_id']);?>" <?php if(isset($starting_semester) and $starting_semester == $row['period_id']) echo "selected"; ?>><?php echo ($row['exchange_semester']);?></option> 
				              			<?php } ?>
				              		</select>
				              	</div>
                        <div id="periodFeedback" class="invalid-feedback"></div>
                      </div>
                      
                      <div class="form-group row"> 
				              	<label for="inputForeignDegree" class="col-sm-3 control-label">Während des geplanten Auslandsemester werde ich
				              	voraussichtlich Student sein in (abroad degree):</label>
				              	<div class="col-sm-9">
				              		<select type="text" id="inputForeignDegree" size="1" name="foreign_degree" class="form-control" >
				              			<?php 
				              				$statement = $pdo->prepare("SELECT * FROM degree");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
				              					<option value="<?php echo ($row['degree_id']);?>" <?php if(isset($foreign_degree) and $foreign_degree == $row['degree_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
				              			<?php } ?>
				              		</select>
				              	</div>
                        <div id="foreignDegreeFeedback" class="invalid-feedback"></div>
                      </div>
                      
                      <div class="form-group row">
				              	<label for="inputFirstPrio" class="col-sm-3 control-label">1. Priorität (1. priority):</label>
				              	<div class="col-sm-9">
				              		<select type="number" id="inputFirstPrio" size="1" maxlength="20" name="firstprio" class="form-control" >
				              			<option></option>
				              			<?php 
				              				$statement = $pdo->prepare("SELECT * FROM university where university_id in (2,3,4)");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
				              					<option value="<?php echo ($row['university_id']);?>" <?php if(isset($first_uni) and $first_uni == $row['university_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
				              			<?php } ?>
                          </select>
                          <div id="FirstPrioFeedback" class="invalid-feedback"></div>
				              	</div>
                      </div>
                      
                      <div class="form-group row">
				              	<label for="inputSecondPrio" class="col-sm-3 control-label">2. Priorität (2. priority):</label>
				              	<div class="col-sm-9">
				              		<select type="number" id="inputSecondPrio" size="1" maxlength="20" name="secondprio" class="form-control" >
				              			<option></option>
				              			<?php 
				              				$statement = $pdo->prepare("SELECT * FROM university where university_id in (2,3,4)");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
				              					<option value="<?php echo ($row['university_id']);?>" <?php if(isset($second_uni) and $second_uni == $row['university_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
				              			<?php } ?>
                          </select>
                          <div id="SecondPrioFeedback" class="invalid-feedback"></div>
				              	</div>
                      </div>
                      
                      <div class="form-group row">
				              	<label for="inputThirdPrio" class="col-sm-3 control-label">3. Priorität (3. priority):</label>
				              	<div class="col-sm-9">
				              		<select type="number" id="inputThirdPrio" size="1" maxlength="20" name="thirdprio" class="form-control">
				              			<option></option>
				              			<?php 
				              				$statement = $pdo->prepare("SELECT * FROM university where university_id in (2,3,4)");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
				              					<option value="<?php echo ($row['university_id']);?>" <?php if(isset($third_uni) and $third_uni == $row['university_id']) echo "selected"; ?>><?php echo ($row['name']);?></option> 
				              			<?php } ?>
                          </select>
                          <div id="ThirdPrioFeedback" class="invalid-feedback"></div>
				              	</div>
                      </div>
                      
                      <div class="text-right">
                        <button type="button" class="btn btn-secondary" id="zurück4">Zurück</button>
                        <button type="button" class="btn btn-primary" id="weiter4">Weiter</button>
                      </div>

                    </div>
                    <!-- attachments -->
                    <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="tab4">
                        
                      <div class="form-group row">
				              	<label for="CourseList" class="col-sm-3 control-label">Ausgefüllte Fächerwahlliste [Excel Format]</label>
				              	<div class="col-sm-9">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="excelfile" size="75" accept=".xls, .xlsx" name="Fächerwahlliste">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>                          
                          <div id="CourseListFeedback" class="invalid-feedback"></div>
                        </div>
                      </div>

                      <div class="form-group row">
				              	<label for="CourseList" class="col-sm-3 control-label">Motivationsschreiben [In Englisch und PDF]</label>
				              	<div class="col-sm-9">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" size="75" accept=".pdf" name="Motivationsschreiben" id="pdffile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>                          
                          <div id="CourseListFeedback" class="invalid-feedback"></div>
                        </div>
                      </div>

                      <div class="form-group row">
				              	<label for="CourseList" class="col-sm-3 control-label">Lebenslauf [In Englisch und PDF]</label>
				              	<div class="col-sm-9">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" size="75" accept=".pdf" name="Lebenslauf" id="pdffile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>                          
                          <div id="CourseListFeedback" class="invalid-feedback"></div>
                        </div>
                      </div>

                      <div class="form-group row">
				              	<label for="CourseList" class="col-sm-3 control-label">Aktuelles Transkript/Zeugnis [PDF]</label>
				              	<div class="col-sm-9">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" size="75" accept=".pdf" name="Transkript" id="pdffile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>                          
                          <div id="CourseListFeedback" class="invalid-feedback"></div>
                        </div>
                      </div>

                      <div class="text-right">
                        <button type="button" class="btn btn-secondary" id="zurück5">Zurück</button>
                        <button type="submit" class="btn btn-success" id="abschicken" name="abschicken">Bewerbung abschicken</button>
                      </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- form validation -->
<script>
$(document).ready(function(){
  $('#applicationForm').find('input, select').each(function(){
   console.info(this);
  }); 
});
</script>

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

<?php 
    include("templates/testfooter.php");
?>
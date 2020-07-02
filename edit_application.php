<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();

    if(!isset($user)){
        header("location: login.php");
        exit;
    }

    if(!isset($_GET['id'])){
      header("location: status_application.php");
      exit;
    }

    $applicationid = $_GET['id'];
    $salutationid = $user["salutation_id"];
    $firstname = $user["firstname"];
    $lastname = $user["lastname"];
    $email = $user["email"];

    //check if application exists
    if(isset($applicationid)){
        $statement = $pdo->prepare("SELECT * FROM application WHERE application_id = :id");
        $result = $statement->execute(array('id' => $applicationid));
        $application = $statement->fetch();

        if(!isset($application) || empty($application['application_id'])){
            $error_msg = "Application does not exist!";
            $error = true;
            $showForm = false;
        }else{
            $showForm = true;
            $error = false;
        }
    } 

    if(!$error){
    //get salutation name
    if(isset($salutationid)){
      $statement = $pdo->prepare("SELECT * FROM salutation WHERE salutation_id = :id");
      $result = $statement->execute(array('id' => $salutationid));
      $salutation = $statement->fetch();
    }

    //set database table variables
    $studentDB = "student";
    $applicationDB = "application";
    $homeaddressDB = "address";
    $homestudyDB = "study_home";
    $priorityDB = "priority";
      
    //set server location
    $file_server = "uploads";

    //Get data
    if(isset($user)){
      $statement = $pdo->prepare("SELECT * FROM student WHERE user_id = :id");
      $result = $statement->execute(array('id' => $user['user_id']));
      $student = $statement->fetch();

      $studentid = $student['student_id'];
      $nationality = $student['nationality_country_id'];
      $birthday = $student['birthdate'];
    }
    if(isset($student)){
      $statement = $pdo->prepare("SELECT * FROM application WHERE application_id = :id");
      $result = $statement->execute(array('id' => $applicationid));
      $application = $statement->fetch();

      $intention = $application['intention_id'];
      $starting_semester = $application['exchange_period_id'];
      $foreign_degree = $application['applied_degree_id'];

      $statement = $pdo->prepare("SELECT * FROM address WHERE address_id = :id");
      $result = $statement->execute(array('id' => $application['home_address_id']));
      $homeaddress = $statement->fetch();

      $home_street = $homeaddress['street'];
      $home_zip = $homeaddress['zipcode'];
      $home_city = $homeaddress['city'];
      $home_state = $homeaddress['state'];
      $home_country = $homeaddress['country_id'];
      $home_phone = $homeaddress['phone_no'];
    }
    if(isset($application)){
      $statement = $pdo->prepare("SELECT *, ROUND(home_credits) as credits, ROUND(home_cgpa,1) as cgpa FROM study_home WHERE application_id = :id");
      $result = $statement->execute(array('id' => $application['application_id']));
      $homestudy = $statement->fetch();

      $home_university = $homestudy['home_university_id'];
      $home_degree =  $homestudy['home_degree_id'];
      $home_course =  $homestudy['home_course_id'];
      $home_matno =  $homestudy['home_matno'];
      $home_enrollment =  $homestudy['home_enrollment_date'];
      $home_semester =  $homestudy['home_semester'];
      $home_credits =  $homestudy['credits'];
      $home_cgpa =  $homestudy['cgpa'];
  
      $statement = $pdo->prepare("SELECT * FROM priority WHERE application_id = :id");
      $result = $statement->execute(array('id' => $application['application_id']));
      $priority = $statement->fetch();

      $first_uni = $priority['first_uni_id'];
      $second_uni = $priority['second_uni_id'];
      $third_uni = $priority['third_uni_id'];

      $statement = $pdo->prepare("SELECT * FROM exchange_period WHERE period_id = :id");
      $result = $statement->execute(array('id' => $application['exchange_period_id']));
      $period = $statement->fetch();

      //set form readonly after deadline
      if(isset($period)){
        $deadline = $period['application_end'];

        if(((strtotime(date('Y-m-d h:i:sa')) - strtotime($deadline))/60/60/24) >= 0){
          header("location: view_application.php?editabort=1&id=".$applicationid);
          exit;
        }
      }
    }
}
?>

<!-- cancel -->
<?php 
  if(isset($_POST['cancel'])){
    header("location: view_application.php?id=".$applicationid);
    exit;
  }
?>

<!-- after form submit -->
<?php 
  if(isset($_POST['abschicken'])){
    $error = false;
    //ab hier Student_new DB
    $nationality = trim($_POST['nationality']);
    $birthday = $_POST['birthday'];
    
    //ab hier Home_Address DB
    $home_street = $_POST['home_street'];
    $home_zip = trim($_POST['home_zip']);
    $home_city = trim($_POST['home_city']);
    $home_state = trim($_POST['home_state']);
    $home_country = trim($_POST['home_country']);
    $home_phone = trim($_POST['home_phone']);

    //ab hier Home_study DB
    $home_university = trim($_POST['home_university']);
    $home_degree = trim($_POST['home_degree']);
    $home_course = trim($_POST['home_course']);
    $home_matno = trim($_POST['home_matno']);
    $home_enrollment = trim($_POST['home_enrollment']);
    $home_semester = trim($_POST['home_semester']);
    $home_credits = trim($_POST['home_credits']);
    $home_cgpa = Namen_bereinigen(trim($_POST['home_cgpa']));
    
    //ab hier Foreign_study für Student_new DB
    $intention = trim($_POST['intention']);
    $starting_semester = $_POST['starting_semester']; 
    $foreign_degree = $_POST['foreign_degree'];
    
    //ab hier priority DB
    $first_uni = trim($_POST['firstprio']);
    if(isset($_POST['secondprio']) && !empty($_POST['secondprio'])){
        $second_uni = trim($_POST['secondprio']);
    }else{
        $second_uni = 'NULL';
    }
    if(isset($_POST['thirdprio']) && !empty($_POST['thirdprio'])){
        $third_uni = trim($_POST['thirdprio']);
    }else{
        $third_uni = 'NULL';
    }

    if(!$error){
      //Check if all required fields are filled
      if(!isset($nationality) or !isset($birthday)
      or !isset($home_street) or !isset($home_zip) or !isset($home_city) or !isset($home_state) or !isset($home_country) or !isset($home_phone)
      or !isset($home_degree) or !isset($home_university) or !isset($home_course) or !isset($home_matno) or !isset($home_enrollment) or !isset($home_semester) or !isset($home_credits) or !isset($home_cgpa)
      or !isset($intention) or !isset($starting_semester) or !isset($foreign_degree) or !isset($first_uni) ){
        $error_msg = "Please fill in all required fields!";
        $error = true;
      }
    }

    //check whether if selected period is past deadline
    if(!$error) { 
      $statement = $pdo->prepare("SELECT * FROM exchange_period WHERE period_id = :id");
      $result = $statement->execute(array('id' => $starting_semester));
      $period = $statement->fetch();

      //set form readonly after deadline
      if(isset($period)){
        $deadline = $period['application_end'];

        if(((strtotime(date('Y-m-d h:i:sa')) - strtotime($deadline))/60/60/24) >= 0){
          $error = true;
          $error_msg = "Selected period is no longer applicable/editable!";
        }
      }
    }

    if(!$error){
      try {
        //check error in qeuries and throw exception if error found
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        $pdo->beginTransaction();
  
        $statement1 = $pdo->prepare("UPDATE $studentDB SET 
        birthdate = :birthdate , 
        nationality_country_id = :countryid WHERE user_id = :userid ");
        $statement1->execute(array('birthdate'=>$birthday, 'countryid'=> $nationality, 'userid'=>$user['user_id']));
  
        $statement3 = $pdo->prepare("UPDATE $homeaddressDB SET
          street = :street, 
          zipcode = :zip, 
          city = :city, 
          state = :state, 
          country_id = :countryid, 
          phone_no =:phone WHERE address_id = :addressid"); 
        $statement3->execute(array('addressid'=>$homeaddress['address_id'], 'street'=>$home_street, 'zip'=>$home_zip, 'city'=>$home_city, 'state'=>$home_state, 'countryid'=>$home_country, 'phone'=>$home_phone ));
  
        $statement5 = $pdo->prepare("UPDATE $applicationDB SET
          exchange_period_id=:periodid, 
          intention_id=:intentionid, 
          applied_degree_id=:degreeid,
          updated_at=now()   
          WHERE application_id = :applicationid");
        $statement5->execute(array('periodid'=>$starting_semester, 'intentionid'=>$intention, 'degreeid'=>$foreign_degree, 'applicationid'=>$applicationid ));

      
        $statement6 = $pdo->prepare("UPDATE $homestudyDB SET
          home_university_id=:uni,
          home_matno=:matno,
          home_degree_id=:degree, 
          home_course_id=:course,
          home_cgpa=:cgpa,
          home_enrollment_date=:enroll,
          home_semester=:sem,
          home_credits=:credits WHERE application_id = :applicationid");
        $statement6->execute(array('uni'=>$home_university, 'matno'=>$home_matno, 'degree'=>$home_degree, 'course'=>$home_course, 'cgpa'=>$home_cgpa, 'enroll'=>$home_enrollment, 'credits'=>$home_credits, 'sem'=>$home_semester, 'applicationid'=>$applicationid));

        if(!isset($second_uni) || empty($second_uni)){
          $second_uni = "NULL";
        }
        if(!isset($third_uni) || empty($third_uni)){
          $third_uni = "NULL";
        }
        $statement7 = $pdo->prepare("UPDATE $priorityDB SET
          first_uni_id= $first_uni,
          second_uni_id=$second_uni,
          third_uni_id= $third_uni 
          WHERE application_id =:applicationid");
        $statement7->execute(array('applicationid'=>$applicationid));
  
        $pdo->commit();
        
        /*Alert successful message after transaction committed */
        $success_msg = 'Bewerbung gespeichert';
    
      }catch (PDOException $e){
        $pdo->rollback();
        $error = true;
        $error_msg = $e->getMessage();
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

      if(file_exists($_FILES['Fächerwahlliste']['tmp_name']) && is_uploaded_file($_FILES['Fächerwahlliste']['tmp_name'])) {
          if($_FILES['Fächerwahlliste']['size'] <=  2 * 1024 * 1024){
            if(is_dir("$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Fächerwahlliste"."/")) {
                //remove files in this folder
                $files = glob( "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Fächerwahlliste"."/". '*', GLOB_MARK);
                foreach ($files as $file) {
                    if (is_dir($file)) {
                        self::deleteDir($file);
                    } else {
                        unlink($file);
                    }
                }
              }else{
                mkdir("$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Fächerwahlliste"."/"); 
              }
              move_uploaded_file($_FILES["Fächerwahlliste"]["tmp_name"], "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Fächerwahlliste"."/".$matno["home_matno"]."_"  .$_FILES['Fächerwahlliste']['name']);
          }else{
            $error_msg = "Die datei darf nicht größer als 2MB sein!";	
          }
      }

      if(file_exists($_FILES['Motivationsschreiben']['tmp_name']) && is_uploaded_file($_FILES['Motivationsschreiben']['tmp_name'])) {
        if($_FILES['Motivationsschreiben']['size'] <=  2 * 1024 * 1024){
            if(is_dir("$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Motivationsschreiben"."/")) {
                //remove files in this folder
                $files = glob( "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Motivationsschreiben"."/". '*', GLOB_MARK);
                foreach ($files as $file) {
                    if (is_dir($file)) {
                        self::deleteDir($file);
                    } else {
                        unlink($file);
                    }
                }
              }else{
                mkdir("$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Motivationsschreiben"."/"); 
              }
              move_uploaded_file($_FILES["Motivationsschreiben"]["tmp_name"], "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Motivationsschreiben"."/".$matno["home_matno"]."_"  .$_FILES['Motivationsschreiben']['name']);
        }else{
          $error_msg = "Die datei darf nicht größer als 2MB sein!";	
        }

      }

      if(file_exists($_FILES['Lebenslauf']['tmp_name']) && is_uploaded_file($_FILES['Lebenslauf']['tmp_name'])) {
        if($_FILES['Lebenslauf']['size'] <=  2 * 1024 * 1024){
            if(is_dir("$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Lebenslauf"."/")) {
                //remove files in this folder
                $files = glob( "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Lebenslauf"."/". '*', GLOB_MARK);
                foreach ($files as $file) {
                    if (is_dir($file)) {
                        self::deleteDir($file);
                    } else {
                        unlink($file);
                    }
                }
              }else{
                mkdir("$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Lebenslauf"."/"); 
              }
              move_uploaded_file($_FILES["Lebenslauf"]["tmp_name"], "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Lebenslauf"."/".$matno["home_matno"]."_"  .$_FILES['Lebenslauf']['name']);
        }else{
            $error_msg = "Die datei darf nicht größer als 2MB sein!";	
          }

      }

      if(file_exists($_FILES['Transkript']['tmp_name']) && is_uploaded_file($_FILES['Transkript']['tmp_name'])) {
        if($_FILES['Transkript']['size'] <=  2 * 1024 * 1024){
            if(is_dir("$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Transkript"."/")) {
                //remove files in this folder
                $files = glob( "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Transkript"."/". '*', GLOB_MARK);
                foreach ($files as $file) {
                    if (is_dir($file)) {
                        self::deleteDir($file);
                    } else {
                        unlink($file);
                    }
                }
              }else{
                mkdir("$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Transkript"."/"); 
              }
              move_uploaded_file($_FILES["Transkript"]["tmp_name"], "$file_server/".$priority["name"] ."/".$user["lastname"]."_"  .$firstname_short."_"  .$matno["home_matno"]."/Transkript"."/".$matno["home_matno"]."_"  .$_FILES['Transkript']['name']);
        }else{
            $error_msg = "Die datei darf nicht größer als 2MB sein!";	
          }

      }        
		}
  }
}
?>

<?php 
    include("templates/headerlogin.inc.php");
?>

<main class="container-fluid flex-fill">
    <div class="card application-form">
        <!-- page title -->
        <!-- <div class="page-title">
                <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Bewerbungsformular
            </div> -->

        <div class="title-row" style="display: flex; justify-content: space-between;">
            <!-- page title -->
            <div class="page-title">
                <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Bewerbung bearbeiten
            </div>

            <div class="title-button">
                <div class="text-right">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $applicationid;?>" method="post">
                        <button type="submit" class="btn btn-outline-danger btn-sm" name="cancel">Abbrechen</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- <div class="page-navigation">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="test_status.php">Homepage</a></li>
                    <li class="breadcrumb-item"><a href="view_application.php?id=<?php //echo $applicationid;?>">View Application</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Application</li>
                  </ol>
                </nav>
            </div> -->
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
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $error_msg; ?>
        </div>
        <?php 
            endif;
            ?>

        <?php if(isset($showForm) && $showForm == true) { ?>
        <!-- tab navigation -->
        <nav class="nav-application-form">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="tab1" data-toggle="tab" href="#personaldata" role="tab"
                    aria-controls="personaldata" aria-selected="true">Persönliche Angaben</a>
                <a class="nav-item nav-link" id="tab2" data-toggle="tab" href="#homeaddress" role="tab"
                    aria-controls="homeaddress" aria-selected="false">Heimat-Adresse</a>
                <a class="nav-item nav-link" id="tab3" data-toggle="tab" href="#homestudy" role="tab"
                    aria-controls="homestudy" aria-selected="false">Aktuelles Studium</a>
                <a class="nav-item nav-link" id="tab4" data-toggle="tab" href="#foreignstudy" role="tab"
                    aria-controls="foreignstudy" aria-selected="false">Austauschprogramm</a>
                <a class="nav-item nav-link" id="tab5" data-toggle="tab" href="#attachments" role="tab"
                    aria-controls="attachments" aria-selected="false">Anhänge</a>
            </div>
        </nav>
        <!-- form -->
        <form id="applicationForm" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $applicationid;?>"
            method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
            <!-- tab content -->
            <div class="tab-content" id="nav-tabContent">
                <!-- personaldata -->
                <div class="tab-pane fade show active" id="personaldata" role="tabpanel" aria-labelledby="tab1">
                    <div class="form-group row">
                        <label for="inputSalutation"
                            class="col-sm-3 col-form-label col-form-label-sm">Salutation</label>
                        <div class="col-sm-9">
                            <input type="text" name="salutation" class="form-control-plaintext form-control-sm"
                                id="inputSalutation" value="<?php if(isset($salutation)) echo $salutation['name']?>"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputFirstname" class="col-sm-3 col-form-label col-form-label-sm">Vorname</label>
                        <div class="col-sm-9">
                            <input type="text" name="firstname" class="form-control-plaintext form-control-sm"
                                id="inputFirstname" placeholder="Vorname"
                                value="<?php if(isset($firstname)) echo $firstname?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLastname" class="col-sm-3 col-form-label col-form-label-sm">Nachname</label>
                        <div class="col-sm-9">
                            <input type="text" name="lastname" class="form-control-plaintext form-control-sm"
                                id="inputLastname" placeholder="Nachname"
                                value="<?php if(isset($lastname)) echo $lastname?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label col-form-label-sm">E-Mail</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control-plaintext form-control-sm"
                                id="inputEmail" placeholder="E-Mail" value="<?php if(isset($email)) echo $email?>"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputNationality"
                            class="col-sm-3 col-form-label col-form-label-sm">Nationalität</label>
                        <div class="col-sm-9">
                            <select id="inputNationality" name="nationality" class="form-control form-control-sm"
                                required>
                                <?php 
						                		$statement = $pdo->prepare("SELECT * FROM country ORDER BY country_id");
						                		$result = $statement->execute();
						                		while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['country_id']);?>"
                                    <?php if(isset($nationality) and $nationality == $row['country_id']) echo "selected";?>>
                                    <?php echo ($row['name']);?></option>
                                <?php } ?>
                            </select>
                            <div id="nationalityFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLastname"
                            class="col-sm-3 col-form-label col-form-label-sm">Geburtsdatum</label>
                        <div class="col-sm-9">
                            <input type="date" pattern="\d{4}-\d{1,2}-\d{1,2}" id="inputBday" name="birthday"
                                class="form-control form-control-sm" placeholder="YYYY-MM-DD"
                                <?php if(isset($birthday)) echo "value=\"$birthday\""; ?>>
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
                        <label for="inputStreet" class="col-sm-3 col-form-label col-form-label-sm">Straße und
                            Haus-Nr.</label>
                        <div class="col-sm-9">
                            <input type="text" maxlength="40" name="home_street" class="form-control form-control-sm"
                                id="inputStreet" placeholder="street, house no"
                                value="<?php if(isset($home_street)) echo $home_street?>">
                            <div id="streetFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputZip" class="col-sm-3 col-form-label col-form-label-sm">PLZ</label>
                        <div class="col-sm-9">
                            <input type="text" maxlength="10" name="home_zip" class="form-control form-control-sm"
                                id="inputZip" placeholder="postcode"
                                value="<?php if(isset($home_zip)) echo $home_zip?>">
                            <div id="zipFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputCity" class="col-sm-3 col-form-label col-form-label-sm">Ort</label>
                        <div class="col-sm-9">
                            <input type="text" maxlength="40" name="home_city" class="form-control form-control-sm"
                                id="inputCity" placeholder="city" value="<?php if(isset($home_city)) echo $home_city?>">
                            <div id="cityFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputState" class="col-sm-3 col-form-label col-form-label-sm">Bundesland</label>
                        <div class="col-sm-9">
                            <input type="text" maxlength="40" name="home_state" class="form-control form-control-sm"
                                id="inputState" placeholder="state"
                                value="<?php if(isset($home_state)) echo $home_state?>">
                            <div id="stateFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputCountry" class="col-sm-3 col-form-label col-form-label-sm">Land</label>
                        <div class="col-sm-9">
                            <select id="inputCountry" name="home_country" class="form-control form-control-sm"
                                placeholder="country" required>
                                <?php 
						                		$statement = $pdo->prepare("SELECT * FROM country ORDER BY country_id");
						                		$result = $statement->execute();
						                		while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['country_id']);?>"
                                    <?php if(isset($home_country) and $home_country == $row['country_id']) echo "selected";?>>
                                    <?php echo ($row['name']);?></option>
                                <?php } ?>
                            </select>
                            <div id="countryFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPhone" class="col-sm-3 col-form-label col-form-label-sm">Telefonnummer</label>
                        <div class="col-sm-9">
                            <input type="text" maxlength="15" name="home_phone" class="form-control form-control-sm"
                                id="inputPhone" placeholder="phone number"
                                value="<?php if(isset($home_phone)) echo $home_phone?>">
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
                        <label for="inputHomeUniversity" class="col-sm-3 col-form-label col-form-label-sm">Aktuelle
                            Universität</label>
                        <div class="col-sm-9">
                            <select type="value" id="inputHomeUniversity" name="home_university"
                                class="form-control form-control-sm">
                                <?php 
				              				$statement = $pdo->prepare("SELECT * FROM university ORDER BY name ASC");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['university_id']);?>"
                                    <?php if(isset($home_university) and $home_university == $row['university_id']) echo "selected"; ?>>
                                    <?php echo ($row['name']);?></option>
                                <?php } ?>
                            </select>
                            <div id="phoneFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputHomeDegree" class="col-sm-3 col-form-label col-form-label-sm">Derzeit
                            angestrebter Abschluss</label>
                        <div class="col-sm-9">
                            <select type="value" id="inputHomeDegree" name="home_degree"
                                class="form-control form-control-sm">
                                <?php 
				              				$statement = $pdo->prepare("SELECT * FROM degree");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['degree_id']);?>"
                                    <?php if(isset($home_degree) and $home_degree == $row['degree_id']) echo "selected"; ?>>
                                    <?php echo ($row['name']);?></option>
                                <?php } ?>
                            </select>
                            <div id="degreeFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputHomeCourse" class="col-sm-3 col-form-label col-form-label-sm">Aktueller
                            Studiengang</label>
                        <div class="col-sm-9">
                            <select type="value" id="inputHomeCourse" name="home_course"
                                class="form-control form-control-sm">
                                <?php 
				              				$statement = $pdo->prepare("SELECT * FROM course ORDER BY name ASC");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['course_id']);?>"
                                    <?php if(isset($home_course) and $home_course == $row['course_id']) echo "selected"; ?>>
                                    <?php echo ($row['name']);?></option>
                                <?php } ?>
                            </select>
                            <div id="courseFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputMatrNo"
                            class="col-sm-3 col-form-label col-form-label-sm">Matrikelnummer</label>
                        <div class="col-sm-9">
                            <input type="number" maxlength="10" name="home_matno" class="form-control form-control-sm"
                                id="inputMatrNo" placeholder="matriculation number"
                                value="<?php if(isset($home_matno)) echo $home_matno?>">
                            <div id="matnoFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEnrollment" class="col-sm-3 col-form-label col-form-label-sm">Monat/Jahr der
                            Einschreibung in aktuellen Studiengan</label>
                        <div class="col-sm-9">
                            <input pattern="\d{4}-\d{1,2}-\d{1,2}" type="date" id="inputEnrollment"
                                name="home_enrollment" class="form-control form-control-sm"
                                <?php if(isset($home_enrollment)) echo "value=\"$home_enrollment\""; ?>>
                            <div id="enrollmentFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputHomeSemester" class="col-sm-3 col-form-label col-form-label-sm">Fachsemester
                            aktueller Studiengang</label>
                        <div class="col-sm-9">
                            <select type="text" id="inputHomeSemester" name="home_semester"
                                class="form-control form-control-sm">
                                <option></option>
                                <option value="1"
                                    <?php if(isset($home_semester) and $home_semester == "1") echo "selected"; ?>>1.
                                    Semester</option>
                                <option value="2"
                                    <?php if(isset($home_semester) and $home_semester == "2") echo "selected"; ?>>2.
                                    Semester</option>
                                <option value="3"
                                    <?php if(isset($home_semester) and $home_semester == "3") echo "selected"; ?>>3.
                                    Semester</option>
                                <option value="4"
                                    <?php if(isset($home_semester) and $home_semester == "4") echo "selected"; ?>>4.
                                    Semester</option>
                                <option value="5"
                                    <?php if(isset($home_semester) and $home_semester == "5") echo "selected"; ?>>5.
                                    Semester</option>
                                <option value="6"
                                    <?php if(isset($home_semester) and $home_semester == "6") echo "selected"; ?>>6.
                                    Semester</option>
                                <option value="7"
                                    <?php if(isset($home_semester) and $home_semester == "7") echo "selected"; ?>>7.
                                    Semester</option>
                                <option value="8"
                                    <?php if(isset($home_semester) and $home_semester == "8") echo "selected"; ?>>8.
                                    Semester</option>
                            </select>
                            <div id="semesterFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputHomeCredits" class="col-sm-3 col-form-label col-form-label-sm">Summe bisher
                            erworbener Kreditpunkte laut beigefügtem Transkript</label>
                        <div class="col-sm-9">
                            <input type="number" id="inputHomeCredits" min="0" step="1" max="300" maxlength="3"
                                name="home_credits" class="form-control form-control-sm"
                                <?php if(isset($home_credits)) echo "value=\"$home_credits\""; ?>>
                            <div id="creditsFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label for="inputHomeCGPA" class="col-sm-3 col-form-label col-form-label-sm">Durchschnittsnote
                            laut beigefügtem Transkript</label>
                        <div class="col-sm-9">
                            <input  type="number" id="inputHomeCGPA" min="1" max="4" step="0.1" maxlength="3" placeholder="Use period as decimal separator."
                                 name="home_cgpa" class="form-control form-control-sm"
                                <?php if(isset($home_cgpa)) echo "value=\"$home_cgpa\""; ?>>
                            <div id="cgpaFeedback" class="invalid-feedback"></div>
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="inputHomeCGPA" class="col-sm-3 col-form-label col-form-label-sm">Durchschnittsnote
                            laut beigefügtem Transkript</label>
                        <div class="col-sm-9">
                            <input  type="text" id="inputHomeCGPA"  maxlength="3" pattern="[0-9]+([\.,][0-9]+)?"
                                 name="home_cgpa" class="form-control form-control-sm"
                                <?php if(isset($home_cgpa)) echo "value=\"$home_cgpa\""; ?>>
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
                        <label for="inputIntention" class="col-sm-3 col-form-label col-form-label-sm">Programm</label>
                        <div class="col-sm-9">
                            <select type="text" id="inputIntention" size="1" maxlength="20" name="intention"
                                class="form-control form-control-sm">
                                <option></option>
                                <?php 
				              				$statement = $pdo->prepare("SELECT * FROM intention");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['intention_id']);?>"
                                    <?php if(isset($intention) and $intention == $row['intention_id']) echo "selected"; ?>>
                                    <?php echo ($row['name']);?></option>
                                <?php } ?>
                            </select>
                            <div id="intentionFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputStart" class="col-sm-3 col-form-label col-form-label-sm">Beginn des
                            Austauschs</label>
                        <div class="col-sm-9">
                            <select type="number" id="inputStart" size="1" maxlength="7" name="starting_semester"
                                class="form-control form-control-sm">
                                <option></option>
                                <?php 
				              				$statement = $pdo->prepare("SELECT * FROM exchange_period  WHERE now() between application_begin and application_end ");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['period_id']);?>"
                                    <?php if(isset($starting_semester) and $starting_semester == $row['period_id']) echo "selected"; ?>>
                                    <?php echo ($row['exchange_semester']);?></option>
                                <?php } ?>
                                <?php 
				              				$statement = $pdo->prepare("SELECT * FROM exchange_period  WHERE now() not between application_begin and application_end ");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['period_id']);?>"
                                    <?php if(isset($starting_semester) and $starting_semester == $row['period_id']) echo "selected"; ?>
                                    disabled><?php echo ($row['exchange_semester']);?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="periodFeedback" class="invalid-feedback"></div>
                    </div>

                    <div class="form-group row">
                        <label for="inputForeignDegree" class="col-sm-3 col-form-label col-form-label-sm">Während des
                            geplanten Auslandsemester werde ich
                            voraussichtlich Student sein in</label>
                        <div class="col-sm-9">
                            <select type="text" id="inputForeignDegree" size="1" name="foreign_degree"
                                class="form-control form-control-sm">
                                <?php 
				              				$statement = $pdo->prepare("SELECT * FROM degree");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['degree_id']);?>"
                                    <?php if(isset($foreign_degree) and $foreign_degree == $row['degree_id']) echo "selected"; ?>>
                                    <?php echo ($row['name']);?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="foreignDegreeFeedback" class="invalid-feedback"></div>
                    </div>

                    <div class="form-group row">
                        <label for="inputFirstPrio" class="col-sm-3 col-form-label col-form-label-sm">1.
                            Priorität</label>
                        <div class="col-sm-9">
                            <select type="number" id="inputFirstPrio" size="1" maxlength="20" name="firstprio"
                                class="form-control form-control-sm">
                                <option></option>
                                <?php 
				              				$statement = $pdo->prepare("SELECT * FROM university where university_id in (2,3,5)");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['university_id']);?>"
                                    <?php if(isset($first_uni) and $first_uni == $row['university_id']) echo "selected"; ?>>
                                    <?php echo ($row['name']);?></option>
                                <?php } ?>
                            </select>
                            <div id="FirstPrioFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputSecondPrio" class="col-sm-3 col-form-label col-form-label-sm">2.
                            Priorität</label>
                        <div class="col-sm-9">
                            <select type="number" id="inputSecondPrio" size="1" maxlength="20" name="secondprio"
                                class="form-control form-control-sm">
                                <option></option>
                                <?php 
				              				$statement = $pdo->prepare("SELECT * FROM university where university_id in (2,3,5)");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['university_id']);?>"
                                    <?php if(isset($second_uni) and $second_uni == $row['university_id']) echo "selected"; ?>>
                                    <?php echo ($row['name']);?></option>
                                <?php } ?>
                            </select>
                            <div id="SecondPrioFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputThirdPrio" class="col-sm-3 col-form-label col-form-label-sm">3.
                            Priorität</label>
                        <div class="col-sm-9">
                            <select type="number" id="inputThirdPrio" size="1" maxlength="20" name="thirdprio"
                                class="form-control form-control-sm" <?php if(empty($second_uni)) echo"disabled";?>>
                                <option></option>
                                <?php 
				              				$statement = $pdo->prepare("SELECT * FROM university where university_id in (2,3,5)");
				              				$result = $statement->execute();
				              				while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['university_id']);?>"
                                    <?php if(isset($third_uni) and $third_uni == $row['university_id']) echo "selected"; ?>>
                                    <?php echo ($row['name']);?></option>
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

                    <div class="alert alert-warning">
                        Wenn du deine hochgeladenen Dokumente nicht ändern möchten, kannst du diesen Abschnitt
                        überspringen und deine Bewerbung jetzt speichern. Andernfalls werden vorhandene Dokumente durch
                        neue Dokumente ersetzt.
                        <!-- If you don't wish to change your uploaded documents, you can skip this section and save your application now. Otherwise, existing document(s) will be replaced new document(s). -->
                    </div>

                    <div class="form-group row">
                        <label for="CourseList" class="col-sm-3 col-form-label col-form-label-sm">Ausgefüllte
                            Fächerwahlliste [Excel Format]</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file1" size="75" accept=".xls, .xlsx"
                                    name="Fächerwahlliste" required>
                                <label class="custom-file-label" for="customFile" id="inputFächerwahlliste">Choose
                                    file</label>
                            </div>
                            <div id="CourseListFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="CourseList" class="col-sm-3 col-form-label col-form-label-sm">Motivationsschreiben
                            [In Englisch und PDF]</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" size="75" accept=".pdf"
                                    name="Motivationsschreiben" id="file2" required>
                                <label class="custom-file-label" for="customFile" id="inputMotivationsschreiben">Choose
                                    file</label>
                            </div>
                            <div id="CourseListFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="CourseList" class="col-sm-3 col-form-label col-form-label-sm">Lebenslauf [In
                            Englisch und PDF]</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" size="75" accept=".pdf" name="Lebenslauf"
                                    id="file3" required>
                                <label class="custom-file-label" for="customFile" id="inputLebenslauf">Choose
                                    file</label>
                            </div>
                            <div id="CourseListFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="CourseList" class="col-sm-3 col-form-label col-form-label-sm">Aktuelles
                            Transkript/Zeugnis [PDF]</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" size="75" accept=".pdf" name="Transkript"
                                    id="file4" required>
                                <label class="custom-file-label" for="customFile" id="inputTranskript">Choose
                                    file</label>
                            </div>
                            <div id="CourseListFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn btn-secondary" id="zurück5">Zurück</button>
                        <button type="submit" class="btn btn-success" id="abschicken" name="abschicken">Bewerbung
                            ändern</button>
                    </div>

                </div>
            </div>
        </form>
        <?php } ?>
    </div>
</main>

<!-- priority select changed -->
<script>
$(document).ready(function() {
    $("#inputFirstPrio").change(function() {
        var selected = $(this).val();
        $("#inputSecondPrio option:selected").prop("selected", false);
        $("#inputThirdPrio option:selected").prop("selected", false);

        if (selected !== "") {
            $("#inputSecondPrio").attr("disabled", false);

            $("#inputSecondPrio option[value=" + selected + "]").attr('disabled', 'disabled')
                .siblings().removeAttr('disabled');

            $("#inputThirdPrio option[value=" + selected + "]").attr('disabled', 'disabled')
                .siblings().removeAttr('disabled');
        } else {
            $("#inputSecondPrio").attr("disabled", true);
            $("#inputThirdPrio").attr("disabled", true);
        }


    });

    $("#inputSecondPrio").change(function() {
        var second = $(this).val();

        $("#inputThirdPrio option:selected").prop("selected", false);
        $("#inputThirdPrio option:disabled").removeAttr('disabled');

        if (second !== "") {
            var first = $("#inputFirstPrio").val();
            $("#inputThirdPrio").attr("disabled", false);

            $("#inputThirdPrio option[value=" + first + "]").attr('disabled', 'disabled');
            $("#inputThirdPrio option[value=" + second + "]").attr('disabled', 'disabled');
        } else {
            $("#inputThirdPrio").attr("disabled", true);
        }
    });
});
</script>

<!-- form validation -->
<script>
$(document).ready(function() {
    // $('#applicationForm').find('input, select').each(function(){
    //  console.info(this);
    // }); 
});
</script>

<!-- next and back button click -->
<script>
$(document).ready(function() {

    //Button 'Weiter' clicked: To next tab based on buttonid
    $("#weiter1").click(function() {
        $('.nav-tabs a[href="#homeaddress"]').tab('show');
    });

    $("#weiter2").click(function() {
        $('.nav-tabs a[href="#homestudy"]').tab('show');
    });

    $("#weiter3").click(function() {
        $('.nav-tabs a[href="#foreignstudy"]').tab('show');
    });

    $("#weiter4").click(function() {
        $('.nav-tabs a[href="#attachments"]').tab('show');
    });

    //Button 'Zurück' clicked: To previous tab based on buttonid
    $("#zurück2").click(function() {
        $('.nav-tabs a[href="#personaldata"]').tab('show');
    });

    $("#zurück3").click(function() {
        $('.nav-tabs a[href="#homeaddress"]').tab('show');
    });

    $("#zurück4").click(function() {
        $('.nav-tabs a[href="#homestudy"]').tab('show');
    });

    $("#zurück5").click(function() {
        $('.nav-tabs a[href="#foreignstudy"]').tab('show');
    });
});
</script>

<!-- custom file browser show input -->
<script>
$(document).ready(function() {

    $("#file1").change(function(e) {
        var file = e.target.files[0].name;
        $("#inputFächerwahlliste").empty();
        $("#inputFächerwahlliste").append(file);
    });

    $("#file2").change(function(e) {
        var file = e.target.files[0].name;
        $("#inputMotivationsschreiben").empty();
        $("#inputMotivationsschreiben").append(file);
    });

    $("#file3").change(function(e) {
        var file = e.target.files[0].name;
        $("#inputLebenslauf").empty();
        $("#inputLebenslauf").append(file);
    });

    $("#file4").change(function(e) {
        var file = e.target.files[0].name;
        $("#inputTranskript").empty();
        $("#inputTranskript").append(file);
    });
});
</script>

<!-- before submit check file size -->
<script>
$(document).ready(function() {

    $("#applicationForm").submit(function(e) {

        //check file size
        $("#applicationForm").find("input[type=file]").each(function(index, field){
            const file = field.files[0];
            var filename = field.name;
            if(file.size > 2 * 1024 * 1024 ) {
               alert(filename + ' must be less than 2MB.');
               e.preventDefault();
            }    
        });
    });

});
</script>

<?php 
    include("templates/footer.inc.php");
?>
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
      header("location: status.php");
      exit;
    }

    if(isset($_GET['uni'])){
        $activeUni = $_GET['uni'];
    }else{
        $activeUni = 1;
    }

    $degreelist = 0;

    $applicationid = $_GET['id'];
    $salutationid = $user["salutation_id"];
    $firstname = $user["firstname"];
    $lastname = $user["lastname"];
    $email = $user["email"];

    //set database table variables
    $studentDB = "student";
    $applicationDB = "application";
    $homeaddressDB = "address";
    $homestudyDB = "study_home";
    $priorityDB = "priority";

    //get valid application
    if(isset($applicationid) && !empty($applicationid)){
        $statement = $pdo->prepare("SELECT * FROM application WHERE application_id = :id");
        $result = $statement->execute(array('id' => $applicationid));
        $application = $statement->fetch();
    }

    //get home uni
    if(isset($application)){
        $statement = $pdo->prepare("SELECT sh.*, v1.name as homeUni FROM study_home sh
                                    LEFT JOIN university v1 on v1.university_id = sh.home_university_id  
                                    WHERE application_id = :id");
        $result = $statement->execute(array('id' => $application['application_id']));
        $homestudy = $statement->fetch();
  
        $home_university = $homestudy['home_university_id'];
        $home_university_title = $homestudy['homeUni'];
        $home_degree =  $homestudy['home_degree_id'];
        $home_course =  $homestudy['home_course_id'];
        $home_matno =  $homestudy['home_matno'];
        $home_semester =  $homestudy['home_semester'];


        $statement = $pdo->prepare("SELECT pr.*, v1.name as uni1, v2.name as uni2, v3.name as uni3 FROM priority pr
                                    LEFT JOIN university v1 on v1.university_id = pr.first_uni_id 
                                    LEFT JOIN university v2 on v2.university_id = pr.second_uni_id 
                                    LEFT JOIN university v3 on v3.university_id = pr.third_uni_id 
                                    WHERE application_id = :id");
        $result = $statement->execute(array('id' => $application['application_id']));
        $priority = $statement->fetch();
  
        $first_uni_title = $priority['uni1'];
        $second_uni_title = $priority['uni2'];
        $third_uni_title = $priority['uni3'];

        $first_uni_id = $priority['first_uni_id'];
        $second_uni_id = $priority['second_uni_id'];
        $third_uni_id = $priority['third_uni_id'];

  
        $statement = $pdo->prepare("SELECT * FROM exchange_period WHERE period_id = :id");
        $result = $statement->execute(array('id' => $application['exchange_period_id']));
        $period = $statement->fetch();
  
        //set form readonly after deadline
        if(isset($period)){
          $deadline = $period['application_end'];
  
          if(((strtotime(date('Y-m-d h:i:sa')) - strtotime($deadline))/60/60/24) >= 0){
            $readonly = true;
          }else{
              $readonly = false;
          }
        }
    }else{
        header("location: status.php");
        exit;
    }
?>

<?php 
    /* Ergebnis der vom Studenten ausgewählten Kurse */
if(isset($_POST['save'])) {
		if(!empty($_POST['kurse'])) {
			/*DELETE all old entries of students in database table 'student_selectedsubjects' then INSERT newly checked equivalent-courses into database*/
				$stmtDelete = $pdo->prepare("DELETE FROM applied_equivalence WHERE application_id = $applicationid ");
				$stmtInsert = $pdo->prepare("INSERT INTO applied_equivalence (equivalence_id, application_id) VALUES (?, $applicationid)");

				/*Begin transaction*/
				try {

					$pdo->beginTransaction();
					$stmtDelete->execute();
					foreach ($_POST['kurse'] as $value)
					{
						$stmtInsert->execute(array($value));
					}
					$pdo->commit();
					$success_msg = 'Auswahl gespeichert';

				}catch (Exception $e){
					$pdo->rollback();
					throw $e;
					$error_msg = $e->get_message();
				}
			}
	}
?>

<?php 
    include("templates/headerlogin.inc.php");
?>

<main class="container-fluid flex-fill">
    <div class="card auswahl-form">

        <div class="title-row" style="display: flex; justify-content: space-between;">
            <!-- page title -->
            <div class="page-title">
                <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Fächerwahlliste
            </div>

            <div class="title-button">
                <form action="view_application.php?id=<?php echo $applicationid?>" method="post">
                    <div class="text-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm" name="backToHomepage">Zurück zur
                            Übersicht</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="stepper">
              <a class="stepper-link" href="view_application.php?id=<?php echo $applicationid?>">
              <div class="stepper-item complete" data-toggle="tooltip" data-placement="top" title="Bewerbungsformular">
                <span class="stepper-circle">1</span>
                <span class="stepper-label">Bewerbungsformular</span>
              </div>
              </a>
              <div class="stepper-line"></div>
              <a class="stepper-link" href="facherwahl.php?id=<?php echo $applicationid?>">
              <div class="stepper-item active"  data-toggle="tooltip" data-placement="top" title="Fächerwahlliste">
                <span class="stepper-circle">2</span>
                <span class="stepper-label">Fächerwahlliste</span>
              </div>
              </a>
              <div class="stepper-line"></div>
              <div class="stepper-item disabled"  data-toggle="tooltip" data-placement="top" title="Bewerbung eingereicht">
                <span class="stepper-circle">3</span>
                <span class="stepper-label">Bewerbung eingereicht</span>
              </div>
            </div>

        <!-- <div class="page-navigation">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="test_status.php">Homepage</a></li>
                    <li class="breadcrumb-item"><a href="view_application.php?id=<?php echo $applicationid;?>">View Application</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Subject Selection</li>
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

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link<?php if($activeUni == 1) echo" active"?><?php if(!isset($first_uni_id)) echo" disabled"?>"
                    aria-disabled="<?php if(!isset($first_uni_id)) echo "true"; else echo "false";?>"
                    id="pills-first-tab" data-toggle="pill" href="#pills-first" role="tab" aria-controls="pills-first"
                    aria-selected="<?php if($activeUni == 1) echo "true"; else echo "false" ;?>">1.
                    Priorität<?php if(isset($first_uni_title)) echo " - ".$first_uni_title;?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link<?php if($activeUni == 2) echo" active"?><?php if(!isset($second_uni_id)) echo" disabled"?>"
                    aria-disabled="<?php if(!isset($second_uni_id)) echo "true"; else echo "false";?>"
                    id="pills-second-tab" data-toggle="pill" href="#pills-second" role="tab"
                    aria-controls="pills-second"
                    aria-selected="<?php if($activeUni == 2) echo "true"; else echo "false" ;?>">2.
                    Priorität<?php if(isset($second_uni_title)) echo " - ".$second_uni_title;?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link<?php if($activeUni == 3) echo" active"?><?php if(!isset($third_uni_id)) echo" disabled"?>"
                    aria-disabled="<?php if(!isset($third_uni_id)) echo "true"; else echo "false";?>"
                    id="pills-third-tab" data-toggle="pill" href="#pills-third" role="tab" aria-controls="pills-third"
                    aria-selected="<?php if($activeUni == 3) echo "true"; else echo "false" ;?>">3.
                    Priorität<?php if(isset($third_uni_title)) echo " - ".$third_uni_title;?></a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade<?php if($activeUni == 1) echo" show active"?>" id="pills-first" role="tabpanel"
                aria-labelledby="pills-first-tab">
                <?php 
                    if(isset($first_uni_id) && !empty($first_uni_id)){     
                        ?>
                <!-- foreign university name -->
                <!-- <div class="uni-title">
                            <?php //if(isset($first_uni_title)) echo $first_uni_title;?>
                        </div> -->

                <!-- print table button -->
                <div class="text-right">
                    <button type="button" class="btn btn-success" id="print" name="1">Ausdrucken</button>
                </div>

                <div class="list-filter">
                <!-- checkbox button -->
                
                    <div class="form-check form-check-inline">
                        <input name="degree1" class="form-check-input" type="checkbox" id="degree1" value="degree"
                            checked>
                        <label class="form-check-label" for="inlineCheckbox1">Bachelor</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="master1" class="form-check-input" type="checkbox" id="master1" value="master"
                            checked>
                        <label class="form-check-label" for="inlineCheckbox2">Master</label>
                    </div>
                

                    <!-- radio button -->
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="forCourse" id="mycourse1" value="mycourse" checked>
                      <label class="form-check-label" for="mycourse">Meine Studiengang</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="forCourse" id="allcourse1" value="allcourse">
                      <label class="form-check-label" for="allcourse">Alle Studiengänge</label>
                    </div>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $applicationid."&uni=1";?>"
                    method="post">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm" id="courses1">
                            <thead>
                                <tr style="background-color: #003D76; color: white;">
                                    <th scope="col" width="8%" align="center">Auswahl</th>
                                    <th scope="col" width="15%" align="center">Kurs-Nr. Heim-Uni</th>
                                    <th scope="col" width="11%" align="center">Credits Heim-Uni</th>
                                    <th scope="col" width="25%" align="center">Kurs Heim-Uni</th>
                                    <th scope="col" width="11%" align="center">Credits Partner-Uni</th>
                                    <th scope="col" width="25%" align="center">Kurs Partner-Uni</th>
                                    <th scope="col" width="25%" align="center">Gültig Für</th>
                                    <th scope="col" width="5%" align="center">Status</th>
                                    <th scope="col" width="5%" align="center">Zuletzt Aktualisiert</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
		                    /*Query previously selected equivalence-courses' id of the user*/
		                    $statement = $pdo->prepare("SELECT equivalence_id FROM applied_equivalence
		                    							WHERE application_id = $applicationid");
		                    $result = $statement->execute();
		                    $selectedCourses = array();
		                    while($selectedCourse = $statement->fetch())
		                    {
		                    	array_push($selectedCourses, $selectedCourse['equivalence_id']);
		                    }
                        
                    
                            // select equivalences that dont have specific courses, then union with equivalence that valid for this course
                            // $statement = $pdo->prepare("SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status,
                            // s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                            // ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at 
                            // FROM equivalent_subjects es
                            // LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                            // LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                            // LEFT JOIN status st ON st.status_id = es.status_id
                            // WHERE s1.university_id = $home_university AND s2.university_id = $first_uni_id AND 
                            // NOT EXISTS (SELECT * FROM equivalence_course ec WHERE ec.equivalence_id = es.equivalence_id) 
                            // UNION ALL
                            // SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status,
                            // s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                            // ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at 
                            // FROM equivalence_course ec 
                            // LEFT JOIN equivalent_subjects es ON es.equivalence_id = ec.equivalence_id
                            // LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                            // LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                            // LEFT JOIN status st ON st.status_id = es.status_id
                            // WHERE s1.university_id = $home_university AND s2.university_id = $first_uni_id AND ec.course_id = $home_course
                            // ORDER BY status_id, equivalence_id");

		                    //get all equivalence
                            $statement = $pdo->prepare("SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status,
                            s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                            ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at 
                            FROM equivalent_subjects es
                            LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                            LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                            LEFT JOIN status st ON st.status_id = es.status_id
                            WHERE s1.university_id = $home_university AND s2.university_id = $first_uni_id");
                        
                            $result = $statement->execute();
                            
                            while($row = $statement->fetch()) {
                            
                                //check course validity
                                $statement1 = $pdo->prepare("SELECT cs.course_id, cs.name FROM equivalence_course ec 
                                LEFT JOIN course cs ON cs.course_id = ec.course_id 
                                WHERE ec.equivalence_id = :id");
                            
                                $result1 = $statement1->execute(array('id'=>$row['equivalence_id']));
                                $validcourses = array();
                                $validcoursesids = array();
                                while($row1 = $statement1->fetch()){
                                    array_push($validcourses, $row1['name']);
                                    array_push($validcoursesids, $row1['course_id']);
                                }
                                if(count($validcourses) == 0){
                                    $forAll = true;
                                }else{
                                    $forAll = false;
                                    $validcoursesname = implode(",", $validcourses); //convert array to string
                            
                                    // equivalence is not for all courses, check if it is valid for user's home course
                                    if(in_array($home_course, $validcoursesids)){
                                        $available = true;        
                                    }else{
                                        $available = false;
                                    }
                                }
                        
                                
                                ?>
                            
                                <tr id="<?php echo $row['valid_degree_id']; ?>" 
                                    class="<?php if($forAll==false && $available==false) echo "table-secondary"; else if($row['status_id'] == "1") echo "table-warning"; else if($row['status_id'] == "2") echo "table-success"; else if($row['status_id'] == "3") echo "table-danger";?>">
                                    <!--check previously selected equivalence-courses and disable declined courses-->
                                    <?php
                                    if(!$readonly){
                                        ?><td align="center"
                                        id="<?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "checked"?>">
                                        <input type="checkbox" name="kurse[]"
                                            value="<?php echo $row['equivalence_id'] ?>"
                                            <?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "checked" ; if($row['status_id'] == "3" || ($forAll == false && $available == false)) echo "disabled"; ?>>
                                    </td>
                                    <?php
                                    }else{
                                        ?>
                                    <!-- <td align="center"><i <?php // if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "class='glyphicon glyphicon-ok'" ?>></i></td> -->
                                    <td align="center">
                                        <?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "selected" ?>
                                    </td>
                                    <?php
                                    }
                                ?>
                                    <td align="center" valign="middle"><?php echo $row['home_subject_code'] ?></td>
                                    <td align="center"><?php echo $row['home_subject_credits'] ?></td>
                                    <td align="center"><?php echo $row['home_subject_title'] ?></td>
                                    <td align="center"><?php echo $row['foreign_subject_credits'] ?></td>
                                    <td align="center"><?php echo $row['foreign_subject_title'] ?></td>
                                    <td align="center"><?php if($forAll==true) {
                                                                echo "alle";
                                                                }else{ ?>
                                                                <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="top" data-content="<?php echo $validcoursesname;?>">hier klicken</button><?php } ?></td>
                                    <td align="center"><?php echo $row['status'] ?></td>
                                    <td align="center"><?php echo $row['updated_at'] ?></td>
                                </tr>

                                <?php
                            }?>
                            </tbody>
                        </table>
                    </div>

                    <!-- save -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" name="save">Speichern</button>
                    </div>
                </form>


                <?php
                    }
                ?>
            </div>
            <div class="tab-pane fade<?php if($activeUni == 2) echo" show active"?>" id="pills-second" role="tabpanel"
                aria-labelledby="pills-second-tab">
                <?php 
                    if(isset($second_uni_id) && !empty($second_uni_id)){     
                        ?>
                <!-- foreign university name -->
                <!-- <div class="uni-title">
                            <?php //if(isset($second_uni_title)) echo $second_uni_title;?>
                        </div> -->

                <!-- print table button -->
                <div class="text-right">
                    <button type="button" class="btn btn-success" id="second_auswahl"
                        name="printSecond">Ausdrucken</button>
                </div>

                <!-- radio button -->
                <div class="radio-group">
                    <div class="form-check form-check-inline">
                        <input name="degree2" class="form-check-input" type="checkbox" id="degree2" value="degree"
                            checked>
                        <label class="form-check-label" for="inlineCheckbox1">Bachelor</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="master2" class="form-check-input" type="checkbox" id="master2" value="master"
                            checked>
                        <label class="form-check-label" for="inlineCheckbox2">Master</label>
                    </div>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $applicationid."&uni=2";?>"
                    method="post">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm" id="courses2">
                            <thead>
                                <tr style="background-color: #003D76; color: white;">
                                    <th scope="col" width="8%" align="center">Auswahl</th>
                                    <th scope="col" width="15%" align="center">Kurs-Nr. Heim-Uni</th>
                                    <th scope="col" width="11%" align="center">Credits Heim-Uni</th>
                                    <th scope="col" width="25%" align="center">Kurs Heim-Uni</th>
                                    <th scope="col" width="11%" align="center">Credits Partner-Uni</th>
                                    <th scope="col" width="25%" align="center">Kurs Partner-Uni</th>
                                    <th scope="col" width="5%" align="center">Status</th>
                                    <th scope="col" width="5%" align="center">Zuletzt Aktualisiert</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
		                    /*Query previously selected equivalence-courses' id of the user*/
		                    $statement = $pdo->prepare("SELECT equivalence_id FROM applied_equivalence
		                    							WHERE application_id = $applicationid");
		                    $result = $statement->execute();
		                    $selectedCourses = array();
		                    while($selectedCourse = $statement->fetch())
		                    {
		                    	array_push($selectedCourses, $selectedCourse['equivalence_id']);
		                    }
                        
                            // select equivalences that dont have specific courses, then union with equivalence that valid for this course
                            $statement = $pdo->prepare("SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status,
                            s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                            ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at 
                            FROM equivalent_subjects es
                            LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                            LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                            LEFT JOIN status st ON st.status_id = es.status_id
                            WHERE s1.university_id = $home_university AND s2.university_id = $second_uni_id AND 
                            NOT EXISTS (SELECT * FROM equivalence_course ec WHERE ec.equivalence_id = es.equivalence_id) 
                            UNION ALL
                            SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status,
                            s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                            ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at 
                            FROM equivalence_course ec 
                            LEFT JOIN equivalent_subjects es ON es.equivalence_id = ec.equivalence_id
                            LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                            LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                            LEFT JOIN status st ON st.status_id = es.status_id
                            WHERE s1.university_id = $home_university AND s2.university_id = $second_uni_id AND ec.course_id = $home_course
                            ORDER BY status_id, equivalence_id");

		                    $result = $statement->execute();
                        
		                    while($row = $statement->fetch()) {
                                
                                $statement = $pdo->prepare("SELECT * FROM equivalence_course WHERE equivalence_id = ");
    
                                $result = $statement->execute();
                                
                                
                                
                                
                                ?>



                                <tr id="<?php echo $row['valid_degree_id']; ?>"
                                    class="<?php if($row['status_id'] == "1") echo "table-warning"; else if($row['status_id'] == "2") echo "table-success"; else if($row['status_id'] == "3") echo "table-danger";?>">
                                    <!--check previously selected equivalence-courses and disable declined courses-->
                                    <?php
		                    		if(!$readonly){
		                    			?><td align="center"
                                        id="<?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "checked"?>">
                                        <input type="checkbox" name="kurse[]"
                                            value="<?php echo $row['equivalence_id'] ?>"
                                            <?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "checked" ; if($row['status_id'] == "3") echo "disabled"; ?>>
                                    </td>
                                    <?php
		                    		}else{
		                    			?>
                                    <!-- <td align="center"><i <?php // if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "class='glyphicon glyphicon-ok'" ?>></i></td> -->
                                    <td align="center">
                                        <?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "selected" ?>
                                    </td>
                                    <?php
		                    		}
		                    	?>
                                    <td align="center" valign="middle"><?php echo $row['home_subject_code'] ?></td>
                                    <td align="center"><?php echo $row['home_subject_credits'] ?></td>
                                    <td align="center"><?php echo $row['home_subject_title'] ?></td>
                                    <td align="center"><?php echo $row['foreign_subject_credits'] ?></td>
                                    <td align="center"><?php echo $row['foreign_subject_title'] ?></td>
                                    <td align="center"><?php echo $row['status'] ?></td>
                                    <td align="center"><?php echo $row['updated_at'] ?></td>
                                </tr>

                                <?php
                            }?>
                            </tbody>
                        </table>
                    </div>

                    <!-- save -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" name="save">Speichern</button>
                    </div>
                </form>


                <?php
                    }
                ?>
            </div>
            <div class="tab-pane fade<?php if($activeUni == 3) echo" show active"?>" id="pills-third" role="tabpanel"
                aria-labelledby="pills-third-tab">
                <?php 
                    if(isset($third_uni_id) && !empty($third_uni_id)){     
                        ?>
                <!-- foreign university name -->
                <!-- <div class="uni-title">
                            <?php //if(isset($third_uni_title)) echo $third_uni_title;?>
                        </div> -->

                <!-- print table button -->
                <div class="text-right">
                    <button type="button" class="btn btn-success" id="third_auswahl"
                        name="printThird">Ausdrucken</button>
                </div>

                <!-- radio button -->
                <div class="radio-group">
                    <div class="form-check form-check-inline">
                        <input name="degree3" class="form-check-input" type="checkbox" id="degree3" value="degree"
                            checked>
                        <label class="form-check-label" for="inlineCheckbox1">Bachelor</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="master3" class="form-check-input" type="checkbox" id="master3" value="master"
                            checked>
                        <label class="form-check-label" for="inlineCheckbox2">Master</label>
                    </div>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $applicationid."&uni=3";?>"
                    method="post">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm" id="courses2">
                            <thead>
                                <tr style="background-color: #003D76; color: white;">
                                    <th scope="col" width="8%" align="center">Auswahl</th>
                                    <th scope="col" width="15%" align="center">Kurs-Nr. Heim-Uni</th>
                                    <th scope="col" width="11%" align="center">Credits Heim-Uni</th>
                                    <th scope="col" width="25%" align="center">Kurs Heim-Uni</th>
                                    <th scope="col" width="11%" align="center">Credits Partner-Uni</th>
                                    <th scope="col" width="25%" align="center">Kurs Partner-Uni</th>
                                    <th scope="col" width="25%" align="center">Gültig Für</th>
                                    <th scope="col" width="5%" align="center">Status</th>
                                    <th scope="col" width="5%" align="center">Zuletzt Aktualisiert</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
		                    /*Query previously selected equivalence-courses' id of the user*/
		                    $statement = $pdo->prepare("SELECT equivalence_id FROM applied_equivalence
		                    							WHERE application_id = $applicationid");
		                    $result = $statement->execute();
		                    $selectedCourses = array();
		                    while($selectedCourse = $statement->fetch())
		                    {
		                    	array_push($selectedCourses, $selectedCourse['equivalence_id']);
		                    }
                        
                    
                            // select equivalences that dont have specific courses, then union with equivalence that valid for this course
                            $statement = $pdo->prepare("SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status,
                            s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                            ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at 
                            FROM equivalent_subjects es
                            LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                            LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                            LEFT JOIN status st ON st.status_id = es.status_id
                            WHERE s1.university_id = $home_university AND s2.university_id = $third_uni_id AND 
                            NOT EXISTS (SELECT * FROM equivalence_course ec WHERE ec.equivalence_id = es.equivalence_id) 
                            UNION ALL
                            SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status,
                            s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                            ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at 
                            FROM equivalence_course ec 
                            LEFT JOIN equivalent_subjects es ON es.equivalence_id = ec.equivalence_id
                            LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                            LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                            LEFT JOIN status st ON st.status_id = es.status_id
                            WHERE s1.university_id = $home_university AND s2.university_id = $third_uni_id AND ec.course_id = $home_course
                            ORDER BY status_id, equivalence_id");

                            //get all equivalence
                            $statement = $pdo->prepare("SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status,
                            s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                            ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at 
                            FROM equivalent_subjects es
                            LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                            LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                            LEFT JOIN status st ON st.status_id = es.status_id
                            WHERE s1.university_id = $home_university AND s2.university_id = $third_uni_id");

		                    $result = $statement->execute();
                        
		                    while($row = $statement->fetch()) {

                                //check course validity
                                $statement1 = $pdo->prepare("SELECT cs.course_id, cs.name FROM equivalence_course ec 
                                LEFT JOIN course cs ON cs.course_id = ec.course_id 
                                WHERE ec.equivalence_id = :id");

                                $result1 = $statement1->execute(array('id'=>$row['equivalence_id']));
                                $validcourses = array();
                                $validcoursesids = array();
                                while($row1 = $statement1->fetch()){
                                    array_push($validcourses, $row1['name']);
                                    array_push($validcoursesids, $row1['course_id']);
                                }
                                if(count($validcourses) == 0){
                                    $forAll = true;
                                }else{
                                    $forAll = false;
                                    $validcoursesname = implode(",", $validcourses); //convert array to string

                                    // equivalence is not for all courses, check if it is valid for user's home course
                                    if(in_array($home_course, $validcoursesids)){
                                        $available = true;        
                                    }else{
                                        $available = false;
                                    }
                                }

                                
                                
                                ?>

                                <tr id="<?php echo $row['valid_degree_id']; ?>" 
                                    class="<?php if($forAll==false && $available==false) echo "table-secondary"; else if($row['status_id'] == "1") echo "table-warning"; else if($row['status_id'] == "2") echo "table-success"; else if($row['status_id'] == "3") echo "table-danger";?>">
                                    <!--check previously selected equivalence-courses and disable declined courses-->
                                    <?php
		                    		if(!$readonly){
		                    			?><td align="center"
                                        id="<?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "checked"?>">
                                        <input type="checkbox" name="kurse[]"
                                            value="<?php echo $row['equivalence_id'] ?>"
                                            <?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "checked" ; if($row['status_id'] == "3" || ($forAll == false && $available == false)) echo "disabled"; ?>>
                                    </td>
                                    <?php
		                    		}else{
		                    			?>
                                    <!-- <td align="center"><i <?php // if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "class='glyphicon glyphicon-ok'" ?>></i></td> -->
                                    <td align="center">
                                        <?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "selected" ?>
                                    </td>
                                    <?php
		                    		}
		                    	?>
                                    <td align="center" valign="middle"><?php echo $row['home_subject_code'] ?></td>
                                    <td align="center"><?php echo $row['home_subject_credits'] ?></td>
                                    <td align="center"><?php echo $row['home_subject_title'] ?></td>
                                    <td align="center"><?php echo $row['foreign_subject_credits'] ?></td>
                                    <td align="center"><?php echo $row['foreign_subject_title'] ?></td>
                                    <td align="center"><?php if($forAll==true) {
                                                                echo "alle";
                                                                }else{ ?>
                                                                <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="top" data-content="<?php echo $validcoursesname;?>">hier klicken</button><?php } ?></td>
                                    <td align="center"><?php echo $row['status'] ?></td>
                                    <td align="center"><?php echo $row['updated_at'] ?></td>
                                </tr>

                                <?php
                            }?>
                            </tbody>
                        </table>
                    </div>

                    <!-- save -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" name="save">Speichern</button>
                    </div>
                </form>


                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    $("#degree1").click(function() {
        var rows = $('#courses1 tr');

        if ($("#degree1").prop("checked") == true) {
            rows.filter('#1').show();
        } else {
            rows.filter('#1').hide();
        }
    });

    $("#master1").click(function() {
        var rows = $('#courses1 tr');

        if ($("#master1").prop("checked") == true) {
            rows.filter('#2').show();
        } else {
            rows.filter('#2').hide();
        }
    });

    $("#degree2").click(function() {
        var rows = $('#courses2 tr');

        if ($("#degree2").prop("checked") == true) {
            rows.filter('#1').show();
        } else {
            rows.filter('#1').hide();
        }
    });

    $("#master2").click(function() {
        var rows = $('#courses2 tr');

        if ($("#master2").prop("checked") == true) {
            rows.filter('#2').show();
        } else {
            rows.filter('#2').hide();
        }
    });

    $("#degree3").click(function() {
        var rows = $('#courses3 tr');

        if ($("#degree3").prop("checked") == true) {
            rows.filter('#1').show();
        } else {
            rows.filter('#1').hide();
        }
    });

    $("#master3").click(function() {
        var rows = $('#courses3 tr');

        if ($("#master3").prop("checked") == true) {
            rows.filter('#2').show();
        } else {
            rows.filter('#2').hide();
        }
    });

    $("#mycourse1").click(function() {
        var rows = $('#courses1 tr');

        if ($("#mycourse1").prop("checked") == true) {
            rows.filter('#2').show();
        } else {
            rows.filter('#2').hide();
        }
    });
});
</script>

<!-- get matno -->
<?php 
	echo "<div class=\"$home_matno\" id=\"matno\"></div>";
	echo "<div class=\"$lastname\" id=\"surname\"></div>";
	echo "<div class=\"$firstname\" id=\"firstname\"></div>";
	echo "<div class=\"$home_university_title\" id=\"homeUni\"></div>";
	echo "<div class=\"$first_uni_title\" id=\"firstUni\"></div>";
	echo "<div class=\"$second_uni_title\" id=\"secondUni\"></div>";
	echo "<div class=\"$third_uni_title\" id=\"thirdUni\"></div>";
?>

<!-- print list -->
<script>
$(document).ready(function() {
    $("#print").click(function() {
        var index = $("#print").attr('name');
        var table = "#courses" + index;

        var foreignUni = "";

        if (index == 1) {
            foreignUni = $("#firstUni").attr('class');
        } else if (index == 2) {
            foreignUni = $("#secondUni").attr('class');
        } else if (index == 3) {
            foreignUni = $("#thirdUni").attr('class');
        }

        var homeUni = $("#homeUni").attr('class');
        var matno = $("#matno").attr('class');
        var surname = $("#surname").attr('class');
        var firstname = $("#firstname").attr('class');

        var doc = new jsPDF('l', 'mm', 'a4');
        var totalPagesExp = '{total_pages_count_string}';
        var img = new Image();
        img.src = 'screenshots/UDE-Logo.jpeg';

        var pageHeight = doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
        var pageWidth = doc.internal.pageSize.width || doc.internal.pageSize.getWidth();

        var d = new Date();
        var date = d.getDate() + "." + (d.getMonth() + 1) + "." + d.getFullYear();

        doc.autoTable({
            html: table,
            didDrawCell: function(data) {
                if (data.cell.raw.id == "checked") {
                    doc.text("selected", data.cell.x + 2, data.cell.y + 5);
                }
            },
            didDrawPage: function(data) {
                // Header
                doc.setFontSize(20);
                doc.setFontStyle('normal');
                doc.addImage(img, 'JPEG', pageWidth - data.settings.margin.right - 36, 15,
                    36, 14);
                doc.text('Fächerwahlliste', pageWidth / 2, 30, 'center');
                doc.setFontSize(10);
                doc.text('Matriculationnummer: ' + matno.toString(), data.settings.margin
                    .left, 20, 'left');
                doc.text('Nachname: ' + surname, data.settings.margin.left, 25, 'left');
                doc.text('Vorname: ' + firstname, data.settings.margin.left, 30, 'left');
                doc.text('Home-Uni: ' + homeUni + '	     Foreign-Uni: ' + foreignUni,
                    pageWidth / 2, 40, 'center');


                // Footer
                var str = 'Page ' + doc.internal.getNumberOfPages();
                // Total page number plugin only available in jspdf v1.0+
                if (typeof doc.putTotalPages === 'function') {
                    str = str + ' of ' + totalPagesExp;
                }
                doc.setFontSize(10);

                // jsPDF 1.4+ uses getWidth, <1.4 uses .width
                var pageSize = doc.internal.pageSize;
                var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
                doc.text(str, pageWidth - data.settings.margin.right - 20, pageHeight - 10,
                    'left');
                doc.text(date, data.settings.margin.left, pageHeight - 10);
            },
            margin: {
                top: 50
            },
        });

        // Total page number plugin only available in jspdf v1.0+
        if (typeof doc.putTotalPages === 'function') {
            doc.putTotalPages(totalPagesExp);
        }

        doc.save(homeUni + '_' + foreignUni + '_Fächerwahlliste_' + date + '.pdf');
    });
});
</script>

<?php 
    include("templates/footer.inc.php");
?>
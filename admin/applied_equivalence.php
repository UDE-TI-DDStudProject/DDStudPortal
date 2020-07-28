<?php 
    session_start();
    require_once("../inc/config.inc.php");
    require_once("../inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_admin();

    if(empty($user)){
        header("location: login.php");
        exit;
    }

        // admin home university = UDE
        $home_university = 4; 


     //set server location
     $file_server = "../uploads";

    //after filter change
    if(isset($_GET['save_filter'])){
        $error = false;
        $auslandssemester = $_GET['auslandssemester'];
        $foreignuni = $_GET['foreignuni'];
        $abschluss = $_GET['abschluss'];

        if(empty($auslandssemester) || empty($foreignuni) || empty($abschluss)){
            $error = true;
            $error_msg = "Bitte alle Felder auswählen!";
        }

        if(!$error){
            $show_table = true;
        }else{
            $show_table = false;
        }
    }

    //upon save
    if(isset($_POST['save_list'])){
        $error = false;
        $auslandssemester = $_GET['auslandssemester'];
        $foreignuni = $_GET['foreignuni'];
        $abschluss = $_GET['abschluss'];

        if(empty($auslandssemester) || empty($foreignuni) || empty($abschluss)){
            $error = true;
            $error_msg = "Bitte alle Felder auswählen!";
        }

        if(!empty($_POST['student_equivalence_status']) && !$error) {
			/*Begin transaction*/
			try {

				$pdo->beginTransaction();

				foreach ($_POST['student_equivalence'] as $equivalence_id => $application_id){

                    if(isset($_POST['student_equivalence_status'][$equivalence_id.$application_id])){

                        $equivalence_status = $_POST['student_equivalence_status'][$equivalence_id.$application_id];

                        $statement = $pdo->prepare("UPDATE applied_equivalence SET application_status_id = $equivalence_status WHERE application_id =:application_id AND equivalence_id = :equivalence_id");
                        $result = $statement->execute(array('application_id'=>$application_id, 'equivalence_id'=>$equivalence_id));
                    }
                }
                
				$pdo->commit();
				$success_msg = 'Liste gespeichert';

			}catch (Exception $e){
				$pdo->rollback();
                throw $e;
                $error = true;
				$error_msg = $e->get_message();
			}
        }
    }

?>

<?php     
    include("templates/headerlogin.inc.php");  
?>

<main class="container-fluid flex-fill">
    <div class="card application-form">

        <!-- title row -->
        <div class="title-row" style="display: flex; justify-content: space-between;">
            <!-- page title -->
            <div class="page-title">
                <span><img src="../screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Fächerwahlliste des Auslandssemesters
            </div>

            <div class="title-button">
                <form action="index.php" method="post">
                    <div class="text-right">
                        <button type="submit" class="btn btn-outline-secondary btn-sm" name="logout"> Zurück zum Dashboard</button>
                    </div>
                </form>
            </div>
        </div>

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

        <!-- filter option for Bewerbungszeitraum, Bachelor-Master, Foreign University -->
        <form id="filter-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
          <div class="form-row">
          <div class="form-group row col-auto">
          <label for="Auslandssemester" class="col-auto col-form-label col-form-label-sm">*Auslandssemester:</label>
            <div class="col-auto">
              <select class="form-control form-control-sm" placeholder="Auslandssemester" name="auslandssemester">
              <option></option>
              <?php 
 				    $statement = $pdo->prepare("SELECT * FROM exchange_period");
                    $result = $statement->execute();
                    while($period = $statement->fetch()) { ?>
                        <option value="<?php echo $period['period_id'];?>"  
                        <?php if(isset($auslandssemester) && $auslandssemester == $period['period_id']) echo "selected" ?>>
                        <?php echo ($period['exchange_semester']);?></option>
                     <?php
                        }
                    ?>
              </select>
            </div>
            </div>
            <div class="form-group row col-auto">
            <label for="foreignuni" class="col-auto col-form-label col-form-label-sm">*Partner-Universität:</label>
            <div class="col-auto">
              <select class="form-control form-control-sm" placeholder="Partner-Universität" name="foreignuni">
              <option></option>
                <?php 
							$statement = $pdo->prepare("SELECT * FROM university where university_id in (2,3,5)");
							$result = $statement->execute();
							while($row = $statement->fetch()) { ?>
                <option value="<?php echo ($row['university_id']);?>"
                <?php if(isset($foreignuni) && $foreignuni == $row['university_id']) echo "selected" ?>>
                <?php echo ($row['name']);?></option>
                <?php } ?>
              </select>
            </div>
            </div>
            <div class="form-group row col-auto">
            <label for="abschluss" class="col-auto col-form-label col-form-label-sm">Abschluss:</label>
            <div class="col-auto">
              <select class="form-control form-control-sm" placeholder="Abschluss" name="abschluss">
              <option></option>
              <?php 
					$statement = $pdo->prepare("SELECT * FROM degree where name is not null");
	    			$result = $statement->execute();
	    			while($row = $statement->fetch()) { ?>
                    <option value="<?php echo ($row['degree_id']);?>"
                    <?php if(isset($abschluss) && $abschluss == $row['degree_id']) echo "selected" ?>>
                    <?php echo ($row['name']);?></option>
                <?php } ?>
              </select>
            </div>
            </div>
            <div class="form-group row col-auto">
            <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-sm" name="save_filter" value="filterchanges" >Suchen</button>
            </div>
            </div>
          </div>
        </form>

        <!-- equivalence-table-form -->
        <?php if(isset($show_table)&& $show_table==true): ?>

            <!-- checkbox button -->
            <div class="form-check form-check-inline">
                <input name="applied_only" class="form-check-input form-control-sm" type="checkbox" id="applied_only" value="applied_only">
                <label class="form-check-label" for="applied_only" style="font-size:16px;">Nur ausgewählte Äquivalenz zeigen</label>
            </div>

        <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
            
        <div class="table-responsive">
                <table class="table table-hover table-sm" id="equivalence_list" style="text-align:center;font-size:14px;">
                    <thead>
                        <tr style="background-color: #003D76; color: white;">
                            <th scope="col" width="8%" align="center">Siehe Bewerbungen</th>
                            <th scope="col" width="8%" align="center">Anzahl Kursplätzen</th>
                            <th scope="col" width="8%" align="center">Anzahl Bewerbungen</th>
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

                            //get all equivalence
                            $statement = $pdo->prepare("SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status,
                            s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                            ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at ,
                            (SELECT COUNT(distinct(ex.exchange_id)) FROM applied_equivalence ae  
                                                    LEFT JOIN application ap on ap.application_id = ae.application_id 
                                                    LEFT JOIN exchange ex on ex.application_id = ap.application_id
                                                    LEFT JOIN study_home sh on sh.application_id = ap.application_id 
                                                    WHERE ap.exchange_period_id = $auslandssemester AND ae.equivalence_id = es.equivalence_id AND sh.home_degree_id = $abschluss AND ex.exchange_id IS NOT NULL) as applied_count,
                            (SELECT quota FROM equivalence_quota eq WHERE eq.equivalence_id = es.equivalence_id and eq.exchange_period_id = $auslandssemester) as max_count 
                            FROM equivalent_subjects es
                            LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                            LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                            LEFT JOIN status st ON st.status_id = es.status_id
                            WHERE s1.university_id = $home_university AND s2.university_id = $foreignuni 
                            ORDER BY  st.name ASC, s1.subject_title ASC");
                        
                            $result = $statement->execute();
                    
                    while($equivalence = $statement->fetch()) {

                        //check course validity
                        $statement1 = $pdo->prepare("SELECT cs.course_id, cs.name FROM equivalence_course ec 
                        LEFT JOIN course cs ON cs.course_id = ec.course_id 
                        WHERE ec.equivalence_id = :id");
                    
                        $result1 = $statement1->execute(array('id'=>$equivalence['equivalence_id']));
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
                        }


                        ?>
                    
                            <tr id="<?php if($equivalence['applied_count'] > 0) echo "1"; else echo "0"; ?>" 
                                class="<?php if(!empty($equivalence['max_count']) && ($equivalence['max_count'] < $equivalence['applied_count'])) echo "table-warning"?>" >
                                <td align="center">
                                    <a class="expand-btn" data-toggle="collapse" href="#row<?php echo $equivalence['equivalence_id']?>" role="button" aria-expanded="<?php if($equivalence['applied_count']==0) echo "false"; else echo "true"?>" aria-controls="row<?php echo $equivalence['equivalence_id']?>">
                                        <i class="fa fa-<?php if($equivalence['applied_count']==0) echo "plus"; else echo "minus"?>-circle" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td align="center"><?php echo $equivalence['max_count'] ?></td>
                                <td align="center"><?php echo $equivalence['applied_count'] ?></td>
                                <td align="center"><?php echo $equivalence['home_subject_code'] ?></td>
                                <td align="center"><?php echo $equivalence['home_subject_credits'] ?></td>
                                <td align="center"><?php echo $equivalence['home_subject_title'] ?></td>
                                <td align="center"><?php echo $equivalence['foreign_subject_credits'] ?></td>
                                <td align="center"><?php echo $equivalence['foreign_subject_title'] ?></td>
                                <td align="center"><?php if($forAll) echo "alle"; else if(isset($validcoursesname))echo $validcoursesname ?></td>
                                <td align="center"><?php echo $equivalence['status'] ?></td>
                                <td align="center"><?php echo $equivalence['updated_at'] ?></td>
                            </tr>

                            <?php 
                                //if at least one student applied for the equivalence, then create a row, in that row create a table to show all students that applied for this equivalence
                                if($equivalence['applied_count']>0):?>
                                    <script>console.log("yay")</script>
                                    
                                    <tr>
                                        <td colspan="11"  class="collapse multi-collapse<?php if($equivalence['applied_count']>0) echo " show"?>" id="row<?php echo $equivalence['equivalence_id']?>">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-sm" id="student_equivalence" style="text-align:center;font-size:14px;">
                                                    <thead>
                                                        <tr style="background-color: #0076e1; color: white;">
                                                            <th scope="col" width="5%" align="center">annehmen</th>
                                                            <th scope="col" width="5%" align="center">ablehnen</th>
                                                            <th scope="col" width="10%" align="center">Matrikulationnummer</th>
                                                            <th scope="col" width="15%" align="center">Studiengang</th>
                                                            <th scope="col" width="10%" align="center">Fachsemester</th>
                                                            <th scope="col" width="10%" align="center">Erfolgsfaktor</th>
                                                            <th scope="col" width="10%" align="center">Dokumente</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php
                                                        //get all approved students that applied this equivalence
                                                        $statement3 = $pdo->prepare("SELECT ae.equivalence_id, ae.application_status_id, us.firstname,us.lastname, ap.application_id, sh.home_matno, cr.name as home_course, sh.home_semester, ap.success_factor, uni1.name as uni1  
                                                        FROM applied_equivalence ae 
                                                        LEFT JOIN exchange ex on ex.application_id = ae.application_id 
                                                        LEFT JOIN exchange_equivalence eq on eq.exchange_id = ex.exchange_id and eq.equivalence_id = ae.equivalence_id 
                                                        LEFT JOIN application ap on ap.application_id = ae.application_id 
                                                        LEFT JOIN student st on st.student_id = ap.student_id 
                                                        LEFT JOIN user us on us.user_id = st.user_id 
                                                        LEFT JOIN study_home sh on sh.application_id = ap.application_id 
                                                        LEFT JOIN course cr on cr.course_id = sh.home_course_id 
                                                        LEFT JOIN priority pr on pr.application_id = ap.application_id 
                                                        LEFT JOIN university uni1 on uni1.university_id = pr.first_uni_id 
                                                        WHERE  ap.exchange_period_id = $auslandssemester and sh.home_degree_id = $abschluss and ae.equivalence_id = :id and ex.exchange_id IS NOT NULL 
                                                        ORDER BY ap.success_factor DESC");

                                                        $result3 = $statement3->execute(array('id'=>$equivalence['equivalence_id']));

                                                        // how many application per period should be approved
                                                        $max_count = $equivalence['max_count'];
                                                        $count = 0;

                                                        while($student = $statement3->fetch()){
                                                            $studentname= $student["firstname"];
                                                            echo "<script>console.log(\"$studentname\")</script>"; 
                                                            $count += 1;
                                                        
                                                            if(empty($max_count)){
                                                                $suggested = true;
                                                            }else{
                                                                if($count <= $max_count){
                                                                    $suggested = true;
                                                                }else{
                                                                    $suggested = false;
                                                                }
                                                            }

                                                            //get 3 chars of first name
        
                                                            $home_matno = $student["home_matno"];
                                                            $first_uni = $student["uni1"];
                                                        
                                                            //check uploaded document
	                                                        if(is_dir("$file_server/".$first_uni ."/".$home_matno."/Fächerwahlliste")) {
                                                                $F_files = glob( "$file_server/".$first_uni."/".$home_matno."/Fächerwahlliste"."/". '*', GLOB_MARK);
                                                                if(!empty($F_files) && file_exists($F_files[0])){
                                                                  $F_name[$row["application_id"]] = basename($F_files[0]);
                                                                }
                                                            }
                                                            if(is_dir("$file_server/".$first_uni ."/".$home_matno."/Motivationsschreiben")) {
                                                              $M_files = glob( "$file_server/".$first_uni."/".$home_matno."/Motivationsschreiben"."/". '*', GLOB_MARK);
                                                              if(!empty($M_files) && file_exists($M_files[0])){
                                                                $M_name[$row["application_id"]] = basename($M_files[0]);
                                                              }
                                                            }
                                                            if(is_dir("$file_server/".$first_uni ."/".$home_matno."/Lebenslauf")) {
                                                              $L_files = glob( "$file_server/".$first_uni."/".$home_matno."/Lebenslauf"."/". '*', GLOB_MARK);
                                                              if(!empty($L_files) && file_exists($L_files[0])){
                                                                $L_name[$row["application_id"]] = basename($L_files[0]);
                                                              }
                                                            }
                                                            if(is_dir("$file_server/".$first_uni ."/".$home_matno."/Transkript")) {
                                                              $T_files = glob( "$file_server/".$first_uni."/".$home_matno."/Transkript"."/". '*', GLOB_MARK);
                                                              if(!empty($T_files) && file_exists($T_files[0])){
                                                                $T_name[$row["application_id"]] = basename($T_files[0]);
                                                              }
                                                            }
                                                            
                                                            ?>

                                                            <input type="hidden" name="student_equivalence[<?php echo $equivalence['equivalence_id'] ?>]" value="<?php echo $student['application_id']?>">


                                                            <tr class="<?php if(!empty($student) && $student['application_status_id'] == 2) echo "table-success"; else if(!empty($student) && $student['application_status_id'] == 3) echo "table-danger"; else if($suggested) echo "table-info"; else echo "table-secondary"?>">
                                                                <td align="center">
                                                                    <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio" name="student_equivalence_status[<?php echo $equivalence['equivalence_id'].$student['application_id'] ?>]" id="2" value="2" <?php if(!empty($student) && $student['application_status_id'] == 2) echo "checked" ?>>
                                                                    </div>
                                                                </td>
                                                                <td align="center">
                                                                    <div class="form-check form-check-inline">
                                                                      <input class="form-check-input" type="radio" name="student_equivalence_status[<?php echo  $equivalence['equivalence_id'].$student['application_id'] ?>]" id="3" value="3" <?php if(!empty($student) && $student['application_status_id'] == 3) echo "checked" ?>>
                                                                    </div>
                                                                </td>
                                                                <td align="center"><?php echo $student['home_matno'] ?></td>
                                                                <td align="center"><?php echo $student['home_course'] ?></td>
                                                                <td align="center"><?php echo $student['home_semester'] ?></td>
                                                                <td align="center"><?php echo $student['success_factor'] ?></td>
                                                                <td align="center">
                                                                    <?php if(isset($T_name)): ?><a  target="_blank" rel="noopener noreferrer"  href="<?php echo $T_files[0]; ?>">Transkript</a><br><?php endif;?>
                                                                    <?php if(isset($L_name)): ?><a  target="_blank" rel="noopener noreferrer"  href="<?php echo $L_files[0]; ?>">Lebenslauf</a><br><?php endif;?>
                                                                    <?php if(isset($M_name)): ?><a  target="_blank" rel="noopener noreferrer"  href="<?php echo $M_files[0]; ?>">Motivationsschreiben</a><?php endif;?>
                                                                </td>
                                                            </tr>

                                                        <?php
                                                        }?>  
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>    

                        <?php
                    }?>
                    </tbody>
                </table>
            </div>

            <!-- save -->
            <div class="text-right">
                <button type="submit" class="btn btn-primary" name="save_list" value="save_list" >Speichern</button>
            </div>
        </form>
        <?php endif; ?>

    </div>
</main>



<!-- change row color upon checked -->
<script>
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var radioValue = $(this).val();
        // approved
        if(radioValue == "2"){
            var parent_tr = $(this).closest('tr'); //find innermost parent
            $(parent_tr).removeClass(); //clear class
            $(parent_tr).addClass("table-success"); //change row color

            //denied
        }else if(radioValue == "3"){
            var parent_tr = $(this).closest('tr'); //find innermost parent
            $(parent_tr).removeClass(); //clear class
            $(parent_tr).addClass("table-danger"); //change row color
        }
    });
});
</script>

<!-- show/hide rows upon checkbox checked/unchecked -->
<script>
$(document).ready(function(){

    $("#applied_only").click(function() {
        var rows = $('#equivalence_list tr');

        if ($("#applied_only").prop("checked") == true) {
            rows.filter('#0').hide();
        } else {
            rows.filter('#0').show();
        }
    });
});
</script>


<!--change button icon upon clicked-->
<script>
$(document).ready(function(){

    $(".expand-btn").click(function() {
         $(this).children(":first").toggleClass("fa-plus-circle fa-minus-circle");
    });
});
</script>

<?php 
    include("templates/footer.inc.php");
?>
<?php 
    session_start();
    require_once("../inc/config.inc.php");
    require_once("../inc/functions.inc.php");

    //redirect user to homepage if the user has not already login
    $user = check_admin();

    if(empty($user)){
        header("location: login.php");
        exit;
    }

    // admin home university = UDE
    $home_university = 4; 


    //after filter change
    if(isset($_GET['save_filter'])){
        $error = false;
        $foreignuni = $_GET['foreignuni'];
        $abschluss = $_GET['abschluss'];

        if( empty($foreignuni) ){
            $error = true;
            $error_msg = "Bitte Partner-Universität auswählen!";
        }

        if(!$error){
            $show_table = true;
        }else{
            $show_table = false;
        }
    }

    //upon remove equivalence
    if(isset($_POST['remove_equivalence'])){
        $remove_equivalence_id = $_POST['remove_equivalence'];

        	/*Begin transaction*/
			try {

				$pdo->beginTransaction();

                $statement = $pdo->prepare("DELETE FROM equivalent_subjects WHERE equivalence_id =:id ");
                $result = $statement->execute(array('id'=>$remove_equivalence_id));
                
				$pdo->commit();
				$success_msg = 'Äquivalenz ist gelöscht.';

			}catch (Exception $e){
				$pdo->rollback();
                throw $e;
                $error = true;
				$error_msg = $e->get_message();
			}
    }

    //upon save list
    if(isset($_POST['save_list'])){
        $error = false;
        $home_university = $_GET['homeuni'];
        $foreignuni = $_GET['foreignuni'];
        $abschluss = $_GET['abschluss'];

        if( empty($foreignuni) || empty($home_university) ){
            $error = true;
            $error_msg = "Bitte Universitäten auswählen!";
        }

        if(!empty($_POST['status']) && !$error) {
			/*Begin transaction*/
			try {

				$pdo->beginTransaction();

				foreach ($_POST['status'] as $equivalence_id => $status_id){

                    if(isset($status_id)){

                        $statement = $pdo->prepare("UPDATE equivalent_subjects SET status_id = $status_id WHERE equivalence_id =:id");
                        $result = $statement->execute(array('id'=>$equivalence_id));
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

<!-- upon save valid course -->
<?php 
    if(isset($_POST['save_course'])){
        //get equivalence_id
        $equivalence_id = $_POST['save_course'];

        //remove all valid course of this equivalence in database
        $statementD = $pdo->prepare("DELETE FROM equivalence_course WHERE equivalence_id = :id");
        $resultD = $statementD->execute(array('id' => $equivalence_id)); 

        foreach($_POST['equivalence_course'][$equivalence_id] as $course => $course_id){

            //add valid course into database 
            $statementS = $pdo->prepare("INSERT INTO equivalence_course(equivalence_id, course_id) VALUES(:eid, :cid)");
            $resultS = $statementS->execute(array('eid' => $equivalence_id, "cid"=>$course_id));     
        }
    }
?>

<!-- add new equivalence -->
<?php 
        if(isset($_POST['add_equivalence'])){

            //get home subject and foreign subject from drop down list
            if(isset($_POST['home_subject_id'])){
                $home_subject_id = $_POST['home_subject_id'];
            }
            if(isset($_POST['foreign_subject_id'])){
                $foreign_subject_id = $_POST['foreign_subject_id'];
            }

            //check checkbox home_subject
            if(isset($_POST['new_subject_home']) && !empty($_POST['new_subject_home'])){
                //check if all fields are filled
                if(!empty($_POST['courseNo_home']) && !empty($_POST['course_name_home']) && !empty($_POST['credit_home']) && !empty($_POST['degree_home'])){
                    //check if subject exists in database
                    $statementS = $pdo->prepare("SELECT * FROM subject WHERE subject_code = :subject_code");
                    $resultS = $statementS->execute(array('subject_code' => $_POST['courseNo_home']));            
                    $home_subject = $statementS->fetch();
                    $home_subject_id = $home_subject['subject_id'];

                    if(empty($home_subject)){
                        // trim credits
                        $home_credit = str_replace(',', '.' ,trim($_POST['credit_home']));

                        //insert home subject
                        $statement = $pdo->prepare("INSERT INTO subject(subject_code, subject_title, degree_id, subject_credits, university_id) VALUES (:subject_code, :subject_title, :degree_id, :subject_credits, :university_id)");
                        $result = $statement->execute(array('subject_code' => $_POST['courseNo_home'], 'subject_title' => $_POST['course_name_home'], 'subject_credits' => $home_credit, 'degree_id' => $_POST['degree_home'], 'university_id'=>$home_university));         
                        
                        //get inserted subject in database
                        $statementS = $pdo->prepare("SELECT * FROM subject WHERE subject_code = :subject_code");
                        $resultS = $statementS->execute(array('subject_code' => $_POST['courseNo_home']));            
                        $home_subject = $statementS->fetch();
                        $home_subject_id = $home_subject['subject_id'];
                    }
                }else{
                    //show error msg if not all fields are filled
                    $error_msg = "Bitte alle Felder ausfüllen!";
                }
            }

            //check checkbox foreign_subject
            if(isset($_POST['new_subject_foreign']) && !empty($_POST['new_subject_foreign'])){
                //check if all fields are filled
                if(!empty($_POST['courseNo_foreign']) && !empty($_POST['course_name_foreign']) && !empty($_POST['credit_foreign']) && !empty($_POST['degree_foreign'])){
                    //check if subject exists in database
                    $statementS = $pdo->prepare("SELECT * FROM subject WHERE subject_code = :subject_code");
                    $resultS = $statementS->execute(array('subject_code' => $_POST['courseNo_foreign']));            
                    $foreign_subject = $statementS->fetch();
                    $foreign_subject_id = $foreign_subject['subject_id'];
        
                    if(empty($foreign_subject)){
                        // trim credits
                        $foreign_credit = str_replace(',', '.' ,trim($_POST['credit_foreign']));

                        //insert foreign subject
                        $statement = $pdo->prepare("INSERT INTO subject(subject_code, subject_title, degree_id, subject_credits, university_id) VALUES (:subject_code, :subject_title, :degree_id, :subject_credits, :university_id)");
                        $result = $statement->execute(array('subject_code' => $_POST['courseNo_foreign'], 'subject_title' => $_POST['course_name_foreign'], 'subject_credits' => $foreign_credit, 'degree_id' => $_POST['degree_foreign'], 'university_id'=>$foreignuni));         
                        
                        //get inserted subject in database
                        $statementS = $pdo->prepare("SELECT * FROM subject WHERE subject_code = :subject_code");
                        $resultS = $statementS->execute(array('subject_code' => $_POST['courseNo_foreign']));            
                        $foreign_subject = $statementS->fetch();
                        $foreign_subject_id = $foreign_subject['subject_id'];
                    }
                }else{
                    //show error msg if not all fields are filled
                    $error_msg = "Bitte alle Felder ausfüllen!";
                }
            }

            //check if home_subject and foreign_subject are not empty, then insert euqivalence into database
            if(!empty($home_subject_id) && !empty($foreign_subject_id)){
                //check if equivalence exists in database
                $statementS = $pdo->prepare("SELECT * FROM equivalent_subjects WHERE home_subject_id = :home_id and foreign_subject_id = :foreign_id");
                $resultS = $statementS->execute(array('home_id' => $home_subject_id, 'foreign_id' => $foreign_subject_id));            
                $equivalence = $statementS->fetch();

                if(empty($equivalence)){
                    //check status and abschluss
                    if(isset($_POST["valid_degree"])){
                        $valid_degree_id = $_POST["valid_degree"];
                    }
                    if(isset($_POST["status"]) ){
                        $status = $_POST["status"];
                    }
                    if(isset($_POST["valid_degree"]) && isset($_POST["status"]) && !empty($_POST["valid_degree"] && !empty($_POST["status"]))){

                        //insert equivalence 
                        $statement = $pdo->prepare("INSERT INTO equivalent_subjects(home_subject_id, foreign_subject_id, status_id, valid_degree_id) VALUES (:home_subject_id, :foreign_subject_id, :status_id, :degree_id)");
                        $result = $statement->execute(array('home_subject_id' => $home_subject_id, 'foreign_subject_id' => $foreign_subject_id, 'status_id'=> $_POST["status"], 'degree_id'=>$_POST["valid_degree"]));    
                        
                        //check if equivalence exists in database
                        $statementS = $pdo->prepare("SELECT * FROM equivalent_subjects WHERE home_subject_id = :home_id and foreign_subject_id = :foreign_id");
                        $resultS = $statementS->execute(array('home_id' => $home_subject_id, 'foreign_id' => $foreign_subject_id));            
                        $equivalence = $statementS->fetch();

                        //check if equivalence is successfully added to database
                        if(!empty($equivalence)){
                            //show success msg if equivalence already added to database
                            $success_msg = "Äquivalenz ist erfolgreich hinzugefügt!";
                        }else{
                            //show error msg if equivalence already not added to database
                            $error_msg = "Beim Speichern des Äquivalenz ist ein Fehler aufgetreten. Bitte neu versuchen!";
                        }
                    }else{
                        //show error msg if abschluss and valid degree is not selected
                        $error_msg = "Bitte Abschluss und Status auswählen!";
                    }
                
                
                }else{
                    //show error msg if equivalence already exists in database
                    $error_msg = "Äquivalenz existiert schon in der Datenbank!";
                }
            }
            else{
                //show error msg if not all fields are filled
                $error_msg = "Bitte Heim-Kurs und Kus Partner-Uni auswählen!";
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
                <span><img src="../screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Fächerwahlliste der Partner-Universität
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

        <!-- filter option for Heim-Uni, Foreign University -->
        <form id="filter-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
        <div class="form-row">
            <div class="form-group row col-auto">
            <label for="homeuni" class="col-auto col-form-label col-form-label-sm">*Heim-Universität:</label>
            <div class="col-auto">
              <select class="form-control form-control-sm"  name="homeuni">
                <?php 
							$statement = $pdo->prepare("SELECT * FROM university");
							$result = $statement->execute();
							while($row = $statement->fetch()) { ?>
                <option value="<?php echo ($row['university_id']);?>"
                <?php if(isset($home_university) && $home_university == $row['university_id']) echo "selected" ?>>
                <?php echo ($row['name']);?></option>
                <?php } ?>
              </select>
            </div>
            </div>
            <div class="form-group row col-auto">
            <label for="foreignuni" class="col-auto col-form-label col-form-label-sm">*Partner-Universität:</label>
            <div class="col-auto">
              <select class="form-control form-control-sm"  name="foreignuni">
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
              <option>alle</option>
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

        <?php require("component/add_new_equivalence.php"); ?>

        <div class="list-filter">
            <!-- checkbox button -->
            <!-- <div class="form-check form-check-inline">
                <input name="degree" class="form-check-input" type="checkbox" id="degree" value="degree"
                    checked>
                <label class="form-check-label" for="inlineCheckbox1">Bachelor</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="master" class="form-check-input" type="checkbox" id="master" value="master"
                    checked>
                <label class="form-check-label" for="inlineCheckbox2">Master</label>
            </div> -->
        </div>

        <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="equivalence-form">
            
        <div class="table-responsive">
                <table class="table table-hover table-sm" id="equivalence_list" style="text-align:center;font-size:14px;">
                    <thead>
                        <tr style="background-color: #003D76; color: white;">
                            <th scope="col" width="5%" align="center"></th>
                            <th scope="col" width="5%" align="center">Kurs-Nr. Heim-Uni</th>
                            <th scope="col" width="5%" align="center">Credits Heim-Uni</th>
                            <th scope="col" width="20%" align="center">Kurs Heim-Uni</th>
                            <th scope="col" width="5%" align="center">Credits Partner-Uni</th>
                            <th scope="col" width="20%" align="center">Kurs Partner-Uni</th>
                            <th scope="col" width="5%" align="center">Abschluss</th>
                            <th scope="col" width="25%" align="center">Gültig Für</th>
                            <th scope="col" width=30%" align="center">Status</th>
                            <th scope="col" width="5%" align="center">Zuletzt Aktualisiert</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php

                            //get all equivalence of this partner-uni
                            $statement = $pdo->prepare("SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status, dg.name as degree, 
                            s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                            ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at 
                            FROM equivalent_subjects es
                            LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                            LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                            LEFT JOIN status st ON st.status_id = es.status_id
                            LEFT JOIN degree dg on dg.degree_id = es.valid_degree_id 
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
                        $validcoursesnames = array();
                        $validcoursesids = array();
                        while($row1 = $statement1->fetch()){
                            array_push($validcourses, $row1);
                            array_push($validcoursesids, $row1['course_id']);
                            array_push($validcoursesnames, $row1['name']);
                        }
                        if(count($validcoursesnames) == 0){
                            $forAll = true;
                        }else{
                            $forAll = false;
                            $validcoursesnames_string = implode(",", $validcoursesnames); //convert array to string
                        }


                        ?>
                    
                            <tr id="<?php echo $equivalence['valid_degree_id']?>">
                                <td align="center">
                                <button type="submit" class="btn btn-outline-warning btn-sm" name="remove_equivalence" value="<?php echo $equivalence['equivalence_id']?>"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </td>
                                <td align="center"><?php echo $equivalence['home_subject_code'] ?></td>
                                <td align="center"><?php echo $equivalence['home_subject_credits'] ?></td>
                                <td align="center"><?php echo $equivalence['home_subject_title'] ?></td>
                                <td align="center"><?php echo $equivalence['foreign_subject_credits'] ?></td>
                                <td align="center"><?php echo $equivalence['foreign_subject_title'] ?></td>
                                <td align="center"><?php echo $equivalence['degree'] ?></td>
                                <td align="center">
                                <?php if($forAll) echo "alle"; else if(isset($validcoursesnames_string)) echo $validcoursesnames_string; ?>
                                <!-- <span><i class="fa fa-pencil" aria-hidden="true"></i></span> -->
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-valid-courses-<?php echo $equivalence['equivalence_id']?>">
                                   edit
                                </button>
                                <?php require("component/edit_valid_course.php") ?>
                                </td>
                                <td align="center">
                                    <select class="form-control form-control-sm"  name="status[<?php echo $equivalence['equivalence_id']?>]">
                                    <?php 
			                        		$statement2 = $pdo->prepare("SELECT * FROM status");
	    	                        		$result2 = $statement2->execute();
	    	                        		while($row = $statement2->fetch()) { ?>
                                          <option value="<?php echo ($row['status_id']);?>"
                                          <?php if(isset($equivalence['status_id']) && $equivalence['status_id'] == $row['status_id']) echo "selected" ?>>
                                          <?php echo ($row['name']);?></option>
                                      <?php } ?>
                                    </select>
                                </td>
                                <td align="center"><?php echo $equivalence['updated_at'] ?></td>
                            </tr>

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

<!-- show/hide row upon checkbox changed -->
<script>
$(document).ready(function(){

    $("#degree").click(function() {
        var rows = $('#equivalence_list tr');

        if ($("#degree").prop("checked") == true) {
            rows.filter('#1').show();
        } else {
            rows.filter('#1').hide();
        }
    });

    $("#master").click(function() {
        var rows = $('#equivalence_list tr');

        if ($("#master").prop("checked") == true) {
            rows.filter('#2').show();
        } else {
            rows.filter('#2').hide();
        }
    });
});
</script>

<!-- ask for confirmation upon deleting equivalence -->
<script>
$(document).ready(function(){
    $("#equivalence-form").submit(function(e){

        var btn_name = e.originalEvent.submitter.name;

        if(btn_name=="remove_equivalence"){
            if(!confirm("Äquivalenz löschen?")){
                e.preventDefault();
            }
        }

    });
});
</script>

<?php 
    include("templates/footer.inc.php");
?>
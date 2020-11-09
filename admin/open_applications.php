<?php 
    session_start();
    require_once("../inc/config.inc.php");
    require_once("../inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_admin();

    // admin home university = UDE
    $home_university = 4; 

    if(empty($user)){
        header("location: login.php");
        exit;
    }

    //set server location
    $file_server = "../uploads";

    //after filter change
    if(isset($_GET['save_filter'])){
        $error = false;
        $auslandssemester = $_GET['auslandssemester'];
        $foreignuni = $_GET['foreignuni'];
        $abschluss = $_GET['abschluss'];

        if(empty($auslandssemester)){
            $error = true;
            $error_msg = "Bitte Auslandssemester auswählen!";
        }

        if(!$error){
            $show_table = true;
        }else{
            $show_table = false;
        }
    }

    //upon save
    if(isset($_POST['subtmitbtn']) && $_POST['subtmitbtn'] == "save_list"){
        $error = false;
        $auslandssemester = $_GET['auslandssemester'];
        $foreignuni = $_GET['foreignuni'];
        $abschluss = $_GET['abschluss'];

        if(empty($auslandssemester)){
            $error = true;
            $error_msg = "Bitte Auslandssemester auswählen!";
        }

        if(!empty($_POST['reviewed']) && !$error) {
			/*Begin transaction*/
			try {

				$pdo->beginTransaction();

				foreach ($_POST['reviewed'] as $application_id => $application_status){
                    if(isset($_POST['reviewed']) && !empty($_POST['reviewed'])){
                        if(isset($application_status) && !empty($application_status)){

                            $statement = $pdo->prepare("SELECT * FROM reviewed_application WHERE application_id =:id");
                            $result = $statement->execute(array('id'=>$application_id));
                            $application = $statement->fetch();
                        
                            if(empty($application)){
                                if(empty($_POST['comment'][$application_id])){
                                    $statement1 = $pdo->prepare("INSERT INTO reviewed_application(application_id, application_status_id, reviewed_by_user_id) VALUES(:application_id, :application_status_id, :reviewed_by_user_id)");
                                }else{
                                    $comment = $_POST['comment'][$application_id];
                                    $statement1 = $pdo->prepare("INSERT INTO reviewed_application(application_id, application_status_id, reviewed_by_user_id, comment) VALUES(:application_id, :application_status_id, :reviewed_by_user_id, '$comment')");
                                }
                            }else{
                                if(empty($_POST['comment'][$application_id])){
                                    $statement1 = $pdo->prepare("UPDATE reviewed_application set application_status_id = :application_status_id, reviewed_by_user_id = :reviewed_by_user_id WHERE application_id =:application_id");
                                }else{
                                    $comment = $_POST['comment'][$application_id];
                                    $statement1 = $pdo->prepare("UPDATE reviewed_application set application_status_id = :application_status_id, reviewed_by_user_id = :reviewed_by_user_id, comment = '$comment' WHERE application_id =:application_id");
                                }
                            }    
                            $result1 = $statement1->execute(array('application_id'=>$application_id, 'application_status_id'=>$application_status, 'reviewed_by_user_id'=>$user['user_id']));
                        }
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

    if(isset($_POST['subtmitbtn']) && $_POST['subtmitbtn'] == "finalize"){
        
        //finalize reviewed applicatin to exchange list
        $error = false;
        $auslandssemester = $_GET['auslandssemester'];
        $foreignuni = $_GET['foreignuni'];
        $abschluss = $_GET['abschluss'];

        if(empty($auslandssemester)){
            $error = true;
            $error_msg = "Bitte Auslandssemester auswählen!";
        }

        //save result first
        if(!empty($_POST['reviewed']) && !$error) {
			/*Begin transaction*/
			try {

				$pdo->beginTransaction();

				foreach ($_POST['reviewed'] as $application_id => $application_status){
                    if(isset($_POST['reviewed']) && !empty($_POST['reviewed'])){
                        if(isset($application_status) && !empty($application_status)){

                            //set all applied_equivalence of this application to null
                            $statement1 = $pdo->prepare("UPDATE applied_equivalence ae 
                                                            SET ae.application_status_id = NULL 
                                                            WHERE ae.application_id = :id");
                            $result1 = $statement1->execute(array('id'=>$application_id));

                            //check if application already added to reviewed_application
                            $statement = $pdo->prepare("SELECT * FROM reviewed_application WHERE application_id =:id");
                            $result = $statement->execute(array('id'=>$application_id));
                            $application = $statement->fetch();
                        
                            if(empty($application)){
                                if(empty($_POST['comment'][$application_id])){
                                    $statement1 = $pdo->prepare("INSERT INTO reviewed_application(application_id, application_status_id, reviewed_by_user_id) VALUES(:application_id, :application_status_id, :reviewed_by_user_id)");
                                }else{
                                    $comment = $_POST['comment'][$application_id];
                                    $statement1 = $pdo->prepare("INSERT INTO reviewed_application(application_id, application_status_id, reviewed_by_user_id, comment) VALUES(:application_id, :application_status_id, :reviewed_by_user_id, '$comment')");
                                }
                            }else{
                                if(empty($_POST['comment'][$application_id])){
                                    $statement1 = $pdo->prepare("UPDATE reviewed_application set application_status_id = :application_status_id, reviewed_by_user_id = :reviewed_by_user_id WHERE application_id =:application_id");
                                }else{
                                    $comment = $_POST['comment'][$application_id];
                                    $statement1 = $pdo->prepare("UPDATE reviewed_application set application_status_id = :application_status_id, reviewed_by_user_id = :reviewed_by_user_id, comment = '$comment' WHERE application_id =:application_id");
                                }
                            }    
                            $result1 = $statement1->execute(array('application_id'=>$application_id, 'application_status_id'=>$application_status, 'reviewed_by_user_id'=>$user['user_id']));

                            //check if application is added to exchange
                            $statement = $pdo->prepare("SELECT ap.application_id, ex.exchange_id, pr.first_uni_id  FROM application ap
                                                        LEFT JOIN priority pr ON pr.application_id = ap.application_id 
                                                        LEFT JOIN exchange ex ON ex.application_id = ap.application_id 
                                                        WHERE ap.application_id =:id");
                            $result = $statement->execute(array('id'=>$application_id));
                            $exchange = $statement->fetch();

                            if($application_status==2){
                                //if application is approved but havnt added to exchange, add to exchange
                                if(empty($exchange['exchange_id'])){
                                    $statement = $pdo->prepare("INSERT INTO exchange(application_id, foreign_uni_id) VALUES(:application_id, :foreign_uni_id)");
                                    $result = $statement->execute(array('application_id'=>$exchange['application_id'],'foreign_uni_id'=>$exchange['first_uni_id']));
                                }
                            }else{
                                //if application is denied or not reviewed but was in exchange, remove from exchange
                                if(!empty($exchange['exchange_id'])){
                                    $statement = $pdo->prepare("DELETE FROM exchange WHERE exchange_id = :id");
                                    $result = $statement->execute(array('id'=>$exchange['exchange_id']));
                                }
                            }
                        }

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

        // add to exchange_equivalenz
        if(!$error){
                
            /*Begin transaction*/
			try {

                $pdo->beginTransaction();
                
                //get exchange applications order by success_factor
                $statement = $pdo->prepare("SELECT ex.exchange_id, ex.application_id, ap.success_factor FROM exchange ex
                                            LEFT JOIN application ap ON ap.application_id = ex.application_id 
                                            ORDER BY ap.success_factor DESC");
                $result = $statement->execute();

                while($exchange = $statement->fetch()){

                    //get applied equivalences of this exchange  
                    $statement1 = $pdo->prepare("SELECT * FROM applied_equivalence ae 
                                                    LEFT JOIN exchange ex ON ex.application_id = ae.application_id 
                                                    WHERE ex.exchange_id = :id");
                    $result1 = $statement1->execute(array('id'=>$exchange['exchange_id']));

                    while($equivalence = $statement1->fetch()){

                        //get max_count of equivalence
                        $statement2 = $pdo->prepare("SELECT quota FROM equivalence_quota 
                                                    WHERE equivalence_id = :id and exchange_period_id = :eid");
                        $result2 = $statement2->execute(array('id'=>$equivalence['equivalence_id'], 'eid'=>$auslandssemester));
                        $max_count_row = $statement->fetch();

                        if(empty($max_count_row) || empty($max_count_row['quota'])){
                            //change applied_equivalence status
                            $statement4 = $pdo->prepare("UPDATE applied_equivalence SET application_status_id = 2 
                                                        WHERE application_id = :id AND equivalence_id = :eid ");
                            $result4 = $statement4->execute(array('eid'=>$equivalence['equivalence_id'], 'id'=>$exchange['application_id']));

                            //insert applied equivalence into exchange_equivalence
                            $statement4 = $pdo->prepare("INSERT INTO exchange_equivalence(exchange_id, equivalence_id) 
                                                            VALUES(:id, :eid) ");
                            $result4 = $statement4->execute(array('eid'=>$equivalence['equivalence_id'], 'id'=>$exchange['exchange_id']));
                        
                        }else{
                        
                            //get current_count of equivalence
                            $statement3 = $pdo->prepare("SELECT COUNT(exchange_id) as current_count  FROM exchange_equivalence  
                                                        WHERE equivalence_id = :id 
                                                        GROUP BY equivalence_id ");
                            $result3 = $statement3->execute(array('id'=>$equivalence['equivalence_id']));
                            $current_count_row = $statement->fetch();

                            if($current_count_row['current_count'] < $max_count_row['quota']){
                                //change applied_equivalence status
                                $statement4 = $pdo->prepare("UPDATE applied_equivalence SET application_status_id = 2 
                                                                WHERE application_id = :id AND equivalence_id = :eid ");
                                $result4 = $statement4->execute(array('eid'=>$equivalence['equivalence_id'], 'id'=>$exchange['application_id']));

                                //insert applied equivalence into exchange_equivalence
                                $statement4 = $pdo->prepare("INSERT INTO exchange_equivalence(exchange_id, equivalence_id) 
                                                                VALUES(:id, :eid) ");
                                $result4 = $statement4->execute(array('eid'=>$equivalence['equivalence_id'], 'id'=>$exchange['exchange_id']));
                            }else{
                                 //change applied_equivalence status
                                 $statement4 = $pdo->prepare("UPDATE applied_equivalence SET application_status_id = 3 
                                                                WHERE application_id = :id AND equivalence_id = :eid ");
                                 $result4 = $statement4->execute(array('eid'=>$equivalence['equivalence_id'], 'id'=>$exchange['application_id']));
                            }

                        }
                    }
                }


                $pdo->commit();
                $success_msg = 'Die abgenommen Bewerbungen sind im Auslandssemester gespeichert.';
        
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
                <span><img src="../screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Offene Bewerbungen
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
            <label for="foreignuni" class="col-auto col-form-label col-form-label-sm">Partner-Universität:</label>
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

        <!-- application-table-form -->
        <?php if(isset($show_table)&& $show_table==true): ?>
        <form id="applications-table-form" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">

       <div class="form-group row">
            <label for="search" class="col-auto col-form-label col-form-label-sm">Bewerbung suchen</label>
            <div class="col-sm-5">
                <input type="search" name="searchKey" class="form-control form-control-sm"
                   id="inputSearch" placeholder="Name oder Matrikelnummer" value="<?php if(isset($search)) echo $search?>">
            </div>
            </div>

        <div class="table-responsive">
                <table class="table table-hover table-sm" id="application-table" style="text-align:center;font-size:16px;">
                    <thead>
                        <tr id="columnHeader" style="background-color: #003D76; color: white;">
                            <th scope="col" width="5%" align="center">Annehmen</th>
                            <th scope="col" width="5%" align="center">Ablehnen</th>
                            <th scope="col" width="30%" align="center">Kommentar</th>
                            <th scope="col" width="5%" align="center">Bewerbung vollständig</th>
                            <th scope="col" width="10%" align="center">Name</th>
                            <th scope="col" width="10%" align="center">Vorname</th>
                            <th scope="col" width="10%" align="center">Mat.-Nr.</th>
                            <th scope="col" width="15%" align="center">Studiengang</th>
                            <th scope="col" width="5%" align="center">Fachsemester</th>
                            <th scope="col" width="5%" align="center">Erfolgsfaktor</th>
                            <th scope="col" width="5%" align="center">Credits</th>
                            <th scope="col" width="5%" align="center">Noten</th>
                            <th scope="col" width="5%" align="center">Austausch-Abschluss</th>
                            <th scope="col" width="10%" align="center">1. Priorität</th>
                            <th scope="col" width="10%" align="center">2. Priorität</th>
                            <th scope="col" width="10%" align="center">3. Priorität</th>
                            <th scope="col" width="15%" align="center">Dokumente</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php

                    //get filter string
                    $abschluss_filter = $foreignuni_filter = "";

                    if(!empty($abschluss)){
                        $abschluss_filter = " AND ap.applied_degree_id = $abschluss";
                    }

                    if(!empty($foreignuni)){
                        $foreignuni_filter = " AND pr.first_uni_id = $foreignuni";
                    }

                    //get all completed applications where user still has a valid accounts
                    $statement = $pdo->prepare("SELECT us.firstname,us.lastname, ap.application_id, sh.home_matno, cr.name as home_course, sh.home_semester, ROUND(ap.success_factor,3) as success_factor, 
                                                uni1.abbreviation as uni1, uni2.abbreviation as uni2, uni3.abbreviation as uni3 , ra.comment, 
                                                ROUND(sh.home_cgpa,1) as home_cgpa, ROUND(sh.home_credits) as home_credits, ep.period_id, dg.name as applied_degree , uni1.name as firstuni , ap.completed,
                                                us.firstname, us.lastname 
                                                FROM application ap 
                                                LEFT JOIN exchange_period ep on ep.period_id = ap.exchange_period_id 
                                                LEFT JOIN reviewed_application ra on ra.application_id = ap.application_id 
                                                LEFT JOIN student st on st.student_id = ap.student_id 
                                                LEFT JOIN user us on us.user_id = st.user_id 
                                                LEFT JOIN study_home sh on sh.application_id = ap.application_id 
                                                LEFT JOIN priority pr on pr.application_id = ap.application_id 
                                                LEFT JOIN university uni1 on uni1.university_id = pr.first_uni_id 
                                                LEFT JOIN university uni2 on uni2.university_id = pr.second_uni_id 
                                                LEFT JOIN university uni3 on uni3.university_id = pr.third_uni_id 
                                                LEFT JOIN course cr on cr.course_id = sh.home_course_id 
                                                LEFT JOIN degree dg on dg.degree_id = ap.applied_degree_id 
                                                WHERE us.user_id IS NOT NULL AND 
                                                ap.exchange_period_id = $auslandssemester $abschluss_filter $foreignuni_filter
                                                ORDER BY ap.completed DESC, ap.success_factor DESC");
                
                    $result = $statement->execute();

                    while($row = $statement->fetch()) {

                        $statement1 = $pdo->prepare("SELECT min_success_factor FROM exchange_period WHERE period_id = :id");
                        $result1 = $statement1->execute(array(":id"=>$row['period_id']));
                        $requirement = $statement1->fetch();

                        if($row['success_factor'] >= $requirement['min_success_factor']){
                            $suggested = true;
                        }else{
                            $suggested = false;
                        }

                        $statement1 = $pdo->prepare("SELECT * FROM reviewed_application WHERE application_id = :id");
                        $result1 = $statement1->execute(array(":id"=>$row['application_id']));
                        $reviewed = $statement1->fetch();

                        $home_matno = $row["home_matno"];
                        $first_uni = $row["firstuni"];
                    
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
                    

                        <tr id="childrenRows" class="<?php if(!empty($reviewed) && $reviewed['application_status_id'] == 2) echo "table-success"; else if(!empty($reviewed) && $reviewed['application_status_id'] == 3) echo "table-danger";else if($row['completed']==0) echo "table-secondary"; else if($suggested) echo "table-info"; else echo "table-warning"?>">

                            <td align="center">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="reviewed[<?php echo $row['application_id'] ?>]" id="2" value="2" <?php if(!empty($reviewed) && $reviewed['application_status_id'] == 2) echo "checked" ?>>
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="reviewed[<?php echo $row['application_id'] ?>]" id="3" value="3" <?php if(!empty($reviewed) && $reviewed['application_status_id'] == 3) echo "checked" ?>>
                                </div>
                            </td>
                            <td align="center"><textarea class="form-control form-control-sm" cols="30" rows="2" name="comment[<?php echo $row['application_id']?>]" id="comment" ><?php if(isset($row['comment'])) echo $row['comment'];?></textarea></td>
                            <td align="center"><?php if($row['completed']==1) echo "Ja"; else echo "Nein"; ?></td>
                            <td align="center" id="lastname"><?php echo $row['lastname'] ?></td>
                            <td align="center" id="firstname"><?php echo $row['firstname'] ?></td>
                            <td align="center" id="matno"><?php echo $row['home_matno'] ?></td>
                            <td align="center"><?php echo $row['home_course'] ?></td>
                            <td align="center"><?php echo $row['home_semester'] ?></td>
                            <td align="center"><?php echo $row['success_factor'] ?></td>
                            <td align="center"><?php echo $row['home_credits'] ?></td>
                            <td align="center"><?php echo $row['home_cgpa'] ?></td>
                            <td align="center"><?php echo $row['applied_degree'] ?></td>
                            <td align="center"><?php echo $row['uni1'] ?></td>
                            <td align="center"><?php echo $row['uni2'] ?></td>
                            <td align="center"><?php echo $row['uni3'] ?></td>
                            <td align="center">
                                <?php if(isset($T_name[$row["application_id"]] )): ?><a  target="_blank" rel="noopener noreferrer"  href="<?php echo $T_files[0]; ?>">Transkript</a><br><?php endif;?>
                                <?php if(isset($L_name[$row["application_id"]] )): ?><a  target="_blank" rel="noopener noreferrer"  href="<?php echo $L_files[0]; ?>">Lebenslauf</a><br><?php endif;?>
                                <?php if(isset($M_name[$row["application_id"]] )): ?><a  target="_blank" rel="noopener noreferrer"  href="<?php echo $M_files[0]; ?>">Motivationsschreiben</a><?php endif;?>
                            </td>

                        </tr>

                        <?php
                    }?>
                    </tbody>
                </table>
            </div>

            <!-- save -->
            <div class="text-right">
                <button type="submit" class="btn btn-primary" name="subtmitbtn" value="save_list" >Zwischenstand speichern</button>
                <button type="submit" class="btn btn-success" name="subtmitbtn" value="finalize" >Ergebnisse veröffentlichen</button>
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

<!-- search keyword change-->
<script>
$(document).ready(function(){

    $("#inputSearch").on('input',function(){

        if($(this).val()){
            var keyword  = $(this).val().toLowerCase();

            $('#application-table #childrenRows').each(function() { 
                var firstname = $(this).find('#firstname').text().toLowerCase();
                var lastname = $(this).find('#lastname').text().toLowerCase();
                var matno = $(this).find('#matno').text().toLowerCase();

                if(firstname.indexOf(keyword) >= 0 || lastname.indexOf(keyword) >= 0|| matno.indexOf(keyword) >= 0){
                    $(this).show();
                }else{

                    $(this).hide();
                }
            });

        }else{
            $('#application-table #childrenRows').show();
        }

    });
});
</script>

<!-- ask for confirmation upon finalizing -->
<script>
$(document).ready(function(){
    $("#applications-table-form").submit(function(e){
        if(!confirm("Weiter?")){
            e.preventDefault();
        }
    });
});
</script>


<?php 
    include("templates/footer.inc.php");
?>
<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_admin();

    // admin home university = UDE
    $home_university = 4; 

    if(!isset($user)){
        header("location: admin_login.php");
        exit;
    }

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
                <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Fächerwahlliste des Auslandssemesters
            </div>

            <div class="title-button">
                <form action="admin_home.php" method="post">
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
        <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
            
        <div class="table-responsive">
                <table class="table table-hover table-sm" id="equivalence_quota" style="text-align:center;font-size:16px;">
                    <thead>
                        <tr style="background-color: #003D76; color: white;">
                            <th scope="col" width="5%" align="center">annehmen</th>
                            <th scope="col" width="5%" align="center">ablehnen</th>
                            <th scope="col" width="50%" align="center">Hinweis</th>
                            <th scope="col" width="10%" align="center">Matrikulationnummer</th>
                            <th scope="col" width="15%" align="center">Studiengang</th>
                            <th scope="col" width="10%" align="center">Fachsemester</th>
                            <th scope="col" width="10%" align="center">Erfolgsfaktor</th>
                            <th scope="col" width="20%" align="center">1. Priorität</th>
                            <th scope="col" width="20%" align="center">2. Priorität</th>
                            <th scope="col" width="20%" align="center">3. Priorität</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php


                    //get all filtered equivalence
                    $statement = $pdo->prepare("SELECT ap.application_id, sh.home_matno, cr.name as home_course, sh.home_semester, ap.success_factor, uni1.name as uni1, uni2.name as uni2, uni3.name as uni3 , ra.comment 
                                                FROM application ap 
                                                LEFT JOIN exchange_period ep on ep.period_id = ap.exchange_period_id 
                                                LEFT JOIN reviewed_application ra on ra.application_id = ap.application_id 
                                                LEFT JOIN student st on st.student_id = ap.student_id 
                                                LEFT JOIN study_home sh on sh.application_id = ap.application_id 
                                                LEFT JOIN priority pr on pr.application_id = ap.application_id 
                                                LEFT JOIN university uni1 on uni1.university_id = pr.first_uni_id 
                                                LEFT JOIN university uni2 on uni2.university_id = pr.second_uni_id 
                                                LEFT JOIN university uni3 on uni3.university_id = pr.third_uni_id 
                                                LEFT JOIN course cr on cr.course_id = sh.home_course_id 
                                                WHERE ap.exchange_period_id = $auslandssemester and sh.home_degree_id = $abschluss and pr.first_uni_id = $foreignuni 
                                                ORDER BY ap.success_factor DESC");
                
                    $result = $statement->execute();
                    
                    // how many application per period should be approved
                    $max_count = 10;
                    $count = 0;

                    while($row = $statement->fetch()) {

                        $count += 1;

                        if($count <= $max_count){
                            $suggested = true;
                        }else{
                            $suggested = false;
                        }

                        $statement1 = $pdo->prepare("SELECT * FROM reviewed_application WHERE application_id = :id");
                        $result1 = $statement1->execute(array(":id"=>$row['application_id']));
                        $reviewed = $statement1->fetch();
                        ?>
                    

                        <tr class="<?php if(!empty($reviewed) && $reviewed['application_status_id'] == 2) echo "table-success"; else if(!empty($reviewed) && $reviewed['application_status_id'] == 3) echo "table-danger"; else if($suggested) echo "table-info"; else echo "table-secondary"?>">

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
                            <td align="center"><?php echo $row['home_matno'] ?></td>
                            <td align="center"><?php echo $row['home_course'] ?></td>
                            <td align="center"><?php echo $row['home_semester'] ?></td>
                            <td align="center"><?php echo $row['success_factor'] ?></td>
                            <td align="center"><?php echo $row['uni1'] ?></td>
                            <td align="center"><?php echo $row['uni2'] ?></td>
                            <td align="center"><?php echo $row['uni3'] ?></td>
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

<?php 
    include("templates/footer.inc.php");
?>
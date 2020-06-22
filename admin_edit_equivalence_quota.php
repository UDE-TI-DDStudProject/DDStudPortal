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
        $status = $_GET['status'];

        if(empty($auslandssemester) || empty($foreignuni)){
            $error = true;
            $error_msg = "Bitte Auslandssemester und Partner-Universität auswählen!";
        }

        if(!$error){
            $show_table = true;
        }else{
            $show_table = false;
        }
    }

    //upon save
    if(isset($_POST['save_quota'])){
        $error = false;
        $auslandssemester = $_GET['auslandssemester'];
        $foreignuni = $_GET['foreignuni'];
        $abschluss = $_GET['abschluss'];
        $status = $_GET['status'];

        if(empty($auslandssemester) || empty($foreignuni)){
            $error = true;
            $error_msg = "Bitte Auslandssemester und Partner-Universität auswählen!";
        }

        if(!empty($_POST['equivalence']) && !$error) {
			/*Begin transaction*/
			try {

				$pdo->beginTransaction();

				foreach ($_POST['equivalence'] as $equivalence_key => $equivalence_value)
				{
                    $id = $equivalence_key;
                    $quota = $equivalence_value;

                    if(!empty($quota)){
                        $statement = $pdo->prepare("SELECT * FROM equivalence_quota WHERE equivalence_id =:id AND exchange_period_id = :period_id");
                        $result = $statement->execute(array('id'=>$id, 'period_id'=>$auslandssemester));
                        $e_quota = $statement->fetch();
    
                        if(empty($e_quota)){
                            $statement1 = $pdo->prepare("INSERT INTO equivalence_quota(equivalence_id, exchange_period_id, quota) VALUES(:id, :period_id, :quota)");
                        }else{
                            $statement1 = $pdo->prepare("UPDATE equivalence_quota set quota = :quota  WHERE equivalence_id =:id AND exchange_period_id = :period_id");
                        }
    
                        $result1 = $statement1->execute(array('id'=>$id, 'period_id'=>$auslandssemester, 'quota'=>$quota));
                    }
                
				}
				$pdo->commit();
				$success_msg = 'Äquivalenz gespeichert';

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
                <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Äquivalenz-Kursplätze bearbeiten
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
              <option value="0" <?php if(isset($abschluss) && $abschluss == 0) echo "selected" ?>>alle</option>
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
            <label for="abschluss" class="col-auto col-form-label col-form-label-sm">Äquivalenzstatus:</label>
            <div class="col-auto">
              <select class="form-control form-control-sm" placeholder="Status" name="status">
              <option value="0" <?php if(isset($status) && $status == 0) echo "selected" ?>>alle</option>
              <?php 
					$statement = $pdo->prepare("SELECT * FROM status");
	    			$result = $statement->execute();
	    			while($row = $statement->fetch()) { ?>
                    <option value="<?php echo ($row['status_id']);?>"
                    <?php if(isset($status) && $status == $row['status_id']) echo "selected" ?>>
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
                <table class="table table-hover table-sm" id="equivalence_quota" style="text-align:center;">
                    <thead>
                        <tr style="background-color: #003D76; color: white;">
                            <th scope="col" width="8%" align="center">Anzahl eingeben</th>
                            <th scope="col" width="15%" align="center">Kurs-Nr. Heim-Uni</th>
                            <!-- <th scope="col" width="11%" align="center">Credits Heim-Uni</th> -->
                            <th scope="col" width="25%" align="center">Kurs Heim-Uni</th>
                            <!-- <th scope="col" width="11%" align="center">Credits Partner-Uni</th> -->
                            <th scope="col" width="25%" align="center">Kurs Partner-Uni</th>
                            <th scope="col" width="25%" align="center">Gültig Für</th>
                            <th scope="col" width="5%" align="center">Status</th>
                            <!-- <th scope="col" width="5%" align="center">Zuletzt Aktualisiert</th> -->
                        </tr>
                    </thead>

                    <tbody>

                    <?php

                    //check abschluss filter
                    if(isset($abschluss) && $abschluss!=0){
                        $valid_degree = "AND es.valid_degree_id = ".$abschluss;
                    }else{
                        $valid_degree = "";
                    }

                    //check equivalence status filter
                    if(isset($status) && $status!=0){
                        $valid_status = "AND es.status_id = ".$status;
                    }else{
                        $valid_status = "";
                    }

                    //get all filtered equivalence
                    $statement = $pdo->prepare("SELECT es.valid_degree_id, es.equivalence_id as equivalence_id, es.status_id as status_id , st.name as status,
                    s1.subject_code as home_subject_code, ROUND(s1.subject_credits, 1) as home_subject_credits, s1.subject_title as home_subject_title ,
                    ROUND(s2.subject_credits, 1) as foreign_subject_credits, s2.subject_title as foreign_subject_title, case when es.updated_at = '0000-00-00' then '-' else DATE_FORMAT(es.updated_at,'%d/%m/%Y') end as updated_at 
                    FROM equivalent_subjects es
                    LEFT JOIN subject s1 ON s1.subject_id = es.home_subject_id
                    LEFT JOIN subject s2 ON s2.subject_id = es.foreign_subject_id
                    LEFT JOIN status st ON st.status_id = es.status_id
                    WHERE s1.university_id = $home_university AND s2.university_id = $foreignuni $valid_degree $valid_status
                    ORDER BY st.name ASC, s1.subject_title ASC");
                
                    $result = $statement->execute();
                    
                    while($row = $statement->fetch()) {

                        //check valid courses of the equivalence 
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
                        }

                        //get quota of equivalence
                        $statement2 = $pdo->prepare("SELECT quota FROM equivalence_quota 
                        WHERE equivalence_id = :equivalence_id AND exchange_period_id = :period_id");
                        $result2 = $statement2->execute(array('equivalence_id'=>$row['equivalence_id'], 'period_id'=>$auslandssemester));
                        $quota = $statement2->fetch();

                        ?>
                    

                        <tr class="<?php if($row['status_id'] == "1") echo "table-warning"; else if($row['status_id'] == "2") echo "table-success"; else if($row['status_id'] == "3") echo "table-danger"; ?>">
                            <td align="center" valign="middle"><input class="form-control form-control-sm" type="number" name="equivalence[<?php echo $row['equivalence_id']; ?>]" min="0" value="<?php if(isset($quota) && !empty($quota)) echo $quota['quota'];?>" ></td>
                            <td align="center" valign="middle"><?php echo $row['home_subject_code'] ?></td>
                            <td align="center"><?php echo $row['home_subject_title'] ?></td>
                            <td align="center"><?php echo $row['foreign_subject_title'] ?></td>
                            <td align="center"><?php if($forAll) echo "alle"; else if(isset($validcoursesname))echo $validcoursesname ?></td>
                            <td align="center"><?php echo $row['status'] ?></td>
                        </tr>

                        <?php
                    }?>
                    </tbody>
                </table>
            </div>

            <!-- save -->
            <div class="text-right">
                <button type="submit" class="btn btn-primary" name="save_quota" value="quota-table" >Speichern</button>
            </div>
        </form>
        <?php endif; ?>

    </div>
</main>

<!-- ask for confirmation upon filter change -->
<script>
$(document).ready(function(){
    $("#filter-form").submit(function(){
        if(!confirm("Diese Seite wird erneut aktualisieren. Die nicht gespeicherte Daten werden verloren sein. Weiter?")){
            e.preventDefault();
        }
    });
});
</script>


<?php 
    include("templates/footer.inc.php");
?>
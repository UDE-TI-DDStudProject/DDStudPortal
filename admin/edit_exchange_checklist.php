<?php 
    session_start();
    require_once("../inc/config.inc.php");
    require_once("../inc/functions.inc.php");

    //redirect user to login if the user has not login
    $user = check_admin();

    if(empty($user)){
        header("location: login.php");
        exit;
    }

?>

<!-- upon filter change -->
<?php
    if(isset($_GET['save_filter'])){
        $error = false;
        $auslandssemester = $_GET['auslandssemester'];
        $foreignuni = $_GET['foreignuni'];

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
 ?>

<!-- insert new step -->
<?php 
    if(isset($_POST['save_new_step'])){
        $insert_error = false;
        $insert_error_msg = "";

        $stage_id = trim($_POST['exchange_stage']);
        $exchange_step = $_POST['exchange_step'];
        $step_begin = $_POST['step_begin'];
        $step_deadline = $_POST['step_deadline'];

        if(empty($stage_id) || empty($exchange_step) || empty($step_begin) || empty($step_deadline)){
            $insert_error = true;
            $insert_error_msg = "Bitte alle Felder ausfüllen!";
        }

        if(!$insert_error){
            //validate data

            
        }

        if(!$insert_error){
            
            //check if step exists for this auslandssemester in database
            $statement = $pdo->prepare("SELECT step_id FROM exchange_checklist_deadline ecd
                                        LEFT JOIN exchange_checklist ec ON ec.step_id = ecd.step_id 
                                        WHERE ecd.exchange_period_id = :period_id and ec.foreign_uni_id = :uni and step_id = :step");
            $result = $statement->execute(array('period_id' => $auslandssemester, 'uni' => $foreignuni, 'step'=>$exchange_step));            
            $step = $statement->fetch();

            // if empty then insert else update
            if(empty($step)){
                try {
                    //check error in qeuries and throw exception if error found
                    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                    $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
                    $pdo->beginTransaction();
    
                    //insert new step into database
                    $statement = $pdo->prepare("INSERT INTO exchange_checklist_deadline(step_id, exchange_period_id, beginn, deadline)
                                                VALUES(:step_id, :exchange_period_id, :beginn, :deadline)");
                    $result = $statement->execute(array('step_id' => $exchange_step, 'exchange_period_id' => $auslandssemester,'beginn' => $step_begin ,
                                                        'deadline' => $step_deadline)); 
    
                    $success_msg = "To-do ist erfolgreich hinzugefügt.";
    
                }catch (PDOException $e){
                    $pdo->rollback();
                    $insert_error = true;
                    $insert_error_msg = $e->getMessage();
                }
            }else{
                try {
                    //check error in qeuries and throw exception if error found
                    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                    $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
                    $pdo->beginTransaction();
    
                    //update step into database
                    $statement = $pdo->prepare("UPDATE exchange_checklist_deadline SET beginn = :beginn, deadline = :deadline 
                                                WHERE step_id = :step_id and exchange_period_id = :exchange_period_id ");
                    $result = $statement->execute(array('step_id' => $exchange_step, 'exchange_period_id' => $auslandssemester,'beginn' => $step_begin ,
                                                        'deadline' => $step_deadline)); 
    
                    $success_msg = "To-do ist erfolgreich aktualisiert.";
    
                }catch (PDOException $e){
                    $pdo->rollback();
                    $insert_error = true;
                    $insert_error_msg = $e->getMessage();
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

        <!-- title row -->
        <div class="title-row" style="display: flex; justify-content: space-between;">
            <!-- page title -->
            <div class="page-title">
                <span><img src="../screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Auslandssemester bearbeiten
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
            <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-sm" name="save_filter" value="filterchanges" >Suchen</button>
            </div>
            </div>
          </div>
        </form>


        <?php if(isset($show_table) && $show_table==true) : ?>
        <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
            
        <div class="table-responsive">
                <table class="table table-hover table-sm" id="exchange_checklist" style="text-align:center;font-size:16px">
                    <thead>
                        <tr style="background-color: #003D76; color: white;">
                            <th scope="col" width="30%" align="center">Exchange Stage</th>
                            <th scope="col" width="30%" align="center">To-do</th>
                            <th scope="col" width="15%" align="center">Start Date</th>
                            <th scope="col" width="15%" align="center">Deadline</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    <?php
                    //get auslandssemester
                    $statement = $pdo->prepare("SELECT ec.step_id, ec.step_name, es.stage_name, ecd.beginn, ecd.deadline 
                                                FROM exchange_checklist_deadline ecd
                                                LEFT JOIN exchange_checklist ec on ecd.step_id = ec.step_id 
                                                LEFT JOIN exchange_stages es on ec.exchange_stage_id = es.stage_id 
                                                WHERE ( ec.foreign_uni_id = 1 OR ec.foreign_uni_id = :uni) AND ecd.exchange_period_id = :exchange_period 
                                                ORDER BY ecd.beginn ASC, ecd.deadline ASC");
                
                    $result = $statement->execute(array('uni'=>$foreignuni, 'exchange_period'=>$auslandssemester)); 

                    while($period = $statement->fetch()) {

                    ?>

                        <tr>   
                            <td align="center"><?php echo $period['stage_name'] ?></td>
                            <td align="center"><?php echo $period['step_name'] ?></td>
                            <td align="center"><?php echo $period['beginn'] ?></td>
                            <td align="center"><?php echo $period['deadline'] ?></td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- save -->
            <div class="text-right">
                <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add-new-step">Neues To-do hinzufügen</button>
                <button type="submit" class="btn btn-primary" name="save_quota" value="quotachanged" >Speichern</button>
            </div>
        </form>

        <?php endif; ?>

        <!--Pop up Modal to edit valid course list for equivalence -->
        <div class="modal fade" id="add-new-step" tabindex="-1" role="dialog" aria-labelledby="add-new-step" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Neues To-do hinzufügen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <!-- show error message -->
                <?php 
                if(isset($insert_error_msg) && !empty($insert_error_msg)):
                ?>
                <div class="alert alert-danger">
                    <?php echo $insert_error_msg; ?>
                </div>
                <?php 
                endif;
                ?>

                <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="new_step">
                    <div class="form-group">
                        <label for="exchange_stage" class="form-label form-label-sm">Exchange Stage</label>
                        <select class="form-control form-control-sm" name="exchange_stage">
                            <option></option>
                            <?php 
 			                	    $statement = $pdo->prepare("SELECT * FROM exchange_stages");
                                    $result = $statement->execute();
                                    while($stage = $statement->fetch()) { ?>
                                         <option value="<?php echo $stage['stage_id'];?>"  
                                         <?php if(isset($stage_id) && $stage_id == $stage['stage_id']) echo "selected" ?>>
                                        <?php echo ($stage['stage_name']);?></option>
                                 <?php
                                      }
                                  ?>
                        </select>                    
                    </div>
                    <div class="form-group">
                        <label for="exchange_stage" class="form-label form-label-sm">Exchange To-do</label>
                        <select class="form-control form-control-sm" name="exchange_step" >
                            <option></option>
                            <?php 
 			                	    $statement = $pdo->prepare("SELECT * FROM exchange_checklist WHERE foreign_uni_id = :uni");
                                    $result = $statement->execute(array('uni'=>$foreignuni));
                                    while($step = $statement->fetch()) { ?>
                                         <option value="<?php echo $step['step_id'];?>"  id="<?php echo['exchange_stage_id'];?>" 
                                         <?php if(isset($exchange_step) && $exchange_step == $step['step_id']) echo "selected" ?>>
                                        <?php echo ($step['step_name']);?></option>
                                 <?php
                                      }
                                  ?>
                        </select>                    
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="new_step" name="new_step">
                            <label class="form-check-label" for="new_step">
                              Neues To-do 
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exchange_step" class="form-label form-label-sm">Neues To-do</label>
                        <input type="text" name="new_exchange_step"  class="form-control form-control-sm" value="<?php if(isset($new_exchange_step)) echo $new_exchange_step; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="step_valid_all" name="step_valid_all" disabled> 
                            <label class="form-check-label" for="step_valid_all">
                              Gültig für alle Universitäten
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="step_start_date" class="form-label form-label-sm">Start Date</label>
                        <input type="date" name="step_start_date"  class="form-control form-control-sm" value="<?php if(isset($step_begin)) echo $step_begin; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="step_deadline" class="form-label form-label-sm">Deadline</label>
                        <input type="datetime-local" name="step_deadline"  class="form-control form-control-sm" value="<?php if(isset($step_deadline)) echo $step_deadline; ?>" required>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" name="modal-cancel" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                <button type="submit" name="save_step" class="btn btn-primary">Speichern</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</main>


<?php  if(isset($insert_error) && $insert_error==true): ?>
        <script>
            $(document).ready(function(){
                $('#add-new-step').modal('show');
            });
        </script>    
<?php endif;?>

        <!-- change row color upon checked -->
        <script>
        $(document).ready(function(){
            $('input[type="checkbox"]').click(function(){
                var value = $(this).val();

                if(value == "new_step"){
                    if($(this).prop("checked") == true){
                        //disable step select
                        $('select[name="exchange_step"]').attr('disabled', 'disabled');
                        //enable new step input
                        $('input[name="new_exchange_step"]').prop("disabled", false);
                        $('input[name="step_valid_all"]').prop("disabled", false);
                    }else{
                        //enable step select
                        $('select[name="exchange_step"]').removeAttr('disabled');
                        //disable new step input
                        $('input[name="new_exchange_step"]').prop("disabled", 'disabled');
                        $('input[name="step_valid_all"]').prop("disabled", 'disabled');
                    }

                }
            });
        });
        </script>

<?php 
    include("templates/footer.inc.php");
?>
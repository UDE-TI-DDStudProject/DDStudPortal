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

<!-- insert new semester -->
<?php 
    if(isset($_POST['save_new_semester'])){
        $insert_error = false;
        $insert_error_msg = "";

        $semester = trim($_POST['semester']);
        $semesterbegin = $_POST['semesterbegin'];
        $semesterend = $_POST['semesterend'];
        $applicationbegin = $_POST['applicationbegin'];
        $applicationend = $_POST['applicationend'];
        $successfactor = str_replace(',', '.' ,trim($_POST['successfactor']));

        if(empty($semester) || empty($semesterbegin) || empty($semesterend) || empty($applicationbegin) || empty($applicationend) || empty($successfactor) ){
            $insert_error = true;
            $insert_error_msg = "Bitte alle Felder ausfüllen!";
        }

        if(!$insert_error){
            //validate data

            
        }

        if(!$insert_error){
            
            //check if semester name exists in database
            $statement = $pdo->prepare("SELECT exchange_semester FROM exchange_period WHERE exchange_semester = :sem");
            $result = $statement->execute(array('sem' => $semester));            
            $sem = $statement->fetch();

            if(!empty($sem)){
                $insert_error = true;
                $insert_error_msg .= "Bitte verwenden Sie einen eindeutigen Semesternamen.";
            }

            //check time period

        }

        if(!$insert_error){
            try {
                //check error in qeuries and throw exception if error found
                $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
                $pdo->beginTransaction();

                //insert new semester into database
                $statement = $pdo->prepare("INSERT INTO exchange_period(exchange_semester, semester_begin, semester_end, application_begin, application_end, min_success_factor)
                                            VALUES(:exchange_semester, :semester_begin, :semester_end, :application_begin, :application_end, :min_success_factor)");
                $result = $statement->execute(array('exchange_semester' => $semester, 'semester_begin' => $semesterbegin,'semester_end' => $semesterend ,
                                                    'application_begin' => $applicationbegin,'application_end' => $applicationend, 'min_success_factor' => $successfactor)); 

                $success_msg = "Semester ist erfolgreich hinzugefügt.";

                $pdo->commit();

            }catch (PDOException $e){
                $pdo->rollback();
                $insert_error = true;
                $insert_error_msg = $e->getMessage();
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

        <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
            
        <div class="table-responsive">
                <table class="table table-hover table-sm" id="exchange_semester_list" style="text-align:center;font-size:16px">
                    <thead>
                        <tr style="background-color: #003D76; color: white;">
                            <th scope="col" width="10%" align="center">Semester</th>
                            <th scope="col" width="15%" align="center">Semester Beginn</th>
                            <th scope="col" width="15%" align="center">Semester Ende</th>
                            <th scope="col" width="15%" align="center">Bewerbungphase Beginn</th>
                            <th scope="col" width="15%" align="center">Bewerbungphase Ende</th>
                            <th scope="col" width="5%" align="center">Min Success Factor</th>
                            <th scope="col" width="15%" align="center">Zuletzt Aktualisiert</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    <?php
                    //get auslandssemester
                    $statement = $pdo->prepare("SELECT exchange_semester, semester_begin, semester_end, application_begin, application_end, 
                                                min_success_factor, CASE WHEN updated_on IS NULL THEN created_on ELSE updated_on END AS updated 
                                                FROM exchange_period ORDER BY application_begin DESC");
                
                    $result = $statement->execute(); 

                    while($period = $statement->fetch()) {

                        //check application is still open

                    ?>

                        <!-- <tr class="<?php //if($row['status_id'] == "1") echo "table-warning"; else if($row['status_id'] == "2") echo "table-success"; else if($row['status_id'] == "3") echo "table-danger"; ?>"> -->
                        <tr>   
                            <td align="center"><?php echo $period['exchange_semester'] ?></td>
                            <td align="center"><?php echo $period['semester_begin'] ?></td>
                            <td align="center"><?php echo $period['semester_end'] ?></td>
                            <td align="center"><?php echo $period['application_begin'] ?></td>
                            <td align="center"><?php echo $period['application_end'] ?></td>
                            <td align="center"><?php echo $period['min_success_factor'] ?></td>
                            <td align="center"><?php echo $period['updated'] ?></td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- save -->
            <div class="text-right">
                <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add-new-semester">Neues Semester hinzufügen</button>
                <!-- <button type="submit" class="btn btn-primary" name="save_quota" value="quotachanged" >Speichern</button> -->
            </div>
        </form>

        <!--Pop up Modal to edit valid course list for equivalence -->
        <div class="modal fade" id="add-new-semester" tabindex="-1" role="dialog" aria-labelledby="add-new-semester" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Neues Semester hinzufügen</h5>
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

                <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="new_semester">
                    <div class="form-group">
                        <label for="semester" class="form-label form-label-sm">Semester</label>
                        <input type="text" name="semester" placeholder="WS19/20 order SS2020" maxlength="7" minlength = "6"  class="form-control form-control-sm" value="<?php if(isset($semester)) echo $semester; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="semesterbegin" class="form-label form-label-sm">Semester Begin</label>
                        <input type="date" name="semesterbegin"  class="form-control form-control-sm" value="<?php if(isset($semesterbegin)) echo $semesterbegin; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="semesterend" class="form-label form-label-sm">Semester End</label>
                        <input type="date" name="semesterend"  class="form-control form-control-sm" value="<?php if(isset($semesterend)) echo $semesterend; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="applicationbegin" class="form-label form-label-sm">Application Begin</label>
                        <input type="datetime-local" name="applicationbegin"  class="form-control form-control-sm" value="<?php if(isset($applicationbegin)) echo $applicationbegin; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="applicationend" class="form-label form-label-sm">Application End</label>
                        <input type="datetime-local" name="applicationend"  class="form-control form-control-sm" value="<?php if(isset($applicationend)) echo $applicationend; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="successfactor" class="form-label form-label-sm">Min Success Factor</label>
                        <input type="text" name="successfactor" maxlength="3" pattern="^[1-9]\d*((\.|,)\d+)?$"  class="form-control form-control-sm" value="<?php if(isset($successfactor)) echo $successfactor; ?>" required>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" name="modal-cancel" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                <button type="submit" name="save_new_semester" class="btn btn-primary">Speichern</button>
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
                $('#add-new-semester').modal('show');
            });
        </script>    
<?php endif;?>


<?php 
    include("templates/footer.inc.php");
?>
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

        <!-- add new -->
        <div class="text-right">
            <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add-new-semester">Neues Semester hinzufügen</button>
        </div>

        
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
                <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
                    <div class="form-group row col-auto">
                        <label for="course" class="col-auto col-form-label col-form-label-sm">Semester</label>
                        <div class="col-auto">
                          <input type="text" name="semester" placeholder="WS1920 order SS2020" maxlength="6" minlength = "6"  class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="form-group row col-auto">
                        <label for="course" class="col-auto col-form-label col-form-label-sm">Semester Begin</label>
                        <div class="col-auto">
                          <input type="date" name="semesterbegin"  class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="form-group row col-auto">
                        <label for="course" class="col-auto col-form-label col-form-label-sm">Semester End</label>
                        <div class="col-auto">
                          <input type="date" name="semesterend"  class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="form-group row col-auto">
                        <label for="course" class="col-auto col-form-label col-form-label-sm">Application Begin</label>
                        <div class="col-auto">
                          <input type="datetime" name="applicationbegin"  class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="form-group row col-auto">
                        <label for="course" class="col-auto col-form-label col-form-label-sm">Application End</label>
                        <div class="col-auto">
                          <input type="datetime" name="applicationend"  class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="form-group row col-auto">
                        <label for="course" class="col-auto col-form-label col-form-label-sm">Min Success Factor</label>
                        <div class="col-auto">
                          <input type="text" name="successfactor" maxlength="3" pattern="^[1-9]\d*((\.|,)\d+)?$"  class="form-control form-control-sm" required>
                        </div>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" name="modal-cancel" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                <button type="submit" name="save_new_semester" class="btn btn-primary">Speichern</button>
              </div>
            </div>
          </div>
        </div>

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
                <button type="submit" class="btn btn-primary" name="save_quota" value="quotachanged" >Speichern</button>
            </div>
        </form>
    </div>
</main>


<script>
$(document).ready(function() {

});
</script>

<?php 
    include("templates/footer.inc.php");
?>
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
                            <th scope="col" width="10%" align="center">Success Factor</th>
                            <th scope="col" width="10%" align="center">Zuletzt Aktualisiert</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="<?php if($row['status_id'] == "1") echo "table-warning"; else if($row['status_id'] == "2") echo "table-success"; else if($row['status_id'] == "3") echo "table-danger"; ?>">
                            <td align="center" valign="middle"><input class="form-control form-control-sm" type="number" name="equivalence[<?php echo $row['equivalence_id']; ?>]" min="0" value="<?php if(isset($quota) && !empty($quota)) echo $quota['quota'];?>" ></td>
                            <td align="center" valign="middle"><?php echo $row['home_subject_code'] ?></td>
                            <td align="center"><?php echo $row['home_subject_title'] ?></td>
                            <td align="center"><?php echo $row['foreign_subject_title'] ?></td>
                            <td align="center"><?php if($forAll) echo "alle"; else if(isset($validcoursesname))echo $validcoursesname ?></td>
                            <td align="center"><?php echo $row['status'] ?></td>
                        </tr>
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
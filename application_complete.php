<?php
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();

    if(empty($user)){
        header("location: login.php");
        exit;
    }

    if(!isset($_GET['id'])){
      header("location: status_application.php");
      exit;
    }
    
    if(isset($_GET['error'])){
        $error_msg = $_GET['error'];
    }else if(isset($_GET['success'])){
        $success_msg = $_GET['success'];
    }

    $applicationid = $_GET['id'];

    //get valid application
    if(isset($applicationid) && !empty($applicationid)){
        $statement = $pdo->prepare("SELECT * FROM application WHERE application_id = :id");
        $result = $statement->execute(array('id' => $applicationid));
        $application = $statement->fetch();
    }

    if(isset($application)&&!empty($application)){
        //check application status
        $statement = $pdo->prepare("SELECT count(distinct(sj.university_id)) as submmited_count FROM applied_equivalence ae 
        LEFT JOIN equivalent_subjects es on es.equivalence_id = ae.equivalence_id
        LEFT JOIN subject sj on sj.subject_id = es.foreign_subject_id 
        WHERE ae.application_id = :id");
        $result = $statement->execute(array('id' => $applicationid));
        $submitted = $statement->fetch();
        $submittedCount = $submitted['submmited_count'];

        $statement = $pdo->prepare("SELECT CASE WHEN second_uni_id IS NULL AND third_uni_id IS NULL THEN 1 
                WHEN third_uni_id IS NULL THEN 2 
                ELSE 3 END AS prior_count 
                FROM priority WHERE application_id = :id");
        $result = $statement->execute(array('id' => $applicationid));
        $priority = $statement->fetch();
        $priorityCount = $priority['prior_count'];

        if($submittedCount==$priorityCount){
            $application_completed = true;
        }else{
            $application_completed = false;
        }
    }else{
        $error_msg = "Keine Bewerbung gefunden!";
    }




?>

<?php 
    include("templates/headerlogin.inc.php");
?>

<main class="container-fluid flex-fill">
    <div class="card message-only-form">
    <div class="stepper">

              <a class="stepper-link" href="view_application.php?id=<?php echo $applicationid?>">
              <div class="stepper-item complete" data-toggle="tooltip" data-placement="top" title="Bewerbungsformular">
                <!-- <span class="stepper-circle">1</span> -->
                <div class="stepper-circle">✓</div>
                <span class="stepper-label">Bewerbungsformular</span>
              </div>
              </a>
              <div class="stepper-line"></div>
              <a class="stepper-link" href="facherwahl.php?id=<?php echo $applicationid?>">
              <div class="stepper-item<?php if(isset($application_completed) && $application_completed==true) echo " complete"; else echo " next"; ?>"  data-toggle="tooltip" data-placement="top" title="Fächerwahlliste">
                <span class="stepper-circle"><?php if(isset($application_completed) && $application_completed==true) echo "✓"; else echo "!"; ?></span>
                <span class="stepper-label">Fächerwahlliste</span>
              </div>
              </a>
              <div class="stepper-line"></div>
              <div class="stepper-item active"  data-toggle="tooltip" data-placement="top" title="Bewerbung eingereicht">
                <span class="stepper-circle"><?php if(isset($application_completed) && $application_completed==true) echo "✓"; else echo "-"; ?></span>
                <span class="stepper-label">Bewerbung vollständig</span>
              </div>
            </div>

        <!-- page title -->
        <div class="page-title">
            <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Bewerbungsstatus
        </div>

        <!-- show message -->
        <?php 
            if(isset($application_completed)  && $application_completed==true):
                ?>
            <div class="alert alert-success">
                <?php echo "Deine Bewerbung ist erfolgreich eingereicht! Siehe alle Bewerbungen <a href=\"status_application.php\">hier</a>"; ?>
            </div>
            <?php 
                endif;
        ?>

        <?php 
            if(isset($application_completed)  && $application_completed==false):
                ?>
            <div class="alert alert-danger">
                <?php echo "Deine Bewerbung ist nicht vollständig! Weiter zur <a href=\"facherwahl.php?id=$applicationid\">Fächerwahlliste</a>"; ?>
            </div>
            <?php 
                endif;
        ?>
        <!-- <?php 
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
            <?php echo $error_msg; ?>
        </div>
        <?php 
            endif;
            ?> -->

    </div>
</main>


<?php
    include("templates/footer.inc.php");
?>
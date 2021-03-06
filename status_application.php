<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();
    $user_id = $user['user_id'];

    if(empty($user)){
        header("location: login.php");
        exit;
    }

    if(isset($_GET['application_removed'])){
        $success_msg = "Application is removed successfully.";
    }

    if(isset($_GET['message'])){
        $error_msg = $_GET['message'];
    }

    $studentDB = "student";
    $applicationDB = "application";

    //get all applications of this user
    if(isset($user)){
        $statement = $pdo->prepare("SELECT student_id FROM $studentDB WHERE user_id = $user_id");
        $result = $statement->execute();
        $student = $statement->fetch();
        $studentid = $student['student_id'];

        echo "<script>console.log($studentid)</script>";
    }

    if(isset($_POST['newApplication'])){
        header("location: new_application.php");
        exit;
    }

?>

<?php     
    include("templates/headerlogin.inc.php");  
?>

<main class="container-fluid flex-fill">
    <div class="card status-form">

        <div class="title-row" style="display: flex; justify-content: space-between;">
            <!-- page title -->
            <div class="page-title">
                <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Meine Bewerbungen
            </div>

            <div class="title-button">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success" name="newApplication">Neue Bewerbung</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- get all applications -->
        <?php 
            if(isset($studentid) && !empty($studentid)){
                $statement = $pdo->prepare("SELECT CASE WHEN ra.application_status_id IS NULL THEN 'under review' ELSE st.name END as application_status, 
                                        CASE WHEN ra.application_status_id IS NULL THEN -1 ELSE st.status_id END as application_status_id,      
                                            ap.application_id, ap.created_at, ap.updated_at, ep.exchange_semester, ra.comment, ex.exchange_id
                                            FROM $applicationDB ap 
                                            LEFT JOIN exchange_period ep on ep.period_id = ap.exchange_period_id 
                                            LEFT JOIN reviewed_application ra on ra.application_id = ap.application_id 
                                            LEFT JOIN status st on st.status_id = ra.application_status_id 
                                            LEFT JOIN exchange ex on ex.application_id = ap.application_id 
                                            WHERE student_id = $studentid");
                $result = $statement->execute();
                $applications = array();
                while($row = $statement->fetch()){ 
                    array_push($applications, $row);
                }
            }
        ?>


        <?php 
            if(!isset($applications)){
                $info_msg = "Noch keine Bewerbung vorhanden.";
            }else if(count($applications)==0){
                $info_msg =  "Noch keine Bewerbung vorhanden.";
            }
                ?>

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

        <?php 
        if(isset($info_msg) && !empty($info_msg)):
        ?>
        <div class="alert alert-primary">
            <?php echo $info_msg; ?>
        </div>
        <?php 
        endif;
        ?>

        <?php if(isset($applications) && count($applications)> 0) {?>

        <div class="table-responsive">
            <table class="table table-hover table-sm" style="font-size: 18px;">
                <thead>
                    <tr>
                        <th scope="col">Angestrebtes Auslandsemester</th>
                        <th scope="col">Eingereicht am</th>
                        <th scope="col">Zuletzt bearbeitet am</th>
                        <th scope="col">Aktueller Stand</th>
                        <th scope="col">Hinweis</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                            foreach($applications as $application){
                                
                                //for each application, check if user has already submit facherwahlliste
                                $statement = $pdo->prepare("SELECT count(distinct(sj.university_id)) as submmited_count FROM applied_equivalence ae 
                                                            LEFT JOIN equivalent_subjects es on es.equivalence_id = ae.equivalence_id
                                                            LEFT JOIN subject sj on sj.subject_id = es.foreign_subject_id 
                                                            WHERE ae.application_id = :id");
                                $result = $statement->execute(array('id' => $application['application_id']));
                                $submitted = $statement->fetch();
                                $submittedCount = $submitted['submmited_count'];
                            
                                $statement = $pdo->prepare("SELECT CASE WHEN second_uni_id IS NULL AND third_uni_id IS NULL THEN 1 
                                                            WHEN third_uni_id IS NULL THEN 2 
                                                            ELSE 3 END AS prior_count 
                                                            FROM priority WHERE application_id = :id");
                                $result = $statement->execute(array('id' => $application['application_id']));
                                $priority = $statement->fetch();
                                $priorityCount = $priority['prior_count'];
                            
                                if($submittedCount==$priorityCount){
                                    $application_completed = true;
                                }else{
                                    $application_completed = false;
                                }
                    ?>

                    <tr
                        class="<?php if($application['application_status_id']==1) echo "table-primary"; else if($application['application_status_id']==2) echo"table-success"; else if($application['application_status_id']==3) echo"table-danger";else if($application_completed==false) echo "table-warning"; ?>">
                        <td><?php echo $application['exchange_semester'] ?></td>
                        <td><?php echo $application['created_at'] ?></td>
                        <td><?php echo $application['updated_at'] ?></td>
                        <td><?php if($application_completed==false) echo "incomplete";else echo $application['application_status'] ?></td>
                        <td><?php echo $application['comment'] ?><?php if($application['application_status_id']==2):?> Zum <a href="exchange_checklist.php?id=<?php echo $application['exchange_id']; ?>">Auslandssemester</a><?php endif ?></td>
                        <td><a href="view_application.php?id=<?php echo $application['application_id']; ?>">Bewerbung
                                öffnen</a></td>
                    </tr>
                    <?php }
                          ?>
                </tbody>
            </table>
        </div>

        <?php    
            }
        ?>



        <!-- <div class="list-group application-list">
            <?php 
                // if(isset($studentid) && !empty($studentid)){
                //     $statement = $pdo->prepare("SELECT ap.application_id, ap.created_at, ep.exchange_semester FROM $applicationDB ap LEFT JOIN exchange_period ep on ep.period_id = ap.exchange_period_id WHERE student_id = $studentid");
                //     $result = $statement->execute();
                //     while($application = $statement->fetch()){ ?>
                //         <a  href="view_application.php?id=<?php //echo $application['application_id']?>" class="list-group-item list-group-item-action"><?php// echo $application['exchange_semester']; echo"   "; echo $application['created_at']; ?></a>
                //     <?php 
                //     }
                // }
            ?>
        </div> -->
    </div>
</main>


<?php 
    include("templates/footer.inc.php");
?>
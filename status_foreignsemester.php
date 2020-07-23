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

    $studentDB = "student";
    $applicationDB = "application";
    $exchangeDB = "exchange";

    //get student account of this user
    if(isset($user)){
        $statement = $pdo->prepare("SELECT student_id FROM $studentDB WHERE user_id = $user_id");
        $result = $statement->execute();
        $student = $statement->fetch();
        $studentid = $student['student_id'];
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
                <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Meine Auslandssemesters
            </div>

        </div>

        <!-- get all exchange data -->
        <?php 
            if(isset($studentid) && !empty($studentid)){
                $statement = $pdo->prepare("SELECT ep.exchange_semester, ep.semester_begin, ep.semester_end, ex.exchange_id, ap.exchange_period_id, ex.foreign_uni_id    
                                            FROM exchange ex 
                                            LEFT JOIN $applicationDB ap on ap.application_id = ex.application_id  
                                            LEFT JOIN exchange_period ep on ep.period_id = ap.exchange_period_id 
                                            WHERE ap.student_id = $studentid 
                                            ORDER BY ep.semester_begin DESC");
                $result = $statement->execute();
                $exchangedatas = array();
                while($row = $statement->fetch()){ 
                    array_push($exchangedatas, $row);
                }
            }
        ?>


        <?php 
            if(!isset($exchangedatas)){
                $info_msg = "Noch keine Auslandssemesters vorhanden.";
            }else if(count($exchangedatas)==0){
                $info_msg =  "Noch keine Auslandssemesters vorhanden.";
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

        <?php if(isset($exchangedatas) && count($exchangedatas)> 0) {?>

        <div class="table-responsive">
            <table class="table table-hover table-sm" style="font-size: 18px;">
                <thead>
                    <tr>
                        <th scope="col">Auslandsemester</th>
                        <th scope="col">Semesterbeginn</th>
                        <th scope="col">Semesterende</th>
                        <th scope="col">Next Step</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Checklist</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                            foreach($exchangedatas as $exchangedata){
                                $statement = $pdo->prepare("SELECT ec.step_name as next_step, ecd.deadline
                                                            FROM exchange_checklist ec
                                                            LEFT JOIN exchange_checklist_deadline ecd on ecd.step_id = ec.step_id 
                                                            WHERE ecd.exchange_period_id = :exchange_period_id and (ec.foreign_uni_id = 1 or ec.foreign_uni_id = :foreign_uni_id ) AND
                                                            ec.step_id not in (SELECT step_id FROM exchange_checklist_student WHERE exchange_id = :exchange_id)
                                                            ORDER BY ecd.deadline ASC LIMIT 1");
                                $result = $statement->execute(array(":exchange_id"=>$exchangedata['exchange_id'], ":exchange_period_id"=>$exchangedata['exchange_period_id'], ":foreign_uni_id"=>$exchangedata['foreign_uni_id']));
                                $nextstep = $statement->fetch();

                                ?>

                    <tr>
                        <td><?php echo $exchangedata['exchange_semester'] ?></td>
                        <td><?php echo $exchangedata['semester_begin'] ?></td>
                        <td><?php echo $exchangedata['semester_end'] ?></td>
                        <td><?php echo $nextstep['next_step'] ?></td>
                        <td><?php echo $nextstep['deadline'] ?></td>

                        <td><a href="exchange_checklist.php?id=<?php echo $exchangedata['exchange_id']; ?>">Full Checklist</a></td>
                    </tr>
                    <?php }
                          ?>
                </tbody>
            </table>
        </div>

        <?php    
            }
        ?>


    </div>
</main>


<?php 
    include("templates/footer.inc.php");
?>
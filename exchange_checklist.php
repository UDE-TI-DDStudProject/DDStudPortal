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

    if(!isset($_GET['id'])){
        header("location: status_foreignsemester.php");
        exit;
    }

    $exchangeid = $_GET['id'];

    //get user's student id
    $statement = $pdo->prepare("SELECT * FROM student WHERE user_id = :id ");
    $result = $statement->execute(array('id' => $user_id));
    $check_student = $statement->fetch();

    //check if application exist for the student
    if(isset($applicationid)){
        $statement = $pdo->prepare("SELECT * FROM application WHERE application_id = :id and student_id = :student_id");
        $result = $statement->execute(array('id' => $applicationid, 'student_id'=>$check_student['student_id']));
        $application = $statement->fetch();
    } 

    //get exchange data for the student
    if(isset($check_student)){
        $statement = $pdo->prepare("SELECT ep.exchange_semester, ep.semester_begin, ep.semester_end, ex.exchange_id, ap.exchange_period_id, ex.foreign_uni_id , uni.name as uni_name    
                                    FROM exchange ex 
                                    LEFT JOIN application ap on ap.application_id = ex.application_id  
                                    LEFT JOIN exchange_period ep on ep.period_id = ap.exchange_period_id 
                                    LEFT JOIN university uni on uni.university_id = ex.foreign_uni_id
                                    WHERE ex.exchange_id = $exchangeid and ap.student_id = :student_id");
        $result = $statement->execute(array('student_id'=>$check_student['student_id']));
        $exchangedata = $statement->fetch();
    }

    
    if(isset($exchangedata)){
        //get checklist of this exchange
        $statement = $pdo->prepare("SELECT ec.step_id, ec.step_name, ecd.beginn, ecd.deadline     
                                    FROM exchange_checklist ec 
                                    LEFT JOIN exchange_checklist_deadline ecd on ecd.step_id = ec.step_id
                                    WHERE ecd.exchange_period_id = :exchange_period_id 
                                    ORDER BY ecd.deadline ASC");
        $result = $statement->execute(array(":exchange_period_id"=>$exchangedata['exchange_period_id']));
        $checklist = array();
        while($row = $statement->fetch()){ 
            array_push($checklist, $row);
        }

        //get completed checklist item
        $statement = $pdo->prepare("SELECT ecs.step_id    
        FROM exchange_checklist_student ecs 
        WHERE ecs.exchange_id = :exchange_id");
        $result = $statement->execute(array(":exchange_id"=>$exchangeid));
        $completeditems = array();
        while($row = $statement->fetch()){ 
            array_push($completeditems, $row['step_id']);
        }

        $showForm = true;
    }else{
        $showForm = false;
        $error_msg = "Kein Auslandssemester vorhanden.";
    }


?>

<?php 
    //upon save
    if(isset($_POST['save'])){
        if(isset($_POST['completed']) && !empty($_POST['completed'])){

            $stmtDelete = $pdo->prepare("DELETE FROM exchange_checklist_student WHERE exchange_id = $exchangeid ");
            $stmtInsert = $pdo->prepare("INSERT INTO exchange_checklist_student (step_id, exchange_id) VALUES (?, $exchangeid)");

            /*Begin transaction*/
            try {
                $pdo->beginTransaction();
                $stmtDelete->execute();
                foreach ($_POST['completed'] as $value)
                {
                    $stmtInsert->execute(array($value));
                }
                $pdo->commit();
                $success_msg = 'Checklist gespeichert';

            }catch (Exception $e){
                $pdo->rollback();
                throw $e;
                $error_msg = $e->get_message();
            }
        }
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
                <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Auslandssemester - Checklist
            </div>

            <div class="title-button">
            <form action="status_foreignsemester.php" method="post">
                    <div class="text-right">
                        <button type="submit" class="btn btn-outline-primary btn-sm" name="backToOverview">Zurück zur
                            Auslandssemesters Übersicht</button>
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

        <?php 
        if(isset($info_msg) && !empty($info_msg)):
        ?>
        <div class="alert alert-primary">
            <?php echo $info_msg; ?>
        </div>
        <?php 
        endif;
        ?>

        <?php if(isset($showForm) && $showForm == true): ?>

        <!-- display exchange semester data -->
        <div class="table-responsive">
                <table class="table table-borderless table-hover table-sm" id="application" style="font-size:18px">
                    <tbody>
                        <tr class="d-flex">
                            <td class="col-sm-3">Auslandssemester</td>
                            <td class="col-sm-9"><?php if(isset($exchangedata)) echo $exchangedata['exchange_semester'] ?></td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-sm-3">Semesterbeginn</td>
                            <td class="col-sm-9"><?php if(isset($exchangedata)) echo $exchangedata['semester_begin'] ?></td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-sm-3">Semesterende</td>
                            <td class="col-sm-9"><?php if(isset($exchangedata)) echo $exchangedata['semester_end'] ?></td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-sm-3">Partner-Universität</td>
                            <td class="col-sm-9"><?php if(isset($exchangedata)) echo $exchangedata['uni_name'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $exchangeid;?>" method="post">

        <?php if(isset($checklist) && count($checklist) > 0) { ?>
        <div class="table-responsive">
            <table class="table table-hover table-sm" style="font-size: 18px; text-align:center;">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">To-do</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Done</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    $count = 0;
                    foreach($checklist as $checklistitem){
                        $count += 1;
                    ?>

                    <tr>
                        <td><?php echo $count?></td>
                        <td><a class="btn btn-link" data-toggle="collapse" href="#step<?php echo $checklistitem['step_id'];?>" role="button" aria-expanded="false" aria-controls="step<?php echo $checklistitem['step_id'];?>"><?php echo $checklistitem['step_name'] ?></a>
                        <div class="collapse" id="step<?php echo $checklistitem['step_id'];?>">
                          <div class="card card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                          </div>
                        </div>
                        </td>
                        <td><?php echo $checklistitem['deadline'] ?></td>
                        <td><input type="checkbox" name="completed[]" value="<?php echo $checklistitem['step_id'] ?>" <?php if(in_array($checklistitem['step_id'], $completeditems, true)) echo "checked"; ?>></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php } ?>

        <div class="text-right">
            <button type="submit" class="btn btn-success" name="save">Speichern</button>
        </div>

        </form>
        <?php endif; ?>
    </div>
</main>




<?php 
    include("templates/footer.inc.php");
?>
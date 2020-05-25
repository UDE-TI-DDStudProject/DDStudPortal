<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();
    $user_id = $user['user_id'];

    if(!isset($user)){
        header("location: testlogin.php");
        exit;
    }

    if(isset($_GET['application_removed'])){
        $success_msg = "Application is removed successfully.";
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

?>

<?php     
    include("templates/testheaderlogin.php");  
?>

<main class="container-fluid flex-fill">
    <div class="card status-form">
        <!-- page title -->
        <div class="page-title">
            <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Meine Applikation
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

        <div class="list-group application-list">
            <?php 
                if(isset($studentid) && !empty($studentid)){
                    $statement = $pdo->prepare("SELECT ap.application_id, ap.created_at, ep.exchange_semester FROM $applicationDB ap LEFT JOIN exchange_period ep on ep.period_id = ap.exchange_period_id WHERE student_id = $studentid");
                    $result = $statement->execute();
                    while($application = $statement->fetch()){ ?>
                        <a  href="view_application.php?id=<?php echo $application['application_id']?>" class="list-group-item list-group-item-action"><?php echo $application['exchange_semester']; echo"   "; echo $application['created_at']; ?></a>
                    <?php 
                    }
                }
            ?>
        </div>
    </div>
</main>


<?php 
    include("templates/testfooter.php");
?>
<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
$user = check_user();
$userid = $user['id'];

include("templates/header.inc.php");

$statement = $pdo->prepare("SELECT personalid FROM student_new WHERE user_id = $userid ");
$result = $statement->execute();
$student = $statement->fetch();
$studentid = $student['personalid'];

if(isset($studentid)){
$statement = $pdo->prepare("SELECT COUNT(*) as count FROM student_selectedsubjects WHERE personalid = $studentid ");
$result = $statement->execute();
$courses = $statement->fetch();
$coursesCount = $courses['count'];
}

$activeStep = 1;

if(isset($studentid)){
    $activeStep = 2;

    if(isset($coursesCount)){
        if($coursesCount > 0){
            $activeStep = 3;
        }
    }
}

//still need to check if application is confirmed

?>

<div class = "main">
	<div class = "container main-container">
        <h3>Bewerbungsstatus</h3><br>

        <div class="stepper">
            <ul class="nav nav-tabs nav-justified" role="tablist">
              <li role="presentation" class="<?php if($activeStep == 1) echo "active"; else echo "completed"; ?>">
                <a class="persistant-disabled" href="#stepper-step-1" data-toggle="tab" aria-controls="stepper-step-1" role="tab" title="Submit Application">
                  <span class="round-tab">1</span>
                </a>
              </li>
              <li role="presentation" class="<?php if($activeStep == 2) echo "active"; else if($activeStep > 2) echo "completed"; else echo "disabled" ;?>">
                <a class="persistant-disabled" href="#stepper-step-2" data-toggle="tab" aria-controls="stepper-step-2" role="tab" title="Select courses">
                  <span class="round-tab">2</span>
                </a>
              </li>
              <li role="presentation" class="<?php if($activeStep == 3) echo "active"; else if($activeStep > 3) echo "completed"; else echo "disabled" ;?>">
                <a class="persistant-disabled" href="#stepper-step-3" data-toggle="tab" aria-controls="stepper-step-3" role="tab" title="Waiting for confirmation">
                  <span class="round-tab">3</span>
                </a>
              </li>
              <li role="presentation" class="<?php if($activeStep == 4) echo "active"; else if($activeStep > 4) echo "completed"; else echo "disabled" ;?>">
                <a class="persistant-disabled" href="#stepper-step-4" data-toggle="tab" aria-controls="stepper-step-4" role="tab" title="Application Complete!">
                  <span class="round-tab">4</span>
                </a>
              </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade" role="tabpanel" id="stepper-step-1">
                  <h3>Submit Application</h3>
                  <p><a href="application.php">click here</a> to apply/see your application details.</p>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="stepper-step-2">
                  <h3>Select courses</h3>
                  <p>You have to select the courses for the transfer semester.</p>
                  <p><a href="test_auswahl.php">click here</a> to select courses.</p>
                </div>
                <div class="tab-pane fade in active" role="tabpanel" id="stepper-step-3">
                  <h3>Wait for confirmation</h3>
                  <p>We have received your submission. It will take about 2 weeks to review your submission.</p> 
                  <p>If you have not received an email confirmation after 2 weeks, please contact us.</p>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="stepper-step-4">
                  <h3>Application complete!</h3>
                  <p>Congratulations! Your application is accepted. We wish you all the best and have a great study abroad experience!</p>
                </div>
              </div>
        </div>

<script>
    $(document).ready(function() {
            function triggerClick(elem) {
                $(elem).click();
            }
            var $progressWizard = $('.stepper'),
                $tab_active,
                $tab_prev,
                $tab_next,
                $tab_toggle = $progressWizard.find('[data-toggle="tab"]'),
                $tooltips = $progressWizard.find('[data-toggle="tab"][title]');

            //Initialize tooltips
            $tooltips.tooltip();

            //Wizard
            $tab_toggle.on('show.bs.tab', function(e) {
                var $target = $(e.target);
                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });
        });
  </script>
<?php 
include("templates/footer.inc.php")
?>


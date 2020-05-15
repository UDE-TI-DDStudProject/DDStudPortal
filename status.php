<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
$user = check_user();
$userid = $user['user_id'];

include("templates/header.inc.php");

$statement = $pdo->prepare("SELECT * FROM student WHERE user_id = $userid ");
$result = $statement->execute();
$student = $statement->fetch();
$studentid = $student['student_id'];

//check application
if(isset($studentid)){
$statement = $pdo->prepare("SELECT * FROM application WHERE student_id = $studentid ");
$result = $statement->execute();
$application = $statement->fetch();
$applicationid = $application['application_id'];
}

$activeStep = 1;

if(isset($applicationid)){
    $activeStep = 2;

    $statement = $pdo->prepare("SELECT ra.* , st.name as status FROM reviewed_application ra
                                LEFT JOIN status st on st.status_id = ra.application_status_id 
                                WHERE application_id = $applicationid ");
    $result = $statement->execute();
    $reviewed = $statement->fetch();
    $applicationstatus = $reviewed['status'];

    if(isset($applicationstatus)){
      $activeStep = 3;
    }
}

//still need to check if application is confirmed

?>

<style>.stepper .nav-tabs {
	position: relative;
}
.stepper .nav-tabs > li {
	position: relative;
}
.stepper .nav-tabs > li:after {
	content: '';
	position: absolute;
	background: #f1f1f1;
	display: block;
	width: 100%;
	height: 5px;
	top: 30px;
	left: 50%;
	z-index: 1;
}
.stepper .nav-tabs > li.completed::after {
	background: #34bc9b;
}
.stepper .nav-tabs > li:last-child::after {
	background: transparent;
}
.stepper .nav-tabs > li.active:last-child .round-tab {
	background: #34bc9b;
}
.stepper .nav-tabs > li.active:last-child .round-tab::after {
	content: '✔';
	color: #fff;
	position: absolute;
	left: 0;
	right: 0;
	margin: 0 auto;
	top: 0;
	display: block;
}
.stepper .nav-tabs [data-toggle='tab'] {
	width: 25px;
	height: 25px;
	margin: 20px auto;
	border-radius: 100%;
	border: none;
	padding: 0;
	color: #f1f1f1;
}
.stepper .nav-tabs [data-toggle='tab']:hover {
	background: transparent;
	border: none;
}
.stepper .nav-tabs > .active > [data-toggle='tab'],
.stepper .nav-tabs > .active > [data-toggle='tab']:hover,
.stepper .nav-tabs > .active > [data-toggle='tab']:focus {
	color: #34bc9b;
	cursor: default;
	border: none;
}
.stepper .tab-pane {
	position: relative;
	padding-top: 50px;
}
.stepper .round-tab {
	width: 25px;
	height: 25px;
	line-height: 22px;
	display: inline-block;
	border-radius: 25px;
	background: #fff;
	border: 2px solid #34bc9b;
	color: #34bc9b;
	z-index: 2;
	position: absolute;
	left: 0;
	text-align: center;
	font-size: 14px;
}
.stepper .completed .round-tab {
	background: #34bc9b;
}
.stepper .completed .round-tab::after {
	content: '✔';
	color: #fff;
	position: absolute;
	left: 0;
	right: 0;
	margin: 0 auto;
	top: 0;
	display: block;
}
.stepper .active .round-tab {
	background: #fff;
	border: 2px solid #77d6db;
}
.stepper .active .round-tab:hover {
	background: #fff;
	border: 2px solid #77d6db;
}
.stepper .active .round-tab::after {
	display: none;
}
.stepper .disabled .round-tab {
	background: #fff;
	color: #f1f1f1;
	border-color: #f1f1f1;
}
.stepper .disabled .round-tab:hover {
	color: #4dd3b6;
	border: 2px solid #a6dfd3;
}
.stepper .disabled .round-tab::after {
	display: none;
}

.stepper .tab-content {
	position: relative;
	text-align: center;
}
</style>

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
                <a class="persistant-disabled" href="#stepper-step-2" data-toggle="tab" aria-controls="stepper-step-2" role="tab" title="Application under reviewed">
                  <span class="round-tab">2</span>
                </a>
              </li>
              <li role="presentation" class="<?php if($activeStep == 3) echo "active"; else if($activeStep > 3) echo "completed"; else echo "disabled" ;?>">
                <a class="persistant-disabled" href="#stepper-step-3" data-toggle="tab" aria-controls="stepper-step-3" role="tab" title="Application completed">
                  <span class="round-tab">3</span>
                </a>
              </li>
              <!-- <li role="presentation" class="<?php //if($activeStep == 4) echo "active"; else if($activeStep > 4) echo "completed"; else echo "disabled" ;?>">
                <a class="persistant-disabled" href="#stepper-step-4" data-toggle="tab" aria-controls="stepper-step-4" role="tab" title="Application Complete!">
                  <span class="round-tab">4</span>
                </a>
              </li> -->
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade<?php if($activeStep == 1) echo " in active"?>" role="tabpanel" id="stepper-step-1">
                  <h3>Submit Application</h3>
                  <p><?php if($activeStep == 1) echo "You have not submitted the application form. Please <a href=\"application.php\">click here</a> to apply."; else echo"You have submitted the application form. Please <a href=\"application.php\">click here</a> to see your submitted data.";  ?></p>
                </div>
                <div class="tab-pane fade<?php if($activeStep == 2) echo " in active"?>" role="tabpanel" id="stepper-step-2">
                  <h3>Application under reviewed</h3>
                  <p><?php if($activeStep == 2) echo "We have received your application. It is now being processed."; ?></p>
                </div>
                <div class="tab-pane fade<?php if($activeStep == 3) echo " in active"?>" role="tabpanel" id="stepper-step-3">
                  <h3>Application completed</h3>
                  <p><?php if($activeStep == 3) echo "Your application is $applicationstatus. "; ?></p>
                </div>
                <!-- <div class="tab-pane fade<?php //if($activeStep == 4) echo " in active"?>" role="tabpanel" id="stepper-step-4">
                  <h3>Application complete!</h3>
                  <p>Congratulations! Your application is accepted. We wish you all the best and have a great study abroad experience!</p>
                </div> -->
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


<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
$user = check_user();
$userid = $user['id'];

include("templates/header.inc.php");

$statement = $pdo->prepare("SELECT * FROM student_new WHERE user_id = $userid ");
$result = $statement->execute();
$student = $statement->fetch();

//check if course selection is still available for editing
if(isset($student)){
    if(((strtotime(date('Y-m-d h:i:sa')) - strtotime($student['created_at']))/60/60/24) >= 10){
        $selection = false;
    }else{
        $selection = true;
    }

    $status = "Bewerbung in Bearbeitung";
}else{
    $status = "Bitte erst Bewerbung abschicken!";
}

?>

<div class = "main">
	<div class = "container main-container">
        <h3>Bewerbungsstatus</h3><br>

        <div class="alert alert-info" role="alert"><?php echo $status ?></div>
        <i <?php if(isset($student)) echo "class=\"glyphicon glyphicon-ok\""; else echo "class=\"glyphicon glyphicon-exclamation-sign\""; ?>></i>  <a href="application.php">Bewerbungsformular</a><br>
        <i <?php if($selection) echo "class=\"glyphicon glyphicon-pencil\""; else echo "class=\"glyphicon glyphicon-ok\""; ?>></i>  <a href="test_auswahl.php">Fächerwahlliste</a><br>
        <br>
        <br>
    </div>
</div>

<?php 
include("templates/footer.inc.php")
?>


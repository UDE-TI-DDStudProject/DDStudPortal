
<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user(); //zur Prüfung des users in der "user"-Datenbank
$inputDB = 'student_new';
$userid = $user['id'];

include("templates/header.inc.php");
?>

<div class="main">


<div class = "container main-container">

	<div class="head">
		<h1>Fächerwahlliste</h1>
	</div>	


<!-- ########## Abfrage Universitäten ############ --> 

<?php
$showFormular = false; //Variable ob das Registrierungsformular angezeigt werden soll

/* Ergebnis der vom Studenten ausgewählten Kurse */
if(isset($_POST['auswahl'])) {

	//check whether if student has registered already
	$statement = $pdo->prepare("SELECT personalid FROM student_new WHERE user_id = $userid");
	$result = $statement->execute();
	$row = $statement->fetch();
	$studentid = $row['personalid'];

	if(isset($studentid)){
		if(!empty($_POST['kurse'])) {

			/*DELETE all old entries of students in database table 'student_selectedsubjects' then INSERT newly checked equivalent-courses into database*/	
				$stmtDelete = $pdo->prepare("DELETE FROM student_selectedsubjects WHERE personalid = $userid");
				$stmtInsert = $pdo->prepare("INSERT INTO student_selectedsubjects (equivalence_id, personalid) VALUES (?, $userid)");
		
				/*Begin transaction*/
				try {
					$pdo->beginTransaction();
					$stmtDelete->execute();
					foreach ($_POST['kurse'] as $value)
					{
						$stmtInsert->execute(array($value));
					}
					$pdo->commit();
					
					/*Alert successful message after transaction committed */
					?><div class="alert alert-success"><?php
					echo 'Auswahl gespeichert'."<br>";
					?></div><?php
		
				}catch (Exception $e){
					$pdo->rollback();
					throw $e;
					
					/*Alert Error message after transaction rollbacked (cancelled) */
					?><div class="alert alert-danger"><?php
					echo $e->get_message();
					?></div><?php
				}
			}
		
			/*Show previous universities selection and the course-selection form*/
			if(isset($_POST['home_locationid']) AND isset($_POST['foreign_locationid']) AND ($_POST['home_locationid']>1) AND ($_POST['foreign_locationid']>1)) {
				$home_locationid = $_POST['home_locationid'];
				$foreign_locationid = $_POST['foreign_locationid'];
		
				$showFormular = true;
			}
	}else{
		?><div class="alert alert-danger"><?php
		echo 'Sie haben sich noch nicht beworben. <br> Bitte erst <a href="application.php">Bewerbungformular</a> abschicken!';
		?></div><?php
	}
}

/* Wenn der Button "Äquivalenliste Laden" geklickt wurde, kann geprüft werden, ob die Universitäten ausgewählt wurden*/
if(isset($_POST['university'])) {
	if(isset($_POST['home_locationid']) AND isset($_POST['foreign_locationid']) AND ($_POST['home_locationid']>1) AND ($_POST['foreign_locationid']>1)) {
		$home_locationid = $_POST['home_locationid'];
		$foreign_locationid = $_POST['foreign_locationid'];
		/*echo $home_locationid;
		echo $foreign_locationid;*/
		
		$showFormular = true;
	}
	else {
		?><div class="alert alert-warning"><?php
			echo "Bitte zunächst Universitäten auswählen!";
		?></div><?php
		$showFormular = false;
	}
}
?>

<!-- ########## Formular zur Abfrage der Universitäten ############ --> 

<form action="?university=1" method="post">

		<div class="form-group" style="background-color: #003D76; color: white"> 
			<table class="table" rules="none">
				<tr>
					<td width="50%" align="center"><label for="Home_uni"><font size="5">Heim-Universität </font><br>(Home-University)</label></th>
					<td width="50%" align="center"><label for="Foreign_uni"><font size="5">Partner-Universität </font><br>(Foreign-University)</label></th>
				</tr>
				<tr>
					<td>				
						<select type="text" size="1" name="home_locationid" class="form-control" required>
							<?php 
							$statement = $pdo->prepare("SELECT location, locationid FROM university ORDER BY locationid");
							$result = $statement->execute();
							while($row = $statement->fetch()) { ?>
                                <!--show selected option after selection 06.04.2020 by lin-->
								<option  <?php if (isset($home_locationid) AND $row['locationid'] == $home_locationid) echo "selected" ?> value="<?php echo ($row['locationid'])?>"><?php echo ($row['location'])?></option>
							<?php } ?>		
						</select>
					</td>
					<td>
						<select type="text" size="1"  name="foreign_locationid" class="form-control">
							<?php 
							$statement = $pdo->prepare("SELECT location, locationid FROM university ORDER BY locationid");
							$result = $statement->execute();
							while($row = $statement->fetch()) { ?>
                            <!--show selected option after selection 06.04.2020 by lin-->
							<option  <?php if (isset($foreign_locationid) AND $row['locationid'] == $foreign_locationid) echo "selected" ?> value="<?php echo ($row['locationid'])?>"><?php echo ($row['location'])?></option>
							<?php } ?>		
						</select>
					</td>
				</tr>
			</table>

			<button type="submit" name="university" class="btn btn-lg btn-primary btn-block">Äquivalenzliste laden</button>
		</div><br>
</div>


<!-- ########## Anzeige der Äquivalenzlisten für ausgewählte Universitäten ############ --> 
<!-- nachdem abgefragt wurde, welche Universitäten geladen werden sollen, können die Fächer aus der Datenbank gelesen werden:-->

<?php
if($showFormular) {
?>
<div class="container main-container">


	<table id = "courses" border="1" rules="row" cellspacing="10">
		<tr style="background-color: #003D76; color: white; align: middle">
			<td width="8%" align="center"><b>Auswahl</b><br>(Selection)</th>
			<td width="15%" align="center"><b>Kurs-Nr. Heim-Uni</b><br>(Home-Subject-No.)</th>
			<td width="11%" align="center"><b>Credits Heim-Uni</b><br>(Home-Credits)</th>
			<td width="25%" align="center"><b>Kurs Heim-Uni</b><br>(Home-subject)</th>
			<td width="11%" align="center"><b>Credits Partner-Uni</b><br>(Foreign-Credits)</th>
			<td width="25%" align="center"><b>Kurs Partner-Uni</b><br>(Foreign-subject)</th>
			<td width="5%" align="center"><b>Status</b></th>
		</tr>


		<?php 
		/*Abfrage der vorhandenen Äquivalenzen aus der "equivalent_subjects"-DB*/
		$statement = $pdo->prepare("SELECT equivalence_id, home_subject_id, foreign_subject_id, status_id FROM equivalent_subjects ORDER BY equivalence_id");
		$result = $statement->execute();
		while($row = $statement->fetch()) {
			
			/*Übergabe der Afrage aus "equivalent_subjects"-DB an Variablen*/
			$home_subject_id = $row['home_subject_id'];
			$foreign_subject_id = $row['foreign_subject_id'];
			$status_id = $row['status_id'];
			$equivalence_id = $row['equivalence_id'];
			
			/*Abfrage aus "Subjects"-DB der Infos für Home_Course*/ 
			$statement1 = $pdo->prepare("SELECT subject_title, subject_code, subject_credits, university_id FROM subjects WHERE (subject_id = $home_subject_id)");
			$result = $statement1->execute();
			$row1 = $statement1 ->fetch();
			
			/*wenn die ausgewählte Home-University-ID nicht mit der University-ID der Äquivalenz übereinstimmt: Schleife unterbrechen*/
			if (!($row1['university_id'] == $home_locationid)) {
				continue;
				die("falsch Foreign");
			}
			
			/*Abfrage aus "Subjects"-DB der Infos für Foreign_Course*/ 
			$statement1 = $pdo->prepare("SELECT subject_title, subject_code, subject_credits, university_id FROM subjects WHERE subject_id = $foreign_subject_id");
			$result = $statement1->execute();
			$row2 = $statement1 ->fetch();
			
			/*wenn die ausgewählte Foreign-University-ID nicht mit der University-ID der Äquivalenz übereinstimmt: Schleife unterbrechen*/
			if (!($row2['university_id'] == $foreign_locationid)) {
				continue;
				die("falsch Foreign");
			}
			
			/*Abfrage aus "equivalence_status"-DB der Infos für Foreign_Course*/ 
			$statement1 = $pdo->prepare("SELECT status FROM equivalence_status WHERE status_id = $status_id");
			$result = $statement1->execute();
            $row3 = $statement1 ->fetch();
            
            /*Query previously selected equivalence-courses' id of the user*/
            $statement1 = $pdo->prepare("SELECT equivalence_id FROM student_selectedsubjects WHERE personalid = $userid");
            $result = $statement1->execute();
            $selectedCourses = array();
            while($selectedCourse = $statement1 ->fetch())
            {
                array_push($selectedCourses, $selectedCourse['equivalence_id']);
            }
			
			?>
			<?php 
			if ($status_id == "1") {
				$backcolor = "yellow";
			}
			if ($status_id == "2") {
				$backcolor = "lightgreen";
			}
			if ($status_id == "3") {
				$backcolor = "tomato";
			}?>
			<tr style="background-color: <?php echo $backcolor; ?>">
            <!--check previously selected equivalence-courses and disable declined courses-->
			<td align="center"><input type="checkbox" name="kurse[]" value="<?php echo $row['equivalence_id'] ?>" <?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "checked"; if($status_id == "3") echo "disabled" ?>></td>
			<td align="center" valign="middle"><?php echo $row1['subject_code'] ?></td>
			<td align="center"><?php echo $row1['subject_credits'] ?></td>
			<td align="center"><?php echo $row1['subject_title'] ?></td>
			<td align="center"><?php echo $row2['subject_credits'] ?></td>
			<td align="center"><?php echo $row2['subject_title'] ?></td>
			<td align="center"><?php echo $row3['status'] ?></td>
			</tr>
			<?php
		}
		?>
	</table>
	
	<br>
	<div class="registration-form">
		<button type="submit" name="auswahl" id = "auswahl" class="btn btn-lg btn-primary btn-block">Fächerwahl übernehmen</button>
	</div>
</form>


</div>
</div>

<?php 
}
?>


</div>

<script>
//if drop down selection changed, hide table and button
$(document).ready(function(){
	$("select").change(function(){
		//$("#auswahl").attr("disabled", true);
		$(".registration-form").hide();
		$("#courses").hide();
	});
});
</script>

<?php 
include("templates/footer.inc.php")
?>

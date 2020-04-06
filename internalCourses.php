<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user(); //zur Prüfung des users in der "user"-Datenbank
$inputDB = 'student_new';

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
	if(isset($_POST['kurse'])) {
		?><div class="alert alert-success"><?php
		echo 'Ihre Auswahl lautet:'."<br>";
	
		foreach($_POST['kurse'] as $value) {
			echo $value."<br>";
		}
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
						<select type="text" size="1"  name="home_locationid" class="form-control" required>
							<?php 
							$statement = $pdo->prepare("SELECT location, locationid FROM university ORDER BY locationid");
							$result = $statement->execute();
							while($row = $statement->fetch()) { ?>
								<option value="<?php echo ($row['locationid'])?>"><?php echo ($row['location'])?></option>
							<?php } ?>		
						</select>
					</td>
					<td>
						<select type="text" size="1"  name="foreign_locationid" class="form-control">
							<?php 
							$statement = $pdo->prepare("SELECT location, locationid FROM university ORDER BY locationid");
							$result = $statement->execute();
							while($row = $statement->fetch()) { ?>
							<option value="<?php echo ($row['locationid'])?>"><?php echo ($row['location'])?></option>
							<?php } ?>		
						</select>
					</td>
				</tr>
			</table>

			<button type="submit" name="university" class="btn btn-lg btn-primary btn-block">Äquivalenzliste laden</button>
		</div><br>
</form>
</div>

<!-- ########## Anzeige der Äquivalenzlisten für ausgewählte Universitäten ############ --> 
<!-- nachdem abgefragt wurde, welche Universitäten geladen werden sollen, können die Fächer aus der Datenbank gelesen werden:-->

<?php
if($showFormular) {
?>
<div class="container main-container">

<form action="?auswahl=1" method="post">

	<table border="1" rules="row" cellspacing="10">
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
			<td align="center"><input type="checkbox" name="kurse[]" value="<?php echo $row['equivalence_id'] ?>" ></td>
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
		<button type="submit" name="auswahl" class="btn btn-lg btn-primary btn-block">Fächerwahl übernehmen</button>
	</div>
</form>


</div>
</div>

<?php 
}
?>


</div>
<?php 
include("templates/footer.inc.php")
?>
<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user(); //zur Prüfung des users in der "user"-Datenbank
$inputDB = 'student_new';
$userid = $user['id'];

//degree list default
$degreelist = 1;

//check whether if student has registered already
$statement = $pdo->prepare("SELECT * FROM student_new 
							LEFT JOIN study_home on study_home.studentid = student_new.personalid 
							WHERE user_id = $userid");
$result = $statement->execute();
$row = $statement->fetch();
$studentid = $row['personalid'];
$student_matno = $row['home_matno'];
$student_firstname = $row['firstname'];
$student_surname = $row['surname'];

$readonly = true;

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
	if(isset($studentid)){
		if(!empty($_POST['kurse'])) {

			/*DELETE all old entries of students in database table 'student_selectedsubjects' then INSERT newly checked equivalent-courses into database*/
				$stmtDelete = $pdo->prepare("DELETE FROM student_selectedsubjects WHERE personalid = $studentid");
				$stmtInsert = $pdo->prepare("INSERT INTO student_selectedsubjects (equivalence_id, personalid) VALUES (?, $studentid)");

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
if(isset($_GET['university'])) {
	if(isset($_GET['home_locationid']) AND isset($_GET['foreign_locationid']) AND ($_GET['home_locationid']>1) AND ($_GET['foreign_locationid']>1)) {
		$home_locationid = $_GET['home_locationid'];
		$foreign_locationid = $_GET['foreign_locationid'];
		/*echo $home_locationid;
		echo $foreign_locationid;*/

		if(isset($_GET['degree_list'])){
			$degreelist = $_GET['degree_list'];
		}

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

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">

		<div class="form-group" style="background-color: #003D76; color: white">
			<table class="table" rules="none">
				<tr>
					<td width="50%" align="center"><label for="Home_uni"><font size="5">Heim-Universität </font><br>(Home-University)</label></th>
					<td width="50%" align="center"><label for="Foreign_uni"><font size="5">Partner-Universität </font><br>(Foreign-University)</label></th>
				</tr>
				<tr>
					<td>
						<select type="text" size="1" name="home_locationid" class="form-control" id="homeuniversity" required>
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
						<select type="text" size="1"  name="foreign_locationid" class="form-control" id="foreignuniversity" required>
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
		<div class="no-printme">
		<input type="submit" name="university" class="btn btn-lg btn-primary btn-block" value="Äquivalenzliste laden">
		</div>
		</div><br>
</div>


<!-- ########## Anzeige der Äquivalenzlisten für ausgewählte Universitäten ############ -->
<!-- nachdem abgefragt wurde, welche Universitäten geladen werden sollen, können die Fächer aus der Datenbank gelesen werden:-->

<?php
if($showFormular) {

?>
<div class="container main-container">

<?php
	if($readonly){
		?>
		<script>
			$(document).ready(function(){
				$("#auswahl").hide();
			});
		</script>
		<?php
	}
?>


<?php
/*Check deadline for selecting equivalence-courses */ /*
	$statement1 = $pdo->prepare("SELECT created_at FROM student_new WHERE user_id = $userid");
	$result = $statement1->execute();
	$row4 = $statement1 ->fetch();
	if(isset($row4)){
		if(((strtotime(date('Y-m-d h:i:sa')) - strtotime($row4['created_at']))/60/60/24) >= 0){
			?><div class="alert alert-warning"><?php
			echo "The selection is no longer available!";
			?></div>
			<script>
			$(document).ready(function(){
					$("#auswahl").hide();
				});
			</script>
			<?php
			$readonly = true;
		}
	}*/
?>

	<div class="panel" id="degreelist-panel">
		<p>Select Degree: </p>
		<select type="text"  name="degreelist" id="degreelist" class="form-control">
			<option value="1" <?php if($degreelist==1) echo "selected"; ?>>Bachelor</option>
			<option value="2" <?php if($degreelist==2) echo "selected"; ?>>Master</option>
			<option value="0" <?php if($degreelist==0) echo "selected"; ?>>All</option>
		</select>
		<button type="button" name="print" id = "print" class="btn btn-lg btn-primary btn-block">Fächerwahlliste ausdrucken</button>
	</div>

	<div class="table-responsive">
	<table class="table table-hover" id = "courses" >
	<thead>
		<tr style="background-color: #003D76; color: white; align: middle">
			<td width="8%" align="center"><b>Auswahl</b><br>(Selection)</th>
			<td width="15%" align="center"><b>Kurs-Nr. Heim-Uni</b><br>(Home-Subject-No.)</th>
			<td width="11%" align="center"><b>Credits Heim-Uni</b><br>(Home-Credits)</th>
			<td width="25%" align="center"><b>Kurs Heim-Uni</b><br>(Home-subject)</th>
			<td width="11%" align="center"><b>Credits Partner-Uni</b><br>(Foreign-Credits)</th>
			<td width="25%" align="center"><b>Kurs Partner-Uni</b><br>(Foreign-subject)</th>
			<td width="5%" align="center"><b>Status</b></th>
		</tr>
	</thead>


		<?php
		/*Query previously selected equivalence-courses' id of the user*/
		$statement = $pdo->prepare("SELECT equivalence_id FROM student_selectedsubjects
									WHERE personalid = $studentid");
		$result = $statement->execute();
		$selectedCourses = array();
		while($selectedCourse = $statement->fetch())
		{
			array_push($selectedCourses, $selectedCourse['equivalence_id']);
		}


		/*Abfrage der vorhandenen Äquivalenzen aus der "equivalent_subjects"-DB*/
		if($degreelist!=0){
			$statement = $pdo->prepare("SELECT es.equivalence_id as equivalence_id, es.status_id as status_id , st.status as status,
			s1.subject_code as home_subject_code, s1.subject_credits as home_subject_credits, s1.subject_title as home_subject_title ,
			s2.subject_credits as foreign_subject_credits, s2.subject_title as foreign_subject_title
			FROM equivalent_subjects es
			LEFT JOIN subjects s1 ON s1.subject_id = es.home_subject_id
			LEFT JOIN subjects s2 ON s2.subject_id = es.foreign_subject_id
			LEFT JOIN equivalence_status st ON st.status_id = es.status_id
			WHERE s1.university_id = $home_locationid AND s2.university_id = $foreign_locationid
			AND s1.degree_id = $degreelist AND s2.degree_id = $degreelist
			ORDER BY es.status_id, es.equivalence_id");
		}else{
			$statement = $pdo->prepare("SELECT es.equivalence_id as equivalence_id, es.status_id as status_id , st.status as status,
			s1.subject_code as home_subject_code, s1.subject_credits as home_subject_credits, s1.subject_title as home_subject_title ,
			s2.subject_credits as foreign_subject_credits, s2.subject_title as foreign_subject_title
			FROM equivalent_subjects es
			LEFT JOIN subjects s1 ON s1.subject_id = es.home_subject_id
			LEFT JOIN subjects s2 ON s2.subject_id = es.foreign_subject_id
			LEFT JOIN equivalence_status st ON st.status_id = es.status_id
			WHERE s1.university_id = $home_locationid AND s2.university_id = $foreign_locationid
			ORDER BY es.status_id, es.equivalence_id");
		}
		$result = $statement->execute();

		while($row = $statement->fetch()) {
			?>
			<?php /*
			if ($status_id == "1") {
				$backcolor = "yellow";
			}
			if ($status_id == "2") {
				$backcolor = "lightgreen";
			}
			if ($status_id == "3") {
				$backcolor = "tomato";

			}*/?>

			<tbody>
			<!-- <tr style="background-color: <?php //echo $backcolor; ?>"> -->
			<tr class="<?php if($row['status_id'] == "1") echo "warning"; else if($row['status_id'] == "2") echo "success"; else if($row['status_id'] == "3") echo "danger";?>">
            <!--check previously selected equivalence-courses and disable declined courses-->
			<?php
				if(!$readonly){
					?><td align="center"><input type="checkbox" name="kurse[]" value="<?php echo $row['equivalence_id'] ?>" <?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "checked" ; if($row['status_id'] == "3") echo "disabled"; ?>></td>
					<?php
				}else{
					?>
					<!-- <td align="center"><i <?php // if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "class='glyphicon glyphicon-ok'" ?>></i></td> -->
					<td align="center"><?php if(in_array($row['equivalence_id'], $selectedCourses, true)) echo "selected" ?></td>
					<?php
				}
			?>
			<td align="center" valign="middle"><?php echo $row['home_subject_code'] ?></td>
			<td align="center"><?php echo $row['home_subject_credits'] ?></td>
			<td align="center"><?php echo $row['home_subject_title'] ?></td>
			<td align="center"><?php echo $row['foreign_subject_credits'] ?></td>
			<td align="center"><?php echo $row['foreign_subject_title'] ?></td>
			<td align="center"><?php echo $row['status'] ?></td>
			</tr>
			</tbody>
			<?php
		}
		?>
	</table>
	</div>

	<div id="elementH"></div>
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

<!-- hide sent button if readonly -->
<?php
if($readonly){
	?>
	<script>
		var x = document.getElementById("auswahl");
  		if (x.style.display === "none") {
    		x.style.display = "block";
  		} else {
    		x.style.display = "none";
  			}
	</script>
	<?php
}

?>

<!-- if university selection changed, hide table and button -->
<script>
$(document).ready(function(){
	$("#homeuniversity").change(function(){
		//$("#auswahl").attr("disabled", true);
		$(".registration-form").hide();
		$("#courses").hide();
		$("#degreelist-panel").hide();
	});

	$("#foreignuniversity").change(function(){
		//$("#auswahl").attr("disabled", true);
		$(".registration-form").hide();
		$("#courses").hide();
		$("#degreelist-panel").hide();
	});
});
</script>

<!-- if degreelist selection changed, hide table and button -->
<script>
$(document).ready(function(){
	$("#degreelist").change(function(){
		var degreelist =  $("#degreelist").val();
		window.location.replace("http://localhost/ddstudportal/test_auswahl.php?home_locationid=4&foreign_locationid=2&degree_list="+degreelist+"&university=%C3%84quivalenzliste+laden");
	});
});
</script>

<!-- get matno -->
<?php 
	echo "<div class=\"$student_matno\" id=\"matno\"></div>";
	echo "<div class=\"$student_surname\" id=\"surname\"></div>";
	echo "<div class=\"$student_firstname\" id=\"firstname\"></div>";
?>

<!-- print list -->
<script>
$(document).ready(function(){
	$("#print").click(function(){
		var homeUni = $("#homeuniversity option:selected").html();
		var foreignUni = $("#foreignuniversity option:selected").html();
		var matno = $("#matno").attr('class');
		var surname = $("#surname").attr('class');
		var firstname = $("#firstname").attr('class');

		var doc = new jsPDF('l', 'mm', 'a4');
		var totalPagesExp = '{total_pages_count_string}';
		var img = new Image();
    	img.src = 'screenshots/UDE-Logo.jpeg';
		
		var pageHeight = doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
		var pageWidth = doc.internal.pageSize.width || doc.internal.pageSize.getWidth();

		var d = new Date();
		var date  =  d.getDate() + "." + (d.getMonth()+1) +  "." +  d.getFullYear();

  		doc.autoTable({ 
			  html: '#courses', 
			//   startY: 20,
			  didDrawPage: function (data) {
					// Header
				  	doc.setFontSize(20);
      				doc.setFontStyle('normal');
					doc.addImage(img, 'JPEG', pageWidth - data.settings.margin.right - 36, 15, 36, 14);
      				doc.text('Fächerwahlliste', pageWidth / 2, 30, 'center');
					doc.setFontSize(10);
					doc.text('Matriculationnummer: ' + matno, data.settings.margin.left  , 20 , 'left');
					doc.text('Nachname: ' + surname, data.settings.margin.left  , 25 , 'left');
					doc.text('Vorname: ' + firstname, data.settings.margin.left , 30 , 'left');
      				doc.text('Home-Uni: ' + homeUni + '	     Foreign-Uni: ' +  foreignUni, pageWidth / 2, 40 , 'center');
					

  				    // Footer
  				    var str = 'Page ' + doc.internal.getNumberOfPages();
  				    // Total page number plugin only available in jspdf v1.0+
  				    if (typeof doc.putTotalPages === 'function') {
  				      str = str + ' of ' + totalPagesExp;
  				    }
  				    doc.setFontSize(10);
				  
  				    // jsPDF 1.4+ uses getWidth, <1.4 uses .width
  				    var pageSize = doc.internal.pageSize;
  				    var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
  				    doc.text(str, pageWidth - data.settings.margin.right - 20 , pageHeight - 10 , 'left');
  				    doc.text(date, data.settings.margin.left, pageHeight - 10);
  				  },
  			  margin: { top: 50 },
  		});
			  
  		// Total page number plugin only available in jspdf v1.0+
  		if (typeof doc.putTotalPages === 'function') {
  		  doc.putTotalPages(totalPagesExp);
  		}

  		doc.save('table.pdf');
	});
});
</script>

<?php
include("templates/footer.inc.php")
?>

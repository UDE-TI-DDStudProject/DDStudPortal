<head>
    <link href="css/style.css" rel="stylesheet">
</head>

<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user(); //zur Prüfung des users in der "user"-Datenbank
$showformular = true;
$error = false;
include("templates/header.inc.php");
?>

<div class = "main"> 

<?php

if(isset($_GET['upload'])) {
	
	if(!$error) { 
		//Namen der Input-Felder - Ggf. anpassen
		$dateinamen = array('Fächerwahlliste', 'Motivationsschreiben', 'Lebenslauf', 'Transkript');
		
			//Schleife für alle Dateien
		foreach ($dateinamen as $value) {
		
		
		if ($_FILES[$value]['error'] == 4) {
			continue; // Skip file if any error found
		}

		$upload_folder = 'uploads/'; //Das Upload-Verzeichnis
		//$filename = Namen_bereinigen(pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME));
		$extension = strtolower(pathinfo($_FILES[$value]['name'], PATHINFO_EXTENSION));
	 
		//Abfrage der PersonalID des Users 
		if(!$error) {	
			$userid = $user['id'];
			//student_id feststellen
			$statement = $pdo->prepare("SELECT personalid FROM student_new WHERE user_id = $userid");
			$result = $statement->execute();
			$personalid = $statement->fetchcolumn(); 
			
			if($result) {
				//
			}
			else {
				?><div class="alert alert-danger"><?php
				echo 'Beim Feststellen der StudentID ist leider ein Fehler aufgetreten<br>';
				?></div><?php
				$error = true;
			}	
			//student_id feststellen ende
		}
	 
		//Überprüfung der Dateiendung
		$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
		if(!in_array($extension, $allowed_extensions)) {
			?><div class="alert alert-danger"><?php
			die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt.");
			?></div><?php
		}

		//Überprüfung der Dateigröße
		$max_size = 500*1024; //500 KB
		if($_FILES[$value]['size'] > $max_size) {
			?><div class="alert alert-danger"><?php
			die("Bitte keine Dateien größer 500kb hochladen");
			?></div><?php
		}
	 
		//Überprüfung dass das Bild keine Fehler enthält
		if(function_exists('exif_imagetype')) { //Die exif_imagetype-Funktion erfordert die exif-Erweiterung auf dem Server
			 $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, "application/pdf");
			 $detected_type = exif_imagetype($_FILES[$value]['tmp_name']);
			 if(!in_array($detected_type, $allowed_types)) {
				?><div class="alert alert-danger"><?php
				die("Nur der Upload von Bilddateien ist gestattet");
				?></div><?php
			 }
		}
	 
		//Pfad zum Upload
		$new_path = $upload_folder.'Student('.$personalid.'-'.$user['nachname'].'-'.$user['vorname'].')-'.$value.'.'.$extension; 

		//Neuer Dateiname falls die Datei bereits existiert
		if(file_exists($new_path)) { //Falls Datei existiert, hänge eine Zahl an den Dateinamen
		 $id = 1;
		 do {
			 $new_path = $upload_folder.'Student('.$personalid.'-'.$user['nachname'].'-'.$user['vorname'].')-'.$value.$id.'.'.$extension;
			 $id++;
		 } while(file_exists($new_path));
		}
	 
		//Alles okay, verschiebe Datei an neuen Pfad
		move_uploaded_file($_FILES[$value]['tmp_name'], $new_path);
		}
	?><div class="alert alert-success"><?php
	echo 'Dateien erfolgreich hochgeladen. Weiter zur <a href="internalCourses.php">Fächerwahl</a>';
	?></div><?php
	$showformular = false;
	}
}
if ($showformular) {
?>

	<div class = "container main-container">
		<div class="head">
			<h1>Datei-Upload</h1>
		</div>

	<div class = "container main-container registration-form">
	<form action="?upload=1" method="post" name="upload" enctype="multipart/form-data"> <!-- register anpassen! -->
		<div class="form-group"> 
			<label for="CourseList"> Ausgefüllte Fächerwahlliste [Excel Format]</label>	
			<input type="file" size="37.5" class="btn btn-primary" name="Fächerwahlliste" accept="text/*" required><br>
		</div>
		
		<div class="form-group"> 
			<label for="CourseList"> Motivationsschreiben [In Englisch und PDF]</label>	
			<input type="file" size="37.5" class="btn btn-primary" name="Motivationsschreiben" accept="text/*" ><br>
		</div>
		
		<div class="form-group"> 
			<label for="CourseList"> Lebenslauf [In Englisch und PDF]</label>	
			<input type="file" size="37.5" class="btn btn-primary" name="Lebenslauf" accept="text/*" ><br>
		</div>
		
		<div class="form-group"> 
			<label for="CourseList"> Aktuelles Transkript/Zeugnis [PDF]</label>	
			<input type="file" size="37.5" class="btn btn-primary" name="Transkript" accept="text/*" ><br>
		</div>
		
		<div class="form-group"> 
			<button type="submit" class="btn btn-lg btn-primary btn-block">Dateien hochladen</button>
		</div>
	</form>
<?php
}
?>
</div>
</div>
</div>
<?php 
include("templates/footer.inc.php")
?>
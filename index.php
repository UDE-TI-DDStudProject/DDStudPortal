<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
include("templates/header.inc.php")
?>

		
      <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="main">

      <div class="container main-container">
			<br>
			<p><font size="6">Herzlich Willkommen!</font></p>

	<!--<div class = "container main-container bg1">
	<div class = "container big-container">-->

        Du bist Studierender der Universität Duisburg-Essen (UDE) und interessierst Dich für ein <b>Auslandssemester in Südostasien</b>? 
		Dann bist Du hier genau richtig! <br><br>
		Vor über 17 Jahren hat die UDE die erste Universität in Südostasien als Partner gewonnen. Seitdem arbeiten wir kontinuierlich an neuen Partnerschaften 
		und daran die bestehenden Partnerschaften weiter auszubauen und zu festigen.
		Die derzeit in Südostasien zur Verfügung stehenden Partneruniversitäten für ein Auslandssemester sind: 
		<p>
		<ul>
			<li style="list-style-type:none;margin-bottom:10px;"><a href="https://www.ukm.my/portal/" target="_blank"><i class="glyphicon glyphicon-education"></i> Universitii Kebangsaan Malaysia</a> (UKM) in Kuala Lumpur, <b>Malaysia</b></li>
			<li style="list-style-type:none;margin-bottom:10px;"><a href="https://www.ui.ac.id/" target="_blank"><i class="glyphicon glyphicon-education"></i> National University of Indonesia</a> (UI) in Jakarta, <b>Indonesien</b></li>
			<li style="list-style-type:none;"><a href="https://www.ntu.edu.sg/oia/Pages/home.aspx" target="_blank"><i class="glyphicon glyphicon-education"></i> Nanyang Technological University</a> (NTU) in <b>Singapur</b></li>
		</ul><p></p>
		Die langjährigen Beziehungen zu unseren Partnern ermöglichen uns, Dir bei deinem Auslandssemester einiges an Arbeit abzunehmen. 
		Im Rahmen deines Austauschprogramms unterstützen wir Dich bei: 
		<p></p>
		<ul>
			<li>Der <b>Bewerbung</b> an der Partneruniversität Deiner Wahl</li>
			<li>Der <b>Visa</b>-Beantragung</li>
			<li>Der <b>Kursbelegung</b> an der Partneruniversität</li>
			<li>Dem richtigen Timing für deine <b>Flugbuchung</b></li>
			<li>Allen Fragen und Problemen während deines Auslandssemesters durch ein Mercator Büro direkt <b>vor Ort</b></li>
			<li>Der <b>Anrechnung</b> von Prüfungsleistungen im Anschluss an dein Auslandssemester</li>
		</ul><p></p>
		Darüber hinaus profitierst Du von Deinen Vorgängern: 
		Wir haben Dir alle Kurse an den Partneruniversitäten in einer Tabelle zusammengefasst, die Du dir an der UDE für einen äquivalenten Kurs in deinem Zeugnis anrechnen lassen kannst.
		So kannst Du dir dein individuelles Kursprogramm vor Abreise zusammenstellen und sicher sein, dass deine Prüfungsleistungen auch für Dein Studium in Deutschland angerechnet werden.
		<br><br>
		Haben wir Dein Interesse geweckt? Dann registriere dich jetzt und bewirb dich bequem über diese Homepage! <br><br>
		Wir freuen uns auf Deine Bewerbung! 	
        </p>
		
		<?php if(!is_checked_in()): ?>
        <p><a class="btn btn-primary btn-lg" href="register.php" role="button">Jetzt registrieren</a></p>
		<?php endif; ?>
	  </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Features</h2>
          <ul>
          	<li>Registrierung & Login</li> 
          	<li>Online-Bewerbungsformular</li>
          	<li>Dateiupload-Bereich</li>
          	<li>Fächerwahllisten abrufen</li>
			<li>Responsives Web-Design</li>
		  </ul>
		  <p><a class="btn btn-default" href="#" target="_blank" role="button">Weitere Informationen &raquo;</a></p>
         
        </div>
        <div class="col-md-4">
          <h2>Impressum</h2>
          <p>Text </p>
          <p><a class="btn btn-default" href="#" target="_blank" role="button">Weitere Informationen &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>Weitere Links</h2>
          <p>Text</p>
          <p><a class="btn btn-default" href="#" target="_blank" role="button">Weitere Informationen &raquo;</a></p>
        </div>
      </div>
	</div> <!-- /container -->
      

  
<?php 
include("templates/footer.inc.php")
?>

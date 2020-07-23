<?php
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();

    if(isset($user) && !empty($user)){
        include("templates/headerlogin.inc.php");
    }else{
        include("templates/header.inc.php");
    }
?>

<main class="container-fluid flex-fill">
    <div class="card homepage-form">
        <!-- page title -->
        <div class="page-title">
            <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Herzlich Willkommen!
        </div>

        <div class="content">
            <p>
                Du bist Studierender der Universität Duisburg-Essen (UDE) und interessierst Dich für ein
                <b>Auslandssemester in Südostasien</b>?
                Dann bist Du hier genau richtig!
            </p>
            <p>
                Vor über 17 Jahren hat die UDE die erste Universität in Südostasien als Partner gewonnen. Seitdem
                arbeiten wir kontinuierlich an neuen Partnerschaften
                und daran die bestehenden Partnerschaften weiter auszubauen und zu festigen.
                Die derzeit in Südostasien zur Verfügung stehenden Partneruniversitäten für ein Auslandssemester sind:
            </p>
            <ul>
                <li style="list-style-type:none;margin-bottom:10px;"><a href="https://www.ukm.my/portal/"
                        target="_blank"><i class="glyphicon glyphicon-education"></i> Universitii Kebangsaan
                        Malaysia</a> (UKM) in Kuala Lumpur, <b>Malaysia</b></li>
                <li style="list-style-type:none;margin-bottom:10px;"><a href="https://www.ui.ac.id/" target="_blank"><i
                            class="glyphicon glyphicon-education"></i> National University of Indonesia</a> (UI) in
                    Jakarta, <b>Indonesien</b></li>
                <li style="list-style-type:none;"><a href="https://www.ntu.edu.sg/oia/Pages/home.aspx"
                        target="_blank"><i class="glyphicon glyphicon-education"></i> Nanyang Technological
                        University</a> (NTU) in <b>Singapur</b></li>
            </ul>
            <p>
                Die langjährigen Beziehungen zu unseren Partnern ermöglichen uns, Dir bei deinem Auslandssemester
                einiges an Arbeit abzunehmen.
                Im Rahmen deines Austauschprogramms unterstützen wir Dich bei:
            </p>
            <ul>
                <li>Der <b>Bewerbung</b> an der Partneruniversität Deiner Wahl</li>
                <li>Der <b>Visa</b>-Beantragung</li>
                <li>Der <b>Kursbelegung</b> an der Partneruniversität</li>
                <li>Dem richtigen Timing für deine <b>Flugbuchung</b></li>
                <li>Allen Fragen und Problemen während deines Auslandssemesters durch ein Mercator Büro direkt <b>vor
                        Ort</b></li>
                <li>Der <b>Anrechnung</b> von Prüfungsleistungen im Anschluss an dein Auslandssemester</li>
            </ul>
            <p>
                Darüber hinaus profitierst Du von Deinen Vorgängern:
                Wir haben Dir alle Kurse an den Partneruniversitäten in einer Tabelle zusammengefasst, die Du dir an der
                UDE für einen äquivalenten Kurs in deinem Zeugnis anrechnen lassen kannst.
                So kannst Du dir dein individuelles Kursprogramm vor Abreise zusammenstellen und sicher sein, dass deine
                Prüfungsleistungen auch für Dein Studium in Deutschland angerechnet werden.
            </p>
            <p>
                Haben wir Dein Interesse geweckt? Dann registriere dich jetzt und bewirb dich bequem über diese
                Homepage!
            </p>
            <p>
                Wir freuen uns auf Deine Bewerbung!
            </p>

            <?php if(empty($user)): ?>
            <p><a class="btn btn-primary btn-lg" href="register.php" role="button" style="color:#ffffff;">Jetzt
                    registrieren</a></p>
            <?php endif; ?>
        </div>

    </div>
</main>


<?php
    include("templates/footer.inc.php");
?>
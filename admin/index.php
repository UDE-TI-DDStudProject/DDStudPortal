<?php 
    session_start();
    require_once("../inc/config.inc.php");
    require_once("../inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_admin();

    if(empty($user)){
        header("location: login.php");
        exit;
    }

?>

<?php     
    include("templates/headerlogin.inc.php");  
?>

<main class="container-fluid flex-fill">
    <div class="card application-form">

        <!-- dashboard title -->
        <div class="title-row" style="display: flex; justify-content: space-between;">
            <!-- page title -->
            <div class="page-title">
                <span><img src="../screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Wilkommen zum Admin-Dashboard
            </div>

            <!-- <div class="title-button">
                <form action="logout.php" method="post">
                    <div class="text-right">
                        <button type="submit" class="btn btn-outline-secondary btn-sm" name="logout"> ausloggen</button>
                    </div>
                </form>
            </div> -->
        </div>

        <!-- dashboard -->
        <div class="admin-dashboard">

            <!-- edit facherwahlliste quota -->
            <div class="dashboard-flex-item">
                <h5 class="card-title">Anzahl Kursplätze</h5>
                <p class="card-text">Anzahl Kursplätze in Fächerwahllisten ändern.</p>
                <a href="equivalence_quota.php" class="btn btn-primary">Klick hier</a>
            </div>

             <!-- See all bewerbungen -->
            <div class="dashboard-flex-item">
                <h5 class="card-title">Alle Bewerbungen</h5>
                <p class="card-text">Übersicht Bewerbungen aller Studierenden eines Semesters.</p>
                <a href="open_applications.php" class="btn btn-primary">Klick hier</a>
            </div>

            <!-- See Exchange Facherwahlliste  -->
            <div class="dashboard-flex-item">
                <h5 class="card-title">Übersicht Fächerwahlen</h5>
                <p class="card-text">Übersicht Fächerwahllisten aller Studierenden eines Semesters.</p>
                <a href="applied_equivalence.php" class="btn btn-primary">Klick hier</a>
            </div>

            <!-- add admin to admin_list -->
            <div class="dashboard-flex-item">
                <h5 class="card-title">Neuen Admin eintragen</h5>
                <p class="card-text">Neue E-Mail Adresse in Admin-Liste hinzufügen.</p>
                <a href="add_new_admin.php" class="btn btn-primary">Klick hier</a>
            </div>

            <!-- edit facherwahlliste -->
            <div class="dashboard-flex-item">
                <h5 class="card-title">Fächerwahlliste bearbeiten</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="equivalence_list.php" class="btn btn-primary">Klick hier</a>
            </div>

            <!-- edit exchange semester -->
            <div class="dashboard-flex-item">
                <h5 class="card-title">Auslandssemester bearbeiten</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="edit_auslandssemester.php" class="btn btn-primary">Klick hier</a>
            </div>
        
        </div>
    </div>

</main>




<?php 
    include("templates/footer.inc.php");
?>
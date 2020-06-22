<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_admin();

    if(!isset($user)){
        header("location: admin_login.php");
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
                <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Wilkommen zum Admin-Dashboard
            </div>

            <div class="title-button">
                <form action="logout.php" method="post">
                    <div class="text-right">
                        <button type="submit" class="btn btn-outline-secondary btn-sm" name="logout"> ausloggen</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- dashboard -->
        <div class="admin-dashboard">
            <!-- add admin to admin_list -->
            <div class="card dashboard-item">
                <div class="card-body">
                    <h5 class="card-title">Neuen Admin eintragen</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="add_admin.php" class="btn btn-primary">Klick hier</a>
                </div>
            </div>

            <!-- edit facherwahlliste -->
            <div class="card dashboard-item">
                <div class="card-body">
                    <h5 class="card-title">Fächerwahlliste bearbeiten</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="edit_equivalence_list.php" class="btn btn-primary">Klick hier</a>
                </div>
            </div>

            <!-- edit facherwahlliste quota -->
            <div class="card dashboard-item">
                <div class="card-body">
                    <h5 class="card-title">Kursplätze bearbeiten</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="admin_edit_equivalence_quota.php" class="btn btn-primary">Klick hier</a>
                </div>
            </div>
        
        </div>
    </div>

</main>




<?php 
    include("templates/footer.inc.php");
?>
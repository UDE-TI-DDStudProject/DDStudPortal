<?php 
    session_start();
    require_once("../inc/config.inc.php");
    require_once("../inc/functions.inc.php");

    //redirect user to login if the user has not login
    $user = check_admin();

    if(empty($user)){
        header("location: login.php");
        exit;
    }

    //after form submit
    if(isset($_POST['add_admin'])){
        if(isset($_POST['email']) && isset($_POST['passwort'])) {
            $email = trim($_POST['email']);
            $passwort = $_POST['passwort'];
        
            //Überprüfung des Passworts
            if (password_verify($passwort, $user['password'])) {
                //check if admin exists in database
                $statement = $pdo->prepare("SELECT * FROM admin_list WHERE admin_email = :email");
                $result = $statement->execute(array('email' => $email));            
                $admin = $statement->fetch();
    
                if(empty($admin)){
                    //insert admin to admin_list database
                    $statement = $pdo->prepare("INSERT INTO admin_list(admin_email) VALUES (:email)");
                    $result = $statement->execute(array('email' => $email));    
    
                    //check if admin added to database
                    $statement = $pdo->prepare("SELECT * FROM admin_list WHERE admin_email = :email");
                    $result = $statement->execute(array('email' => $email));            
                    $admin = $statement->fetch();
    
                    if(!empty($admin)){
                        $success_msg =  $email." ist erfolgreich hinzugefügt!";
                    }else{
                        $error_msg =  "Beim Speichern ist ein Fehler aufgetreten!";
                    }
                }
    
    
            } else {
                $error_msg =  "Passwort war ungültig!";
            }
        }else{
            $error_msg =  "Bitte alle Felder ausfüllen!";
        }
    }


?>

<?php     
    include("templates/headerlogin.inc.php");  
?>

<main class="container-fluid flex-fill">
    <div class="card add-admin-form">

        <!-- title row -->
        <div class="title-row" style="display: flex; justify-content: space-between;">
            <!-- page title -->
            <div class="page-title">
                <span><img src="../screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Neuen Admin hinzufügen
            </div>

            <div class="title-button">
                <form action="index.php" method="post">
                    <div class="text-right">
                        <button type="submit" class="btn btn-outline-secondary btn-sm" name="logout"> Zurück zum Dashboard</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- show message -->
        <?php 
        if(isset($success_msg) && !empty($success_msg)):
        ?>
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $success_msg; ?>
        </div>
        <?php 
        endif;
        ?>

        <?php 
        if(isset($error_msg) && !empty($error_msg)):
        ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $error_msg; ?>
        </div>
        <?php 
        endif;
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="needs-validation" id="adminForm"
            novalidate>
            <div class="form-group">
                <label for="email">E-Mail des neuen Admins</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-Mail"
                    value="<?php if(isset($email)) echo $email?>" required>
                <div id="emailFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="passwort">Dein Passwort</label>
                <input type="password" name="passwort" class="form-control" id="inputPassword" placeholder="Passwort"
                    required>
                <div id="passwordFeedback" class="invalid-feedback"></div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="btnAdd" name="add_admin">hinzufügen</button>
        </form>
    </div>
</main>


<script>
$(document).ready(function() {

});
</script>

<?php 
    include("templates/footer.inc.php");
?>
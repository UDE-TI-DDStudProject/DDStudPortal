<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();

    if(isset($user)){
        if($user['user_group_id']==1){
            //student
            header("location: status_application.php");
        }else{
            //admin
            header("location: admin/index.php");
        }
        exit;
    }

    //after form submit
    if(isset($_POST['email']) && isset($_POST['passwort'])) {
        $email = trim($_POST['email']);
        $passwort = $_POST['passwort'];
    
        $statement = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();
    
        //Überprüfung des Passworts
        if ($user !== false && password_verify($passwort, $user['password'])) {
            $_SESSION['userid'] = $user['user_id'];
        
            //Möchte der Nutzer angemeldet beleiben?
            if(isset($_POST['rememberMe'])) {

                $identifier = random_string();
                $securitytoken = random_string();

                $insert = $pdo->prepare("INSERT INTO securitytoken (user_id, identifier, securitytoken) VALUES (:user_id, :identifier, :securitytoken)");
                $insert->execute(array('user_id' => $user['user_id'], 'identifier' => $identifier, 'securitytoken' => sha1($securitytoken)));
                setcookie("identifier",$identifier,time()+(3600*24*365)); //Valid for 1 year
                setcookie("securitytoken",$securitytoken,time()+(3600*24*365)); //Valid for 1 year
            }
            if($user['user_group_id']==1){
                //student
                header("location: status_application.php");
            }else{
                //admin
                header("location: admin/index.php");
            }
            exit;
            // header("location: status_application.php");
            // exit;
        } else {
            $error_message =  "E-Mail oder Passwort war ungültig!";
        }
    }

?>

<?php     
    include("templates/header.inc.php");  
?>

<main class="container-fluid flex-fill">
    <div class="card login-form">
        <?php if(isset($error_message)) echo 
        "<div class=\"alert alert-danger\" role=\"alert\">
          $error_message
        </div>" ?>
        <img class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="needs-validation" id="loginForm"
            novalidate>
            <div class="form-group">
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-Mail"
                    value="<?php if(isset($email)) echo $email?>" required>
                <div id="emailFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <input type="password" name="passwort" class="form-control" id="inputPassword" placeholder="Passwort"
                    required>
                <div id="passwordFeedback" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input form-control-sm" id="rememberMe"
                        name="rememberMe" checked>
                    <label class="custom-control-label col-form-label-sm" for="rememberMe">angemeldet bleiben</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="btnLogin" name="loginMain">Login</button>
        </form>
        <br>
        <small><a href="forgetpassword.php">Passwort vergessen</a></small>
        <small><a href="register.php">Registieren</a></small>
    </div>
</main>


<script>
$(document).ready(function() {

    // $('#loginForm').find('input, select').each(function(){
    //     var required = this['required'];
    // }); 

    //form validation 
    $("#loginForm").submit(function(e) {

        // var error = false;

        // $('#loginForm').find('input, select').each(function(){
        //     var require = this['required'];
        //     var id = this['id'];
        //     var name = this['name'];
        //     var feedback = name + 'Feedback';

        //     var validated = required(id, feedback);

        //     if(validated==false){
        //         error = true;
        //     }
        // }); 

        var validateEmail = required("inputEmail", "emailFeedback", "Email cannot be empty");
        var validatePassword = required("inputPassword", "passwordFeedback",
            "Password cannot be empty");

        if (validateEmail == false || validatePassword == false) {
            e.preventDefault();
        }
    });
});
</script>

<?php 
    include("templates/footer.inc.php");
?>
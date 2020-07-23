<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();

    if(empty($user)){
        header("location: login.php");
        exit;
    }

    $salutationid = $user["salutation_id"];
    $firstname = $user["firstname"];
    $lastname = $user["lastname"];
    $email = $user["email"];

    if(isset($_POST['btnPersonal'])) {
    
    	$activeTab = "personaldata";
    	$firstname = trim($_POST['firstname']);
    	$lastname = trim($_POST['lastname']);
    	$salutationid = trim($_POST['salutation']);
    
    	if($firstname == "" || $lastname == "") {
    		$error_msg = "Bitte Vor- und Nachname ausfüllen.";
    	} else {
    		$statement = $pdo->prepare("UPDATE user SET firstname = :vorname, lastname = :nachname, salutation_id = :salutation WHERE user_id = :userid");
    		$result = $statement->execute(array('vorname' => $firstname, 'nachname'=> $lastname, 'salutation' => $salutationid, 'userid' => $user['user_id'] ));
        
    		$success_msg = "Daten erfolgreich gespeichert.";
    	}

    }else if(isset($_POST['btnEmail'])) {
    		$activeTab = "email";
    		$passwort = $_POST['password'];
    		$email = strtolower(trim($_POST['emailNew']));
    		$email2 = strtolower(trim($_POST['emailNew1']));
    
    		if($email != $email2) {
    			$error_msg = "Die eingegebenen E-Mail-Adressen stimmten nicht überein.";
    		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    			$error_msg = "Bitte eine gültige E-Mail-Adresse eingeben.";
    		} else if(!password_verify($passwort, $user['password'])) {
    			$error_msg = "Bitte korrektes Passwort eingeben.";
    		} else {
    			$statement = $pdo->prepare("UPDATE user SET email = :email WHERE user_id = :userid");
    			$result = $statement->execute(array('email' => $email, 'userid' => $user['user_id'] ));
            
    			$success_msg = "E-Mail-Adresse erfolgreich gespeichert.";
    		}

    } else if(isset($_POST['btnPassword'])) {
    	$activeTab = "password";
    	$passwortAlt = $_POST['passwordOld'];
    	$passwortNeu = trim($_POST['passwordNew']);
    	$passwortNeu2 = trim($_POST['passwordNew1']);
    
    	if($passwortNeu != $passwortNeu2) {
    		$error_msg = "Die eingegebenen Passwörter stimmten nicht überein.";
    	} else if($passwortNeu == "") {
    		$error_msg = "Das Passwort darf nicht leer sein.";
    	} else if(!password_verify($passwortAlt, $user['password'])) {
    		$error_msg = "Bitte korrektes Passwort eingeben.";
    	} else {
    		$passwort_hash = password_hash($passwortNeu, PASSWORD_DEFAULT);
        
    		$statement = $pdo->prepare("UPDATE user SET password = :passwort WHERE user_id = :userid");
    		$result = $statement->execute(array('passwort' => $passwort_hash, 'userid' => $user['user_id'] ));
        
    		$success_msg = "Passwort erfolgreich gespeichert.";
    	}
    
    }else if(isset($_POST['btnDelete'])) {
    	$passwort = $_POST['password'];
    
    	if(!password_verify($passwort, $user['password'])) {
        $error_msg = "Bitte korrektes Passwort eingeben.";
      }else {
    		$statement = $pdo->prepare("DELETE FROM user WHERE user_id = :userid");
    		$result = $statement->execute(array('userid' => $user['user_id'] ));
        
        header("location: logout.php");
        exit;      
    	}
    
    }
    


$user = check_user();

?>

<?php     
    include("templates/headerlogin.inc.php");  
?>

<main class="container-fluid flex-fill">
    <div class="card setup-form">
        <!-- page title -->
        <div class="page-title">
            <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Einstellungen
        </div>
        <!-- tab navigation -->
        <nav class="nav-application-form">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="tab1" data-toggle="tab" href="#personaldata" role="tab"
                    aria-controls="personaldata" aria-selected="true">Persönliche Daten</a>
                <a class="nav-item nav-link" id="tab2" data-toggle="tab" href="#email" role="tab" aria-controls="email"
                    aria-selected="false">E-Mail</a>
                <a class="nav-item nav-link" id="tab3" data-toggle="tab" href="#password" role="tab"
                    aria-controls="password" aria-selected="false">Passwort</a>
                <a class="nav-item nav-link" id="tab4" data-toggle="tab" href="#deleteaccount" role="tab"
                    aria-controls="deleteaccount" aria-selected="false">Account löschen</a>
            </div>
        </nav>

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


        <!-- tab content -->
        <div class="tab-content" id="nav-tabContent">
            <!-- personaldata -->
            <div class="tab-pane fade show active" id="personaldata" role="tabpanel" aria-labelledby="tab1">
                <!-- form -->
                <form id="personalForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
                    class="needs-validation" novalidate>
                    <div class="form-group row">
                        <label for="inputSalutation"
                            class="col-sm-3 col-form-label col-form-label-sm">Salutation</label>
                        <div class="col-sm-9">
                            <select class="form-control form-control-sm" id="inputSalutation" name="salutation"
                                placeholder="salutation" required>
                                <?php
							  $statement = $pdo->prepare("SELECT * FROM salutation");
							  $result = $statement->execute();
							  while($row = $statement->fetch()) { ?>
                                <option value="<?php echo ($row['salutation_id'])?>"
                                    <?php if(isset($salutationid) and $salutationid == $row['salutation_id']) echo "selected"; ?>>
                                    <?php echo ($row['name'])?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputFirstname" class="col-sm-3 col-form-label col-form-label-sm">Vorname</label>
                        <div class="col-sm-9">
                            <input type="text" name="firstname" class="form-control form-control-sm" id="inputFirstname"
                                placeholder="Vorname" value="<?php if(isset($firstname)) echo $firstname?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLastname" class="col-sm-3 col-form-label col-form-label-sm">Nachname</label>
                        <div class="col-sm-9">
                            <input type="text" name="lastname" class="form-control form-control-sm" id="inputLastname"
                                placeholder="Nachname" value="<?php if(isset($lastname)) echo $lastname?>" required>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="btnPersonal"
                            name="btnPersonal">Speichern</button>
                    </div>
                </form>
            </div>

            <!-- email -->
            <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="tab2">
                <!-- form -->
                <form id="emailForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="needs-validation"
                    novalidate>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label col-form-label-sm">E-Mail</label>
                        <div class="col-sm-9">
                            <input type="email" name="emailCurr" class="form-control-plaintext form-control-sm"
                                id="emailCurr" value="<?php if(isset($email)) echo $email?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Passwort</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control form-control-sm"
                                id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label col-form-label-sm">Neue E-Mail</label>
                        <div class="col-sm-9">
                            <input type="email" name="emailNew" class="form-control form-control-sm" id="inputEmailNew">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmailNew" class="col-sm-3 col-form-label col-form-label-sm">Neue E-Mail
                            wiederholen</label>
                        <div class="col-sm-9">
                            <input type="email" name="emailNew1" class="form-control form-control-sm"
                                id="inputEmailNew">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="btnEmail" name="btnEmail">Speichern</button>
                    </div>
                </form>
            </div>

            <!-- password -->
            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="tab3">
                <!-- form -->
                <form id="passwordForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
                    class="needs-validation" novalidate>
                    <div class="form-group row">
                        <label for="inputPasswordOld" class="col-sm-3 col-form-label col-form-label-sm">Passwort</label>
                        <div class="col-sm-9">
                            <input type="password" name="passwordOld" class="form-control form-control-sm"
                                id="inputPasswordOld">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPasswordNew" class="col-sm-3 col-form-label col-form-label-sm">Neues
                            Passwort</label>
                        <div class="col-sm-9">
                            <input type="password" name="passwordNew" class="form-control form-control-sm"
                                id="inputPasswordNew">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPasswordNew" class="col-sm-3 col-form-label col-form-label-sm">Neues Passwort
                            wiederholen</label>
                        <div class="col-sm-9">
                            <input type="password" name="passwordNew1" class="form-control form-control-sm"
                                id="inputPasswordNew">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="btnPassword"
                            name="btnPassword">Speichern</button>
                    </div>
                </form>
            </div>

            <!-- delete account -->
            <div class="tab-pane fade" id="deleteaccount" role="tabpanel" aria-labelledby="tab4">
                <!-- form -->
                <div class="alert alert-warning">
                    <?php echo "Deine Daten werden gelöscht, nachdem dein Account gelöscht ist!"; ?>
                    <?php //echo "By removing your account, all your data will be deleted!"; ?>
                </div>
                <form id="deleteAccount" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
                    class="needs-validation" novalidate>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Passwort</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control form-control-sm"
                                id="inputPassword">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-danger" id="btnDelete" name="btnDelete">Account
                            löschen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

<?php
if(isset($activeTab)){
	echo "<script>
	$(document).ready(function(){
		showTab('$activeTab');
	});

	function showTab(tab){
		$('.nav-tabs a[href=\"#' + tab + '\"]').tab('show');
	};
	</script>";
}
?>

<?php 
    include("templates/footer.inc.php");
?>
<?php 
    session_start();
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");

    //redirect user to homepage if the user has already login
    $user = check_user();
    $user_id = $user['user_id'];

    if(!isset($user)){
        header("location: testlogin.php");
        exit;
    }

    if(!isset($_GET['id'])){
        header("location: test_status.php");
        exit;
    }

    if(isset($_GET['submitsuccess'])){
        $success_msg = "Bewerbung abgeschickt!";
    }else if(isset($_GET['editsuccess'])){
        $success_msg = "Bewerbung gespeichert!";
    }else if(isset($_GET['editabort'])){
        $error_msg = "Application cannot be edited after deadline!";
    }

    $applicationid = $_GET['id'];
    $salutationid = $user["salutation_id"];
    $firstname = $user["firstname"];
    $lastname = $user["lastname"];
    $email = $user["email"];

    //get salutation name
    if(isset($salutationid)){
        $statement = $pdo->prepare("SELECT * FROM salutation WHERE salutation_id = :id");
        $result = $statement->execute(array('id' => $salutationid));
        $salutation = $statement->fetch();
    }
    
    //set database table variables
    $studentDB = "student";
    $applicationDB = "application";
    $homeaddressDB = "address";
    $homestudyDB = "study_home";
    $priorityDB = "priority";
      
    //set server location
    $file_server = "uploads";

    //Get data
    $statement = $pdo->prepare("SELECT st.*, ct.name as country FROM student st
                                LEFT JOIN country ct on ct.country_id = st.nationality_country_id WHERE user_id = :id");
    $result = $statement->execute(array('id' => $user['user_id']));
    $student = $statement->fetch();

    $studentid = $student['student_id'];
    $nationality = $student['country'];
    $birthday = $student['birthdate'];

    $statement = $pdo->prepare("SELECT ap.*, ap.created_at as submitted, it.name as intention, ep.exchange_semester, dg.name as degree 
                                FROM application ap
                                LEFT JOIN intention it on it.intention_id = ap.intention_id 
                                LEFT JOIN exchange_period ep on ep.period_id = ap.exchange_period_id 
                                LEFT JOIN degree dg on dg.degree_id = ap.applied_degree_id 
                                WHERE application_id = :id");
    $result = $statement->execute(array('id' => $applicationid));
    $application = $statement->fetch();

    $submitted = $application['submitted'];
    $intention = $application['intention'];
    $starting_semester = $application['exchange_semester'];
    $foreign_degree = $application['degree'];

    $statement = $pdo->prepare("SELECT ad.*, ct.name as country FROM address ad
                                LEFT JOIN country ct on ct.country_id = ad.country_id WHERE address_id = :id");
    $result = $statement->execute(array('id' => $application['home_address_id']));
    $homeaddress = $statement->fetch();

    $home_street = $homeaddress['street'];
    $home_zip = $homeaddress['zipcode'];
    $home_city = $homeaddress['city'];
    $home_state = $homeaddress['state'];
    $home_country = $homeaddress['country'];
    $home_phone = $homeaddress['phone_no'];

    $statement = $pdo->prepare("SELECT sh.*, ROUND(sh.home_credits) as credits, ROUND(sh.home_cgpa,1) as cgpa,
                                uni.name as home_uni, dg.name as home_degree, cr.name as home_course  
                                FROM study_home sh 
                                LEFT JOIN university uni on uni.university_id = sh.home_university_id 
                                LEFT JOIN degree dg on dg.degree_id = sh.home_degree_id 
                                LEFT JOIN course cr on cr.course_id = sh.home_course_id 
                                WHERE application_id = :id");
    $result = $statement->execute(array('id' => $application['application_id']));
    $homestudy = $statement->fetch();

    $home_university = $homestudy['home_uni'];
    $home_degree =  $homestudy['home_degree'];
    $home_course =  $homestudy['home_course'];
    $home_matno =  $homestudy['home_matno'];
    $home_enrollment =  $homestudy['home_enrollment_date'];
    $home_semester =  $homestudy['home_semester'];
    $home_credits =  $homestudy['credits'];
    $home_cgpa =  $homestudy['cgpa'];

    $statement = $pdo->prepare("SELECT uni1.name as uni1, uni2.name as uni2, uni3.name as uni3 FROM priority  pr
                                LEFT JOIN university uni1 on uni1.university_id = pr.first_uni_id 
                                LEFT JOIN university uni2 on uni2.university_id = pr.second_uni_id 
                                LEFT JOIN university uni3 on uni3.university_id = pr.third_uni_id 
                                WHERE application_id = :id");
    $result = $statement->execute(array('id' => $application['application_id']));
    $priority = $statement->fetch();

    $first_uni = $priority['uni1'];
    $second_uni = $priority['uni2'];
    $third_uni = $priority['uni3'];

    $statement = $pdo->prepare("SELECT * FROM exchange_period WHERE period_id = :id");
    $result = $statement->execute(array('id' => $application['exchange_period_id']));
    $period = $statement->fetch();

    //set form readonly after deadline
    if(isset($period)){
      $deadline = $period['application_end'];

      if(((strtotime(date('Y-m-d h:i:sa')) - strtotime($deadline))/60/60/24) >= 0){
          $readonly = true;
      }else{
          $readonly = false;
      }
    }
?>

<?php 
    if(isset($_POST['edit'])){
        header('location: test_application.php?id='.$applicationid);
        exit;
    }
    else if(isset($_POST['delete'])){
        try {
            //check error in qeuries and throw exception if error found
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
            $pdo->beginTransaction();

            $statement = $pdo->prepare("DELETE FROM $homestudyDB WHERE application_id = :id");
            $result = $statement->execute(array('id' => $application['application_id']));
            $result = $statement->fetch();
    
            $statement = $pdo->prepare("DELETE FROM $priorityDB WHERE application_id = :id");
            $result = $statement->execute(array('id' => $application['application_id']));
            $result = $statement->fetch();
    
            $statement = $pdo->prepare("DELETE FROM $applicationDB WHERE application_id = :id");
            $result = $statement->execute(array('id' => $application['application_id']));
            $result = $statement->fetch();

            $statement = $pdo->prepare("DELETE FROM $homeaddressDB WHERE address_id = :id");
            $result = $statement->execute(array('id' => $application['home_address_id']));
            $result = $statement->fetch();

            $pdo->commit();
            header("location: test_status.php?application_removed=1");
            exit;

        }catch (PDOException $e){
            $pdo->rollback();
            $error_msg = $e->getMessage();
          }
    }
?>

<?php     
    include("templates/testheaderlogin.php");  
?>

<main class="container-fluid flex-fill">
    <div class="card view-application-form">
        <!-- page title -->
        <div class="page-title">
            <span><img src="screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Application
        </div>

        <div class="page-navigation">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="test_status.php">Homepage</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Application</li>
                <li class="breadcrumb-item"><a href="test_facherwahl.php?id=<?php echo $applicationid;?>">Subject Selection</a></li>
              </ol>
            </nav>
        </div>
        <!-- <small class="submitted-date" id="<?php echo $submitted; ?>">submitted on <?php echo $submitted; ?></small> -->
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

        <div class="container">
        <div class="text-right">
            <button type="button" class="btn btn-success btn-sm" id="print">Ausdrucken</button>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-hover table-sm" id="application">
              <tbody>
              <tr class="d-flex">
                  <td class="col-sm-3">Submitted on</td>
                  <td class="col-sm-9"><?php if(isset($submitted)) echo $submitted ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Salutation</td>
                  <td class="col-sm-9"><?php if(isset($salutation)) echo $salutation['name'] ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Vorname</td>
                  <td class="col-sm-9"><?php if(isset($firstname)) echo $firstname ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Nachname</td>
                  <td class="col-sm-9"><?php if(isset($lastname)) echo $lastname ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">E-Mail</td>
                  <td class="col-sm-9"><?php if(isset($email)) echo $email ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Nationalität</td>
                  <td class="col-sm-9"><?php if(isset($nationality)) echo $nationality ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Geburtsdatum</td>
                  <td class="col-sm-9"><?php if(isset($birthday)) echo $birthday ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Straße und Haus-Nr.</td>
                  <td class="col-sm-9"><?php if(isset($home_street)) echo $home_street ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">PLZ</td>
                  <td class="col-sm-9"><?php if(isset($home_zip)) echo $home_zip ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Ort</td>
                  <td class="col-sm-9"><?php if(isset($home_city)) echo $home_city ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Bundesland</td>
                  <td class="col-sm-9"><?php if(isset($home_state)) echo $home_state ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Land</td>
                  <td class="col-sm-9"><?php if(isset($home_country)) echo $home_country ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Telefonnummer</td>
                  <td class="col-sm-9"><?php if(isset($home_phone)) echo $home_phone ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Aktuelle Universität</td>
                  <td class="col-sm-9"><?php if(isset($home_university)) echo $home_university ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Derzeit angestrebter Abschluss</td>
                  <td class="col-sm-9"><?php if(isset($home_degree)) echo $home_degree ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Aktueller Studiengang</td>
                  <td class="col-sm-9"><?php if(isset($home_course)) echo $home_course ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Matrikelnummer</td>
                  <td class="col-sm-9"><?php if(isset($home_matno)) echo $home_matno ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Monat/Jahr der Einschreibung in aktuellen Studiengang(month/year of enrollment):</td>
                  <td class="col-sm-9"><?php if(isset($home_enrollment)) echo $home_enrollment ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Fachsemester aktueller Studiengang (semester):</td>
                  <td class="col-sm-9"><?php if(isset($home_semester)) echo $home_semester ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Summe bisher erworbener Kreditpunkte laut beigefügtem Transkript (Credits):</td>
                  <td class="col-sm-9"><?php if(isset($home_credits)) echo $home_credits ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Durchschnittsnote laut beigefügtem Transkript (CGPA/ Average Grade)):</td>
                  <td class="col-sm-9"><?php if(isset($home_cgpa)) echo $home_cgpa ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Programm (type of transfer):</td>
                  <td class="col-sm-9"><?php if(isset($intention)) echo $intention ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Beginn des Austauschs (start of transfer):</td>
                  <td class="col-sm-9"><?php if(isset($starting_semester)) echo $starting_semester ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Während des geplanten Auslandsemester werde ich voraussichtlich Student sein in (abroad degree):</td>
                  <td class="col-sm-9"><?php if(isset($foreign_degree)) echo $foreign_degree ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">1. Priorität (1. priority):</td>
                  <td class="col-sm-9"><?php if(isset($first_uni)) echo $first_uni ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">2. Priorität (2. priority):</td>
                  <td class="col-sm-9"><?php if(isset($second_uni)) echo $second_uni ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">3. Priorität (3. priority):</td>
                  <td class="col-sm-9"><?php if(isset($third_uni)) echo $third_uni ?></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Fächerwahlliste</td>
                  <td class="col-sm-9"></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Motivationsschreiben</td>
                  <td class="col-sm-9"></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Lebenslauf</td>
                  <td class="col-sm-9"></td>
                </tr>
                <tr class="d-flex">
                  <td class="col-sm-3">Transkript</td>
                  <td class="col-sm-9"></td>
                </tr>
              </tbody>
            </table>
            <div class="text-right">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $applicationid; ?>" method="post">
                <button type="submit" class="btn btn-primary btn-sm" name="edit" <?php if($readonly) echo "disabled" ?>>Editieren</button>
                <button type="submit" class="btn btn-danger btn-sm" name="delete">Löschen</button>
                </form>
            </div>
        </div>
        </div>
    </div>
</main>

<!-- get matno -->
<?php 
	echo "<div class=\"$home_matno\" id=\"matno\"></div>";
	// echo "<div class=\"$lastname\" id=\"surname\"></div>";
	// echo "<div class=\"$firstname\" id=\"firstname\"></div>";
	// echo "<div class=\"$home_university_title\" id=\"homeUni\"></div>";
	// echo "<div class=\"$first_uni_title\" id=\"firstUni\"></div>";
	// echo "<div class=\"$second_uni_title\" id=\"secondUni\"></div>";
	// echo "<div class=\"$third_uni_title\" id=\"thirdUni\"></div>";
?>

<!-- print list -->
<script>
$(document).ready(function(){
	$("#print").click(function(){

		var submitteddate = $(".submitted-date").attr('id');
		var Matriculationnummer = $("#matno").attr('class');

		var doc = new jsPDF('p', 'mm', 'a4');
		var totalPagesExp = '{total_pages_count_string}';
		var img = new Image();
    	img.src = 'screenshots/UDE-Logo.jpeg';
		
		var pageHeight = doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
		var pageWidth = doc.internal.pageSize.width || doc.internal.pageSize.getWidth();

		var d = new Date();
		var date  =  d.getDate() + "." + (d.getMonth()+1) +  "." +  d.getFullYear();

  		doc.autoTable({ 
			  html: "#application", 
			  //html: '#courses', 
			//   startY: 20,
			  didDrawPage: function (data) {
					// Header
				  	doc.setFontSize(20);
      				doc.setFontStyle('normal');
					doc.addImage(img, 'JPEG', pageWidth - data.settings.margin.right - 36, 15, 36, 14);
      				doc.text('Application', pageWidth / 2, 30, 'center');
					doc.setFontSize(10);
					doc.text('Submitted on: ' + submitteddate, data.settings.margin.left  , 20 , 'left');
					doc.text('Matriculationnummer: ' + Matriculationnummer.toString(), data.settings.margin.left  , 25 , 'left');
					// doc.text('Nachname: ' + surname, data.settings.margin.left  , 25 , 'left');
					// doc.text('Vorname: ' + firstname, data.settings.margin.left , 30 , 'left');
      				// doc.text('Home-Uni: ' + homeUni + '	     Foreign-Uni: ' +  foreignUni, pageWidth / 2, 40 , 'center');
					

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

  		doc.save(Matriculationnummer + '_' +'Application'+ '_' + date +'.pdf');
	});
});
</script>


<?php 
    include("templates/testfooter.php");
?>
<?php 
    session_start();
    require_once("../inc/config.inc.php");
    require_once("../inc/functions.inc.php");

    //redirect user to homepage if the user has not already login
    $user = check_admin();

    if(empty($user)){
        header("location: login.php");
        exit;
    }

    // admin home university = UDE
    $university = 4; 


    //after filter change
    if(isset($_GET['save_filter'])){
        $error = false;
        $university = $_GET['university'];
        $abschluss = $_GET['abschluss'];

        if( empty($university) ){
            $error = true;
            $error_msg = "Bitte Universität auswählen!";
        }

        if(!$error){
            $show_table = true;
        }else{
            $show_table = false;
        }
    }



?>



<?php     
    include("templates/headerlogin.inc.php");  
?>

<main class="container-fluid flex-fill">
    <div class="card application-form">

        <!-- title row -->
        <div class="title-row" style="display: flex; justify-content: space-between;">
            <!-- page title -->
            <div class="page-title">
                <span><img src="../screenshots/UDE Sky.jpg" alt="" width="50" height="50"></span> Veranstaltungen 
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

        <!-- filter option for University -->
        <form id="filter-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
        <div class="form-row">
            <div class="form-group row col-auto">
            <label for="university" class="col-auto col-form-label col-form-label-sm">*Universität:</label>
            <div class="col-auto">
              <select class="form-control form-control-sm"  name="university">
                <?php 
							$statement = $pdo->prepare("SELECT * FROM university");
							$result = $statement->execute();
							while($row = $statement->fetch()) { ?>
                <option value="<?php echo ($row['university_id']);?>"
                <?php if(isset($university) && $university == $row['university_id']) echo "selected" ?>>
                <?php echo ($row['name']);?></option>
                <?php } ?>
              </select>
            </div>
            </div>
            <div class="form-group row col-auto">
            <label for="abschluss" class="col-auto col-form-label col-form-label-sm">Abschluss:</label>
            <div class="col-auto">
              <select class="form-control form-control-sm" placeholder="Abschluss" name="abschluss">
              <option>alle</option>
              <?php 
					$statement = $pdo->prepare("SELECT * FROM degree where name is not null");
	    			$result = $statement->execute();
	    			while($row = $statement->fetch()) { ?>
                    <option value="<?php echo ($row['degree_id']);?>"
                    <?php if(isset($abschluss) && $abschluss == $row['degree_id']) echo "selected" ?>>
                    <?php echo ($row['name']);?></option>
                <?php } ?>
              </select>
            </div>
            </div>
            <div class="form-group row col-auto">
            <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-sm" name="save_filter" value="filterchanges" >Suchen</button>
            </div>
            </div>
          </div>
        </form>

        <!-- subjects-table-form -->
        <?php if(isset($show_table)&& $show_table==true): ?>


        <div class="text-right">
            <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#new-subject">Neues Kurs hinzufügen</button>
        </div>

        <?php //require("component/modal_new_subject.php"); ?>
            
        <div class="table-responsive">
                <table class="table table-hover table-sm" id="equivalence_list" style="text-align:center;font-size:14px;">
                    <thead>
                        <tr style="background-color: #003D76; color: white;">
                            <th scope="col" width="5%" align="center"></th>
                            <th scope="col" width="5%" align="center">Kurs-Nr</th>
                            <th scope="col" width="20%" align="center">Kurs</th>
                            <th scope="col" width="5%" align="center">Professor</th>
                            <th scope="col" width="5%" align="center">Credits</th>
                            <th scope="col" width="5%" align="center">Abschluss</th>
                            <th scope="col" width="5%" align="center">Zuletzt Aktualisiert</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                            if(isset($abschluss) && $abschluss!="alle"){
                                $abschluss_filter = " AND sj.degree_id = ".$abschluss;
                            }else{
                                $abschluss_filter = " ";
                            }

                            //get all equivalence of this partner-uni
                            $statement = $pdo->prepare("SELECT sj.subject_id, prof.prof_surname, sj.degree_id, dg.name as degree, 
                            sj.subject_code , ROUND(sj.subject_credits, 1) as subject_credits , sj.subject_title  ,
                            case when sj.updated_at = '0000-00-00' then '-' else DATE_FORMAT(sj.updated_at,'%d/%m/%Y') end as updated_at 
                            FROM subject sj
                            LEFT JOIN degree dg on dg.degree_id = sj.degree_id 
                            LEFT JOIN professor prof on prof.professor_id = sj.prof_id 
                            WHERE sj.university_id = $university   $abschluss_filter
                            ORDER BY  sj.subject_title ASC");
                        
                            $result = $statement->execute();
                    
                    while($subject = $statement->fetch()) {


                        ?>

                            <tr id="<?php echo $subject['degree_id']?>">
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-subject-<?php echo $subject['subject_id']?>">
                                       edit
                                    </button>  
                                </td>
                                <td align="center"><?php echo $subject['subject_code'] ?></td>
                                <td align="center"><?php echo $subject['subject_title'] ?></td>
                                <td align="center"><?php echo $subject['prof_surname'] ?></td>
                                <td align="center"><?php echo $subject['subject_credits'] ?></td>
                                <td align="center"><?php echo $subject['degree'] ?></td>
                                <td align="center"><?php echo $subject['updated_at'] ?></td>
                            </tr>
                            <?php require("component/edit_subject.php") ?>  
                        <?php
                    }?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>
    </div>
</main>






<?php 
    include("templates/footer.inc.php");
?>
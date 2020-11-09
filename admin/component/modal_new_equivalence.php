<!-- create JS subject arrays -->
<script>
    var home_subjects = [];
    var foreign_subjects = [];
</script>

<!-- get home subject list -->
<?php 
	$statementA = $pdo->prepare("SELECT degree_id, subject_id ,subject_code,subject_title, subject_credits FROM subject WHERE university_id=:id");
    $resultA = $statementA->execute(array(':id'=>$home_university));
    $home_subjects = array();
	while($row = $statementA->fetch()) { 
        array_push($home_subjects, $row);?>
        <script>
            var subject = JSON.parse('<?php echo json_encode($row) ?>');
            home_subjects.push(subject);
        </script>
    <?php } 
?> 

<!-- get foreign subject list -->
<?php 
	$statementA = $pdo->prepare("SELECT degree_id, subject_id ,subject_code,subject_title, subject_credits FROM subject WHERE university_id=:id");
    $resultA = $statementA->execute(array(':id'=>$foreignuni));
    $foreign_subjects = array();
	while($row = $statementA->fetch()) { 
        array_push($foreign_subjects, $row);?>
        <script>
            var subject = JSON.parse('<?php echo json_encode($row) ?>');
            foreign_subjects.push(subject);
        </script>
    <?php } 
?> 

<!--Pop up Modal to edit valid course list for equivalence -->
<div class="modal fade" id="new-equivalence" tabindex="-1" role="dialog" aria-labelledby="new-equivalence" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Neue Äquivalenz eintragen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
        <div class="modal-body">
             <!-- select equivalence abschluss row -->
           <div class="form-row">
                <!-- select valid_degree -->
                <div class="form-group col-md-6">
                    <label for="valid_degree">Abschluss</label>
                    <select class="form-control form-control-sm" name="valid_degree" >
                    <option></option>
                     <?php 
			         	$statementA = $pdo->prepare("SELECT * FROM degree WHERE name is not null");
	    	         	$resultA = $statementA->execute();
	    	         	while($row = $statementA->fetch()) { ?>
                         <option value="<?php echo $row['degree_id'];?>" <?php if(isset($valid_degree_id) && $valid_degree_id== $row['degree_id']) echo "selected"; else if(isset($abschluss) && $abschluss== $row['degree_id']) echo "selected"; ?>>
                         <?php echo $row['name'];?></option>
                     <?php } ?>
                    </select>
                </div>

                <!-- select equivalence_status -->
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select class="form-control form-control-sm" name="status" >
                    <option></option>
                     <?php 
			         	$statementA = $pdo->prepare("SELECT * FROM status");
	    	         	$resultA = $statementA->execute();
	    	         	while($row = $statementA->fetch()) { ?>
                         <option value="<?php echo $row['status_id'];?>" <?php if(isset($status) && $status== $row['status_id']) echo "selected" ?>>  
                         <?php echo $row['name'];?></option>
                     <?php } ?>
                    </select>
                </div>
            </div>
            
            <!-- select subjects row -->
            <div class="form-row">
                <!-- select for home subject or add new subject -->
                <div class="form-group col-md-6">
                    <label for="home_subject">Heim-Kurs</label>
                    <select class="form-control form-control-sm" name="home_subject_id" >
                    <option></option>
                     <?php 
			         	$statementA = $pdo->prepare("SELECT subject_id ,subject_code,subject_title, subject_credits FROM subject WHERE university_id=:id ORDER BY subject_title ASC");
	    	         	$resultA = $statementA->execute(array(':id'=>$home_university));
	    	         	while($row = $statementA->fetch()) { ?>
                         <option value="<?php echo $row['subject_id'];?>" <?php if(isset($home_subject_id) && $home_subject_id== $row['subject_id']) echo "selected" ?>>
                         <?php echo $row['subject_title']." | ".$row['subject_code'];?></option>
                     <?php } ?>
                    </select>
                </div>

                <!-- select for foreign subject or add new subject -->
                <div class="form-group col-md-6">
                    <label for="foreign_subject">Partner-Kurs</label>
                    <select class="form-control form-control-sm" name="foreign_subject_id" >
                    <option></option>
                     <?php 
			         	$statementA = $pdo->prepare("SELECT * FROM subject WHERE university_id=:id ORDER BY subject_title ASC");
	    	         	$resultA = $statementA->execute(array(':id'=>$foreignuni));
	    	         	while($row = $statementA->fetch()) { ?>
                         <option value="<?php echo $row['subject_id'];?>" <?php if(isset($foreign_subject_id) && $foreign_subject_id== $row['subject_id']) echo "selected" ?>>
                         <?php echo $row['subject_title']." | ".$row['subject_code'];?></option>
                     <?php } ?>
                    </select>
                </div>
            </div>

            <!-- enter new subjects checkbox row -->
            <div class="form-row">
                <!-- checkbox home new subject -->
                <div class="form-group col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="home" name="new_subject_home">
                        <label class="form-check-label" for="new_subject_home">
                          Neues Kurs hinzufügen
                        </label>
                    </div>
                </div>

                <!-- checkbox foreign new subject -->
                <div class="form-group col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="foreign" name="new_subject_foreign">
                        <label class="form-check-label" for="new_subject_foreign">
                          Neues Kurs hinzufügen
                        </label>
                    </div>
                </div>
            </div>

            <!-- enter new subject number row -->
            <div class="form-row">
                <!-- home new subject number -->
                <div class="form-group col-md-6">
                    <label for="courseNo">Kurs.Nr.</label>
                    <input type="text" class="form-control form-control-sm" name="courseNo_home"  disabled>
                </div>

                <!-- foreign new subject number -->
                <div class="form-group col-md-6">
                    <label for="courseNo">Kurs.Nr.</label>
                    <input type="text" class="form-control form-control-sm" name="courseNo_foreign"  disabled>
                </div>
            </div>

            <!-- enter new subject title row -->
            <div class="form-row">
                <!-- home new subject title -->
                <div class="form-group col-md-6">
                    <label for="coursename">Kursname</label>
                    <input type="text" class="form-control form-control-sm" name="course_name_home"  disabled>
                </div>

                <!-- foreign new subject title -->
                <div class="form-group col-md-6">
                    <label for="coursename">Kursname</label>
                    <input type="text" class="form-control form-control-sm" name="course_name_foreign" disabled>
                </div>
            </div>

            <!-- enter new subject credit row -->
            <div class="form-row">
                <!-- home new subject credit -->
                <div class="form-group col-md-6">
                    <label for="credit">Credits</label>
                    <input type="text" class="form-control form-control-sm" name="credit_home" maxlength="4" pattern="^[1-9]\d*((\.|,)\d+)?$"  disabled>
                </div>

                <!-- foreign new subject credit -->
                <div class="form-group col-md-6">
                    <label for="credit">Credits</label>
                    <input type="text" class="form-control form-control-sm" name="credit_foreign"  maxlength="4" pattern="^[1-9]\d*((\.|,)\d+)?$"  disabled>
                </div>
            </div>

            <!-- enter new subject degree row -->
            <div class="form-row">
                <!-- home new subject degree -->
                <div class="form-group col-md-6">
                    <label for="Abschluss">Abschluss</label>
                    <select class="form-control form-control-sm" name="degree_home" disabled>
                            <?php 
			                	$statementA = $pdo->prepare("SELECT * FROM degree");
	    	                	$resultA = $statementA->execute();
	    	                	while($row = $statementA->fetch()) { ?>
                                <option value="<?php echo $row['degree_id'];?>">
                                <?php echo $row['name'];?></option>
                            <?php } ?>
                    </select>  
                </div>

                <!-- foreign new subject degree -->
                <div class="form-group col-md-6">
                    <label for="Abschluss">Abschluss</label>
                    <select class="form-control form-control-sm" name="degree_foreign" disabled>
                            <?php 
			                	$statementA = $pdo->prepare("SELECT * FROM degree");
	    	                	$resultA = $statementA->execute();
	    	                	while($row = $statementA->fetch()) { ?>
                                <option value="<?php echo $row['degree_id'];?>">
                                <?php echo $row['name'];?></option>
                            <?php } ?>
                    </select>  
                </div>
            </div>


        </div>
      <div class="modal-footer">
        <button type="button" name="cancel" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-success btn-sm" name="add_equivalence">Speichern</button>
      </div>
      </form>
    </div>
  </div>
</div>


        <!-- change row color upon checked -->
        <script>
        $(document).ready(function(){
            $('input[type="checkbox"]').click(function(){
                var value = $(this).val();

                if(value == "home"){
                    if($(this).prop("checked") == true){
                        //disable home subject select
                        $('select[name="home_subject_id"]').attr('disabled', 'disabled');
                        $('select[name="home_subject_id"]').val('');
                        // $('select[name="home_subject_id"]').find("option:selected").removeAttr("selected");
                        //enable new subject input
                        $('input[name="courseNo_home"]').prop("disabled", false);
                        $('input[name="course_name_home"]').prop("disabled", false);
                        $('input[name="credit_home"]').prop("disabled", false);
                        $('select[name="degree_home"]').removeAttr('disabled');
                    }else{
                        //enable home subject select
                        $('select[name="home_subject_id"]').removeAttr('disabled');
                        //disable new subject input
                        $('input[name="courseNo_home"]').prop("disabled", 'disabled');
                        $('input[name="course_name_home"]').prop("disabled", 'disabled');
                        $('input[name="credit_home"]').prop("disabled", 'disabled');
                        $('select[name="degree_home"]').attr("disabled", 'disabled');

                        //clear input values
                        $('input[name="courseNo_home"]').val('');
                        $('input[name="course_name_home"]').val('');
                        $('input[name="credit_home"]').val('');
                        $('select[name="degree_home"]').val('');

                        // $('select[name="degree_home"]').find("option:selected").removeAttr("selected");
                    }

                }else if(value == "foreign"){
                    if($(this).prop("checked") == true){
                        //disable home subject select
                        $('select[name="foreign_subject_id"]').attr('disabled', 'disabled');
                        $('select[name="foreign_subject_id"]').val('');
                        // $('select[name="foreign_subject_id"]').find("option:selected").removeAttr("selected");

                        //enable new subject input
                        $('input[name="courseNo_foreign"]').prop("disabled", false);
                        $('input[name="course_name_foreign"]').prop("disabled", false);
                        $('input[name="credit_foreign"]').prop("disabled", false);
                        $('select[name="degree_foreign"]').removeAttr('disabled');
                    }else{
                        //enable home subject select
                        $('select[name="foreign_subject_id"]').removeAttr('disabled');
                        //disable new subject input
                        $('input[name="courseNo_foreign"]').prop("disabled", 'disabled');
                        $('input[name="course_name_foreign"]').prop("disabled", 'disabled');
                        $('input[name="credit_foreign"]').prop("disabled", 'disabled');
                        $('select[name="degree_foreign"]').attr("disabled", 'disabled');

                        //clear input fields
                        $('input[name="courseNo_foreign"]').val('');
                        $('input[name="course_name_foreign"]').val('');
                        $('input[name="credit_foreign"]').val('');
                        $('select[name="degree_foreign"]').val('');

                        // $('select[name="degree_foreign"]').find("option:selected").removeAttr("selected");
                    }
                }
            });
        });
        </script>

        <!-- university drop down select change -->
        <script>
            $(document).ready(function(){
                //select home uni changed
                $('select[name="home_subject_id"]').change(function(){
                    var home_id = $(this).val();

                     for(var i=0; i<home_subjects.length;i++){
                        if(home_subjects[i].subject_id == home_id){
             
                            $('input[name="courseNo_home"]').val(home_subjects[i].subject_code);
                            $('input[name="course_name_home"]').val(home_subjects[i].subject_title);
                            $('input[name="credit_home"]').val(home_subjects[i].subject_credits);
                            $('select[name="degree_home"]').val(home_subjects[i].degree_id);
                        }
                     }
                });

                //select home uni changed
                $('select[name="foreign_subject_id"]').change(function(){
                    var foreign_id = $(this).val();

                     for(var i=0; i<foreign_subjects.length;i++){
                        if(foreign_subjects[i].subject_id == foreign_id){
                            $('input[name="courseNo_foreign"]').val(foreign_subjects[i].subject_code);
                            $('input[name="course_name_foreign"]').val(foreign_subjects[i].subject_title);
                            $('input[name="credit_foreign"]').val(foreign_subjects[i].subject_credits);
                            $('select[name="degree_foreign"]').val(foreign_subjects[i].degree_id);
                        }
                     }
                });
            });

        </script>

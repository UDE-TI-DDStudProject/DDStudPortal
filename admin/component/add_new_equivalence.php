        
        
        <!-- add new equivalence to the foreign_uni -->
        <form id="add-equivalence-form" action="<?php echo $_SERVER['REQUEST_URI']."?foreignuni=".$foreignuni."&abschluss=".$abschluss ;?>" method="post" style="font-size: 16px">

            <!-- select subjects row -->
            <div class="form-row">
                <!-- select for home subject or add new subject -->
                <div class="form-group col-md-6">
                    <label for="home_subject">Heim-Kurs</label>
                    <select class="form-control form-control-sm" name="home_subject_id" >
                    <option></option>
                     <?php 
			         	$statementA = $pdo->prepare("SELECT * FROM subject WHERE university_id=:id");
	    	         	$resultA = $statementA->execute(array(':id'=>$home_university));
	    	         	while($row = $statementA->fetch()) { ?>
                         <option value="<?php echo $row['subject_id'];?>">
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
			         	$statementA = $pdo->prepare("SELECT * FROM subject WHERE university_id=:id");
	    	         	$resultA = $statementA->execute(array(':id'=>$foreignuni));
	    	         	while($row = $statementA->fetch()) { ?>
                         <option value="<?php echo $row['subject_id'];?>">
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
                    <input type="text" class="form-control form-control-sm" name="courseNo_home" placeholder="z.B. ZKB12345" disabled>
                </div>

                <!-- foreign new subject number -->
                <div class="form-group col-md-6">
                    <label for="courseNo">Kurs.Nr.</label>
                    <input type="text" class="form-control form-control-sm" name="courseNo_foreign" placeholder="z.B. ZKB12345" disabled>
                </div>
            </div>

            <!-- enter new subject title row -->
            <div class="form-row">
                <!-- home new subject title -->
                <div class="form-group col-md-6">
                    <label for="coursename">Kursname</label>
                    <input type="text" class="form-control form-control-sm" name="course_name_home" placeholder="z.B. Mathematik 1" disabled>
                </div>

                <!-- foreign new subject title -->
                <div class="form-group col-md-6">
                    <label for="coursename">Kursname</label>
                    <input type="text" class="form-control form-control-sm" name="course_name_foreign" placeholder="z.B. Mathematik 1" disabled>
                </div>
            </div>

            <!-- enter new subject credit row -->
            <div class="form-row">
                <!-- home new subject credit -->
                <div class="form-group col-md-6">
                    <label for="credit">Credits</label>
                    <input type="text" class="form-control form-control-sm" name="credit_home" placeholder="z.B. 4,0" maxlength="4" pattern="^[1-9]\d*((\.|,)\d+)?$"  disabled>
                </div>

                <!-- foreign new subject credit -->
                <div class="form-group col-md-6">
                    <label for="credit">Credits</label>
                    <input type="text" class="form-control form-control-sm" name="credit_foreign" placeholder="z.B. 4,0" maxlength="4" pattern="^[1-9]\d*((\.|,)\d+)?$"  disabled>
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

            <!-- save -->
            <div class="text-right">
                <button type="submit" class="btn btn-success" name="add_equivalence" value="add_equivalence" >Äquivalenz hinzufügen</button>
            </div>

        </form>

        <!-- change row color upon checked -->
        <script>
        $(document).ready(function(){
            $('input[type="checkbox"]').click(function(){
                var value = $(this).val();

                if(value == "home"){
                    if($(this).prop("checked") == true){
                        //disable home subject select
                        $('select[name="home_subject_id"]').attr('disabled', 'disabled');
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
                    }

                }else if(value == "foreign"){
                    if($(this).prop("checked") == true){
                        //disable home subject select
                        $('select[name="foreign_subject_id"]').attr('disabled', 'disabled');
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
                    }
                }
            });
        });
        </script>
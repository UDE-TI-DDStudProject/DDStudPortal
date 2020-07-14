
<!--Pop up Modal to edit valid course list for equivalence -->
<div class="modal fade" id="edit-valid-courses-<?php echo $equivalence['equivalence_id']?>" tabindex="-1" role="dialog" aria-labelledby="edit-valid-courses-<?php echo $equivalence['equivalence_id']?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Studiengänge bearbeiten <?php echo $equivalence['equivalence_id'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- allow add courses -->
        <!-- <form> -->
            <div class="form-group row col-auto">
                <label for="course" class="col-auto col-form-label col-form-label-sm">Studiengang hinzufügen:</label>
                <div class="col-auto">
                  <select class="form-control form-control-sm"  name="course">
                  <option></option>
                    <?php 
			    		        $statementC = $pdo->prepare("SELECT * FROM course");
			    		        $resultC = $statementC->execute();
                      while($course = $statementC->fetch()) { ?>
  
                        <option value="<?php echo $course['course_id'];?>" <?php if(in_array($course['course_id'], $validcoursesids)) echo " hidden disabled" ?>><?php echo $course['name'];?></option>
                    <?php } ?>
                  </select>
                </div>
            </div>
        <!-- </form> -->

        <!-- list all valid-courses -->
        <ul id="valid-courses" class="list-group" style="list-style: none; text-align: left;">
            <?php 
            foreach($validcourses as $validcourse){?>
                <li id="<?php echo $validcourse["course_id"]; ?>">
                    <a href="#" name="remove-course" id="<?php echo $validcourse["course_id"]; ?>">
                        <i  class="fa fa-times" aria-hidden="true"></i>
                    </a> 
                    <?php echo $validcourse["name"]; ?>
                    <input name="equivalence_course[<?php echo $equivalence['equivalence_id']?>][<?php echo $validcourse["course_id"]?>]" type="hidden" value="<?php echo $validcourse["course_id"]; ?>">
                </li>
            <?php
            }?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" name="cancel" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" name="save_course" value="<?php echo $equivalence['equivalence_id'] ?>" class="btn btn-primary">Speichern</button>
      </div>
    </div>
  </div>
</div>

<!-- courses drop down select change -->
<script>
    $(document).ready(function(){

        //select course changed
        $('#edit-valid-courses-<?php echo $equivalence['equivalence_id']?> select[name="course"]').change(function(){

          //selected course
          var course_id = $(this).val();
          var course_name =  $(this).find('option:selected').html();

          //set a variable if course exist in list
          var exists = false;

          //get ul list items
          var course_items = $("#edit-valid-courses-<?php echo $equivalence['equivalence_id']?> #valid-courses li");

          if(course_items!=null){
            course_items.each(function(idx, li){
              var course = $(li);
              if(course.attr('id')==course_id){
                exists = true;
              }
            });
          }

          if(exists==false){
            // create a <li> item for the new valid course and append to <ul>
            $("#edit-valid-courses-<?php echo $equivalence['equivalence_id']?> #valid-courses").append('<li id="'+course_id+'"><a href="#" name="remove-course" id="'+ course_id +'"><i class="fa fa-times" aria-hidden="true"></i></a> '+ course_name +'<input name="equivalence_course[<?php echo $equivalence['equivalence_id']?>]['+course_id+']" type="hidden" value="'+course_id+'"></li>');

          }
            
        });
    });
</script>

<!-- valid course remove button clicked -->
<script>
    $(document).ready(function(){

        //remove button clicked
        $('#edit-valid-courses-<?php echo $equivalence['equivalence_id']?> #valid-courses').on("click", "a[name='remove-course']", function(){ 

          // remove <li> item for the deleted course from <ul>
          $(this).closest('li').remove();
        });
    });
</script>


<!-- upon cancel -->
<script>
    $(document).ready(function(){

        //cancel button clicked
        $('button[name="cancel"]').click(function(){ 
          // //refresh page to dump JS changes
          location.reload();

        });
    });
</script>

 

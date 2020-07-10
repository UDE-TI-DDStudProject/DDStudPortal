

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
        <form>
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
        </form>

        <!-- list all valid-courses -->
        <ul class="list-group" style="list-style: none; text-align: left;">
            <?php 
            foreach($validcourses as $validcourse){?>
                <li>
                    <a href="#" name="remove-course" id="<?php echo $equivalence['equivalence_id']?>" >
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a> 
                    <?php echo $validcourse; ?>
                </li>
            <?php
            }?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


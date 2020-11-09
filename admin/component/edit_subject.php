<!--Pop up Modal to edit valid course list for equivalence -->
<div class="modal fade" id="edit-subject-<?php echo $subject['subject_id']?>" tabindex="-1" role="dialog" aria-labelledby="edit-subject-<?php echo $subject['subject_id']?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kurs bearbeiten</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" >
                <div class="modal-body">
                    <!-- show error message -->
                    <?php 
                    if(isset($edit_error_msg) && !empty($edit_error_msg)):
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $edit_error_msg; ?>
                    </div>
                    <?php 
                    endif;
                    ?>
                    <div class="form-group">
                        <label for="edit_abschluss" class="col-form-label col-form-label-sm">Abschluss</label>
                        <input type="text" name="edit_abschluss" class="form-control-plaintext form-control-sm"
                                value="<?php echo $subject['degree']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_subject_code" class="col-form-label col-form-label-sm">Kurs-Nr</label>
                        <input type="text" name="edit_subject_code" class="form-control-plaintext form-control-sm"
                                value="<?php echo $subject['subject_code']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_subject_title" class="col-form-label col-form-label-sm">Kurs</label>
                        <input type="text" name="edit_subject_title" class="form-control-plaintext form-control-sm"
                                value="<?php echo $subject['subject_title']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_prof" class="col-form-label col-form-label-sm">Professor</label>
                        <input type="text" name="edit_prof" class="form-control-plaintext form-control-sm"
                                value="<?php echo $subject['prof_surname']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="edit_credits" class="col-form-label col-form-label-sm">Credits</label>
                        <input type="text" name="edit_credits" class="form-control form-control-sm"
                                value="<?php echo $subject['subject_credits']?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="modal-cancel" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                    <button type="submit" name="edit_subject" value="<?php echo $subject['subject_id']?>" class="btn btn-primary">Speichern</button>
                </div>
            </form>
        </div>
    </div>
</div>

<form>

    <div class="form_subtitle" style="font-weight:500;">
        Use saved query
        <hr>
    </div>
    <!-- saved query -->
    <div class="form-group row">
        <label for="saved_query" class="col-sm-2 col-form-label-sm col-form-label">Saved Query:</label>
        <div class="col-sm-5">
        <input type="text" class="form-control form-control-sm" name="saved_query" >
        </div>
    </div>

    <div class="form_subtitle" style="font-weight:500;">
        Simple search
        <hr>
    </div>
    <!-- simple search: name, matno and email -->
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label-sm col-form-label">Name:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="name" >
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label-sm col-form-label">E-Mail:</label>
        <div class="col-sm-5">
            <input type="email" class="form-control form-control-sm" name="email" >
        </div>
    </div>
    <div class="form-group row">
        <label for="matno" class="col-sm-2 col-form-label-sm col-form-label">Mat.-Nr.:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="matno" >
        </div>
    </div>

    <div class="form_subtitle" style="font-weight:500;">
        Personal related criteria
        <hr>
    </div>
    <!-- Personal related criteria -->
    <div class="form-group row">
        <label for="salutation" class="col-sm-2 col-form-label-sm col-form-label">Salutation:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="salutation" >
        </div>
    </div>
    <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label-sm col-form-label">Overall Status:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="status" >
        </div>
    </div>
    <div class="form-group row">
        <label for="nationality" class="col-sm-2 col-form-label-sm col-form-label">Nationality:</label>
        <div class="col-sm-2">
            <input type="text" class="form-control form-control-sm" name="status_range" >
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm" name="nationality" >
        </div>
    </div>

    <div class="form_subtitle" style="font-weight:500;">
        Application related criteria
        <hr>
    </div>
    <!-- Application related criteria -->
    <div class="form-group row">
        <label for="transfer_type" class="col-sm-2 col-form-label-sm col-form-label">Type of Transfer:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="transfer_type" >
        </div>
    </div>
    <div class="form-group row">
        <label for="tansfer_start" class="col-sm-2 col-form-label-sm col-form-label">Start of Transfer:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="tansfer_start" >
        </div>
    </div>
    <div class="form-group row">
        <label for="home_uni" class="col-sm-2 col-form-label-sm col-form-label">Home University:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="home_uni" >
        </div>
    </div>
    <div class="form-group row">
        <label for="home_degree" class="col-sm-2 col-form-label-sm col-form-label">Home Degree:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="home_degree" >
        </div>
    </div>
    <div class="form-group row">
        <label for="home_program" class="col-sm-2 col-form-label-sm col-form-label">Home Program:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="home_program" >
        </div>
    </div>
    <div class="form-group row">
        <label for="foreign_uni" class="col-sm-2 col-form-label-sm col-form-label">Abroad University:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="foreign_uni" >
        </div>
    </div>

    <div class="form_subtitle" style="font-weight:500;">
        Alumni related criteria
        <hr>
    </div>
    <!-- Alumni related criteria -->
    <div class="form-group row">
        <label for="study_time" class="col-sm-2 col-form-label-sm col-form-label">Study Time:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="study_time_range" >
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="study_time" >
        </div>
    </div>
    <div class="form-group row">
        <label for="grade" class="col-sm-2 col-form-label-sm col-form-label">Average Grade:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="grade_range" >
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" name="grade" >
        </div>
    </div>

    <button type="submit" class="btn btn-primary" name="search">search</button>

</form>
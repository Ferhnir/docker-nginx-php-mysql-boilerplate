<?php

  if (!(new App\Middleware\Auth())->checkToken()){
    header('Location: /login');
    exit;
  }
  require_once base() . '/View/includes/_header.php';
  require_once base() . '/View/includes/_navbar.html';
?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="container">
  <div class="row justify-content-md-center">
      <div class="col-10">

        <form action="/hazard-documents/create" method="POST">

          <div class="card mt-5">
            <div class="card-header">
                New Hazard Document:
            </div>
            <div class="card-body">

                <!-- JOB POSITION -->
                <div class="mb-3 row">
                  <label for="job-position" class="col-sm-2 col-form-label">Job position</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="job-position" name="job_position" value="">
                  </div>
                </div>

                <!-- PLACE OF JOB -->
                <div class="mb-3 row">
                  <label for="place-of-job" class="col-sm-2 col-form-label">Place of job</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="date" name="place_of_job" value="">
                  </div>
                </div>

                <!-- DATE  -->
                <div class="mb-3 row">
                  <label for="date" class="col-sm-2 col-form-label">Date</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="date" name="date" value="">
                  </div>
                </div>

                <hr />

                <!-- Job Description -->
                <div class="mb-3 row">
                  <label for="job_description[]" class="col-sm-12 col-form-label">Job Description:</label>
                </div>

                <div id="job-desc-list">
                  <div class="mb-3 row job-desc-list">
                    <label for="date" class="col-sm-1 col-form-label text-center" value="1">1</label>
                    <div class="col-sm-11">
                      <input type="text" class="form-control" name="job_description[]" value="">
                    </div>
                  </div>
                </div>

                <div class="mb-3 row justify-content-md-end">
                  <div class="col-sm-1 d-grid">
                    <button class="btn btn-info" type="button" id="new-job-desc-btn">Add</button>
                  </div>
                </div>

                <hr />

                <!-- Used Machines -->
                <div class="mb-3 row">
                  <label for="machines" class="col-sm-12 col-form-label">Machines and/or applicances:</label>
                </div>

                <div id="machines-list">
                  <div class="mb-3 row machines-list">
                    <label for="date" class="col-sm-1 col-form-label text-center" value="1">1</label>
                    <div class="col-sm-11">
                      <input type="text" class="form-control" name="machines[]" value="">
                    </div>
                  </div>
                </div>

                <div class="mb-3 row justify-content-md-end">
                  <div class="col-sm-1 d-grid">
                    <button class="btn btn-info" type="button" id="new-machine-btn">Add</button>
                  </div>
                </div>

                <hr />
                <!-- Used Tools -->
                <div class="mb-3 row">
                  <label for="tools[]" class="col-sm-12 col-form-label">Tools:</label>
                </div>

                <div id="tools-list">
                  <div class="mb-3 row tools-list">
                    <label for="date" class="col-sm-1 col-form-label text-center" value="1">1</label>
                    <div class="col-sm-11">
                      <input type="text" class="form-control" name="tools[]" value="">
                    </div>
                  </div>
                </div>

                <div class="mb-3 row justify-content-md-end">
                  <div class="col-sm-1 d-grid">
                    <button class="btn btn-info" type="button" id="new-tool-btn">Add</button>
                  </div>
                </div>

                <hr />
                <!-- Used Materials -->
                <div class="mb-3 row">
                  <label for="materials[]" class="col-sm-12 col-form-label">Materials:</label>
                </div>

                <div id="materials-list">
                  <div class="mb-3 row materials-list">
                    <label for="date" class="col-sm-1 col-form-label text-center" value="1">1</label>
                    <div class="col-sm-11">
                      <input type="text" class="form-control" name="materials[]" value="">
                    </div>
                  </div>
                </div>

                <div class="mb-3 row justify-content-md-end">
                  <div class="col-sm-1 d-grid">
                    <button class="btn btn-info" type="button" id="new-material-btn">Add</button>
                  </div>
                </div>

                <hr />
                <!-- Used Chemicals -->
                <div class="mb-3 row">
                  <label for="chemicals[]" class="col-sm-12 col-form-label">Chemicals:</label>
                </div>

                <div id="chemicals-list">
                  <div class="mb-3 row chemicals-list">
                    <label for="date" class="col-sm-1 col-form-label text-center" value="1">1</label>
                    <div class="col-sm-11">
                      <input type="text" class="form-control" name="chemicals[]" value="">
                    </div>
                  </div>
                </div>

                <div class="mb-3 row justify-content-md-end">
                  <div class="col-sm-1 d-grid">
                    <button class="btn btn-info" type="button" id="new-chemical-btn">Add</button>
                  </div>
                </div>

            </div>

            <div class="card-footer">
              <div class="my-2 row justify-content-md-center">
                <button type="submit" class="btn btn-success float-right">SAVE</button>
              </div>
          </div>
        </form>
        <div class="mb-5"></div>
      </div>
  </div>
</div>

<script>
$(function() {
  $('input[name="date"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: moment().year(),
    maxYear: moment().add(2, 'years').year()
  });

  //JOBS LIST
  $('#new-job-desc-btn').on('click', () => {

    let jobDescElements = $('#job-desc-list').find('.job-desc-list');
    let newElement = '<div class="mb-3 row job-desc-list">';

    newElement += '<label for="date" class="col-sm-1 col-form-label text-center" value="' + jobDescElements.length++ + '">' + jobDescElements.length++  + '</label>';
    newElement += '<div class="col-sm-11"><input type="text" class="form-control" name="job_description[]" value=""></div></div>';

    $('#job-desc-list').append(newElement);
  });

  //MACHINES
  $('#new-machine-btn').on('click', () => {

    let machinesList = $('#machines-list').find('.machines-list');
    let newMachine = '<div class="mb-3 row machines-list">';

    newMachine += '<label for="date" class="col-sm-1 col-form-label text-center" value="' + machinesList.length++ + '">' + machinesList.length++  + '</label>';
    newMachine += '<div class="col-sm-11"><input type="text" class="form-control" name="machines[]" value=""></div></div>';

    $('#machines-list').append(newMachine);
  });

  //TOOlS
  $('#new-tool-btn').on('click', () => {

    let jobDescElements = $('#tools-list').find('.tools-list');
    let newElement = '<div class="mb-3 row tools-list">';

    newElement += '<label for="date" class="col-sm-1 col-form-label text-center" value="' + jobDescElements.length++ + '">' + jobDescElements.length++  + '</label>';
    newElement += '<div class="col-sm-11"><input type="text" class="form-control" name="tools[]" value=""></div></div>';

    $('#tools-list').append(newElement);
  });

  //MATERIALS
  $('#new-material-btn').on('click', () => {

    let jobDescElements = $('#materials-list').find('.materials-list');
    let newElement = '<div class="mb-3 row materials-list">';

    newElement += '<label for="date" class="col-sm-1 col-form-label text-center" value="' + jobDescElements.length++ + '">' + jobDescElements.length++  + '</label>';
    newElement += '<div class="col-sm-11"><input type="text" class="form-control" name="job_description[]" value=""></div></div>';

    $('#materials-list').append(newElement);
  });

  //CHEMICALS
  $('#new-chemical-btn').on('click', () => {

    let jobDescElements = $('#chemicals-list').find('.chemicals-list');
    let newElement = '<div class="mb-3 row chemicals-list">';

    newElement += '<label for="date" class="col-sm-1 col-form-label text-center" value="' + jobDescElements.length++ + '">' + jobDescElements.length++  + '</label>';
    newElement += '<div class="col-sm-11"><input type="text" class="form-control" name="job_description[]" value=""></div></div>';

    $('#chemicals-list').append(newElement);
  });

});
</script>

<?php require_once base() . '/View/includes/_footer.php'; ?>
<?php
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
          <div class="card mt-5">
            <div class="card-header">
                New Approval:
            </div>
            <div class="card-body">
              <form action="/approval/new" method="POST">

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
                  <label for="job_description[]" class="col-sm-2 col-form-label">Job Description:</label>
                </div>

                <div id="job-desc-list">
                  <div class="mb-3 row job-desc-list">
                    <label for="date" class="col-sm-1 col-form-label text-center" value="1">1</label>
                    <div class="col-sm-11">
                      <input type="text" class="form-control" name="job_description[]" value="">
                    </div>
                  </div>
                </div>

                <div class="mb-3 row justify-content-md-center">
                  <div class="col-sm-12 d-grid">
                    <button class="btn btn-info" type="button" id="new-job-desc-btn">Add new job description</button>
                  </div>
                </div>



              </form>
            </div>
          </div>
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

  $('#new-job-desc-btn').on('click', () => {

    let jobDescElements = $('#job-desc-list').find('.job-desc-list');


    let newElement = '<div class="mb-3 row job-desc-list">';


    newElement += '<label for="date" class="col-sm-1 col-form-label text-center" value="' + jobDescElements.length++ + '">' + jobDescElements.length++  + '</label>';
    newElement += '<div class="col-sm-11"><input type="text" class="form-control" name="job_description[]" value=""></div></div>';

    $('#job-desc-list').append(newElement);
  });

});
</script>

<?php require_once base() . '/View/includes/_footer.php'; ?>
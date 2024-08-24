<?php

  if (!(new App\Middleware\Auth())->checkToken()){
    header('Location: /login');
    exit;
  }
  require_once base() . '/View/includes/_header.php';
  require_once base() . '/View/includes/_navbar.html';

  $resaults = \App\Models\HazardResault::all();
  $exposures = \App\Models\HazardExposure::all();
  $probabilities = \App\Models\HazardProbability::all();

?>

<div class="container">
  <div class="row">
    <div class="col-12">

      <form action="/hazards" method="POST">

        <div id="hazardCard" class="card mt-5">
          <div class="card-header">
              New Hazard:
          </div>
          <div class="card-body">

          <input type="hidden" name="hazard_document_id" value="<?php echo $_GET['hazardDocumentID']; ?>" />

            <div class="form-floating mb-4">
              <textarea class="form-control" name="info" placeholder="Leave a comment here" id="info-Textarea" style="height: 100px"></textarea>
              <label for="info-Textarea">Hazard Info</label>
            </div>

            <div class="form-floating mb-4">
              <textarea class="form-control" name="source" placeholder="Leave a comment here" id="source-Textarea" style="height: 100px"></textarea>
              <label for="source-Textarea">Source of Hazard</label>
            </div>

            <div class="form-floating mb-4">
              <textarea class="form-control" name="resault" placeholder="Leave a comment here" id="resault-Textarea" style="height: 100px"></textarea>
              <label for="resault-Textarea">Possible resault of Hazard</label>
            </div>

            <div class="form-floating mb-4">
              <textarea class="form-control" name="methods_and_tools" placeholder="Leave a comment here" id="methods-and-tools-Textarea" style="height: 100px"></textarea>
              <label for="methods-and-tools-Textarea">Methods and tools to avoid a Hazard</label>
            </div>

            <div class="row">
              <div class="col-4">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Resaults</label>
                  <select id="resaultSelection" class="form-select" name="hazard_resault_id">
                    <option selected>Choose...</option>
                    <?php foreach($resaults as $reault) { echo '<option value="' . $reault->id . '">(' . $reault->strengh . ') ' . $reault->name . "</option>"; } ?>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Exposure</label>
                  <select id="exposureSelection" class="form-select" name="hazard_exposure_id">
                    <option selected>Choose...</option>
                    <?php foreach($exposures as $exposure) { echo '<option value="' . $exposure->id . '">(' . $exposure->strengh . ') ' . $exposure->name . "</option>"; } ?>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Probability</label>
                  <select id="probabilitySelection" class="form-select" name="hazard_probability_id">
                    <option selected>Choose...</option>
                    <?php foreach($probabilities as $probability) { echo '<option value="' . $probability->id . '">(' . $probability->strengh . ') ' . $probability->name . "</option>"; } ?>
                  </select>
                </div>
              </div>
            </div>

          </div>

          <div class="card-footer">
            <div class="my-2 row justify-content-md-center">
              <button type="submit" class="btn btn-success float-right">SAVE</button>
            </div>
          </div>

        </div>

      </form>

    </div>
  </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script>
  $(document).ready(() => {

    $('form').on('submit', function(e){

      if (totalScore === 0){
        e.preventDefault();
        alert('You have to select scored from dropdowns');
      }
    });

    let resaultScore = 0;
    let exposureScore = 0;
    let probabilityScore = 0;
    let totalScore = 0;

    $("#resaultSelection").on( "change", function() {
      resaultScore = this.value;
      caucluateScore();
    });

    $("#exposureSelection").on( "change", function() {
      exposureScore = this.value;
      caucluateScore();
    });

    $("#probabilitySelection").on( "change", function() {
      probabilityScore = this.value;
      caucluateScore();
    });

    function caucluateScore()
    {
      totalScore = resaultScore * exposureScore * probabilityScore;

      if (totalScore > 0){

        if (totalScore < 20){
          $('body').removeClass().addClass('bg-success');
        }

        if (totalScore >= 20 && totalScore < 70){
          $('body').removeClass().addClass('bg-primary');
        }

        if (totalScore >= 70 && totalScore < 200){
          $('body').removeClass().addClass('bg-warning');
        }

        if (totalScore >= 200 && totalScore < 400){
          $('body').removeClass().addClass('bg-danger');
        }

        if (totalScore >= 400){
          $('body').removeClass().addClass('bg-black');
        }
      } else {
        $('body').removeClass();
      }
    }

  });
</script>

<?php require_once base() . '/View/includes/_footer.php'; ?>
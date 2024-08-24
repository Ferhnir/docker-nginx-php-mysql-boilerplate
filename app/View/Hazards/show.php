<?php

  if (!(new App\Middleware\Auth())->checkToken()){
    header('Location: /login');
    exit;
  }
  require_once base() . '/View/includes/_header.php';
  require_once base() . '/View/includes/_navbar.html';

  $hazard = \App\Models\Hazard::find($hazard);

  $resault = \App\Models\HazardResault::find($hazard->hazard_resault_id);
  $exposure = \App\Models\HazardExposure::find($hazard->hazard_exposure_id);
  $probability = \App\Models\HazardProbability::find($hazard->hazard_probability_id);

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

            <div class="form-floating mb-4">
              <textarea class="form-control" name="info" placeholder="Leave a comment here" id="info-Textarea" style="height: 100px" disabled>
                <?php echo $hazard->info; ?>
              </textarea>
              <label for="info-Textarea">Hazard Info</label>
            </div>

            <div class="form-floating mb-4">
              <textarea class="form-control" name="source" placeholder="Leave a comment here" id="source-Textarea" style="height: 100px" disabled>
                <?php echo $hazard->source; ?>
              </textarea>
              <label for="source-Textarea">Source of Hazard</label>
            </div>

            <div class="form-floating mb-4">
              <textarea class="form-control" name="resault" placeholder="Leave a comment here" id="resault-Textarea" style="height: 100px" disabled>
                <?php echo $hazard->resault; ?>
              </textarea>
              <label for="resault-Textarea">Possible resault of Hazard</label>
            </div>

            <div class="form-floating mb-4">
              <textarea class="form-control" name="methods_and_tools" placeholder="Leave a comment here" id="methods-and-tools-Textarea" style="height: 100px" disabled>
                <?php echo $hazard->methods_and_tools; ?>
              </textarea>
              <label for="methods-and-tools-Textarea">Methods and tools to avoid a Hazard</label>
            </div>

            <div class="row">
              <div class="col-4">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Resaults</label>
                  <select id="resaultSelection" class="form-select" name="hazard_resault_id" disabled>
                    <?php echo "<option>" . $resault->name . "</option>";  ?>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Exposure</label>
                  <select id="exposureSelection" class="form-select" name="hazard_exposure_id" disabled>
                    <?php echo "<option>" . $exposure->name . "</option>";  ?>
                  </select>
                </div>
              </div>
              <div class="col-4">
                <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">Probability</label>
                  <select id="probabilitySelection" class="form-select" name="hazard_probability_id" disabled>
                    <?php echo "<option>" . $probability->name . "</option>";  ?>
                  </select>
                </div>
              </div>
            </div>

          </div>

          <div class="card-footer">
            <div class="my-2 row justify-content-md-center">
              <?php echo '<a href="/hazard-documents/'. $hazard->hazard_document_id . '" class="btn btn-success float-right">Back</a>'; ?>
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
      resaultScore = $(this).find('option:selected').data('value');
      caucluateScore();
    });

    $("#exposureSelection").on( "change", function() {
      exposureScore = $(this).find('option:selected').data('value');
      caucluateScore();
    });

    $("#probabilitySelection").on( "change", function() {
      probabilityScore = $(this).find('option:selected').data('value');
      caucluateScore();
    });

    function caucluateScore()
    {

      console.log([ resaultScore, exposureScore, probabilityScore]);

      totalScore = resaultScore * exposureScore * probabilityScore;

      if (totalScore > 0){

        console.log(totalScore);

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
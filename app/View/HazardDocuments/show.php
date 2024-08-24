<?php

  if (!(new App\Middleware\Auth())->checkToken()){
    header('Location: /login');
    exit;
  }

  require_once base() . '/View/includes/_header.php';
  require_once base() . '/View/includes/_navbar.html';

  // HAZARD DOCUMENT
  $hazardDocument = App\Models\HazardDocument::find($doc);

  $jobDescriptions = json_decode($hazardDocument->job_description);
  $machines = json_decode($hazardDocument->machines);
  $tools = json_decode($hazardDocument->tools);
  $materials = json_decode($hazardDocument->materials);
  $chemicals = json_decode($hazardDocument->chemicals);

  //HAZARD



  function loadCardColor(float $score = 0){
    return match (true){
      ($score < 20) => 'text-bg-success',
      ($score >= 20 && $score < 70) => 'text-bg-primary',
      ($score >= 70 && $score < 200) => 'text-bg-warning',
      ($score >= 200 && $score < 400) => 'text-bg-danger',
      ($score > 400) => 'text-bg-dark',
    };
  }

  //HAZARDS
  // $hazards = (new App\Models\Hazard())->getByDocument($hazardDocument->id);
?>

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="row my-3">
        <div class="col-4">
          <h4>Job Position:</h4><?= $hazardDocument->job_position ?>
        </div>
        <div class="col-4">
          <h4>Job Place:</h4><?= $hazardDocument->place ?>
        </div>
        <div class="col-4">
          <h4>Job Date:</h4><?= $hazardDocument->date ?>
        </div>
      </div>
    </div>

    <hr />

    <div class="row my-3">
      <div class="col-12">
        <h3>Details:</h3>

        <div class="accordion accordion-flush" id="accordionFlushExample">

          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-jobDescription" aria-expanded="false" aria-controls="flush-jobDescription">
                Job description
              </button>
            </h2>
            <div id="flush-jobDescription" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <UL>
                <?php
                  foreach((array)$jobDescriptions as $jobDescription){
                    echo "<LI>" . $jobDescription . "</LI>";
                  }
                ?>
                </UL>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-machine" aria-expanded="false" aria-controls="flush-machine">
                Machines and Aplicances
              </button>
            </h2>
            <div id="flush-machine" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <UL>
                <?php
                  foreach((array)$machines as $machine){
                    echo "<LI>" . $machine . "</LI>";
                  }
                ?>
                </UL>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-tool" aria-expanded="false" aria-controls="flush-tool">
                Tools
              </button>
            </h2>
            <div id="flush-tool" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <UL>
                <?php
                  foreach((array)$tools as $tool){
                    echo "<LI>" . $tool . "</LI>";
                  }
                ?>
                </UL>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-material" aria-expanded="false" aria-controls="flush-material">
                Materials
              </button>
            </h2>
            <div id="flush-material" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <UL>
                <?php
                  foreach((array)$materials as $material){
                    echo "<LI>" . $material . "</LI>";
                  }
                ?>
                </UL>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-chemical" aria-expanded="false" aria-controls="flush-chemical">
                Chemicals
              </button>
            </h2>
            <div id="flush-chemical" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <UL>
                <?php
                  foreach((array)$chemicals as $chemical){
                    echo "<LI>" . $chemical . "</LI>";
                  }
                ?>
                </UL>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

    <hr />

    <div class="row my-3">
      <div class="col-12">
        <h3>Possible hazards:</h3>

        <div class="row">
          <div class="col-12">

            <div class="row">

            <?php

              $hazards = \App\Models\Hazard::getByDocument($hazardDocument->id);

              foreach($hazards as $hazard){

                $hazardResault = \App\Models\HazardResault::find($hazard->hazard_resault_id);
                $hazardExposure = \App\Models\HazardExposure::find($hazard->hazard_exposure_id);
                $hazardProbability = \App\Models\HazardProbability::find($hazard->hazard_probability_id);

                $score = $hazardResault->strengh * $hazardExposure->strengh * $hazardProbability->strengh;

                echo ' <div class="col-sm-12 col-md-3 col-3">';
                  echo '<div class="card '. loadCardColor($score) . ' m-3">';
                    echo '<div class="card-body">';
                      echo '<h5 class="card-title">Hazard</h5>';
                      echo '<p class="card-text">Click button below to see details</p>';
                      echo '<a href="/hazards/' . $hazard->id . '" class="btn btn-primary">Show</a>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
              }

            ?>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-3">
            <div class="card m-3">
              <div class="card-body">
                <h5 class="card-title">Add HAzard</h5>
                <p class="card-text">Add Hazard by filling a form. System will calculate and score it for you and warn if that going be serious.</p>
                <a href="/hazards/create?hazardDocumentID=<?php echo $doc; ?>" class="btn btn-success">Add</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    </div>
  </div>
</div>


<?php require_once base() . '/View/includes/_footer.php'; ?>
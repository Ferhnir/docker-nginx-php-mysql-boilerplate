<?php
  require_once base() . '/View/includes/_header.php';
  require_once base() . '/View/includes/_navbar.html';
?>

<div class="container">
  <div class="row">
    <div class="col-12">
      <table class="table mt-5">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Job Position</th>
            <th scope="col">Job Place</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $hazardDocuments = \App\Models\HazardDocument::all('ORDER BY date DESC');

          foreach($hazardDocuments as $hazardDocument)
          {
            echo '<tr>';
              echo '<th scope="row">' . $hazardDocument->id . '</th>';
              echo '<td>' . $hazardDocument->job_position . '</td>';
              echo '<td>' . $hazardDocument->place . '</td>';
              echo '<td>' . $hazardDocument->date . '</td>';
              echo '<td>Awaiting</td>';
              echo '<td>';
                echo '<a href="/hazard-documents/' . $hazardDocument->id . '" class="btn btn-warning mx-1">Show</a>';
              echo '</td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require_once base() . '/View/includes/_footer.php'; ?>
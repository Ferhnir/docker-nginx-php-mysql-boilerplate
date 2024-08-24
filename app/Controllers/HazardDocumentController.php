<?php

namespace App\Controllers;

use App\Models\HazardDocument;
use Carbon\Carbon;

class HazardDocumentController
{
  public function index()
  {
    return include_once('app/View/HazardDocuments/index.php');
  }

  public function create()
  {
    return include_once('app/View/HazardDocuments/create.php');
  }

  public function store(array $requestParams)
  {
    $hazardDocument = new HazardDocument();
    [$success, $documentID, $message] = $hazardDocument->store(
      $requestParams['job_position'],
      $requestParams['place_of_job'],
      Carbon::createFromFormat('m/d/Y', $requestParams['date']),
      json_encode((object)$requestParams['job_description']),
      json_encode((object)$requestParams['machines']),
      json_encode((object)$requestParams['materials']),
      json_encode((object)$requestParams['tools']),
      json_encode((object)$requestParams['chemicals'])
    );

    if ($success) {
      header('Location: /hazard-documents/' . $documentID . '?message=' . $message);
      exit;
    } else {
      header('Location: /hazard-documents/create?error=' . $message);
      exit;
    }
  }

  public function delete()
  {

  }
}
<?php

namespace App\Controllers;

use App\Models\Hazard;
use Carbon\Carbon;

class HazardController
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
    $hazard = new Hazard();
    [$success, $documentID, $message] = $hazard->store(
      (int)$requestParams['hazard_document_id'],
      (int)$requestParams['hazard_resault_id'],
      (int)$requestParams['hazard_exposure_id'],
      (int)$requestParams['hazard_probability_id'],
      $requestParams['info'] ?? null,
      $requestParams['source'] ?? null,
      $requestParams['resault'] ?? null,
      $requestParams['methods_and_tools'] ?? null
    );

    if ($success) {
      header('Location: /hazard-documents/' . $requestParams["hazard_document_id"] . '?message=' . $message);
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
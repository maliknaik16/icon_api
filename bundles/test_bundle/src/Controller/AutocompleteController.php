<?php

/**
 * @file
 * Contains Drupal\test_bundle\Controller\AutocompleteController
 */

namespace Drupal\test_bundle\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Defines a controller for autocomplete form elements
 */
class AutocompleteController extends ControllerBase {
  /**
   * Handler for autocomplete request
   */
   public function handleIcons() {
    $response = [];

    $response[] = [
      'value' => 'vial',
      'label' => t('<i class="fa fa-vial fa-fw faa-2x"></i> Works'),
    ];

    return new JsonResponse($response);
   }
}

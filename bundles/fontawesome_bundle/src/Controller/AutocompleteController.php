<?php

/**
 * @file
 * Contains Drupal\fontawesome_bundle\Controller\AutocompleteController
 */

namespace Drupal\fontawesome_bundle\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Utility\Tags;
use Drupal\fontawesome_bundle\FontAwesomeIconData;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Defines a controller for autocomplete form elements
 */
class AutocompleteController extends ControllerBase {
  /**
   * Handler for autocomplete request
   */
   public static function handleIcons() {
    $response = [];

    // Get the value of q from the query string
    if($input = \Drupal::request()->query->get('q')) {
      $typed_string = Tags::explode($input);
      $typed_string = mb_strtolower(array_pop($typed_string));

      // Get the icon array
      $icon_data = FontAwesomeIconData::getIconArray();

      foreach($icon_data as $icon => $data) {
        // Check if the string match
        if(strpos($icon, $typed_string) === 0) {
          $response[] = [
            'value' => $icon,
            'label' => $this->t('<i class=":prefix fa-:icon fa-fw fa-2x"></i> :icon', [
              ':prefix' => FontAwesomeIconData::determinePrefix($icon_data[$icon]['styles']);
              ':icon' => $icon,
            ]),
          ];
        }
      }
    }

    return new JsonResponse($response);
   }
}

<?php

namespace Drupal\fontawesome_bundle;

/**
 * @file
 * Contains Drupal\fontawesome_bundle\FontAwesomeIconData.
 */

use Symfony\Component\Yaml\Yaml;

/**
 * Provides relevant data related to icons.
 */
class FontAwesomeIconData {

  /**
   * Get the icon data.
   */
  public static function getIconArray() {
    // Check for icons in cache.
    if (!$icons = \Drupal::cache('data')->get('fontawesome_bundle.iconlist')) {
      $icons = [];

      // Get the path for the icons.yml file.
      $path = drupal_get_path('module', 'fontawesome_bundle') . '/metadata/icons.yml';

      // Check if the icons.yml file exists.
      if (!file_exists($path)) {
        return $icons;
      }

      // Traverse through every icon.
      foreach (Yaml::parse(file_get_contents($path)) as $name => $data) {
        // Determine the icon style.
        $type = 'solid';
        foreach ($data['styles'] as $style) {
          if ($style == 'brands') {
            $type = 'brands';
            break;
          }
        }

        $icons[$name] = [
          'name' => $name,
          'type' => $type,
          'label' => $data['label'],
          'styles' => $data['styles'],
        ];
      }

      // Cache the icons array.
      \Drupal::cache('data')->set('fontawesome_bundle.iconlist', $icons, strtotime('+1 week'), ['fontawesome_bundle', 'iconlist']);
    }
    else {
      $icons = $icons->data;
    }
    return (array) $icons;
  }

  /**
   * Returns the prefix of the icon based on icon type.
   *
   * @param array $styles
   *   The array of styles options for icon.
   * @param string $default
   *   The default prefix for the icon.
   *
   * @return string
   *   A vaild prefix for this icon.
   */
  public static function determinePrefix(array $styles, $default = 'fas') {
    // Determine the icon style.
    foreach ($styles as $style) {
      if ($style == 'brands') {
        return 'fab';
      }
    }
    return $default;
  }

}

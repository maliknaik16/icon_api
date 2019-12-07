<?php

namespace Drupal\fontawesome_bundle;

/**
 * @file
 * Contains Drupal\fontawesome_bundle\IconStyle.
 */

use Symfony\Component\Yaml\Yaml;

/**
 * Provides functions to determine the icon style.
 */
class IconStyle {

  /**
   * Returns the icon style from the icon name.
   *
   * @param string $icon_name
   *   Name of the icon.
   *
   * @return string
   *   Icon style prefix.
   */
  public static function determineIconStyle($icon_name) {

    // Get the path for the icons.yml file.
    $path = drupal_get_path('module', 'fontawesome_bundle') . '/metadata/icons.yml';

    if (!file_exists($path)) {
      return 'fas';
    }

    foreach (Yaml::parse(file_get_contents($path)) as $name => $data) {
      if (strcmp(strtolower($icon_name), $name) == 0) {
        return FontAwesomeIconData::determinePrefix($data['styles']);
      }
    }
    return 'fas';
  }

}

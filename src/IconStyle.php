<?php

/**
 * @file
 * Contains Drupal\icon_api\IconStyle
 */

namespace Drupal\icon_api;

/**
 * Provides function to determine the icon style prefix
 */

class IconStyle {

  /**
   * Returns the prefix from the icon name
   *
   * @param string $bundle
   *  Machine name of the icon bundle sub-module
   *
   * @param string $icon_name
   *  Name of the icon
   *
   * @return string
   *  Prefix for the icon in the icon bundle
   */
  public static function determinePrefix($bundle, $icon_name) {
    if(\Drupal::service('module_handler')->moduleExists($bundle)) {
      $namespace = "\\Drupal\\{$bundle}\\IconStyle";
      return $namespace::determineIconStyle($icon_name);
    }

    return '';
  }
}

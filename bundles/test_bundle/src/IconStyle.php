<?php

namespace Drupal\test_bundle;

/**
 * @file
 * Contains Drupal\fontawesome_bundle\IconStyle.
 */

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
    return 'test';
  }

}

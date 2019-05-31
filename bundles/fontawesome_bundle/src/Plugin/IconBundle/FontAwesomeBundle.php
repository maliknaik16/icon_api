<?php

/**
 * @file
 * Contains Drupal\fontawesome_bundle\Plugin\IconBundle\FontAwesomeBundle
 */

namespace Drupal\fontawesome_bundle\Plugin\IconBundle;

use Drupal\icon_api\IconBundleBase;

/**
 * @IconBundle(
 *  id = "fontawesome_bundle",
 *  label = @Translation("Font Awesome Bundle"),
 *  description = @Translation("A icon bundle which integrates the icons from the fontawesome icons."),
 *  config_route = "fontawesome_bundle.settings",
 * )
 */

class FontAwesomeBundle extends IcoNBundleBase {
  /**
   * {@inheritdoc}
   */
  public function getLibrary() {
    return 'Sample Library';
  }
}

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
 *  autocomplete_route = "fontawesome_bundle.autocomplete",
 * )
 */

class FontAwesomeBundle extends IconBundleBase {
  /**
   * {@inheritdoc}
   */
  public function getConfigRoute() {
    return parent::getConfigRoute();
  }
}

<?php

namespace Drupal\test_bundle\Plugin\IconBundle;

/**
 * @file
 * Contains Drupal\test_bundle\Plugin\IconBundle\TestBundle.
 */

use Drupal\icon_api\IconBundleBase;

/**
 * TestBundle plugin.
 *
 * @IconBundle(
 *  id = "test_bundle",
 *  label = @Translation("Test Bundle"),
 *  description = @Translation("A sample icon bundle to test the plugin system"),
 *  autocomplete_route = "test_bundle.autocomplete",
 *  config_route = "test_bundle.settings",
 * )
 */
class TestBundle extends IconBundleBase {

  /**
   * {@inheritdoc}
   */
  public function getConfigRoute() {
    return parent::getConfigRoute();
  }

}

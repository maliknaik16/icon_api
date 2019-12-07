<?php

namespace Drupal\icon_api;

/**
 * @file
 * Contains Drupal\icon_api\IconBundleBase.
 */

use Drupal\Component\Plugin\PluginBase;

/**
 * Implements plugin functions.
 */
class IconBundleBase extends PluginBase implements IconBundleInterface {

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return $this->pluginDefinition['label'];
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->pluginDefinition['description'];
  }

  /**
   * {@inheritdoc}
   */
  public function getAutocompleteRoute() {
    return $this->pluginDefinition['autocomplete_route'];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfigRoute() {
    return $this->pluginDefinition['config_route'];
  }

}

<?php

/**
 * @file
 * Contains Drupal\icon_api\IconBundleBase
 */

namespace Drupal\icon_api;

use Drupal\Component\Plugin\PluginBase;

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
  public function getConfigRoute() {
    return $this->pluginDefinition['autocomplete_route'];
  }

}

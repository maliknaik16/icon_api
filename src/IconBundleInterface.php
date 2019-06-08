<?php

/**
 * @file
 * Provides Drupal\icon_api\IconBundleInterface
 */

namespace Drupal\icon_api;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Provides an interface for the Icon bundle plugins
 */
interface IconBundleInterface extends PluginInspectionInterface {

  /**
   * Returns the label
   */
  public function getLabel();

  /**
   * Returns the description
   */
  public function getDescription();

  /**
   * Returns the route of the configuration
   */
  public function getConfigRoute();

}

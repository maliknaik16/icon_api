<?php

namespace Drupal\icon_api;

/**
 * @file
 * Provides Drupal\icon_api\IconBundleInterface.
 */

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Provides an interface for the Icon bundle plugins.
 */
interface IconBundleInterface extends PluginInspectionInterface {

  /**
   * Returns the label.
   */
  public function getLabel();

  /**
   * Returns the description.
   */
  public function getDescription();

  /**
   * Returns the autocomplete route.
   */
  public function getAutocompleteRoute();

  /**
   * Returns the autocomplete route.
   */
  public function getConfigRoute();

}

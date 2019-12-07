<?php

namespace Drupal\icon_api;

/**
 * @file
 * Contains Drupal\icon_api\IconBundleManager.
 */


use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\icon_api\Annotation\IconBundle;

/**
 * Provides the Icon bundle plugin manager.
 */
class IconBundleManager extends DefaultPluginManager {

  /**
   * Constructs a new IconBundleManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/IconBundle', $namespaces, $module_handler, IconBundleInterface::class, IconBundle::class);

    $this->alterInfo('icon_bundle_info');
    $this->setCacheBackend($cache_backend, 'icon_bundle_plugins');
  }

}

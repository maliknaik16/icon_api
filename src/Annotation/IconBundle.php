<?php

namespace Drupal\icon_api\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Icons bundle item annotation object.
 *
 * @see Drupal\icon_api\IconBundleManager
 * @see plugin_api
 *
 * @Annotation
 */
class IconBundle extends Plugin {

  /**
   * The plugin machine name.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

  /**
   * The description of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;

  /**
   * The route for the bundle form.
   *
   * @var string
   */
  public $autocomplete_route;

  /**
   * The route of the autcomplete controller.
   *
   * @var string
   */
  public $config_route;

}

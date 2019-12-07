<?php

namespace Drupal\icon_api\Controller;

/**
 * @file
 * Contains Drupal\icon_api\Controller\IconBundleController.
 */

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\icon_api\IconBundleManager;
use Drupal\Core\Url;

/**
 * Renders plugins of Icon.
 */
class IconBundleController extends ControllerBase {
  /**
   * The icons bundle manager.
   *
   * @var \Drupal\icon_api\IconBundleManager
   */
  private $iconBundleManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('plugin.manager.icon_bundle'));
  }

  /**
   * IconBundleController constructor.
   *
   * @param \Drupal\icon_api\IconBundleManager $iconBundleManager
   *   The icon bundle manager.
   */
  public function __construct(IconBundleManager $iconBundleManager) {
    $this->iconBundleManager = $iconBundleManager;
  }

  /**
   * Renders the list of plugins for icon bundles.
   *
   * @return array
   *   Render array with the icon bundles.
   */
  public function plugins() {
    $bundles = $this->iconBundleManager->getDefinitions();

    $data = [];

    foreach ($bundles as $bundle) {
      $data[$bundle['id']] = $this->buildRow($bundle);
    }

    $form['overview'] = [
      '#theme' => 'table',
      '#header' => $this->buildHeader(),
      '#rows' => $data,
      '#empty' => $this->t('There are no Icon bundles enabled.'),
    ];

    return $form;
  }

  /**
   * Builds the header row for the plugin.
   *
   * @return array
   *   a render array for the table header.
   */
  public function buildHeader() {
    $header = [
      $this->t('Bundle Name'),
      $this->t('Bundle Machine Name'),
      $this->t('Operations'),
    ];

    return $header;
  }

  /**
   * Builds the row for the icon bundle plugin.
   *
   * @param \Drupal\icon_api\IconBundleManager $bundle
   *   The plugin definition.
   *
   * @return array
   *   A render array structure of fields or columns.
   */
  public function buildRow($bundle) {
    $row = [
      'bundle' => [
        'data' => [
          '#type' => 'markup',
          '#prefix' => '<b>' . $bundle['label'] . '</b>',
          '#suffix' => '<div class="icon-bundle-description">' . $bundle['description'] . '</div>',
        ],
      ],
      'bundle_machine' => [
        'data' => [
          '#type' => 'markup',
          '#prefix' => '<span>' . $bundle['id'] . '</span>',
        ],
      ],
      'operations' => [
        'data' => [
          '#type' => 'operations',
          '#links' => [
            'edit' => [
              'title' => $this->t('Configure Bundle'),
              'url' => Url::fromRoute($bundle['config_route']),
            ],
          ],
        ],
      ],
    ];
    return $row;
  }

}

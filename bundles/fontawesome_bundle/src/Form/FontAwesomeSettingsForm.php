<?php

/**
 * @file
 * Contains Drupal\fontawesome_bundle\Form
 */

namespace Drupal\fontawesome_bundle\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Asset\LibraryDiscovery;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Drupal\fontawesome_bundle\Form\FontAwesomeSettingsForm
 */
class FontAwesomeSettingsForm extends ConfigFormBase {

  /**
   * Drupal LibraryDiscovery service container
   *
   * @var \Drupal\Core\Asset\LibraryDiscovery
   */
  protected $libraryDiscovery;

  /**
   * {@inheritdoc}
   */
  public function __construct(LibraryDiscovery $libraryDiscovery) {
    $this->libraryDiscovery = $libraryDiscovery;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('library.discovery')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'fontawesome_bundle.settings'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'fontawesome_bundle_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get settings
    $config = $this->config('fontawesome_bundle.settings');

    $libraryInfo = $this->libraryDiscovery->getLibraryByName('fontawesome_bundle', 'fontawesome_bundle.svg');

    $form['method'] = [
      '#type' => 'select',
      '#title' => 'Bundle Method',
      '#options' => [
        'svg' => 'SVG With JS',
        'webfonts' => 'Web Fonts with CSS'
      ],
      '#default_value' => $config->get('method'),
      '#description' => $this->t('This setting controls the way font awesome works.'),
    ];

    $form['external'] = [
      '#type' => 'details',
      '#tree' => TRUE,
      '#title' => t('External File'),
      '#open' => TRUE,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#access' => TRUE,
      '#description' => $this->t('These settings controls whether to use the path specified for the icon library file.')
    ];

    $form['external']['use_cdn'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use External/Local file'),
      '#default_value' => $config->get('use_cdn') ? $config->get('use_cdn') : TRUE,
    ];

    $form['external']['external_location'] = [
      '#type' => 'textfield',
      '#title' => $this->t('External File Location'),
      '#default_value' => $config->get('external_location') ? $config->get('external_location') : 'https://use.fontawesome.com/releases/v' . $libraryInfo['version'] . '/js/all.js',
      '#description' => $this->t('For more information on the library visit :url', [
        ':url' => $libraryInfo['remote'],
      ]),
      '#states' => [
        'disabled' => [
          ':input[name="external[use_cdn]"]' => ['checked' => FALSE],
        ],
        'visible' => [
          ':input[name="external[use_cdn]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['partial'] = [
      '#type' => 'details',
      '#tree' => TRUE,
      '#title' => t('Partial File Configuration'),
      '#open' => TRUE,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#access' => TRUE,
    ];

    $form['partial']['use_solid'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Solid Icons'),
      '#description' => $this->t('Checking this field will load the font awesome icons from the <i>solid.js/solid.css</i>'),
      '#default_value' => $config->get('use_solid') ? $config->get('use_solid') : TRUE,
    ];

    $form['partial']['use_light'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Light Icons'),
      '#default_value' => $config->get('use_light'),
      '#description' => $this->t('Checking this field will load the font awesome icons from the <i>light.js/light.css</i>'),
    ];

    $form['partial']['use_regular'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Regular Icons'),
      '#default_value' => $config->get('use_regular'),
      '#description' => $this->t('Checking this field will load the font awesome icons from the <i>regular.js/regular.css</i>'),
    ];
    $form['partial']['use_brand'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Brand Icons'),
      '#default_value' => $config->get('use_brand'),
      '#description' => $this->t('Checking this field will load the font awesome icons from the <i>brands.js/brands.css</i>'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues()['external'];

    // Validate URL
    if(empty($values['external_location']) || !UrlHelper::isValid($values['external_location'], TRUE)) {
      $form_state->setErrorByName('external_location', $this->t('Invalid library location provided.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    // Load fontawesome libraries
    $fontawesome_library = $this->libraryDiscovery->getLibraryByName('fontawesome_bundle', 'fontawesome_bundle.svg');

    // Default location of the library
    $default_location = 'https://use.fontawesome.com/releases/v' . $fontawesome_library['version'] . '/';

    $default_svg_location = $default_location . 'js/all.js';
    $default_webfonts_location = $default_location . 'css/all.css';

    if($values['external']['use_cdn']) {
      if(empty($values['external']['external_location'])) {
        $values['external']['external_location'] = ($values['method'] == 'webfonts') ? $default_webfonts_location : $default_svg_location;
      }
    }

    // Save the settings
    $this->config('fontawesome_bundle.settings')
      ->set('method', $values['method'])
      ->set('use_cdn', $values['external']['use_cdn'])
      ->set('external_location', $values['external']['external_location'])
      ->set('use_solid', $values['partial']['use_solid'])
      ->set('use_light', $values['partial']['use_light'])
      ->set('use_regular', $values['partial']['use_regular'])
      ->set('use_brand', $values['partial']['use_brand'])
      ->save();

    drupal_flush_all_caches();

    parent::submitForm($form, $form_state);
  }
}

<?php

/**
 * @file
 * Contains Drupal\fontawesome_bundle\Form
 */

namespace Drupal\fontawesome_bundle\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Component\Utility\UrlHelper;

/**
 * Class Drupal\fontawesome_bundle\Form\FontAwesomeSettingsForm
 */
class FontAwesomeSettingsForm extends ConfigFormBase {
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

    $form['method'] = [
      '#type' => 'select',
      '#title' => 'Bundle Method',
      '#options' => [
        'svg' => 'SVG With JS',
        'webfonts' => 'Web Fonts with CSS'
      ],
      '#default_value' => $config->get('bundle_method') ? $config->get('bundle_method') : 'svg',
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
      '#default_value' => $config->get('external_location') ? $config->get('external_location') : '',
      '#states' => [
        'disabled' => [
          ':input[name="use_cdn"]' => ['checked' => FALSE],
        ],
        'visible' => [
          ':input[name="use_cdn"]' => ['checked' => TRUE],
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
      '#description' => $this->t('Checking this field will load the font awesome icons from the <i>regular.js/regular.css</i>'),
    ];

    $form['partial']['use_light'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Light Icons'),
    ];

    $form['partial']['use_regular'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Regular Icons'),
    ];
    $form['partial']['use_brand'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Brand Icons'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues()['external'];

    // Validate URL
    if(empty($values['external_location']) && !UrlHelper::isValid($values['external_location'])) {
      $form_state->setErrorByName('external_location', $this->t('Invalid library location provided.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    $config = $this->config('fontawesome_bundle.settings');

    parent::submitForm($form, $form_state);
  }
}

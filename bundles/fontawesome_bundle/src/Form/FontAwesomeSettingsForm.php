<?php

/**
 * @file
 * Contains Drupal\fontawesome_bundle\Form
 */

namespace Drupal\fontawesome_bundle\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

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
    $config = $this->config('fontawesome_bundle.settings');

    /*$form['welcome_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Welcome message'),
      '#description' => $this->t('Description for the above text field'),
    ];*/

    $form['bundle_method'] = [
      '#type' => 'select',
      '#title' => 'Bundle Method',
      '#options' => [
        'svg' => 'SVG With JS',
        'webfonts' => 'Web Fonts with CSS'
      ],
    ];

    $form['external_file'] = [
      '#type' => 'details',
      '#tree' => TRUE,
      '#title' => t('External File'),
      '#open' => TRUE,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#access' => TRUE,
    ];

    $form['external_file']['use_el_file'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use External/Local file'),
    ];

    $form['external_file']['location'] = [
      '#type' => 'textfield',
      '#title' => $this->t('External File Location'),
    ];

    $form['partial_file_config'] = [
      '#type' => 'details',
      '#tree' => TRUE,
      '#title' => t('Partial File Configuration'),
      '#open' => TRUE,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#access' => TRUE,
    ];

    $form['partial_file_config']['solid'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Solid Icons'),
    ];

    $form['partial_file_config']['light'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Light Icons'),
    ];

    $form['partial_file_config']['regular'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Regular Icons'),
    ];
    $form['partial_file_config']['brand'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Load Brand Icons'),
    ];

    return parent::buildForm($form, $form_state);
  }
}

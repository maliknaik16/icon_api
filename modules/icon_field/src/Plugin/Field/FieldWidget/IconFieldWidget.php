<?php

/**
 * @file
 * Contains \Drupal\icon_field\Plugin\Field\FieldWidget\IconFieldWidget.
 */

namespace Drupal\icon_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Plugin implementation of 'icon_field' widget.
 *
 * @FieldWidget(
 *  id = "icon_field_widget",
 *  label = @Translation("Icon"),
 *  module = "icon_field",
 *  field_types = {
 *    "icon_field"
 *  }
 * )
 */
class IconFieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $field_name = $items->getFieldDefinition()->getName();

    $access = \Drupal::currentUser()->hasPermission('administer icons');

    $options = unserialize($items[$delta]->get('options')->getValue());

    $icon_bundle = $this->getInstalledIconBundles();

    $form['#icon_field_name'] = $field_name;
    $form['#icon_field_delta'] = $delta;

    $form_field_id = 'icon_field-field-wrapper-' . $field_name . '-' . $delta;

    $element += [
      '#type' => 'details',
      '#tree' => TRUE,
      '#title' => t('Icon'),
      '#open' => TRUE,
      '#access' => $access,
    ];

    $element['bundle'] = [
      '#title' => $this->t('Icon Bundle'),
      '#type' => 'select',
      '#description' => t('Choose the icon bundle to display the icons using the autocomplete.'),
      '#default_value' => key($icon_bundle), //$items[$delta]->get('bundle')->getValue(),
      '#options' => $icon_bundle,
      '#ajax' => [
        'callback' => [$this, 'updateIconField'],
        'event' => 'change',
        'wrapper' => $form_field_id,
      ],
    ];

    $element['icon'] = [
      '#title' => $this->t('Search Icon'),
      '#type' => 'textfield',
      '#prefix' => '<div id="' . $form_field_id . '">',
      '#suffix' => '</div>',
      '#default_value' => $items[$delta]->get('icon')->getValue(),
      '#autocomplete_route_name' => $form_state->getValue('bundle') ? $form_state->getValue('bundle') : key($icon_bundle),
    ];

    $element['wrapper'] = [
      '#type' => 'select',
      '#title' => t('Icon Wrapper'),
      '#description' => t('Choose an HTML element to wrap the icon with.'),
      '#options' => array(
        'i' => t('i'),
        'span' => t('span'),
      ),
      '#default_value' => '',
    ];

    $element['wrapper_class'] = [
      '#type' => 'textfield',
      '#title' => t('Icon Wrapper Classes'),
      '#description' => t('A space separated list of CSS classes.'),
      '#default_value' => '',
    ];

    $element['use_link'] = [
      '#type' => 'checkbox',
      '#title' => t('Wrap Link around the Icon'),
      '#description' => t('When checked wraps an anchor tag with the link from the next field.'),
      '#default_value' => '',
    ];

    $element['icon_link'] = [
      '#type' => 'textfield',
      '#title' => t('Icon Link'),
      '#default_value' => '',
      '#states' => [
        'visible' => [
          ':input[name="field_icon_field[' . $delta . '][use_link]"]' => [
            'checked' => TRUE,
          ],
        ],
      ],
    ];

    //ksm($form);

    return $element;
  }

  /**
   * Returns the installed Icon bundles
   */
  public function getInstalledIconBundles() {
    // Get the icon bundle list
    $icon_manager = \Drupal::service('plugin.manager.icon_bundle');
    $icon_definitions = $icon_manager->getDefinitions();
    $icon_bundle = array();

    foreach($icon_definitions as $icon_definition) {
      $icon_bundle[$icon_definition['autocomplete_route']] = $icon_definition['label'];
    }

    return $icon_bundle;
  }

  /**
   * Returns the 'Search icon' textfield
   */
  public function updateIconField(array &$form, FormStateInterface $form_state) {
    // Get the delta
    $delta = $form['#icon_field_delta'];

    // Get the field name
    $field_name = $form['#icon_field_name'];

    // Get the textfield
    $icon_form = $form[$field_name]['widget'][$delta]['icon'];

    // Get the current icon bundle key
    $value = $form_state->getTriggeringElement()['#value'];

    // Set the autocomplete route name to the current icon bundle key
    $icon_form['#autocomplete_route_name'] = $value;

    // Set the autocomplete atttribute
    $icon_form['#attributes']['data-autocomplete-path'] = Url::fromRoute($value)->toString();

    return $icon_form;
  }
}

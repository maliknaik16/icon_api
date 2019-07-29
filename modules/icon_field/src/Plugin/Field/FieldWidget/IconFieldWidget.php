<?php

/**
 * @file
 * Contains \Drupal\icon_field\Plugin\Field\FieldWidget\IconFieldWidget.
 */

namespace Drupal\icon_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

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
    $bundle = isset($items[$delta]->bundle) ? $items[$delta]->bundle : '';
    $icon = isset($items[$delta]->icon) ? $items[$delta]->icon : '';

    $element['bundle'] = [
      '#title' => $this->t('Icon Bundle machine name:'),
      '#type' => 'textfield',
      '#default_value' => $bundle,
    ];

    $element['icon'] = [
      '#title' => $this->t('Icon name: '),
      '#type' => 'textfield',
      '#default_value' => $icon,
    ];

    return $element;
  }
}

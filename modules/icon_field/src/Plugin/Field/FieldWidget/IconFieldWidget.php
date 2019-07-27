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
}

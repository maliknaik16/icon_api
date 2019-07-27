<?php

/**
 * @file
 * Contains \Drupal\icon_field\Plugin\Field\FieldFormatter\IconFieldFormatter.
 */

namespace Drupal\icon_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of 'icon_field' formatter.
 *
 * @FieldFormatter (
 *  id = "icon_field_formatter",
 *  label = @Translation("Icon"),
 *  field_types = {
 *    "icon_field"
 *  }
 * )
 */
class IconFieldFormatter extends FormatterBase {
}

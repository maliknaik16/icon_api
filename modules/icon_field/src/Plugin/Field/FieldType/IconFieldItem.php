<?php

/**
 * @file
 * Contains \Drupal\icon_field\Plugin\Field\FieldType\IconFieldItem.
 */

namespace Drupal\icon_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin Implementation of the 'icon_field' field type.
 * @FieldType(
 *  id = "icon_field",
 *  label = @Translation("Icon Field"),
 *  description = @Translation("Store a bundle and icon in the database to assemble an icon field."),
 *  default_widget = "icon_field_widget",
 *  default_formatter = "icon_field_formatter"
 * )
 */
class IconFieldItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'bundle' => [
          'type' => 'varchar',
          'length' => 64,
          'not null' => FALSE,
        ],
        'icon' => [
          'type' => 'varchar',
          'length' => 64,
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];
  }
}

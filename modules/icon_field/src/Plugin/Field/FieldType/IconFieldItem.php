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
 *  module = "icon_field",
 *  description = @Translation("Store a bundle and icon in the database to assemble an icon field."),
 *  category = @Translation("Icons"),
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
          'not null' => TRUE,
        ],
        'icon' => [
          'type' => 'varchar',
          'length' => 64,
          'not null' => TRUE,
        ],
        'wrapper' => [
          'type' => 'text',
          'size' => 'small',
          'not null' => TRUE,
        ],
        'wrapper_class' => [
          'type' => 'text',
          'size' => 'medium',
          'not null' => TRUE,
        ],
        'use_link' => [
          'type' => 'int',
          'size' => 'tiny',
          'not null' => TRUE,
        ],
        'icon_link' => [
          'type' => 'text',
          'size' => 'normal',
          'not null' => TRUE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];
    $properties['bundle'] = DataDefinition::create('string')
      ->setLabel(t('Icon Bundle'))
      ->setDescription(t('Machine name of the icon bundle.'));

    $properties['icon'] = DataDefinition::create('string')
      ->setLabel(t('Icon Name'))
      ->setDescription(t('The name of the icon.'));

    $properties['wrapper'] = DataDefinition::create('string')
      ->setLabel(t('Icon wrapper'))
      ->setDescription(t('HTML element to wrap the icon with.'));

    $properties['wrapper_class'] = DataDefinition::create('string')
      ->setLabel(t('Icon Wrapper Classes'))
      ->setDescription(t('Custom css classes for the icon.'));

    $properties['use_link'] = DataDefinition::create('boolean')
      ->setLabel(t('Wrap Link around the Icon'))
      ->setDescription(t('Wrapping the link around the icon.'));

    $properties['icon_link'] = DataDefinition::create('string')
      ->setLabel(t('Icon Link'))
      ->setDescription(t('Link to wrap around the icon.'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $bundle = $this->get('bundle')->getValue();
    $icon = $this->get('icon')->getValue();

    return $bundle === NULL || $bundle === '' || $icon === NULL || $icon === '';
  }
}

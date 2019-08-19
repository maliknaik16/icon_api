<?php

/**
 * @file
 * Contains Drupal\icon_filter\Plugin\Filter\FilterIcon
 */

namespace Drupal\icon_filter\Plugin\Filter;

use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;

/**
 * @Filter(
 *  id = "icon_filter",
 *  title = @Translation("Convert [icon_api:%bundle:%icon] tags"),
 *  description = @Translation("Converts all [icon_api:%bundle:%icon] tags into the correct markup necessary for displaying a specific icon. Replace the %bundle with the bundle machine name and replace %icon with the icon machine name."),
 *  type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * )
 */
class FilterIcon extends FilterBase {
  /**
   * Icon Filter Regular expression pattern
   *
   * @var string
   */
  protected $icon_filter_regex = '/\[icon_api:([^:]*):([^\]]*)\]/';

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $icons = array();

    if (preg_match_all($this->icon_filter_regex, $text, $matches, PREG_SET_ORDER)) {
      foreach ($matches as $match) {
        if (!isset($icons[$match[0]])) {
          $icons[$match[0]] = [
            '#theme' => 'icon_api',
            '#bundle' => $match[1],
            '#icon' => $match[2],
            '#icon_style' => \Drupal\icon_api\IconStyle::determinePrefix($match[1], $match[2]),
          ];
        }
      }

      foreach ($icons as $search => $replace) {
        if (!empty($replace)) {
          $text = str_replace($search, \Drupal::service('renderer')->render($replace), $text);
        }
      }
    }
    return new FIlterProcessResult($text);
  }
}

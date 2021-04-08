<?php

namespace Drupal\export\Normalizer;

use Drupal\datetime_range\Plugin\Field\FieldType\DateRangeItem;

/**
 * Converts the Drupal address field object structure to a txt array structure.
 */
class DateRangeItemNormalizer extends NormalizerBase {

  /**
   * {@inheritdoc}
   */
  protected $supportedInterfaceOrClass = DateRangeItem::class;

  /**
   * {@inheritdoc}
   */
  public function normalize($date_range_item, $format = NULL, array $context = []) {
    return [
      $date_range_item->get('value')->getValue(),
      $date_range_item->get('end_value')->getValue(),
    ];
  }

}

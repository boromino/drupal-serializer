<?php

namespace Drupal\export\Normalizer;

use Drupal\Core\Field\FieldItemListInterface;

/**
 * Converts the Drupal entity object structure to a txt array structure.
 */
class FieldItemListNormalizer extends NormalizerBase {

  /**
   * {@inheritdoc}
   */
  protected $supportedInterfaceOrClass = FieldItemListInterface::class;

  /**
   * {@inheritdoc}
   */
  public function normalize($field_item_list, $format = NULL, array $context = []) {
    if ($field_item_list->isEmpty()) {
      return $this->placeholder($field_item_list);
    }

    $field_item_values = [];
    foreach ($field_item_list as $field_item) {
      /** @var \Drupal\Core\Field\FieldItemInterface $field_item */
      $field_item_values = $this->serializer->normalize($field_item, $format, $context);
    }

    return $field_item_values;
  }

  /**
   * Returns array of empty placeholders if field item list is empty.
   *
   * @param FieldItemListInterface $field_item_list
   * @return array
   */
  protected function placeholder(FieldItemListInterface $field_item_list) {
    $class = explode('\\', $field_item_list->getItemDefinition()->getClass());
    $class = array_pop($class);

    switch ($class) {
      case 'DateRangeItem':
        $num = 2;
        break;
      case 'AddressItem':
        $num = 8;
        break;
      default:
        $num = 1;
    }

    return array_fill(0, $num, '');
  }

}

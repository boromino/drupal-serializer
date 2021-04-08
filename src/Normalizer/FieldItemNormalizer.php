<?php

namespace Drupal\export\Normalizer;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Converts the Drupal entity object structure to a txt array structure.
 */
class FieldItemNormalizer extends NormalizerBase {

  /**
   * {@inheritdoc}
   */
  protected $supportedInterfaceOrClass = FieldItemInterface::class;

  /**
   * {@inheritdoc}
   */
  public function normalize($field_item, $format = NULL, array $context = []) {
    $main_property_name = $field_item->getDataDefinition()->getMainPropertyName();
    $main_property = $field_item->get($main_property_name);
    $value = $this->serializer->normalize($main_property);
    return ($value) ? $value : '';
  }

}

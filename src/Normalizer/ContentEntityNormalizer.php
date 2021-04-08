<?php

namespace Drupal\export\Normalizer;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Converts the Drupal entity object structure to a txt array structure.
 */
class ContentEntityNormalizer extends NormalizerBase {

  /**
   * {@inheritdoc}
   */
  protected $supportedInterfaceOrClass = ContentEntityInterface::class;

  /**
   * {@inheritdoc}
   */
  public function normalize($entity, $format = NULL, array $context = []) {
    $context += [
      'account' => NULL,
      'included_fields' => NULL,
    ];

    // Create the array of normalized fields.
    $normalized = [];

    /** @var $entity \Drupal\Core\Entity\ContentEntityInterface */
    $field_items = $entity->getFields();

    // If the fields to use were specified, only output those field values.
    if (isset($context['included_fields'])) {
      // array_intersect_key maintaining the file column order.
      $field_items = array_intersect_key($field_items, array_flip($context['included_fields']));
    }
    foreach ($field_items as $field_item_list) {
      // Continue if the current user does not have access to view this field.
      if (!$field_item_list->access('view', $context['account'])) {
        continue;
      }

      $normalized_field = $this->serializer->normalize($field_item_list, $format, $context);
      if (is_array($normalized_field)) {
        $normalized = array_merge($normalized, $normalized_field);
      }
      else {
        $normalized[] = $normalized_field;
      }
    }

    return $normalized;
  }

}

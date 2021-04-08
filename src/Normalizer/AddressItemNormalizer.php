<?php

namespace Drupal\export\Normalizer;

use Drupal\address\Plugin\Field\FieldType\AddressItem;

/**
 * Converts the Drupal address field object structure to a txt array structure.
 */
class AddressItemNormalizer extends NormalizerBase {

  /**
   * {@inheritdoc}
   */
  protected $supportedInterfaceOrClass = AddressItem::class;

  /**
   * {@inheritdoc}
   */
  public function normalize($address_item, $format = NULL, array $context = []) {
    /** @var \Drupal\address\AddressInterface $address_item */
    return [
      $address_item->getOrganization(),
      $address_item->getCountryCode(),
      $address_item->getLocality(),
      $address_item->getDependentLocality(),
      $address_item->getAdministrativeArea(),
      $address_item->getPostalCode(),
      $address_item->getAddressLine1(),
      $address_item->getAddressLine2(),
    ];
  }

}

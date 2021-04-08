<?php

namespace Drupal\export\Plugin\Export;

/**
 * Page export to a file.
 *
 * @Export(
 *  id = "page",
 *  label = @Translation("Page")
 * )
 */
class PageExport extends ExportBase {

  /**
   * {@inheritdoc}
   */
  public function getHeaders() {
    return [
      'Title',
      'Organisation',
      'Country',
      'City',
      'Area',
      'State',
      'Postal Code',
      'Street',
      'Street 2',
      'Start date',
      'End date',
      'Telephone',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getIncludedFields() {
    return [
      'title',
      'field_address',
      'field_daterange',
      'field_telephone',
    ];
  }

}

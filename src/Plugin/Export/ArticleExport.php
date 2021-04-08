<?php

namespace Drupal\export\Plugin\Export;

/**
 * Article export to a file.
 *
 * @Export(
 *  id = "article",
 *  label = @Translation("Article")
 * )
 */
class ArticleExport extends ExportBase {

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
      'Date',
      'Start date',
      'End date'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getIncludedFields() {
    return [
      'title',
      'field_address',
      'field_date',
      'field_daterange',
    ];
  }

}

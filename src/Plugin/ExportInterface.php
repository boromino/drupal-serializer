<?php

namespace Drupal\export\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for Export plugins.
 */
interface ExportInterface extends PluginInspectionInterface {

  /**
   * Get export file headers.
   *
   * @return array
   */
  public function getHeaders();

  /**
   * Get entity fields to export.
   *
   * @return array
   */
  public function getIncludedFields();

}

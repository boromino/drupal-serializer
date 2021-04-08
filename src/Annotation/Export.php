<?php

namespace Drupal\export\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Export item annotation object.
 *
 * @see \Drupal\export\ExportManager
 *
 * @Annotation
 */
class Export extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}

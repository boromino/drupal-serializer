<?php

namespace Drupal\export\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Export plugin manager.
 */
class ExportManager extends DefaultPluginManager {

  /**
   * ExportManager constructor.
   *
   * @param \Traversable $namespaces
   *  An object that implements \Traversable which contains the root paths
   *  keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *  Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *  The module handler to invoke the alter hook with.
  */
  public function __construct(\Traversable $namespaces,
  CacheBackendInterface $cache_backend, ModuleHandlerInterface
  $module_handler) {
    parent::__construct(
      'Plugin/Export',
      $namespaces,
      $module_handler,
      'Drupal\export\Plugin\ExportInterface',
      'Drupal\export\Annotation\Export'
    );

    $this->alterInfo('export_info');
    $this->setCacheBackend($cache_backend, 'export_plugins');
  }
}

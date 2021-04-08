<?php

namespace Drupal\export\Commands;

use Drush\Commands\DrushCommands;
use Symfony\Component\Console\Input\InputOption;
use Drupal\export\Plugin\ExportManager;
use \Drupal\export\Plugin\ExportInterface;

/**
 * Drush commands for export.
 */
class ExportCommands extends DrushCommands {

  /**
   * @var \Drupal\export\Plugin\ExportManager
   */
  protected $exportManager;

  /**
   * ExportCommands constructor.
   *
   * @param \Drupal\export\Plugin\ExportManager $exportManager
   */
  public function __construct(ExportManager $exportManager) {
    $this->exportManager = $exportManager;
  }

  /**
   * Exports the data.
   *
   * @option export
   *   The export config ID to use.
   *
   * @command export
   * @aliases ex,export
   *
   * @param array $options
   *   The command options.
   */
  public function export($options = ['export' => InputOption::VALUE_REQUIRED]) {
    $export = $options['export'];

    if (!is_null($export)) {
      $plugin = $this->exportManager->createInstance($export);
      if ($plugin instanceof ExportInterface) {
        $plugin->export();
      }
    }
  }

}

<?php

namespace Drupal\export\Plugin\Export;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\File\FileSystemInterface;
use Drupal\export\Encoder\TxtEncoder;
use Drupal\export\Plugin\ExportInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Base class for Export plugins.
 */
abstract class ExportBase extends PluginBase implements ExportInterface, ContainerFactoryPluginInterface {

  const FORMAT = 'txt';

  /**
   * The file_system service.
   *
   * @var \Drupal\Core\File\FileSystemInterface;
   */
  protected $fileSystem;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var \Symfony\Component\Serializer\Serializer
   */
  protected $serializer;

  /**
   * ExportBase constructor.
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param FileSystemInterface $file_system
   * @param Serializer $serializer
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition,
                              FileSystemInterface $file_system,
                              EntityTypeManager $entity_type_manager,
                              Serializer $serializer) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->fileSystem = $file_system;
    $this->entityTypeManager = $entity_type_manager;
    $this->serializer = $serializer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id,
  $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('file_system'),
      $container->get('entity_type.manager'),
      $container->get('serializer')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function export() {
    $headers = join(TxtEncoder::getDelimiter(), $this->getHeaders()) . PHP_EOL;
    $destination = 'public://' . $this->pluginId . '.' . self::FORMAT;
    $this->fileSystem->saveData($headers, $destination, FileSystemInterface::EXISTS_REPLACE);

    $nodes = $this->entityTypeManager
      ->getStorage('node')
      ->loadByProperties(['type' => $this->pluginId]);

    $rows = $this->serializer->serialize($nodes, self::FORMAT, ['included_fields' => $this->getIncludedFields()]);

    $file = new \SplFileObject($destination, 'a');
    // fputcsv doesn't allow for empty enclosure.
    $file->fwrite($rows);
    $file = NULL;
  }

}

<?php

namespace Drupal\export\Encoder;

use Symfony\Component\Serializer\Encoder\EncoderInterface;

/**
 * Encodes data in custom Txt format.
 */
class TxtEncoder implements EncoderInterface {

  /**
   * The formats that this Encoder supports.
   *
   * @var string
   */
  protected static $format = ['txt'];

  /**
   * The delimiter.
   *
   * @var string
   */
  protected static $delimiter = ';';

  /**
   * {@inheritdoc}
   */
  public function supportsEncoding($format) {
    return in_array($format, static::$format);
  }

  /**
   * {@inheritdoc}
   */
  public function encode($data, $format, array $context = []) {
    $output = '';

    foreach ($data as $row) {
      $output .= join(static::$delimiter, $row) . PHP_EOL;
    }

    return $output;
  }

  /**
   * Get delimiter.
   *
   * @return string
   */
  public static function getDelimiter() {
    return static::$delimiter;
  }
}

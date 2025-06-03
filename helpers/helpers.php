<?php

namespace ProximitImport;

use WP_CLI;

class Helpers
{
  public static function log($message)
  {
    if (class_exists('WP_CLI')) {
      WP_CLI::log($message);
    } else {
      echo '<p>' . $message . '</p>';
    }
  }

  public static function dump($data)
  {
    if (class_exists('WP_CLI')) {
      $keys = array_keys($data[0]);
      \WP_CLI\Utils\format_items('table', $data, [$keys[0], $keys[1]]);
    } else {
      var_dump($data);
    }
  }
}

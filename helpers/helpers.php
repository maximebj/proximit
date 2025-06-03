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
}

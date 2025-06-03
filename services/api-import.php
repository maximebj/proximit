<?php

namespace ProximitImport;

use WP_CLI;

class ApiImport
{
  protected $api_url = 'https://api.proximit.com/v1/import';

  public function __construct() {}

  public function import_data()
  {
    $this->log('coucou');
  }


  public function log($message)
  {
    if (class_exists('WP_CLI')) {
      WP_CLI::log($message);
    } else {
      echo '<p>' . $message . '</p>';
    }
  }
}

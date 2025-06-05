<?php

namespace ProximitImport;

use WP_CLI;

class RegisterWPCliCommands
{

  public function register_hooks()
  {
    add_action('cli_init', [$this, 'register_commands']);
  }

  public function register_commands()
  {
    if (!class_exists('WP_CLI')) {
      return;
    }

    WP_CLI::add_command('proximit api-import', [$this, 'api_import_command'], [
      'shortdesc' => 'Proximit specific commands'
    ]);

    WP_CLI::add_command('proximit csv-import', [$this, 'csv_import_command'], [
      'shortdesc' => 'Proximit specific commands'
    ]);
  }

  public function api_import_command()
  {
    (new ApiImport(151))->import_data();
  }

  public function csv_import_command()
  {
    (new CsvImport())->import_data();
  }
}

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

    WP_CLI::add_command('proximit import', [$this, 'import_command'], [
      'shortdesc' => 'Proximit specific commands'
    ]);
  }

  public function import_command()
  {
    (new ApiImport(151))->import_data();
  }
}

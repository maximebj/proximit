<?php

namespace ProximitImport;

class ApiImport
{
  protected $api_url = 'https://api.proximit.com/v1/import';

  public function __construct() {}

  public function import_data()
  {
    Helpers::log('coucou');
  }
}

<?php

namespace ProximitImport;

class CsvImport
{
  protected $file_path = '';
  protected $data = [];

  public function __construct() {}

  public function import_data()
  {
    Helpers::log('Démarrage de l’import…');


    Helpers::log('Import terminé !');
  }
}

<?php

namespace ProximitImport;

defined('ABSPATH') || die;

class ClientsRepository
{
  public static function get_clients_by_last_contact()
  {
    global $wpdb;
    $table_name = $wpdb->prefix . 'crm';
    $clients = $wpdb->get_results("SELECT * FROM $table_name ORDER BY date_dernier_contact DESC");
    return $clients;
  }
}

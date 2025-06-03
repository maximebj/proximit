<?php

/**
 * Gère l'interface d'administration du plugin
 */
class Proximit_Import_Admin
{

  public function register_hooks()
  {
    add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
    add_action('admin_enqueue_scripts', array($this, 'enqueue_styles'));
    add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
  }

  /**
   * Enregistre les styles pour l'interface d'administration
   */
  public function enqueue_styles()
  {
    wp_enqueue_style(
      PROXIMIT_IMPORT_PLUGIN_NAME,
      PROXIMIT_IMPORT_PLUGIN_URL . 'admin/css/proximit-import-admin.css',
      array(),
      PROXIMIT_IMPORT_VERSION,
      'all'
    );
  }

  /**
   * Enregistre les scripts pour l'interface d'administration
   */
  public function enqueue_scripts()
  {
    wp_enqueue_script(
      PROXIMIT_IMPORT_PLUGIN_NAME,
      PROXIMIT_IMPORT_PLUGIN_URL . 'admin/js/proximit-import-admin.js',
      array('jquery'),
      PROXIMIT_IMPORT_VERSION,
      false
    );
  }

  /**
   * Ajoute les éléments du menu dans l'interface d'administration
   */
  public function add_plugin_admin_menu()
  {
    add_menu_page(
      'Proximit Import',
      'Import',
      'manage_options',
      PROXIMIT_IMPORT_PLUGIN_NAME,
      array($this, 'display_plugin_admin_page'),
      'dashicons-database-import',
      100
    );
  }

  /**
   * Affiche la page d'administration du plugin
   */
  public function display_plugin_admin_page()
  {
    include_once PROXIMIT_IMPORT_PLUGIN_DIR . 'admin/partials/proximit-import-admin-display.php';
  }
}

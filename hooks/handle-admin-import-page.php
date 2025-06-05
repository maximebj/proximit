<?php

namespace ProximitImport;

/**
 * Gère l'interface d'administration du plugin
 */
class HandleAdminImportPage
{

  public function register_hooks()
  {
    add_action('admin_menu', [$this, 'add_plugin_admin_menu']);
    add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
    add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    add_action('admin_post_proximit_import_via_api', [$this, 'proximit_import_via_api']);
  }

  /**
   * Enregistre les styles pour l'interface d'administration
   */
  public function enqueue_styles()
  {
    if (get_current_screen()->id !== 'toplevel_page_proximit-import') {
      return;
    }

    wp_enqueue_style(
      PROXIMIT_IMPORT_PLUGIN_NAME,
      PROXIMIT_IMPORT_PLUGIN_URL . 'admin/css/proximit-import-admin.css',
      [],
      PROXIMIT_IMPORT_VERSION,
      'all'
    );
  }

  /**
   * Enregistre les scripts pour l'interface d'administration
   */
  public function enqueue_scripts()
  {
    if (get_current_screen()->id !== 'toplevel_page_proximit-import') {
      return;
    }

    wp_enqueue_script(
      PROXIMIT_IMPORT_PLUGIN_NAME,
      PROXIMIT_IMPORT_PLUGIN_URL . 'admin/js/proximit-import-admin.js',
      ['jquery'],
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
      [$this, 'display_plugin_admin_page'],
      'dashicons-database-import',
      100
    );
  }

  /**
   * Affiche la page d'administration du plugin
   */
  public function display_plugin_admin_page()
  {
    include_once PROXIMIT_IMPORT_PLUGIN_DIR . 'admin/templates/import-page.php';
  }


  public function proximit_import_via_api()
  {
    $nonce = isset($_POST['proximit_import_via_api_nonce']) ? sanitize_text_field($_POST['proximit_import_via_api_nonce']) : null;

    if (!wp_verify_nonce($nonce, 'proximit_import_via_api_nonce')) {
      wp_die('Nonce invalide');
    }

    (new ApiImport([
      'number_of_pokemons' => 15,
      'caught' => true,
      'embed' => true
    ]))->import_data();
  }
}

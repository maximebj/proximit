<?php

namespace ProximitImport;

/**
 * Plugin Name: Proximit Import
 * Plugin URI: https://proximit.com
 * Description: Extension pour l'importation de données dans WordPress
 * Version: 1.0.0
 * Author: Proximit
 * Author URI: https://proximit.com
 * Text Domain: proximit-import
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 */

// Si ce fichier est appelé directement, on sort.
defined('ABSPATH') || die;

// Définition des constantes
define('PROXIMIT_IMPORT_VERSION', '1.0.0');
define('PROXIMIT_IMPORT_PLUGIN_NAME', 'proximit-import');
define('PROXIMIT_IMPORT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PROXIMIT_IMPORT_PLUGIN_URL', plugin_dir_url(__FILE__));

define('PROXIMIT_IMPORT_POST_TYPE', 'pokemon');

// Activation du plugin
function proximit_import_activate()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'crm';

  // Vérifier si la table existe déjà
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") === $table_name) {
    return;
  }

  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $table_name (
    id bigint(20) NOT NULL AUTO_INCREMENT,
    nom varchar(100) NOT NULL,
    prenom varchar(100) NOT NULL,
    telephone varchar(20) NOT NULL,
    site_url varchar(255) NOT NULL,
    date_creation datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    date_dernier_contact datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}
register_activation_hook(__FILE__, __NAMESPACE__ . '\proximit_import_activate');

// Désactivation du plugin
function proximit_import_deactivate() {}
register_deactivation_hook(__FILE__, __NAMESPACE__ . '\proximit_import_deactivate');

// Chargement des fichiers nécessaires

# Helpers
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'helpers/helpers.php';

# Repositories
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'repositories/clients.php';

# Services
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'services/block-converter.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'services/api-import.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'services/csv-import.php';

# Hooks
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/handle-admin-import-page.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/register-wp-cli-commands.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/register-post-types.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/register-taxonomies.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/register-rest-params.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/handle-admin-crm-page.php';

// Instanciation des classes
(new HandleAdminImportPage())->register_hooks();
(new RegisterWPCliCommands())->register_hooks();
(new RegisterPostTypes())->register_hooks();
(new RegisterTaxonomies())->register_hooks();
(new RegisterRestParams())->register_hooks();
(new HandleAdminCrmPage())->register_hooks();

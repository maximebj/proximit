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
if (!defined('WPINC')) {
  die;
}

// Définition des constantes
define('PROXIMIT_IMPORT_VERSION', '1.0.0');
define('PROXIMIT_IMPORT_PLUGIN_NAME', 'proximit-import');
define('PROXIMIT_IMPORT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PROXIMIT_IMPORT_PLUGIN_URL', plugin_dir_url(__FILE__));

define('PROXIMIT_IMPORT_POST_TYPE', 'pokemon');

// Activation du plugin
function proximit_import_activate() {}
register_activation_hook(__FILE__, __NAMESPACE__ . '\proximit_import_activate');

// Désactivation du plugin
function proximit_import_deactivate() {}
register_deactivation_hook(__FILE__, __NAMESPACE__ . '\proximit_import_deactivate');

// Chargement des fichiers nécessaires

# Helpers
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'helpers/helpers.php';

# Services
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'services/api-import.php';

# Hooks
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/handle-admin-import-page.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/register-wp-cli-commands.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/register-post-types.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/register-taxonomies.php';
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'hooks/register-rest-params.php';

// Instanciation des classes
(new HandleAdminImportPage())->register_hooks();
(new RegisterWPCliCommands())->register_hooks();
(new RegisterPostTypes())->register_hooks();
(new RegisterTaxonomies())->register_hooks();
(new RegisterRestParams())->register_hooks();

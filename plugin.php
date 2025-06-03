<?php

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

// Activation du plugin
function proximit_import_activate() {}
register_activation_hook(__FILE__, 'proximit_import_activate');

// Désactivation du plugin
function proximit_import_deactivate() {}
register_deactivation_hook(__FILE__, 'proximit_import_deactivate');

// Chargement des fichiers nécessaires
require_once PROXIMIT_IMPORT_PLUGIN_DIR . 'admin/class-proximit-import-admin.php';

// Instanciation des classes
(new Proximit_Import_Admin())->register_hooks();

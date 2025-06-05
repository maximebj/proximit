<?php

namespace ProximitImport;

class HandleAdminCrmPage
{
  public function register_hooks()
  {
    add_action('admin_menu', [$this, 'add_crm_menu_page']);
    add_action('admin_post_add_crm_client', [$this, 'handle_crm_form_submission']);
  }

  public function add_crm_menu_page()
  {
    add_menu_page(
      'Gestion CRM',
      'CRM',
      'manage_options',
      'proximit-crm',
      [$this, 'render_crm_page'],
      'dashicons-groups',
      30
    );
  }

  public function render_crm_page()
  {
    $clients = ClientsRepository::get_clients_by_last_contact();

    include_once PROXIMIT_IMPORT_PLUGIN_DIR . 'admin/templates/crm-page.php';
  }

  public function handle_crm_form_submission()
  {
    if (!isset($_POST['crm_nonce']) || !wp_verify_nonce($_POST['crm_nonce'], 'add_crm_client')) {
      wp_die('Nonce invalide');
    }

    if (!current_user_can('manage_options')) {
      wp_die('Vous n’avez pas les permissions nécessaires pour ajouter un client');
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'crm';

    // Vérification des champs requis
    if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['telephone']) || empty($_POST['site_url'])) {
      wp_die('Tous les champs sont obligatoires');
    }

    $nom = strtoupper(sanitize_text_field($_POST['nom']));
    $prenom = sanitize_text_field($_POST['prenom']);
    $telephone = sanitize_text_field($_POST['telephone']);
    $site_url = esc_url_raw($_POST['site_url']);

    $wpdb->insert(
      $table_name,
      [
        'nom' => $nom,
        'prenom' => $prenom,
        'telephone' => $telephone,
        'site_url' => $site_url,
        'date_creation' => current_time('mysql'),
        'date_dernier_contact' => current_time('mysql')
      ],
      ['%s', '%s', '%s', '%s', '%s', '%s']
    );

    wp_redirect(add_query_arg('message', 'success', admin_url('admin.php?page=proximit-crm')));
    exit;
  }
}

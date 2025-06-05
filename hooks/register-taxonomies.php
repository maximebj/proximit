<?php

namespace ProximitImport;

class RegisterTaxonomies
{
  public function register_hooks()
  {
    add_action('init', [$this, 'register_taxonomies']);
  }

  public function register_taxonomies()
  {
    $labels = [
      'name' => 'Types',
      'singular_name' => 'Type',
      'menu_name' => 'Types',
      'all_items' => 'Tous les types',
      'edit_item' => 'Modifier le type',
      'view_item' => 'Voir le type',
      'update_item' => 'Mettre à jour le type',
      'add_new_item' => 'Ajouter un nouveau type',
      'new_item_name' => 'Nouveau nom de type',
      'search_items' => 'Rechercher des types',
    ];

    $args = [
      'labels' => $labels,
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => ['slug' => 'type'],
    ];

    register_taxonomy('pokemon_type', PROXIMIT_IMPORT_POST_TYPE, $args);
  }
}

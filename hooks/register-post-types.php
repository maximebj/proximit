<?php

namespace ProximitImport;

class RegisterPostTypes
{
  public function register_hooks()
  {
    add_action('init', [$this, 'register_post_types']);
  }

  public function register_post_types()
  {
    $labels = [
      'name' => 'Pokémon',
      'singular_name' => 'Pokémon',
      'menu_name' => 'Pokémon',
      'all_items' => 'Tous les Pokémon',
      'add_new' => 'Ajouter un Pokémon',
    ];

    $args = [
      'labels' => $labels,
      'public' => true,
      'show_in_rest' => true,
      'has_archive' => true,
      'supports' => ['title', 'editor', 'thumbnail', 'revisions', 'custom-fields'],
      'menu_icon' => 'dashicons-pets',
      'menu_position' => 5,
    ];

    register_post_type(PROXIMIT_IMPORT_POST_TYPE, $args);
  }
}

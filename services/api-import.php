<?php

namespace ProximitImport;

class ApiImport
{
  protected $api_url = 'https://pokeapi.co/api/v2/pokemon?limit=15';
  protected $data = [];

  public function __construct() {}

  public function import_data()
  {
    Helpers::log('Démarrage de l’import…');

    $this->call_api();
    $this->save_data();

    Helpers::log('Import terminé !');
  }

  protected function call_api()
  {
    $response = wp_remote_get($this->api_url);
    $body = wp_remote_retrieve_body($response);
    $response_body = json_decode($body, true);

    foreach ($response_body['results'] as $item) {
      $response = wp_remote_get($item['url']);
      $body = wp_remote_retrieve_body($response);
      $response_body = json_decode($body, true);

      $this->data[] = $response_body;
    }
  }

  protected function save_data()
  {
    foreach ($this->data as $item) {

      # Vérification de l'existence du pokemon
      $posts = get_posts([
        'post_type' => 'pokemon',
        'meta_key' => 'pokemon_id',
        'meta_value' => $item['id'],
        'posts_per_page' => 1,
      ]);

      $post = !empty($posts) ? $posts[0] : null;

      # Mise à jour s'il existe
      if ($post) {
        wp_update_post([
          'ID' => $post->ID,
          'post_title' => $item['name'],
          'post_content' => "contenu à jour",
        ]);

        Helpers::log('✅ ' . $item['name'] . ' mis à jour !');
      }

      # Création s'il n'existe pas
      else {

        $post_id = wp_insert_post([
          'post_title' => $item['name'],
          'post_content' => "content",
          'post_status' => 'publish',
          'post_type' => 'pokemon',
        ]);

        update_post_meta($post_id, 'pokemon_id', $item['id']);

        // Download and attach the image
        $image_url = $item['sprites']['front_default'];

        if ($image_url) {
          $image_id = media_sideload_image($image_url, $post_id, $item['name'], 'id');
          if (!is_wp_error($image_id)) {
            set_post_thumbnail($post_id, $image_id);
          }
        }

        Helpers::log('✅ ' . $item['name'] . ' ajouté !');
      }

      // Ajout des types
      if (!empty($item['types'])) {
        $types = array_map(function ($type) {
          return $type['type']['name'];
        }, $item['types']);

        wp_set_object_terms($post->ID, $types, 'pokemon_type');
      }
    }
  }
}

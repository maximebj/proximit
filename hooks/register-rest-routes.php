<?php

namespace ProximitImport;

class RegisterRestRoutes
{
  public function register_hooks()
  {
    add_action('rest_api_init', [$this, 'register_routes']);
  }

  public function register_routes()
  {
    register_rest_route('proximit/v1', '/pokemon', [
      'methods' => 'GET',
      'callback' => [$this, 'get_pokemon'],
      'permission_callback' => '__return_true',
      'args' => [
        'type' => [
          'required' => false,
          'type' => 'string',
          'sanitize_callback' => 'sanitize_text_field',
        ],
      ],
    ]);
  }

  public function get_pokemon($request)
  {
    $type = $request->get_param('type');

    $args = [
      'post_type' => PROXIMIT_IMPORT_POST_TYPE,
      'posts_per_page' => -1,
      'post_status' => 'publish',
    ];

    if ($type) {
      $args['tax_query'] = [
        [
          'taxonomy' => 'pokemon_type',
          'field' => 'slug',
          'terms' => $type,
        ],
      ];
    }

    $query = new \WP_Query($args);
    $pokemon = [];

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();

        $pokemon[] = [
          'id' => get_post_meta($post_id, 'pokemon_id', true),
          'name' => get_the_title(),
          'content' => get_the_content(),
          'thumbnail' => get_the_post_thumbnail_url($post_id, 'full'),
          'types' => wp_get_post_terms($post_id, 'pokemon_type', ['fields' => 'names']),
        ];
      }
    }

    wp_reset_postdata();

    return rest_ensure_response($pokemon);
  }
}

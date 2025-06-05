<?php

namespace ProximitImport;

class RegisterRestRoutes
{
  public function register_hooks()
  {
    add_filter('rest_pokemon_collection_params', [$this, 'add_type_param']);
    add_filter('rest_pokemon_query', [$this, 'add_type_filter'], 10, 2);
  }

  public function add_type_param($params)
  {
    $params['caught'] = [
      'description' => 'Display only caught pokemons',
      'type' => 'boolean',
      'required' => false,
    ];

    return $params;
  }

  public function add_type_filter($args, $request)
  {
    $caught = $request->get_param('caught');

    if ($caught) {
      $args['meta_query'] = [
        [
          'key' => 'caught',
          'value' => '1',
        ],
      ];
    }

    return $args;
  }
}

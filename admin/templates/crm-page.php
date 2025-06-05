<div class="wrap">
  <h1>Gestion CRM</h1>

  <?php if (isset($_GET['message']) && $_GET['message'] === 'success'): ?>
    <div class="notice notice-success is-dismissible">
      <p>Client ajouté avec succès !</p>
    </div>
  <?php endif; ?>

  <div class="card">
    <h2>Ajouter un nouveau client</h2>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <?php wp_nonce_field('add_crm_client', 'crm_nonce'); ?>
      <input type="hidden" name="action" value="add_crm_client">
      <table class="form-table">
        <tr>
          <th><label for="nom">Nom</label></th>
          <td><input type="text" name="nom" id="nom" class="regular-text" required></td>
        </tr>
        <tr>
          <th><label for="prenom">Prénom</label></th>
          <td><input type="text" name="prenom" id="prenom" class="regular-text" required></td>
        </tr>
        <tr>
          <th><label for="telephone">Téléphone</label></th>
          <td><input type="tel" name="telephone" id="telephone" class="regular-text" required></td>
        </tr>
        <tr>
          <th><label for="site_url">URL du site</label></th>
          <td><input type="url" name="site_url" id="site_url" class="regular-text" required></td>
        </tr>
      </table>
      <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Ajouter le client">
      </p>
    </form>
  </div>

  <div class="card" style="max-width: 1200px;">
    <h2>Liste des clients</h2>
    <table class="wp-list-table widefat fixed striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Téléphone</th>
          <th>Site web</th>
          <th>Date de création</th>
          <th>Dernier contact</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($clients as $client): ?>
          <tr>
            <td><?php echo esc_html($client->id); ?></td>
            <td><?php echo esc_html($client->nom); ?></td>
            <td><?php echo esc_html($client->prenom); ?></td>
            <td><?php echo esc_html($client->telephone); ?></td>
            <td><a href="<?php echo esc_url($client->site_url); ?>" target="_blank"><?php echo esc_html($client->site_url); ?></a></td>
            <td><?php echo esc_html(date_i18n(get_option('date_format') . ' à ' . get_option('time_format'), strtotime($client->date_creation))); ?></td>
            <td><?php echo esc_html(date_i18n(get_option('date_format') . ' à ' . get_option('time_format'), strtotime($client->date_dernier_contact))); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
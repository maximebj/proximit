<?php

/**
 * Fournit une vue de la page d'administration du plugin
 */
?>

<div class="wrap">
  <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

  <div class="proximit-import-container">
    <div class="proximit-import-section">
      <h2>Import de données</h2>
      <form method="post" enctype="multipart/form-data" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <?php wp_nonce_field('proximit_import_action', 'proximit_import_nonce'); ?>
        <input type="hidden" name="action" value="proximit_import_process">

        <table class="form-table">
          <tr>
            <th scope="row">
              <label for="import_file">Fichier à importer</label>
            </th>
            <td>
              <input type="file" name="import_file" id="import_file" accept=".csv,.xlsx,.xls" required>
              <p class="description">Formats acceptés : CSV, XLSX, XLS</p>
            </td>
          </tr>
          <tr>
            <th scope="row">
              <label for="import_type">Type d'import</label>
            </th>
            <td>
              <select name="import_type" id="import_type" required>
                <option value="">Sélectionnez un type</option>
                <option value="posts">Articles</option>
                <option value="pages">Pages</option>
                <option value="products">Produits</option>
              </select>
            </td>
          </tr>
        </table>

        <p class="submit">
          <input type="submit" name="submit" id="submit" class="button button-primary" value="Importer">
        </p>
      </form>
    </div>

    <div class="proximit-import-section">
      <h2>Historique des imports</h2>
      <table class="wp-list-table widefat fixed striped">
        <thead>
          <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Fichier</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="5">Aucun import effectué</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
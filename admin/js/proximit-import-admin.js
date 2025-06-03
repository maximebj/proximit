(function ($) {
  "use strict";

  $(document).ready(function () {
    // Gestion du formulaire d'import
    $("#submit").on("click", function (e) {
      var fileInput = $("#import_file");
      var importType = $("#import_type");

      // Vérification du fichier
      if (fileInput[0].files.length === 0) {
        e.preventDefault();
        alert("Veuillez sélectionner un fichier à importer.");
        return false;
      }

      // Vérification du type d'import
      if (!importType.val()) {
        e.preventDefault();
        alert("Veuillez sélectionner un type d'import.");
        return false;
      }

      // Vérification de l'extension du fichier
      var fileName = fileInput[0].files[0].name;
      var fileExt = fileName.split(".").pop().toLowerCase();
      var allowedExts = ["csv", "xlsx", "xls"];

      if (allowedExts.indexOf(fileExt) === -1) {
        e.preventDefault();
        alert(
          "Format de fichier non supporté. Veuillez utiliser un fichier CSV, XLSX ou XLS."
        );
        return false;
      }
    });

    // Animation de chargement lors de la soumission
    $("form").on("submit", function () {
      $("#submit").prop("disabled", true).val("Importation en cours...");
    });
  });
})(jQuery);

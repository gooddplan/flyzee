<?php
// admin.php

$folder = 'soumissions';
$files = glob("$folder/*.json");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin - Dossiers Utilisateurs</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    h1 { margin-bottom: 10px; }
    .file-list { margin-top: 20px; }
    table {
      border-collapse: collapse;
      margin-top: 20px;
      width: 100%;
      max-width: 800px;
    }
    th {
      background-color: #333;
      color: #fff;
    }
    td, th {
      border: 1px solid #ccc;
      padding: 8px;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    a {
      text-decoration: none;
      color: #007BFF;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>📂 Liste des Dossiers Utilisateurs</h1>

  <?php if (empty($files)): ?>
    <p>Aucun dossier trouvé.</p>
  <?php else: ?>
    <ul class="file-list">
      <?php foreach ($files as $file): ?>
        <li><a href="?fichier=<?= urlencode(basename($file)) ?>"><?= htmlspecialchars(basename($file)) ?></a></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <?php
  if (isset($_GET['fichier']) && file_exists("$folder/" . $_GET['fichier'])):
    $data = json_decode(file_get_contents("$folder/" . $_GET['fichier']), true);
  ?>
    <h2>🗂 Détails pour <?= htmlspecialchars($_GET['fichier']) ?></h2>
    <table>
      <thead>
        <tr>
          <th>Champ</th>
          <th>Valeur</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $key => $value): ?>
          <tr>
            <td><strong><?= htmlspecialchars($key) ?></strong></td>
            <td><?= is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : htmlspecialchars($value) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>
</html>

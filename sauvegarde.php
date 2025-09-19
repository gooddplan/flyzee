<?php
    // Récupère les données JSON envoyées
    $data = json_decode(file_get_contents("php://input"), true);

    // Crée un nom de fichier unique
    $timestamp = time();
    $filename = "soumissions/data_$timestamp.json";

    // Crée le dossier s’il n’existe pas
    if (!is_dir("soumissions")) {
    mkdir("soumissions", 0755, true);
    }

    // Sauvegarde les données dans un fichier .json
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

    // Retourne une réponse simple
    echo "Données enregistrées avec succès.";
?>

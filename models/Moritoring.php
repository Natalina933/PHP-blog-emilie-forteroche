<?php
// Inclure la configuration de la base de données
include 'config.php';

// Requête SQL pour obtenir les articles avec le nombre de vues, le nombre de commentaires et la date de publication
$sql = "
    SELECT a.id, a.title, a.nbre_vues, a.date_creation, COUNT(c.id) AS nbre_commentaires
    FROM article a
    LEFT JOIN comment c ON a.id = c.id_article
    GROUP BY a.id
    ORDER BY a.date_creation DESC;
";
$stmt = $pdo->query($sql);
$articles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Monitoring</title>
</head>
<body>
    <h2>Monitoring</h2>

    <div class="monitoring">
        <?php foreach ($articles as $article) { ?>
            <div class="articleLine">
                <div class="title"><?= htmlspecialchars($article['title']) ?></div>
                <div class="nbre_vues"><?= htmlspecialchars($article['nbre_vues']) ?></div>
                <div class="nbre_commentaires"><?= htmlspecialchars($article['nbre_commentaires']) ?></div>
                <div class="date_publication"><?= htmlspecialchars($article['date_creation']) ?></div>
            </div>
        <?php } ?>
    </div>
</body>
</html>

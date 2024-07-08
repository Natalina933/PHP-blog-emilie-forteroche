<body>
    <table class="monitoring">
        <tbody>
            <?php foreach ($articles as $article) : ?>
                <tr>
                    <td><?= htmlspecialchars($article['title']) ?></td>
                    <td><?= htmlspecialchars($article['nbre_vues']) ?></td>
                    <td><?= htmlspecialchars($article['nbre_commentaires']) ?></td>
                    <td><?= htmlspecialchars($article['date_creation']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
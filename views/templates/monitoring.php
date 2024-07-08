<body>
    <table class="monitoring">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Nombre de vues</th>
                <th>Nombre de commentaires</th>
                <th>Date de publication</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) : ?>
                <tr>
                    <td><?= htmlspecialchars($article->getTitle()) ?></td>
                    <td><?= htmlspecialchars($article->getNbreVues()) ?></td>
                    <td><?= htmlspecialchars($article->getNbreCommentaires()) ?></td>
                    <td><?= htmlspecialchars($article->getDateCreation()->format('Y-m-d H:i:s')) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

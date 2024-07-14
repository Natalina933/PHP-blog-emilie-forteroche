<?php
/**
 * 1/création de la page Monitoring
 */
?>
<style>
    .scrollable-table {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #ccc;
        margin-bottom: 20px;
    }

    .scrollable-articles {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #ccc;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    button {
        display: block;
        margin: 20px auto;
    }
</style>

<body>
    <h2>Monitoring des articles</h2>
    <form>
        <div class="scrollable-table">
            <table border="1">
                <thead>
                    <tr>
                        <th>
                            <a href="index.php?action=showMonitoring&sortArticle=id&orderArticle=<?= ($sortArticle === 'id' && $orderArticle === 'ASC') ? 'DESC' : 'ASC' ?>">
                                ID
                                <?= ($sortArticle === 'id' && $orderArticle === 'ASC') ? '🔼' : '🔽' ?>
                            </a>
                        </th>
                        <th>
                            <a href="index.php?action=showMonitoring&sortArticle=title&orderArticle=<?= ($sortArticle === 'title' && $orderArticle === 'ASC') ? 'DESC' : 'ASC' ?>">
                                Titre
                                <?= ($sortArticle === 'title' && $orderArticle === 'ASC') ? '🔼' : '🔽' ?>
                            </a>
                        </th>
                        <th>
                            <a href="index.php?action=showMonitoring&sortArticle=nbre_vues&orderArticle=<?= ($sortArticle === 'nbre_vues' && $orderArticle === 'ASC') ? 'DESC' : 'ASC' ?>">
                                Nombre de vues
                                <?= ($sortArticle === 'nbre_vues' && $orderArticle === 'ASC') ? '🔼' : '🔽' ?>
                            </a>
                        </th>
                        <th>
                            <a href="index.php?action=showMonitoring&sortArticle=nbre_commentaires&orderArticle=<?= ($sortArticle === 'nbre_commentaires' && $orderArticle === 'ASC') ? 'DESC' : 'ASC' ?>">
                                Nombre de commentaires
                                <?= ($sortArticle === 'nbre_commentaires' && $orderArticle === 'ASC') ? '🔼' : '🔽' ?>
                            </a>
                        </th>
                        <th>
                            <a href="index.php?action=showMonitoring&sortArticle=date_creation&orderArticle=<?= ($sortArticle === 'date_creation' && $orderArticle === 'ASC') ? 'DESC' : 'ASC' ?>">
                                Date de publication
                                <?= ($sortArticle === 'date_creation' && $orderArticle === 'ASC') ? '🔼' : '🔽' ?>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article) : ?>
                        <tr>
                            <td><?= htmlspecialchars($article->getId()) ?></td>
                            <td><?= htmlspecialchars($article->getTitle()) ?></td>
                            <td><?= htmlspecialchars($article->getNbreVues()) ?></td>
                            <td><?= htmlspecialchars($article->getNbreCommentaires()) ?></td>
                            <td><?= htmlspecialchars($article->getDateCreation()->format('Y-m-d H:i:s')) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </form>

    <h2>Monitoring des commentaires</h2>

    <form id="deleteForm" action="index.php?action=deleteComment" method="post">
        <div class="scrollable-table">
            <table border="1">
                <thead>
                    <tr>
                        <th>Cocher</th>
                        <th>
                            <a href="index.php?action=showMonitoring&sortComment=article_id&orderComment=<?= ($sortComment === 'article_id' && $orderComment === 'ASC') ? 'DESC' : 'ASC' ?>">
                                ID Article
                                <?= ($sortComment === 'article_id' && $orderComment === 'ASC') ? '🔼' : '🔽' ?>
                            </a>
                        </th>
                        <th>
                            <a href="index.php?action=showMonitoring&sortComment=pseudo&orderComment=<?= ($sortComment === 'pseudo' && $orderComment === 'ASC') ? 'DESC' : 'ASC' ?>">
                                Pseudo
                                <?= ($sortComment === 'pseudo' && $orderComment === 'ASC') ? '🔼' : '🔽' ?>
                            </a>
                        </th>
                        <th>
                            <a href="index.php?action=showMonitoring&sortComment=content&orderComment=<?= ($sortComment === 'content' && $orderComment === 'ASC') ? 'DESC' : 'ASC' ?>">
                                Contenu
                                <?= ($sortComment === 'content' && $orderComment === 'ASC') ? '🔼' : '🔽' ?>
                            </a>
                        </th>
                        <th>
                            <a href="index.php?action=showMonitoring&sortComment=date_creation&orderComment=<?= ($sortComment === 'date_creation' && $orderComment === 'ASC') ? 'DESC' : 'ASC' ?>">
                                Date de Création
                                <?= ($sortComment === 'date_creation' && $orderComment === 'ASC') ? '🔼' : '🔽' ?>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment) : ?>
                        <tr>
                            <td><input type="checkbox" name="commentIds[]" value="<?= $comment->getId() ?>"></td>
                            <td><?= htmlspecialchars($comment->getIdArticle()) ?></td>
                            <td><?= htmlspecialchars($comment->getPseudo()) ?></td>
                            <td><?= htmlspecialchars($comment->getContent()) ?></td>
                            <td><?= htmlspecialchars($comment->getDateCreation()->format('Y-m-d H:i:s')) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <button type="submit">Supprimer les commentaires sélectionnés</button>
    </form>

    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="commentIds[]"]');
            for (const checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });
    </script>

    <br>
    <a class="submit" href="index.php?action=admin">Revenir à la page des articles</a>
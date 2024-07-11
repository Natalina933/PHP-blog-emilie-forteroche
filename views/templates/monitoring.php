<?php

/** 
 * Affichage de la partie monitoring : liste des articles avec tri.
 */
?>

<h2>Monitoring des articles</h2>

<div class="monitoring">
    <table border="1">
        <thead>
            <tr>
                <th>
                    <a href="index.php?action=showMonitoring&sort=title&order=<?= ($sort === 'title' && $order === 'ASC') ? 'DESC' : 'ASC' ?>">
                        Titre
                        <?= ($sort === 'title' && $order === 'ASC') ? '🔼' : '🔽' ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?action=showMonitoring&sort=nbre_vues&order=<?= ($sort === 'nbre_vues' && $order === 'ASC') ? 'DESC' : 'ASC' ?>">
                        Nombre de vues
                        <?= ($sort === 'nbre_vues' && $order === 'ASC') ? '🔼' : '🔽' ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?action=showMonitoring&sort=nbre_commentaires&order=<?= ($sort === 'nbre_commentaires' && $order === 'ASC') ? 'DESC' : 'ASC' ?>">
                        Nombre de commentaires
                        <?= ($sort === 'nbre_commentaires' && $order === 'ASC') ? '🔼' : '🔽' ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?action=showMonitoring&sort=date_creation&order=<?= ($sort === 'date_creation' && $order === 'ASC') ? 'DESC' : 'ASC' ?>">
                        Date de publication
                        <?= ($sort === 'date_creation' && $order === 'ASC') ? '🔼' : '🔽' ?>
                    </a>
                </th>
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
</div>

<h2>Monitoring des commentaires</h2>

<div class="monitoring">
    <table border="1">
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Contenu</th>
                <th>Date de création</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $comment) : ?>
                <tr>
                    <td><?= htmlspecialchars($comment->getPseudo()) ?></td>
                    <td><?= htmlspecialchars($comment->getContent()) ?></td>
                    <td><?= htmlspecialchars($comment->getDateCreation()->format('Y-m-d H:i:s')) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<br>
<a class="submit" href="index.php?action=admin">Revenir à la page des articles</a>

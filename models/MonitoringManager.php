<?php

/**
 * Classe qui gère le monitoring des articles.
 */
class MonitoringManager extends AbstractEntityManager
{
    /**
     * Récupère tous les articles avec tri.
     * @param string $sort : la colonne par laquelle trier.
     * @param string $order : l'ordre de tri (ASC ou DESC).
     * @return array : un tableau d'objets Article.
     */
    public function getArticlesSorted(string $sort, string $order, int $offset, int $limit): array
    {
        // Implémentez la logique pour récupérer les articles triés
        $sql = "SELECT * FROM article ORDER BY $sort $order LIMIT $limit OFFSET $offset";
        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
        return $articles;
    }
    public function getCommentsSorted(string $sort, string $order): array
    {
        // Sécuriser les colonnes de tri pour éviter les injections SQL
        $allowedSortColumns = ['id', 'pseudo', 'content', 'date_creation', 'id_article'];
        if (!in_array($sort, $allowedSortColumns)) {
            $sort = 'date_creation';
        }
        if ($order !== 'ASC' && $order !== 'DESC') {
            $order = 'DESC';
        }

        // Modifier la requête SQL pour trier correctement par id_article si nécessaire
        $orderByClause = ($sort === 'id_article') ? "id_article $order" : "$sort $order";
        $sql = "SELECT * FROM comment ORDER BY $orderByClause";
        $result = $this->db->query($sql);
        $comments = [];

        while ($comment = $result->fetch()) {
            $comments[] = new Comment($comment);
        }
        return $comments;
    }
}

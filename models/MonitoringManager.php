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
}

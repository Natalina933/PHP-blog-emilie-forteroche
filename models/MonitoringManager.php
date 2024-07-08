<?php

/**
 * Classe qui gère le monitoring des articles.
 */
class MonitoringManager extends AbstractEntityManager
{
    public function getMonitoringData(): array
    {
        $sql = "
            SELECT a.id, a.title, a.content, a.nbre_vues, a.date_creation, COUNT(c.id) AS nbre_commentaires
            FROM article a
            LEFT JOIN comment c ON a.id = c.id_article
            GROUP BY a.id
            ORDER BY a.date_creation DESC;
        ";

        $stmt = $this->db->query($sql);
        $articles = [];

        while ($articleData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $article = new Article();
            $article->setId($articleData['id']);
            $article->setTitle($articleData['title']);
            $article->setContent($articleData['content']);
            $article->setNbreVues($articleData['nbre_vues']);
            $article->setNbreCommentaires($articleData['nbre_commentaires']);
            $article->setDateCreation(new DateTime($articleData['date_creation']));

            $articles[] = $article;
        }

        return $articles;
    }
}

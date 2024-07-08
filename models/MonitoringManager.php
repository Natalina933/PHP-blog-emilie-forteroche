<?php

/**
 * Classe qui gère le monitoring des articles.
 */
class MonitoringManager extends AbstractEntityManager
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getMonitoringData(): array
    {
        $sql = "SELECT * FROM article";
        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }

        return $articles; 
    }
}
?>

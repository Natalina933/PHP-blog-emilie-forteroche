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
    public function getMonitoringData(string $sort = 'date_creation', string $order = 'DESC'): array
    {
        // Définir les colonnes autorisées pour le tri
        $allowedSortColumns = ['title', 'nbre_vues', 'nbre_commentaires', 'date_creation'];
        if (!in_array($sort, $allowedSortColumns)) {
            $sort = 'date_creation'; // Valeur par défaut si la colonne de tri n'est pas autorisée
        }

        // Définir les ordres de tri autorisés
        $allowedOrder = ['ASC', 'DESC'];
        if (!in_array($order, $allowedOrder)) {
            $order = 'DESC'; // Valeur par défaut si l'ordre de tri n'est pas autorisé
        }

        // Construire la requête SQL pour récupérer les articles triés
        $sql = "SELECT * FROM article ORDER BY $sort $order";
        $result = $this->db->query($sql);
        $articles = [];

        // Parcourir les résultats de la requête et créer des objets Article
        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }

        // Retourner le tableau des articles
        return $articles;
    }
}

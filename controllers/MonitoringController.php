<?php

class MonitoringController
{
    public function showMonitoring()
    {
        // Récupération des paramètres de tri et de pagination pour les articles
        $sortArticle = Utils::request('sortArticle', 'date_creation');
        $orderArticle = Utils::request('orderArticle', 'DESC');
        $page = Utils::request('page', 1); // Page courante, par défaut 1
        $limit = 10; // Nombre d'articles par page
        $offset = ($page - 1) * $limit; // Offset pour la pagination

        // Instanciation du manager
        $monitoringManager = new MonitoringManager();

        // Récupération des articles triés avec pagination
        $articles = $monitoringManager->getArticlesSorted($sortArticle, $orderArticle, $offset, $limit);

        // Récupération des commentaires avec tri par id_article si spécifié
        $sortComment = Utils::request('sortComment', 'date_creation');
        $orderComment = Utils::request('orderComment', 'DESC');
        $commentManager = new CommentManager();
        $comments = $commentManager->getCommentsSorted($sortComment, $orderComment);

        // Affichage de la vue avec les données récupérées
        $view = new View('Monitoring');
        $view->render('monitoring', [
            'articles' => $articles,
            'comments' => $comments,
            'sortArticle' => $sortArticle,
            'orderArticle' => $orderArticle,
            'sortComment' => $sortComment,
            'orderComment' => $orderComment,
            'currentPage' => $page,
        ]);
    }
    public function deleteComment()
    {
        // Récupérer les IDs des commentaires à supprimer à partir des données POST
        $commentIds = Utils::request('commentIds');

        // Vérifier si des commentaires ont été sélectionnés
        if (!isset($commentIds) || !is_array($commentIds) || empty($commentIds)) {
            throw new Exception("Aucun commentaire sélectionné pour la suppression.");
        }

        // Instancier le gestionnaire de commentaires
        $commentManager = new CommentManager();

        // Parcourir tous les IDs des commentaires et les supprimer un par un
        foreach ($commentIds as $commentId) {
            // Récupérer le commentaire par son ID
            $comment = $commentManager->getCommentById($commentId);
            if (!$comment) {
                throw new Exception("Commentaire introuvable pour l'ID: $commentId.");
            }

            // Supprimer le commentaire
            $result = $commentManager->deleteComment($comment);
            if (!$result) {
                throw new Exception("Échec de la suppression du commentaire avec l'ID: $commentId.");
            }
        }

        // Rediriger vers la page de monitoring après la suppression
        Utils::redirect('showMonitoring');
    }
}

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
}

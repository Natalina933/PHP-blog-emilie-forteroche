<?php

class MonitoringController
{
    public function showMonitoring()
    {
        $sort = Utils::request('sort', 'date_creation');
        $order = Utils::request('order', 'DESC');

        $monitoringManager = new MonitoringManager();
        $articles = $monitoringManager->getMonitoringData($sort, $order);

        $commentManager = new CommentManager();
        $comments = $commentManager->getAllComments();

        $view = new View('Monitoring');
        $view->render('monitoring', [
            'articles' => $articles,
            'comments' => $comments,
            'sort' => $sort,
            'order' => $order
        ]);
    }
    public function deleteComment()
    {
        $commentId = Utils::request('id');
        if (!$commentId) {
            throw new Exception("ID de commentaire manquant.");
        }

        $commentManager = new CommentManager();
        $comment = $commentManager->getCommentById($commentId);
        if (!$comment) {
            throw new Exception("Commentaire introuvable.");
        }

        $result = $commentManager->deleteComment($comment);
        if (!$result) {
            throw new Exception("Échec de la suppression du commentaire.");
        }

        // Rediriger vers la page de monitoring après suppression
        Utils::redirect('showMonitoring');
    }
}


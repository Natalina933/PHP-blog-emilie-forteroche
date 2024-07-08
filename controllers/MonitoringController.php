<?php

class MonitoringController
{
    /**
     * Affiche la page de monitoring.
     * @return void
     */

    /**   
     * * * Cette méthode récupère tous les articles à l'aide d'un ArticleManager et les passe à la vue nommée "monitoring". 
     * La méthode ne retourne rien (void)..*/

    public function showMonitoring(): void
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();
        $view = new View("Monitoring");
        $view->render("monitoring", ['articles' => $articles]);
    }
}

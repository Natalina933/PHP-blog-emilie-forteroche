<?php

class ArticleController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome(): void
    {
        // Récupération de l'id de l'article demandé.
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        $view = new View("Accueil");
        $view->render("home", ['articles' => $articles]);
    }
    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function showArticle(): void
    {
        // Récupération de l'id de l'article demandé.
        $id = Utils::request("id", -1);

        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        $view = new View("Accueil");
        $view->render("home", ['articles' => $articles]);
    }


    /**
     * Affiche le formulaire d'ajout d'un article.
     * @return void
     */
    public function addArticle(): void
    {
        $view = new View("Ajouter un article");
        $view->render("addArticle");
    }

    /**
     * Affiche la page "à propos".
     * @return void
     */
    public function showApropos()
    {
        $view = new View("A propos");
        $view->render("apropos");
    }
    /**
     * Incrémente le compteur de vues d'un article.
     * @param int $articleId : l'identifiant de l'article.
     * @throws Exception Si une erreur survient lors de l'exécution de la requête SQL.
     */
    public function incrementArticleViews(int $articleId): void
    {
        try {
            $updateSql = "UPDATE article SET nbre_vues = nbre_vues + 1 WHERE id = :articleId";
            $stmt = $this->db->prepare($updateSql);
            $stmt->execute(['articleId' => $articleId]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'incrémentation des vues de l'article {$articleId} : " . $e->getMessage());
        }
    }
}

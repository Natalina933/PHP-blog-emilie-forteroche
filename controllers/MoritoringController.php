<php? 
/** L’affichage du titre de chacun des articles 
avec en plus sur chaque ligne : 
    -le nombre de vues ; 
    -le nombre de commentaires ; 
    -la date de publication de l’article. 
Ce tableau pourra être trié (croissant et décroissant)
en fonction de ces quatres critères 
(vues, commentaires, date et titre). 

**/

    class AdminMoritoring { 
        public function showMoritoring() : void
        {
            $articleManager = new ArticleManager();
            $articles = $articleManager->getAllArticles();
            $view = new View("Administration");
            $view->render("moritoring", ['articles' => $articles]);
        }
        


}
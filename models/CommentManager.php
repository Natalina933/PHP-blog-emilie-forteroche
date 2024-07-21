<?php

/**
 * Cette classe sert à gérer les commentaires.
 */
class CommentManager extends AbstractEntityManager
{
    /**
     * Récupère tous les commentaires avec possibilité de tri par colonne spécifiée.
     * Si $idArticle est spécifié, les commentaires seront filtrés par cet article.
     * @param int|null $idArticle : (optionnel) l'id de l'article pour filtrer les commentaires.
     * @param string $sort : la colonne de tri.
     * @param string $order : l'ordre de tri (ASC ou DESC).
     * @return array : un tableau d'objets Comment triés.
     */
    public function getAllComments(?int $idArticle = null, string $sort = 'date_creation', string $order = 'DESC'): array
    {
        // Définir les colonnes autorisées pour le tri
        $allowedSortColumns = ['id', 'pseudo', 'content', 'date_creation', 'id_article'];
        if (!in_array($sort, $allowedSortColumns)) {
            $sort = 'date_creation';
        }
        if ($order !== 'ASC' && $order !== 'DESC') {
            $order = 'DESC';
        }

        $sql = "SELECT * FROM comment";
        $params = [];

        if ($idArticle !== null) {
            $sql .= " WHERE id_article = :idArticle";
            $params['id_Article'] = $idArticle;
        }

        $sql .= " ORDER BY $sort $order";

        $result = $this->db->query($sql, $params);
        $comments = [];

        while ($comment = $result->fetch()) {
            $comments[] = new Comment($comment);
        }
        return $comments;
    }

    /**
     * Récupère un commentaire par son id.
     * @param int $id : l'id du commentaire.
     * @return Comment|null : un objet Comment ou null si le commentaire n'existe pas.
     */
    public function getCommentById(int $id): ?Comment
    {
        $sql = "SELECT * FROM comment WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $comment = $result->fetch();
        if ($comment) {
            return new Comment($comment);
        }
        return null;
    }

    /**
     * Ajoute un commentaire.
     * @param Comment $comment : l'objet Comment à ajouter.
     * @return bool : true si l'ajout a réussi, false sinon.
     */
    public function addComment(Comment $comment): bool
    {
        $sql = "INSERT INTO comment (pseudo, content, id_article, date_creation) VALUES (:pseudo, :content, :idArticle, NOW())";
        $result = $this->db->query($sql, [
            'pseudo' => $comment->getPseudo(),
            'content' => $comment->getContent(),
            'idArticle' => $comment->getIdArticle()
        ]);
        if ($result->rowCount() > 0) {
            // Mettre à jour le nombre de commentaires
            $this->updateCommentCount($comment->getIdArticle());
        }
        return $result->rowCount() > 0;
    }

    /**
     * Supprime un commentaire.
     * @param Comment $comment : l'objet Comment à supprimer.
     * @return bool : true si la suppression a réussi, false sinon.
     */
    public function deleteComment(Comment $comment): bool
    {
        $id = $comment->getId();
        $sql = "DELETE FROM comment WHERE id = :id";
        $pdo = $this->db->getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Mettre à jour le nombre de commentaires
            $this->updateCommentCount($comment->getIdArticle());

            return true;
        }

        return false;
    }

    /**
     * Récupère le nombre de commentaires pour un article donné.
     * @param int $articleId : l'id de l'article.
     * @return int : le nombre de commentaires.
     */
    public function countCommentsByArticleId(int $articleId): int
    {
        $sql = "SELECT COUNT(*) as count FROM comment WHERE id_article = :articleId";
        $stmt = $this->db->query($sql);
        $stmt->execute(['articleId' => $articleId]);
        $result = $stmt->fetch();
        return $result['count'];
    }

    /**
     * Met à jour le nombre de commentaires pour un article donné.
     * @param int $articleId : l'id de l'article.
     */
    public function updateCommentCount(int $articleId): void
    {
        $sql = "UPDATE article 
                SET nbre_commentaires = (SELECT COUNT(*) FROM comment WHERE id_article = :articleId) 
                WHERE id = :articleId";
        $pdo = $this->db->getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function getCommentsSorted(string $sort, string $order): array
    {
        // Sécuriser les colonnes de tri pour éviter les injections SQL
        $allowedSortColumns = ['id', 'pseudo', 'content', 'date_creation', 'id_article'];
        if (!in_array($sort, $allowedSortColumns)) {
            $sort = 'date_creation';
        }
        if ($order !== 'ASC' && $order !== 'DESC') {
            $order = 'DESC';
        }

        // Modifier la requête SQL pour trier correctement par id_article si nécessaire
        $orderByClause = ($sort === 'id_article') ? "id_article $order" : "$sort $order";
        $sql = "SELECT * FROM comment ORDER BY $orderByClause";
        $result = $this->db->query($sql);
        $comments = [];

        while ($comment = $result->fetch()) {
            $comments[] = new Comment($comment);
        }
        return $comments;
    }
    public function getAllCommentsByArticleId(int $idArticle): array
    {
        $sql = "SELECT * FROM comment WHERE id_article = :idArticle";
        $result = $this->db->query($sql, ['idArticle' => $idArticle]);
        $comments = [];

        while ($comment = $result->fetch()) {
            $comments[] = new Comment($comment);
        }
        return $comments;
    }
}

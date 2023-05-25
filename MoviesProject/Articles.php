<?php

class Articles {

    // attributes
    private $articleID;
    private $title;
    private $description;
    private $content;
    private $publishDate;
    private $views;
    private $rating;
    private $likes;
    private $dislikes;
    private $isPublished;
    private $userID;
    private $catID;
    
        private function initWith($articleID, $title, $description, $content, $publishDate, $views, $rating, $likes, $dislikes, $isPublished, $userID, $catID) {
        $this->articleID = $articleID;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->publishDate = $publishDate;
        $this->views = $views;
        $this->rating = $rating;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->isPublished = $isPublished;
        $this->userID = $userID;
        $this->catID = $catID;
    }
   
    public function getArticleID() {
        return $this->articleID;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getPublishDate() {
        return $this->publishDate;
    }

    public function getViews() {
        return $this->views;
    }

    public function getRating() {
        return $this->rating;
    }

    public function getLikes() {
        return $this->likes;
    }

    public function getDislikes() {
        return $this->dislikes;
    }

    public function getIsPublished() {
        return $this->isPublished;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getCatID() {
        return $this->catID;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setPublishDate($publishDate) {
        $this->publishDate = $publishDate;
    }

    public function setViews($views) {
        $this->views = $views;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function setLikes($likes) {
        $this->likes = $likes;
    }

    public function setDislikes($dislikes) {
        $this->dislikes = $dislikes;
    }

    public function setIsPublished($isPublished) {
        $this->isPublished = $isPublished;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setCatID($catID) {
        $this->catID = $catID;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    // method to delete article
    function deleteArticle() {
        try {
            $db = Database::getInstance();
            $data = $db->querySql("DELETE FROM dbProj_ARTICLE WHERE articleID = $this->articleID");
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    // method to initialize article with articleID
    function initWithArticleid($articleID) {
        $db = Database::getInstance();
        $data = $db->singleFetch("Select * from dbProj_ARTICLE WHERE articleID = $articleID ");
        $this->initWith($data->articleID,$data->title, $data->description, $data->content, $data->publishDate, $data->views, $data->likes, $data->dislikes, $data->rating, $data->isPublished, $data->userID, $data->catID);
    }

    // method to add a new article
    function addArticle() {
        try {
            $db = Database::getInstance();
            $data = $db->querySql("INSERT INTO dbProj_ARTICLE (articleID, title, description ,content, publishDate, views, likes, dislikes, isPublished, userID, catID) VALUES (NULL, \"$this->title\", \"$this->description\", \"$this->content\", \"$this->publishDate\", \"$this->views\", \"$this->rating\", \"$this->isPublished\", \"$this->filePath\", \"$this->userID\", \"$this->catID\")");
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    // method to update the database with edited details
    function updateDB() {
        $db = Database::getInstance();
        $data = "UPDATE dbProj_ARTICLE SET
			title = \"$this->title\",
			description = \"$this->description\",
                        content = \"$this->content\",
			publishDate = \"$this->publishDate\",
			views = \"$this->views\",
			rating = \"$this->rating\",
			isPublished = \"$this->isPublished\",
			filePath = \"$this->filePath\",
			userID = \"$this->userID\",
			catID = \"$this->catID\"
			WHERE articleID = $this->articleID";
        $db->querySql($data);
    }

    // method to return all articles
    function getAllArticles() {
        $db = Database::getInstance();
        $data = $db->multiFetch("SELECT * FROM dbProj_ARTICLE");
        return $data;
    }

    // method to return all articles of a specific category
    function getAllArticlesCat($catID) {
        $db = Database::getInstance();
        $data = $db->multiFetch("SELECT * FROM dbProj_ARTICLE WHERE catID = $catID ");
        return $data;
    }
    
    // method to return all articles with matching title
    function ShowArticles($search) {
        $q = "select * from dbProj_ARTICLE where match(title) against ('" . $search . "')  ORDER BY match(title) against ('" . $search . "') DESC";
        $db = Database::getInstance();
        $data = $db->multiFetch($q);
        return $data;
    }
}

    // method to update article view count
    function updateViewCount() {
        
    }

    // method to update article rating score
    function updateRatingScore() {
        
    }


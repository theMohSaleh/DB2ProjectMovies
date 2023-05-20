<?php

class Articles {

    // attributes
    private $articleID;
    private $title;
    private $content;
    private $publishDate;
    private $views;
    private $rating;
    private $likes;
    private $dislikes;
    private $isPublished;
    private $userID;
    private $catID;

    // constructor
    private function initWith($articleID, $title, $content, $publishDate, $views, $rating, $isPublished, $filePath, $userID, $catID) {
        $this->articleID = $articleID;
        $this->title = $title;
        $this->content = $content;
        $this->publishDate = $publishDate;
        $this->views = $views;
        $this->rating = $rating;
        $this->isPublished = $isPublished;
        $this->filePath = $filePath;
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
        $data = $db->singleFetch("SELECT * FROM dbProj_ARTICLE WHERE articleID = $this->articleID");
        $this->initWith($data->title, $data->content, $data->publishDate, $this->views, $this->rating, $this->isPublished, $this->filePath, $this->userID, $this->catID);
    }

    // method to add a new article
    function addArticle() {
        try {
            $db = Database::getInstance();
            $data = $db->querySql("INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, isPublished, userID, catID) VALUES (NULL, \"$this->title\", \"$this->content\", \"$this->publishDate\", \"$this->views\", \"$this->rating\", \"$this->isPublished\", \"$this->filePath\", \"$this->userID\", \"$this->catID\")");
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
        $data = $db->multiFetch("SELECT * FROM dbProj_ARTICLE WHERE catID = $catID");
        return $data;
    }
}

    // method to update article view count
    function updateViewCount() {
        
    }

    // method to update article rating score
    function updateRatingScore() {
        
    }


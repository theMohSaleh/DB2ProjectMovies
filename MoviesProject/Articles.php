<?php

/**
 * 
 * ******** FINISH updateViewCount AND updateRatingScore METHOD *********
 * 
 */
class Articles {

    // attributes
    private $articleID;
    private $title;
    private $content;
    private $publishDate;
    private $views;
    private $rating;
    private $isPublished;
    private $filePath;
    private $userID;
    private $catID;

    // constructor
    public function __construct($articleID, $title, $content, $publishDate, $views, $rating, $isPublished, $filePath, $userID, $catID) {
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

    // getters and setters

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

    public function setIsPublished($isPublished) {
        $this->isPublished = $isPublished;
    }

    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setCatID($catID) {
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

    public function getIsPublished() {
        return $this->isPublished;
    }

    public function getFilePath() {
        return $this->filePath;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getCatID() {
        return $this->catID;
    }

    // method to delte article
    function deleteArticle() {
        try {
            $db = Database::getInstance();
            $data = $db->querySql('Delete from ARTICLE where articleID=' . $this->articleID);
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    // method to initilize article with articleID
    function initWithArticleid($articleID) {

        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM ARTICLE WHERE articleID = ' . $this->articleID);
        $this->initWith($data->title, $data->content, $data->publishDate, $this->views, $this->rating, $this->isPublished, $this->filePath, $this->userID, $this->catID);
    }

    // method to add new article
    function addArticle() {

        try {
            $db = Database::getInstance();
            $data = $db->querySql('INSERT INTO ARTICLE (articleID, title, content, publishDate, views, rating, isPublished, filePath, userID, catID) VALUES (NULL, \'' . $this->title . '\',\'' . $this->content . '\',
                    \'' . $this->publishDate . '\', \'' . $this->views . '\', \'' . $this->rating . '\', \'' . $this->isPublished . '\', \'' . $this->filePath . '\', \'' . $this->userID . '\', \'' . $this->catID . '\')');
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    // method to initlize data
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

    // method to update database with edited details
    function updateDB() {

        $db = Database::getInstance();
        $data = 'UPDATE ARTICLE set
			title = \'' . $this->title . '\',
			content = \'' . $this->content . '\',
			publishDate = \'' . $this->publishDate . '\',
			views = \'' . $this->views . '\',
			rating = \'' . $this->rating . '\',
			isPublished = \'' . $this->isPublished . '\',
			filePath = \'' . $this->filePath . '\',
			userID = \'' . $this->userID . '\',
			catID = \'' . $this->catID . '\'
				WHERE articleID = ' . $this->articleID;
        $db->querySql($data);
    }

    // method to update article view count
    function updateViewCount() {
        
    }

    // method to update article rating score
    function updateRatingScore() {
        
    }

    // method to return all users
    function getAllArticles() {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from ARTICLE');
        return $data;
    }

    // methoid to return all articles of a specific category
    function getAllArticlesCat($catID) {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from ARTICLE WHERE catID = ' . $catID);
        return $data;
    }

}

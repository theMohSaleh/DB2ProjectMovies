<?php

class Articles {

    // attributes
    private $articleID;
    private $title;
    private $description;
    private $content;
    private $publishDate;
    private $views;
    private $likes;
    private $dislikes;
    private $rating;
    private $isPublished;
    private $userID;
    private $catID;
    
        private function initWith($articleID, $title, $description, $content, $publishDate, $views, $likes, $dislikes, $rating, $isPublished, $userID, $catID) {
        $this->articleID = $articleID;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->publishDate = $publishDate;
        $this->views = $views;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->rating = $rating;
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
    
    public function getDescription() {
        return $this->description;
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

    public function getLikes() {
        return $this->likes;
    }

    public function getDislikes() {
        return $this->dislikes;
    }

    public function getRating() {
        return $this->rating;
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
    
    public function setArticleID($articleID) {
        $this->articleID = $articleID;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function setDescription($description) {
        $this->description = $description;
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

    public function setLikes($likes) {
        $this->rating = $likes;
    }

    public function setDislikes($dislikes) {
        $this->likes = $dislikes;
    }

    public function setRating($rating) {
        $this->dislikes = $rating;
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
    function deleteArticle($loggedUserID="") {
        try {
            $db = Database::getInstance();
            $user = new Users();
            $user->initWithUid($this->userID);
            // check if article was not published by an admin
            if ($user->getUserID() == $loggedUserID) {
                $data = $db->querySql("DELETE FROM dbProj_ARTICLE WHERE articleID = $this->articleID");
                return true;
            } else if ($user->getRoleID() != '0') {
                $data = $db->querySql("UPDATE dbProj_ARTICLE SET Title = '*this article was removed by an administrator*', isPublished = 0 WHERE articleID = $this->articleID");
                return true;
            } else { 
                // prevent deletion of article if published by admin
                return false;
            }
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
    function addArticle($userID) {
        try {
            $db = Database::getInstance();
            $lastId = $db->querySql("INSERT INTO dbProj_ARTICLE (title, description, content, isPublished, userID, catID) VALUES ('$this->title', '$this->description',"
                    . "'$this->content', $this->isPublished, $userID, $this->catID);");
            $this->setArticleID($lastId);
            //SAVE
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
            
        }
    }

    // method to update the database with edited details
    function updateDB() {
        $db = Database::getInstance();
        $q = "UPDATE dbProj_ARTICLE SET
			title = \"$this->title\",
			description = \"$this->description\",
                        content = \"$this->content\",
			isPublished = $this->isPublished,
			catID = $this->catID
			WHERE articleID = $this->articleID";
        $db->querySql($q);
    }
    
    // method to set article publish date in database
    function publishArticle() {
        $db = Database::getInstance();
        $date = date("Y-m-d H:i:s"); // get current date and time
        $q = "UPDATE dbProj_ARTICLE SET
			publishDate = \"$date\"
			WHERE articleID = $this->articleID";
        $db->querySql($q);
        return $q;
    }

    // method to return all articles (for admin use)
    function getAllArticles() {
        $db = Database::getInstance();
        $data = $db->multiFetch("SELECT * FROM dbProj_ARTICLE");
        return $data;
    }
    
    function getPublishedArticlesCount() {
        $db = Database::getInstance();
        $q = "SELECT * FROM dbProj_ARTICLE WHERE isPublished = 1";
        $data = $db->multiFetch($q);
        $count = count($data);
        return $count;
    }
    
    // method to display published articles
    function getAllPublishedArticles($start,$end) {
        $db = Database::getInstance();
        $q = "SELECT * FROM dbProj_ARTICLE WHERE isPublished = 1 ORDER BY publishDate DESC ";
        
        if(isset($start)){
            $q .= 'limit ' .$start. ',' . $end;
        }
        $data = $db->multiFetch($q);
        echo $q;
        return $data;
    }
    
    // method to return all articles of a specific category
    function getAllArticlesCat($catID) {
        $db = Database::getInstance();
        $data = $db->multiFetch("SELECT * FROM dbProj_ARTICLE WHERE catID = $catID AND isPublished = 1");
        return $data;
    }
    
    function getAllArticlesAuthor($authorID) {
        $db = Database::getInstance();
        $data = $db->multiFetch("SELECT * FROM dbProj_ARTICLE WHERE userID = $authorID");
        return $data;
    }
    // method to return all articles with matching title
    function ShowArticles($search) {
        $q = "select * from dbProj_ARTICLE where isPublished = 1 AND match(title,description) against ('" . $search . "')  ORDER BY match(title,description) against ('" . $search . "') DESC";
        $db = Database::getInstance();
        $data = $db->multiFetch($q);
        return $data;
    }
    
    // method to update article view count
    function updateViewCount() {
        $db = Database::getInstance();
        $data = "UPDATE dbProj_ARTICLE SET views = views+1 WHERE articleid='$this->articleID'";
        $db->querySql($data);
    }

    // method to increment like value
    function like() {
        $db = Database::getInstance();
        $data = "UPDATE dbProj_ARTICLE SET likes = likes+1 WHERE articleid='$this->articleID'";
        $db->querySql($data);
    }
    
    function dislike() {
        $db = Database::getInstance();
        $data = "UPDATE dbProj_ARTICLE SET dislikes = dislikes+1 WHERE articleid='$this->articleID'";
        $db->querySql($data);
    }
}

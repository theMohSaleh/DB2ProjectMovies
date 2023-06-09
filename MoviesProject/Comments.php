<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Comments
 *
 * @author MohN1080p
 */
class Comments {
    private $commentID;
    private $commentText;
    private $creationDate;
    private $userID;
    private $articleID;
    
    public function getCommentID() {
        return $this->commentID;
    }

    public function getCommentText() {
        return $this->commentText;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getArticleID() {
        return $this->articleID;
    }

    public function setCommentText($commentText) {
        $this->commentText = $commentText;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setArticleID($articleID) {
        $this->articleID = $articleID;
    }
    
    private function initWith($commentID, $commentText, $creationDate, $userID, $articleID) {
        $this->commentID = $commentID;
        $this->commentText = $commentText;
        $this->creationDate = $creationDate;
        $this->userID = $userID;
        $this->articleID = $articleID;
    }

    function initWithCommentId($commentID) {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_COMMENT WHERE commentID = ' . $commentID);
        $this->initWith($data->commentID, $data->commentText, $data->creationDate, $data->userID, $data->$articleID);
    }
    
    function addComment(){
        if ($this->isValid()) {
            try {
                $db = Database::getInstance();
                $data = $db->querySql('INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID) VALUES (NULL, \'' . $this->commentText . '\', \'' . $this->creationDate . '\', \'' .$this->userID. '\', \'' . $this->articleID. '\')');
                echo $data;
                return true;
            } catch (Exception $e) {
                echo 'Exception: ' . $e;
                return false;
            }
        } else
            return false;
    }
    
    function updateDB() {

        if ($this->isValid()) {
            $db = Database::getInstance();
            $data = 'UPDATE dbProj_COMMENT set
			commentText = \'' . $this->commentText . '\' ,
			creationDate = \'' . $this->creationDate . '\' ,
			userID = \'' . $this->userID . '\'  ,
                        articleID = \'' . $this->articleID . '\' ,
				WHERE commentID = ' . $this->uid;
            $db->querySql($data);
        }
    }
    function getAllComments(){
        $db = DatabaseA::getInstance();
        $data = $db->multiFetch("SELECT * FROM dbProj_COMMENT");
        return $data;
    }
    
    function getAllCommentsForArticle($articleID){
        $db = Database::getInstance();
        $data = $db->multiFetch("SELECT * FROM dbProj_COMMENT WHERE articleID = $articleID");
        return $data;
    }
    
    function isValid(){
        $errors = true;
        
        if(empty($this->commentText)){
            $errors = false;
        }
        
        if(empty($this->articleID)){
            $errors = false;
        }
        
        if(empty($this->userID)){
            $errors = false;
        }
        
        return $errors;
    }
    
    function deleteComment() {
            $db = Database::getInstance();
            $data = $db->querySql('UPDATE dbProj_COMMENT SET commentText="This comment was removed by an administrator" WHERE commentID=' . $this->commentID);
            return true;
    }
}

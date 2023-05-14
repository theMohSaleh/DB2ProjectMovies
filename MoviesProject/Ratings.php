<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Ratings
 *
 * @author MohN1080p
 */
class Ratings {
    private $ratingID;
    private $ratingValue;
    private $articleID;
    
    public function getRatingID() {
        return $this->ratingID;
    }

    public function getRatingValue() {
        return $this->ratingValue;
    }

    public function getArticleID() {
        return $this->articleID;
    }

    public function setRatingValue($ratingValue) {
        $this->ratingValue = $ratingValue;
    }

    public function setArticleID($articleID) {
        $this->articleID = $articleID;
    }

    function initWith($ratingID, $ratingValue, $articleID) {
        $this->ratingID = $ratingID;
        $this->ratingValue = $ratingValue;
        $this->articleID = $articleID;
    }
    
    function initWithUid($ratingID) {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM RATING WHERE ratingID = ' . $this->userID);
        $this->initWith($data->ratingID, $data->ratingValue, $data->articleID);
    }
    
    function addRating(){
        if ($this->isValid()) {
            try {
                $db = Database::getInstance();
                $data = $db->querySql("INSERT INTO RATING (ratingID, ratingValue, articleID) VALUES (NULL, $this->ratingValue, $this->articleID )");
                return true;
            } catch (Exception $e) {
                echo 'Exception: ' . $e;
                return false;
            }
        } else
            return false;
    }
    function isValid(){
        $errors = true;
        
        if(empty($this->ratingValue)){
            $errors = false;
        }
        if(empty($this->articleID)){
            $errors = false;
        }
        return $errors;
    }
}

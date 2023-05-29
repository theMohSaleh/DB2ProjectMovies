<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Categories
 *
 * @author MohN1080p
 */
class Categories {
    private $catID;
    private $catName;
    
    public function getCatID() {
        return $this->catID;
    }

    public function getCatName() {
        return $this-catName;
    }

    public function setCatName($catName): void {
        $this->catName = $catName;
    }

    public function initWith($catID, $catName) {
        $this->catID = $catID;
        $this->catName = $catName;
    }
    
    public function initWithCatID($catID) {
        $db = Database::getInstance();
        $data = $db->singleFetch("SELECT * FROM dbProj_CATEGORY WHERE catID = $catID ");
        $this->initWith($data->catID,$data->catName);
    }
    
    function addCategory(){
        if($this->isValid()){
            try{
                $db = Database::getInstance();
                $data = $db->querySql('INSERT INTO dbProj_CATEGORY (catID, catName) VALUES (NULL, \'' . $this->catName. '\')');
                return true;
            } catch (Exception $e) {
                echo 'Exception: ' . $e;
                return false;
            }
        } else {
            return false;
        }
    }
    function updateDB(){
        if($this->isValid()){
            $db = Database::getInstance();
            $data = 'UPDATE dbProj_CATEGORY SET catName = \'' . $this->catName . '\'WHERE catID = ' . $this->catID;
            $db->querySql($data);
        }
    }
    
    function getAllCategories(){
        $db = Database::getInstance();
        $data = $db->multiFetch("SELECT * FROM dbProj_CATEGORY");
        return $data;
    }
    
    function isValid(){
        $errors = true;
        
        if(empty($this->catName)){
            $errors = false;
        }
        return $errors;
    }
}

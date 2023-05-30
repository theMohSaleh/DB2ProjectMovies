<?php

class Files {

    private $fileID;
    private $fileName;
    private $fileType;
    private $fileLocation;
    private $articleID;
    
    public function getFileID() {
        return $this->fileID;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function getFileType() {
        return $this->fileType;
    }

    public function getFileLocation() {
        return $this->fileLocation;
    }

    public function getArticleID() {
        return $this->articleID;
    }

    public function setFileName($fileName) {
        $this->fileName = trim($fileName);
    }

    public function setFileType($fileType) {
        $this->fileType = $fileType;
    }

    public function setFileLocation($fileLocation) {
        $this->fileLocation = trim($fileLocation);
    }

    public function setArticleID($articleID) {
        $this->articleID = $articleID;
    }

        
    private function initWith($fileID, $fileName, $fileType, $fileLocation, $articleID) {
        $this->fileID = $fileID;
        $this->fileName = $fileName;
        $this->fileType = $fileType;
        $this->fileLocation = $fileLocation;
        $this->articleID = $articleID;
    }

    
    
    function deleteFile() {
        try {
            $db = Database::getInstance();
            $data = $db->querySql("Delete from dbProj_FILES where fileID= $this->fileID " );
            unlink($this->fileLocation);
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    function initWithFileID($fileID) {
        $db = Database::getInstance();
        $data = $db->singleFetch("SELECT * FROM dbProj_FILES WHERE fileID = $fileID");
        $this->initWith($data->fileID, $data->fileName, $data->fileType, $data->fileLocation, $data->articleID);
    }

    function addFile() {
        try {
            $db = Database::getInstance();
            $data = $db->querySql("INSERT INTO dbProj_FILES (fileID, fileName, fileType, fileLocation, articleID) VALUES (NULL, \" $this->fileName \" , \" $this->fileType \", \" $this->fileLocation \", $this->articleID )");
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    function updateDB() {

        $db = Database::getInstance();
        $data = 'UPDATE dbProj_FILES set
			fileName= \'' . $this->fileName . '\' ,
			fileType= \'' . $this->fileType . '\' ,
			fileLocation = \'' . $this->fileLocation . '\' ,
                        articleID = ' . $this->articleID . '
				WHERE fileID = ' . $this->fileID;
        $db->querySql($data);
    }

    function getAllFiles() {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_FILES');
        return $data;
    }

    function getArticleFiles($articleID) {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_FILES where articleID=' . $articleID);
        return $data;
    }
    
    function getFirstArticleImage($articleID){
        $filePath = "images/image-not-available.png";
        $imageTypes = array('image/jpeg', 'image/png', 'image/gif', 'image/tiff');
        $files = $this->getArticleFiles($articleID);
        $filePath = $files[0]->fileLocation;
        for($i = 0; $i < count($files); $i++){
            if(in_array($files[$i]->fileType,$imageTypes)){
                $filePath = $files[$i]->fileLocation;
                return $filePath;
            }
        }
        return $filePath;
    }
}
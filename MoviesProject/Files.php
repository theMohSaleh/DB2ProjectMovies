<?php

class Files {

    private $fileID;
    private $fileName;
    private $fileType;
    private $fileLocation;
    private $articleID;
    
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
            $data = $db->querySql("Delete from dbProj_FILE where fileID=' . $this->fileID" );
            unlink($this->fileLocation);
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    function initWithFileID($fileID) {
        $db = Database::getInstance();
        $data = $db->singleFetch("SELECT * FROM dbProj_FILE WHERE fileID = ' . $fileID");
        $this->initWith($data->fid, $data->fname, $data->flocation, $data->ftype, $data->uid);
    }

    function addFile() {
        try {
            $db = Database::getInstance();
            $data = $db->querySql("INSERT INTO dbProj_FILE (fileID, fileName, fileLocation, fileType) VALUES (NULL, $this->fileName, $this->fileLocation, $this->fileType, $this->articleID )");
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }

    function updateDB() {

        $db = Database::getInstance();
        $data = 'UPDATE dbProj_FILE set
			fileName= \'' . $this->fileName . '\' ,
			fileType= \'' . $this->fileType . '\' ,
			fileLocation = \'' . $this->fileLocation . '\' ,
                        articleID = ' . $this->articleID . '
				WHERE fid = ' . $this->fid;
        $db->querySql($data);
    }

    function getAllFiles() {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_FILE');
        return $data;
    }

    function getArticleFiles($articleID) {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_FILE where uid=' . $this->articleID);
        return $data;
    }
}
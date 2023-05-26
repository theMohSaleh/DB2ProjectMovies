<?php

class Search {


    public function ShowArticles($search) {
            $q = "select * from dbProj_ARTICLE where match(title,description) against ('" . $search . "')";

        $q .= " ORDER BY match(title,description) against ('" . $search . "') DESC";
        $db = Database::getInstance();
        $data = $db->multiFetch($q);
        return $data;
        //$this->showResults($q);
    }
    
    public function ShowAdvancedArticles($title="", $authorID="", $popular=false, $startDate="", $endDate="") {
        $q = "select * from dbProj_ARTICLE WHERE isPublished = 1";
        
//        // check if all fields are empty and display all articles instead
//        if (empty($title) && empty($authorID) && empty($startDate) && empty($endDate)) {
//            $q = "select * from dbProj_ARTICLE";
//        }
        
        // check if title was searched for
        if ($title != "") {
            $q = $q." AND match(title,description) against ('" . $title . "')";
        }
        
        // check if an author was selected
        if ($authorID != "") {
            $q = $q." AND UserID = $authorID";
        }
        
        // check if a date range was selected
        if ($startDate != "" && $endDate != "") {
            $q = $q." AND publishDate BETWEEN '$startDate' AND '$endDate'";
        }
        
        // check if most viewed was selected
        if ($popular == true) {
            $q = $q." ORDER BY views DESC";
        }
        
        // fetch data and return
        $db = Database::getInstance();
        $data = $db->multiFetch($q);
        return $data;
    }
    
    
    function showResults($q) {

        $db = Database::getInstance();
        $data = $db->multiFetch($q);

        if (!empty($data)) {
            $row_cnt = count($data);

            if ($row_cnt == 0) {
                echo '<br>';
                echo '<p>sorry no articles were found that match your query</p>';
            } else {
                echo '<br>';
                //display a table of results
                $table = '<table class="CSSTableGenerator" width="75%">' .
                        '<tr bgcolor="#87CEEB">
                     <td><b>Message ID</b></td>
                     <td><b>Topic</b></td>
                     <td><b>Message</b></td>';


                

                $bg = '#eeeeee';

                for ($i = 0; $i < $row_cnt; $i++) {
                    $bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');

                    $table .= '<tr bgcolor="' . $bg . '">
                          <td> ' . $data[$i]->idMessages . '</td>
                          <td>' . $data[$i]->Subject . '</td>
                        <td>' . $data[$i]->MessageText . '</td>';

                    
                }
                $table .= '</table>';

                echo $table;
            }
        }
        else {
            echo '<p class="error"> sorry no messages were found that match your query</p>';
        }
    }

    function handleAll($text) {

        echo $text;
        $search = explode(' ', $text);
        // print_r($search);

        $returnText = '';

        foreach ($search as $term) {
            $term = '+' . $term . ' ';
            $returnText .= $term;
        }

        $returnText = trim($returnText);

        return $returnText;
    }

    function handleNone($text) {

        $search = explode(' ', $text);

        $returnText = '';

        foreach ($search as $term) {
            $term = '-' . $term . ' ';
            $returnText .= $term;
        }

        return $returnText;
    }

    function handlePart($text) {

        $search = explode(' ', $text);

        $returnText = '';

        foreach ($search as $term) {
            $term = $term . '* ';
            $returnText .= $term;
        }

        $returnText = trim($returnText);

        return $returnText;
    }

    function handleExact($text) {

        $returnText = '"' . $text . '"';

        return $returnText;
    }

    function handleFirst($text) {

        $search = explode(' ', $text);

        $returnText = '+' . $search[0] . ' -' . $search[1];
        /*
          foreach($search as $term){
          $term = '-'.$term. ' ';
          $returnText .= $term;
          } */

        return $returnText;
    }

    function handleRank($text) {
        //create a search query that looks first for the exact term, then for all terms, then for any of the terms
        //and then for parts of the terms
        // $returnText = '("'.$text.'")';

        $search = explode(' ', $text);

        $returnText = ' (';

        foreach ($search as $term) {
            $term = '+' . $term . ' ';
            $returnText .= $term;
        }

        $returnText = trim($returnText);

        $returnText .= ') (' . $text . ') ';

        foreach ($search as $term) {
            $term = $term . '* ';
            $returnText .= $term;
        }
        $returnText = trim($returnText);

        return $returnText;
    }

}

?>

<?php
  class cusMovieListController{  
    
    public function retrieveAllMovie(){
        require_once '../../movieEntity.php';
        $movie = new Movie();
        $retrieveAll = $movie->retrieveAll();

        if (!empty($retrieveAll)) {
            return $retrieveAll;
        }
        else {
            return FALSE;
        }

    }

    public function retrieveBySearch($searchArg){
        require_once '../../movieEntity.php';
        $movie = new Movie();
        $retrieveSearch = $movie->retrieveBySearch($searchArg);
        return $retrieveSearch;

    }

  }
?>
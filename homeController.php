<?php
  class homeController{  
    
    public function retrieveFeaturedMovie(){
        require_once 'movieEntity.php';
        $movie = new Movie();
        $retrieveFeatured = $movie->retrieveFeatured();

        if (!empty($retrieveFeatured)) {
            return $retrieveFeatured;
        }
        else {
            return FALSE;
        }

    }

  }
?>
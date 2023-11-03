<?php
    class searchMovieListingController{
        public function searchMovieListing($movieName){

            require_once 'movieListingEntity.php';

            $movieListing = new movieListingType();

            if(!$movieListing->isMovieNameTaken($movieName)){
                $message ="Movie not found in database";
                header("Location: movieListingSearchBoundary.php?message=" . urlencode($message));
                exit();
            }
            else{
                $movieListingList = $movieListing->displayMovie($movieName);
                return $movieListingList;
            }
        }

    }
    
    if(isset($_POST['submit'])){
        $movieName = $_POST['movieName'];

        $searchMovieListingControllerObject = new searchMovieListingController();
        $movieListingList = $searchMovieListingControllerObject -> searchMovieListing($movieName);
        
        $_SESSION['movieListingList'] = $movieListingList;
        header("Location: movieListingSearchBoundary.php");
        exit();
    }
?>
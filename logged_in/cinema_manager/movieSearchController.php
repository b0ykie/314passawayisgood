<?php
session_start();

    class searchMovieController{
        public function searchMovie($movieName) {
            require_once 'movieListEntity.php';
            $movie = new movieList();
        
            $movieList = $movie->displayMovie($movieName);
            if (empty($movieList)) {
                $message = "Movie not found in the database";
                header("Location: movieListingSearchBoundary.php?message=" . urlencode($message));
                exit();
            } else {
                return $movieList;
            }
        }        
    }
    
    if(isset($_POST['submit'])){
        $movieName = $_POST['movieName'];

        $searchMovieController = new searchMovieController();
        $movieList = $searchMovieController -> searchMovie($movieName);
        
        $_SESSION['movieList'] = $movieList;
        header("Location: movieListingSearchBoundary.php");
        exit();
    }
?>
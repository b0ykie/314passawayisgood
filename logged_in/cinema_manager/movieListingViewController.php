<?php
    session_start();
    
    class viewMovieListingController{
        public function viewMovieList(){
            require_once 'movieListEntity.php';

            $movie = new movieList();
            $movieList = $movie->viewMovieListing();
            return $movieList;
        }
    }

    if (isset($_POST['viewAll'])){
        require_once 'movieListEntity.php';

        $viewMovieListingController = new viewMovieListingController();
        $movieList = $viewMovieListingController->viewMovieList();

        $_SESSION['movieList'] = $movieList;
        header("Location: movieListingViewBoundary.php");
        exit();
    }
?>
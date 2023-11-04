<?php
  session_start();
  $username = $_SESSION['username'];

  require_once 'cusmovieListController.php';
  $cusMovieList = new cusmovieListController();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Ticket Booking System</title>
    <link rel="stylesheet" href="../../style.css">
  </head>

    <body>
        <!-- HEADER SECTION -->
        <header>
        <div class="logo">
            <img src="../../images\logoo.jpg" >
        </div>

        <nav>
            <ul>
            <li><a href="cushomeBoundary.php">Home</a></li>
            
            <li><a href="cusaboutUsBoundary.php">About Us</a></li>
            <li><a href="cuscontactUsBoundary.php">Contact Us</a></li>
            </ul>
        </nav>

        <div class="welcome">
            <h2>Welcome Back <?php echo $username; ?> !</h2>
        </div>


        <div class="user-actions">
            <a href="cusPurchaseHistBoundary.php" class="purchase_history-btn">Purchase History</a>
            <a href="../../homeBoundary.php" class="logout-btn">Log Out</a>
        </div>
        </header>

        <!-- MAIN SECTION --> 
        <main>
            <ul>
                <!-- Add the search bar above the movie listing -->
                <div class="search-container">
                    <form method="post">
                        <label for="search">Search Movie Name: </label>
                        <input type="text" name="search" id="search" placeholder="Enter a keyword">
                        <button type="submit" name="submit">Search</button>
                    </form>
                </div>

                <section class="movie_list">
                    <!-- Retrieve and display the movie information from the database based on the search keyword -->
                    <h1>Movie Listing</h1>
                    <?php
                        if (isset($_POST['submit'])) {
                            $searchKeyword = $_POST['search'];
                            $result = $cusMovieList->retrieveBySearch($searchKeyword);
                    
                            if (!empty($result)) {
                                foreach ($result as $movie) {
                                    echo "<li>";
                                    echo "<div class='movie-image'>";
                                    echo "<img src='../../images/Themes/{$movie->getMoviename()}.jpg' alt='Movie Image' style='width: 300px; height: 300px;'>";
                                    echo "</div>";
                                    echo "<div class='movie-info'>";
                                    echo "<h2>{$movie->getMoviename()}</h2>";
                                    echo "<p>{$movie->getMovieDesc()}</p>";
                                    echo "<p><a href='bookingBoundary.php?movie={$movie->getMoviename()}'>Book Now</a></p>";
                                    echo "</div>";
                                    echo "</li>";
                                }
                            } else {
                                echo "No movies found.";
                            }
                        }
                        else {
                            $cusAllMovieList = $cusMovieList->retrieveAllMovie();
                            // Display the movie information in HTML
                            foreach ($cusAllMovieList as $row) {
                                echo "<li>";
                                echo "<div class='movie-image'>";
                                echo "<img src='../../images/Themes/{$row->getMoviename()}.jpg' alt='Movie Image' style='width: 300px; height: 300px;'>";
                                echo "</div>";
                                echo "<div class='movie-info'>";
                                echo "<h2>{$row->getMoviename()}</h2>";
                                echo "<p>{$row->getMovieDesc()}</p>";
                                echo "<p><a href='bookingBoundary.php?movie={$row->getMoviename()}'>Book Now</a></p>";
                                echo "</div>";
                                echo "</li>";
                            }
                        }
                    ?>
                </section>
            </ul>
        </main>

        <!-- FOOTER SECTION -->        
        <footer>
            <p>&copy; CafeworkForce Solutions</p>
        </footer>
    </body>
</html>
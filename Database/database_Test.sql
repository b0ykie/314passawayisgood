CREATE TABLE USER_PROFILE(
    userProfileType VARCHAR (30) NOT NULL,
    CONSTRAINT USER_PROFILE_PKEY PRIMARY KEY(userProfileType)  
);
INSERT INTO USER_PROFILE(userProfileType) 
VALUES 
    ('Admin'),
    ('Owner'),
    ('Manager'),
    ('Customer');

CREATE TABLE USER_ACCOUNT(
    userID INT (30) NOT NULL AUTO_INCREMENT,
    userName VARCHAR (30) NOT NULL,
    userPassword VARCHAR (30) NOT NULL,
    userEmail VARCHAR (30) NOT NULL,
    userProfile VARCHAR (30) NOT NULL,
    userLoyalty_Pts INT (30) NOT NULL,
    CONSTRAINT USER_ACCOUNT_PKEY PRIMARY KEY(userID),
    CONSTRAINT USER_ACCOUNT_CKEY UNIQUE(userName),
    CONSTRAINT USER_ACCOUNT_FKEY FOREIGN KEY(userProfile) REFERENCES USER_PROFILE(userProfileType)
);
INSERT INTO USER_ACCOUNT(userName, userPassword, userEmail,userProfile,userLoyalty_Pts) 
VALUES 
    ('wxc', 'qweqwe', 'wxc@gmail.com', 'customer', '10'),
    ('weixchoon', 'qweqwe', 'weixc@gmail.com', 'customer', '100'),
    ('dave', 'qweqwe', 'dave@gmail.com', 'manager', '0'),
    ('jks', 'qweqwe', 'jks@gmail.com', 'owner', '0'),
    ('dom', 'qweqwe', 'dom@gmail.com', 'admin', '0');

CREATE TABLE MOVIE(
    movieID INT (30) NOT NULL AUTO_INCREMENT,
    movieName VARCHAR (999) NOT NULL,
    movieDescription VARCHAR (9999) NOT NULL,
    movieAvailability BOOLEAN NOT NULL,
    CONSTRAINT MOVIE_PKEY PRIMARY KEY(movieID),
    CONSTRAINT MOVIE_CKEY UNIQUE(movieName)
);
INSERT INTO MOVIE (movieName, movieDescription, movieAvailability)
VALUES 
    ('Sashank Prison Break', '<p>Release Year: 2019</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Dave Lim</p>
    <p>Stars: Jagarapu Kumar Sashank</p>', 1), 
    ('Sashank New Horror Movie', '<p>Release Year: 2020</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Dave Lim</p>
    <p>Stars: Jagarapu Kumar Sashank</p>', 1), 
    ('Sashank TDG', '<p>Release Year: 2021</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Dave Lim</p>
    <p>Stars: Jagarapu Kumar Sashank</p>', 1), 
    ('Sashank TDG2', '<p>Release Year: 2022</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Dave Lim</p>
    <p>Stars: Jagarapu Kumar Sashank</p>', 1), 
    ('Sashank The Joker', '<p>Release Year: 2023</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Dave Lim</p>
    <p>Stars: Jagarapu Kumar Sashank</p>', 1), 
    ('America Pie', '<p>Release Year: 1999</p>
    <p>Genre: Romance, Comedy, Teen, Sex comedy</p>
    <p>Director: Paul Weitz</p>
    <p>Stars: Jason Biggs, Seann William Scott, Chris Klein, Alyson Hannigan, Tara Reid</p>', 1), 
    ('Blue Mountain State', '<p>Release Year: 2016</p>
    <p>Genre: Romance, Sports</p>
    <p>Director: Lev L. Spiro</p>
    <p>Stars: Darin Brooks, Alan Ritchson, Page Kennedy, Sam Jones III, Chris Romano.
    Ed Marinaro, Frankie Shaw, Gabrielle Dennis</p>', 1), 
    ('Expandables 2', '<p>Release Year: 2012</p>
    <p>Genre: Action, Adventure, Thriller</p>
    <p>Director: Simon West</p>
    <p>Stars: Sylvester Stallone, Jason Statham, Jet Li, Dolph Lundgren, Chuck Norris, Jean-Claude Van Damme, Bruce Willis, Arnold Schwarzenegger, Terry Crews, Randy Couture, Liam Hemsworth, Scott Adkins, Yu Nan</p>', 1),
    ('The Fast And The Furious', '<p>Release Year: 2001</p>
    <p>Genre: Adventure, Crime film, Thriller</p>
    <p>Director: Louis Leterrier</p>
    <p>Stars: Vin Diesel, Paul Walker, Michelle Rodriguez, Jordana Brewster</p>', 1), 
    ('John Wick', '<p>Release Year: 2014</p>
    <p>Genre: Action, Thriller</p>
    <p>Director: Chad Stahelski</p>
    <p>Stars: Keanu Reeves</p>', 1), 
    ('Pokémon', '<<p>Release Year: 1998</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Kunihiko Yuyama</p>
    <p>Stars: Art of Brycen and Sabrina</p>', 1), 
    ('Prison Break', '<p>Release Year: 2009</p>
    <p>Genre: Serial, Action, Adventure, Thriller</p>
    <p>Director: Arthur Lubin</p>
    <p>Stars: Dominic Purcell, Wentworth Miller, Robin Tunney, Peter Stormare, Amaury Nolasco, Marshall Allman, Wade Williams, Paul Adelstein</p>', 1), 
    ('Spiderman No Way Home', '<p>Release Year: 2021</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Jon Watts</p>
    <p>Stars: Tom Holland, Zendaya, Benedict Cumberbatch, Jacob Batalon, Jon Favreau, Jamie Foxx, Andrew Garfield, Tobey Maguire</p>', 1),
    ('The Shawshank Redemption', '<p>Release Year: 1994</p>
    <p>Genre: Drama</p>
    <p>Director: Frank Darabont</p>
    <p>Stars: Tim Robbins, Morgan Freeman</p>', 1),
    ('The Godfather', '<p>Release Year: 1972</p>
    <p>Genre: Crime, Drama</p>
    <p>Director: Francis Ford Coppola</p>
    <p>Stars: Marlon Brando, Al Pacino</p>', 1),
    ('Pulp Fiction', '<p>Release Year: 1994</p>
    <p>Genre: Crime, Drama</p>
    <p>Director: Quentin Tarantino</p>
    <p>Stars: John Travolta, Uma Thurman</p>', 1),
    ('The Dark Knight', '<p>Release Year: 2008</p>
    <p>Genre: Action, Crime, Drama</p>
    <p>Director: Christopher Nolan</p>
    <p>Stars: Christian Bale, Heath Ledger</p>', 1),
    ('Inception', '<p>Release Year: 2010</p>
    <p>Genre: Action, Adventure, Sci-Fi</p>
    <p>Director: Christopher Nolan</p>
    <p>Stars: Leonardo DiCaprio, Joseph Gordon-Levitt</p>', 1),
    ('Fight Club', '<p>Release Year: 1999</p>
    <p>Genre: Drama</p>
    <p>Director: David Fincher</p>
    <p>Stars: Brad Pitt, Edward Norton</p>', 1),
    ('The Matrix', '<p>Release Year: 1999</p>
    <p>Genre: Action, Sci-Fi</p>
    <p>Directors: Lana Wachowski, Lilly Wachowski</p>
    <p>Stars: Keanu Reeves, Laurence Fishburne</p>', 1),
    ('Forrest Gump', '<p>Release Year: 1994</p>
    <p>Genre: Drama, Romance</p>
    <p>Director: Robert Zemeckis</p>
    <p>Stars: Tom Hanks, Robin Wright</p>', 1),
    ('The Lion King', '<p>Release Year: 1994</p>
    <p>Genre: Animation, Adventure, Drama</p>
    <p>Directors: Roger Allers, Rob Minkoff</p>
    <p>Stars: Matthew Broderick, Jeremy Irons</p>', 1),
('Sashank Prison Break 2', '<p>Release Year: 2019</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Dave Lim</p>
    <p>Stars: Jagarapu Kumar Sashank</p>', 1), 
    ('Sashank New Horror Movie 2', '<p>Release Year: 2020</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Dave Lim</p>
    <p>Stars: Jagarapu Kumar Sashank</p>', 1), 
    ('Sashank TDG 2', '<p>Release Year: 2021</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Dave Lim</p>
    <p>Stars: Jagarapu Kumar Sashank</p>', 1), 
    ('Sashank TDG2 2', '<p>Release Year: 2022</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Dave Lim</p>
    <p>Stars: Jagarapu Kumar Sashank</p>', 1), 
    ('Sashank The Joker 2', '<p>Release Year: 2023</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Dave Lim</p>
    <p>Stars: Jagarapu Kumar Sashank</p>', 1), 
    ('America Pie 2', '<p>Release Year: 1999</p>
    <p>Genre: Romance, Comedy, Teen, Sex comedy</p>
    <p>Director: Paul Weitz</p>
    <p>Stars: Jason Biggs, Seann William Scott, Chris Klein, Alyson Hannigan, Tara Reid</p>', 1), 
    ('Blue Mountain State 2', '<p>Release Year: 2016</p>
    <p>Genre: Romance, Sports</p>
    <p>Director: Lev L. Spiro</p>
    <p>Stars: Darin Brooks, Alan Ritchson, Page Kennedy, Sam Jones III, Chris Romano.
    Ed Marinaro, Frankie Shaw, Gabrielle Dennis</p>', 1), 
    ('Expandables 2 2', '<p>Release Year: 2012</p>
    <p>Genre: Action, Adventure, Thriller</p>
    <p>Director: Simon West</p>
    <p>Stars: Sylvester Stallone, Jason Statham, Jet Li, Dolph Lundgren, Chuck Norris, Jean-Claude Van Damme, Bruce Willis, Arnold Schwarzenegger, Terry Crews, Randy Couture, Liam Hemsworth, Scott Adkins, Yu Nan</p>', 1),
    ('The Fast And The Furious 2', '<p>Release Year: 2001</p>
    <p>Genre: Adventure, Crime film, Thriller</p>
    <p>Director: Louis Leterrier</p>
    <p>Stars: Vin Diesel, Paul Walker, Michelle Rodriguez, Jordana Brewster</p>', 1), 
    ('John Wick 2', '<p>Release Year: 2014</p>
    <p>Genre: Action, Thriller</p>
    <p>Director: Chad Stahelski</p>
    <p>Stars: Keanu Reeves</p>', 1), 
    ('Pokémon 2', '<<p>Release Year: 1998</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Kunihiko Yuyama</p>
    <p>Stars: Art of Brycen and Sabrina</p>', 1), 
    ('Prison Break 2', '<p>Release Year: 2009</p>
    <p>Genre: Serial, Action, Adventure, Thriller</p>
    <p>Director: Arthur Lubin</p>
    <p>Stars: Dominic Purcell, Wentworth Miller, Robin Tunney, Peter Stormare, Amaury Nolasco, Marshall Allman, Wade Williams, Paul Adelstein</p>', 1), 
    ('Spiderman No Way Home 2', '<p>Release Year: 2021</p>
    <p>Genre: Action, Adventure</p>
    <p>Director: Jon Watts</p>
    <p>Stars: Tom Holland, Zendaya, Benedict Cumberbatch, Jacob Batalon, Jon Favreau, Jamie Foxx, Andrew Garfield, Tobey Maguire</p>', 1),
    ('The Shawshank Redemption 2', '<p>Release Year: 1994</p>
    <p>Genre: Drama</p>
    <p>Director: Frank Darabont</p>
    <p>Stars: Tim Robbins, Morgan Freeman</p>', 1),
    ('The Godfather 2', '<p>Release Year: 1972</p>
    <p>Genre: Crime, Drama</p>
    <p>Director: Francis Ford Coppola</p>
    <p>Stars: Marlon Brando, Al Pacino</p>', 1),
    ('Pulp Fiction 2', '<p>Release Year: 1994</p>
    <p>Genre: Crime, Drama</p>
    <p>Director: Quentin Tarantino</p>
    <p>Stars: John Travolta, Uma Thurman</p>', 1),
    ('The Dark Knight 2', '<p>Release Year: 2008</p>
    <p>Genre: Action, Crime, Drama</p>
    <p>Director: Christopher Nolan</p>
    <p>Stars: Christian Bale, Heath Ledger</p>', 1),
    ('Inception 2', '<p>Release Year: 2010</p>
    <p>Genre: Action, Adventure, Sci-Fi</p>
    <p>Director: Christopher Nolan</p>
    <p>Stars: Leonardo DiCaprio, Joseph Gordon-Levitt</p>', 1),
    ('Fight Club 2', '<p>Release Year: 1999</p>
    <p>Genre: Drama</p>
    <p>Director: David Fincher</p>
    <p>Stars: Brad Pitt, Edward Norton</p>', 1),
    ('The Matrix 2', '<p>Release Year: 1999</p>
    <p>Genre: Action, Sci-Fi</p>
    <p>Directors: Lana Wachowski, Lilly Wachowski</p>
    <p>Stars: Keanu Reeves, Laurence Fishburne</p>', 1),
    ('Forrest Gump 2', '<p>Release Year: 1994</p>
    <p>Genre: Drama, Romance</p>
    <p>Director: Robert Zemeckis</p>
    <p>Stars: Tom Hanks, Robin Wright</p>', 1),
    ('The Lion King 2', '<p>Release Year: 1994</p>
    <p>Genre: Animation, Adventure, Drama</p>
    <p>Directors: Roger Allers, Rob Minkoff</p>
    <p>Stars: Matthew Broderick, Jeremy Irons</p>', 1);





CREATE TABLE CINEMA_ROOM(
    cinema_rm_ID INT (30) NOT NULL AUTO_INCREMENT,
    cinema_rm_number INT NOT NULL,
    cinema_seat_list INT (100) NOT NULL,
    cinema_screening VARCHAR(30) NOT NULL,
    cinema_date DATE NOT NULL,
    cinema_time_slot TIME NOT NULL,
    CONSTRAINT CINEMA_ROOM_PKEY PRIMARY KEY(cinema_rm_ID)
);

INSERT INTO CINEMA_ROOM(cinema_rm_number, cinema_seat_list, cinema_screening, cinema_date, cinema_time_slot)  
VALUES 
('1', '100', 'Sashank TDG2', '2023-05-23', '20:00:00'),
('3', '100', 'Sashank The Joker', '2023-05-24', '13:00:00'),
('5', '100', 'Sashank Prison Break', '2023-05-25', '12:00:00'),
('8', '100', 'Sashank New Horror Movie', '2023-05-26', '17:00:00'),
('7', '100', 'Sashank TDG', '2023-05-27', '15:00:00'),
('2', '100', 'America Pie', '2023-05-28', '22:00:00'),
('6', '100', 'Sashank Prison Break', '2023-05-29', '14:00:00'),
('4', '100', 'Sashank Prison Break', '2023-05-30', '19:00:00'),
('9', '100', 'Sashank Prison Break', '2023-05-31', '18:00:00'),
('1', '100', 'Sashank TDG', '2023-05-23', '21:00:00'),
('3', '100', 'Sashank TDG2', '2023-05-24', '14:00:00'),
('5', '100', 'Sashank New Horror Movie', '2023-05-25', '13:00:00'),
('8', '100', 'Sashank The Joker', '2023-05-26', '18:00:00'),
('7', '100', 'America Pie', '2023-05-27', '16:00:00'),
('2', '100', 'Sashank Prison Break', '2023-05-28', '23:00:00'),
('6', '100', 'Sashank TDG', '2023-05-29', '15:00:00'),
('4', '100', 'Sashank TDG2', '2023-05-30', '20:00:00'),
('9', '100', 'Sashank New Horror Movie', '2023-05-31', '19:00:00'),
('1', '100', 'Sashank The Joker', '2023-05-23', '22:00:00'),
('3', '100', 'America Pie', '2023-05-24', '15:00:00'),
('5', '100', 'Sashank TDG', '2023-05-25', '14:00:00'),
('8', '100', 'Sashank TDG2', '2023-05-26', '19:00:00'),
('7', '100', 'Sashank Prison Break', '2023-05-27', '17:00:00'),
('2', '100', 'Sashank Prison Break', '2023-05-28', '00:00:00'),
('6', '100', 'Sashank New Horror Movie', '2023-05-29', '16:00:00'),
('4', '100', 'Sashank The Joker', '2023-05-30', '21:00:00'),
('9', '100', 'America Pie', '2023-05-31', '20:00:00'),
('1', '100', 'Sashank TDG', '2023-05-23', '23:00:00'),
('3', '100', 'Sashank TDG2', '2023-05-24', '16:00:00'),
('5', '100', 'Sashank Prison Break', '2023-05-25', '15:00:00'),
('8', '100', 'Sashank New Horror Movie', '2023-05-26', '20:00:00'),
('7', '100', 'Sashank TDG', '2023-05-27', '18:00:00'),
('2', '100', 'America Pie', '2023-05-28', '01:00:00'),
('6', '100', 'Sashank Prison Break', '2023-05-29', '17:00:00'),
('4', '100', 'Sashank Prison Break', '2023-05-30', '22:00:00'),
('9', '100', 'Sashank Prison Break', '2023-05-31', '21:00:00'),
('1', '100', 'Sashank TDG2', '2023-05-23', '00:00:00'),
('3', '100', 'Sashank The Joker', '2023-05-24', '17:00:00'),
('5', '100', 'Sashank Prison Break', '2023-05-25', '16:00:00'),
('8', '100', 'Sashank New Horror Movie', '2023-05-26', '21:00:00'),
('7', '100', 'America Pie', '2023-05-27', '19:00:00'),
('2', '100', 'Sashank Prison Break', '2023-05-28', '02:00:00'),
('6', '100', 'Sashank TDG', '2023-05-29', '18:00:00'),
('4', '100', 'Sashank TDG2', '2023-05-30', '23:00:00'),
('9', '100', 'Sashank New Horror Movie', '2023-05-31', '22:00:00'),
('1', '100', 'Sashank The Joker', '2023-05-23', '01:00:00'),
('3', '100', 'America Pie', '2023-05-24', '18:00:00'),
('5', '100', 'Sashank TDG', '2023-05-25', '17:00:00'),
('8', '100', 'Sashank TDG2', '2023-05-26', '22:00:00'),
('7', '100', 'Sashank Prison Break', '2023-05-27', '20:00:00'),
('2', '100', 'Sashank Prison Break', '2023-05-28', '03:00:00'),
('6', '100', 'Sashank New Horror Movie', '2023-05-29', '19:00:00'),
('4', '100', 'Sashank The Joker', '2023-05-30', '00:00:00'),
('9', '100', 'America Pie', '2023-05-31', '23:00:00'),
('1', '100', 'Sashank TDG', '2023-05-23', '02:00:00'),
('3', '100', 'Sashank TDG2', '2023-05-24', '19:00:00'),
('5', '100', 'Sashank New Horror Movie', '2023-05-25', '18:00:00'),
('8', '100', 'Sashank The Joker', '2023-05-26', '23:00:00'),
('7', '100', 'America Pie', '2023-05-27', '21:00:00'),
('2', '100', 'Sashank Prison Break', '2023-05-28', '04:00:00'),
('6', '100', 'Sashank TDG', '2023-05-29', '20:00:00'),
('4', '100', 'Sashank Prison Break', '2023-05-30', '01:00:00'),
('9', '100', 'Sashank Prison Break', '2023-05-31', '00:00:00'),
('1', '100', 'Sashank Prison Break', '2023-05-23', '03:00:00'),
('3', '100', 'Sashank TDG2', '2023-05-24', '20:00:00'),
('5', '100', 'Sashank Prison Break', '2023-05-25', '19:00:00'),
('8', '100', 'Sashank New Horror Movie', '2023-05-26', '00:00:00'),
('7', '100', 'Sashank TDG', '2023-05-27', '22:00:00'),
('2', '100', 'America Pie', '2023-05-28', '05:00:00'),
('6', '100', 'Sashank Prison Break', '2023-05-29', '21:00:00'),
('4', '100', 'Sashank Prison Break', '2023-05-30', '02:00:00'),
('9', '100', 'Sashank Prison Break', '2023-05-31', '01:00:00'),
('1', '100', 'Sashank TDG', '2023-05-23', '04:00:00'),
('3', '100', 'Sashank TDG2', '2023-05-24', '21:00:00'),
('5', '100', 'Sashank New Horror Movie', '2023-05-25', '20:00:00'),
('8', '100', 'Sashank The Joker', '2023-05-26', '01:00:00'),
('7', '100', 'America Pie', '2023-05-27', '23:00:00'),
('2', '100', 'Sashank Prison Break', '2023-05-28', '06:00:00'),
('6', '100', 'Sashank TDG', '2023-05-29', '22:00:00'),
('4', '100', 'Sashank The Joker', '2023-05-30', '03:00:00'),
('9', '100', 'America Pie', '2023-05-31', '02:00:00'),
('1', '100', 'Sashank Prison Break', '2023-05-23', '05:00:00'),
('3', '100', 'Sashank TDG2', '2023-05-24', '22:00:00'),
('5', '100', 'Sashank Prison Break', '2023-05-25', '21:00:00'),
('8', '100', 'Sashank New Horror Movie', '2023-05-26', '02:00:00'),
('7', '100', 'Sashank TDG', '2023-05-27', '00:00:00'),
('2', '100', 'America Pie', '2023-05-28', '07:00:00'),
('6', '100', 'Sashank Prison Break', '2023-05-29', '23:00:00'),
('4', '100', 'Sashank Prison Break', '2023-05-30', '04:00:00'),
('9', '100', 'Sashank Prison Break', '2023-05-31', '03:00:00'),
('1', '100', 'Sashank TDG', '2023-05-23', '06:00:00'),
('3', '100', 'Sashank TDG2', '2023-05-24', '23:00:00'),
('5', '100', 'Sashank New Horror Movie', '2023-05-25', '22:00:00'),
('8', '100', 'Sashank The Joker', '2023-05-26', '03:00:00'),
('7', '100', 'America Pie', '2023-05-27', '01:00:00'),
('2', '100', 'Sashank Prison Break', '2023-05-28', '08:00:00'),
('6', '100', 'Sashank TDG', '2023-05-29', '00:00:00'),
('4', '100', 'Sashank The Joker', '2023-05-30', '05:00:00'),
('9', '100', 'America Pie', '2023-05-31', '04:00:00'),
('1', '100', 'Sashank Prison Break', '2023-05-23', '07:00:00'),
('3', '100', 'Sashank TDG2', '2023-05-24', '00:00:00'),
('5', '100', 'Sashank Prison Break', '2023-05-25', '23:00:00'),
('8', '100', 'Sashank New Horror Movie', '2023-05-26', '04:00:00'),
('7', '100', 'Sashank TDG', '2023-05-27', '02:00:00'),
('2', '100', 'America Pie', '2023-05-28', '09:00:00'),
('6', '100', 'Sashank Prison Break', '2023-05-29', '01:00:00'),
('4', '100', 'Sashank Prison Break', '2023-05-30', '06:00:00'),
('9', '100', 'Sashank Prison Break', '2023-05-31', '05:00:00'),
('1', '100', 'Sashank TDG', '2023-05-23', '08:00:00'),
('3', '100', 'Sashank TDG2', '2023-05-24', '01:00:00'),
('5', '100', 'Sashank New Horror Movie', '2023-05-25', '00:00:00'),
('8', '100', 'Sashank The Joker', '2023-05-26', '05:00:00'),
('7', '100', 'America Pie', '2023-05-27', '03:00:00'),
('2', '100', 'Sashank Prison Break', '2023-05-28', '10:00:00'),
('6', '100', 'Sashank TDG', '2023-05-29', '02:00:00'),
('4', '100', 'Sashank The Joker', '2023-05-30', '07:00:00'),
('9', '100', 'America Pie', '2023-05-31', '06:00:00'),
('1', '100', 'Sashank Prison Break', '2023-05-23', '09:00:00'),
('3', '100', 'Sashank TDG2', '2023-05-24', '02:00:00'),
('5', '100', 'Sashank Prison Break', '2023-05-25', '01:00:00'),
('8', '100', 'Sashank New Horror Movie', '2023-05-26', '06:00:00'),
('7', '100', 'Sashank TDG', '2023-05-27', '04:00:00'),
('2', '100', 'America Pie', '2023-05-28', '11:00:00'),
('6', '100', 'Sashank Prison Break', '2023-05-29', '03:00:00'),
('4', '100', 'Sashank Prison Break', '2023-05-30', '08:00:00'),
('9', '100', 'Sashank Prison Break', '2023-05-31', '07:00:00');

CREATE TABLE CINEMA_SEAT(
    seatID INT (30) NOT NULL AUTO_INCREMENT,
    seatAvailability BOOLEAN NOT NULL,
    cinema_rm_ID INT (30) NOT NULL,
    CONSTRAINT CINEMA_SEAT_PKEY PRIMARY KEY(seatID),
    CONSTRAINT CINEMA_SEAT_FKEY FOREIGN KEY(cinema_rm_ID) REFERENCES CINEMA_ROOM(cinema_rm_ID)
);
INSERT INTO CINEMA_SEAT(seatAvailability, cinema_rm_ID) 
VALUES
    ('1', '1'),
    ('1', '1'),
    ('1', '1'),
    ('1', '1'),
    ('1', '1'),
    ('1', '1'),
    ('1', '1'),
    ('1', '1'),
    ('1', '1'),
    ('1', '1'),

    ('1', '2'),
    ('1', '2'),
    ('1', '2'),
    ('1', '2'),
    ('1', '2'),
    ('1', '2'),
    ('1', '2'),
    ('1', '2'),
    ('1', '2'),
    ('1', '2'),

    ('1', '3'),
    ('1', '3'),
    ('1', '3'),
    ('1', '3'),
    ('1', '3'),
    ('1', '3'),
    ('1', '3'),
    ('1', '3'),
    ('1', '3'),
    ('1', '3'),

    ('1', '4'),
    ('1', '4'),
    ('1', '4'),
    ('1', '4'),
    ('1', '4'),
    ('1', '4'),
    ('1', '4'),
    ('1', '4'),
    ('1', '4'),
    ('1', '4');

CREATE TABLE TICKET(
    ticketID INT (30) NOT NULL AUTO_INCREMENT,
    ticketType VARCHAR (30) NOT NULL,
    loyalty_pts INT(11) NOT NULL,
    ticket_price DECIMAL (20,4) NOT NULL,
    CONSTRAINT TICKET_PKEY PRIMARY KEY(ticketID),
    CONSTRAINT TICKET_CKEY UNIQUE(ticketType)
);
INSERT INTO TICKET(ticketType, loyalty_pts,ticket_price) 
VALUES 
    ('Adults', '12', '12'),
    ('Students', '8', '8'),
    ('Senior Citizen', '6', '6');

CREATE TABLE FNB(
    fnbID INT (30) NOT NULL AUTO_INCREMENT,
    fnbName VARCHAR (999) NOT NULL,
    fnb_availability BOOLEAN NOT NULL,
    fnb_loyalty_pt INT(11) NOT NULL,
    fnb_price DECIMAL (20,4) NOT NULL,
    CONSTRAINT FNB_PKEY PRIMARY KEY(fnbID),
    CONSTRAINT FNB_CKEY UNIQUE(fnbName)
);
INSERT INTO `fnb`(`fnbID`, `fnbName`, `fnb_availability`, `fnb_loyalty_pt`, `fnb_price`) VALUES
('1', 'Popcorn', '1', '0', '10'),
('2', 'Soda', '1', '0', '3'),
('3', 'Hot Dog', '1', '0', '14'),
('4', 'Nachos', '1', '0', '6'),
('5', 'Ice Cream', '1', '0', '22'),
('6', 'Candy', '1', '0', '17'),
('7', 'Pretzel', '1', '0', '8'),
('8', 'Pizza', '1', '0', '11'),
('9', 'Chips', '1', '0', '5'),
('10', 'Cotton Candy', '1', '0', '19'),
('11', 'Burger', '1', '0', '12'),
('12', 'Sushi', '1', '0', '1'),
('13', 'Milkshake', '1', '0', '20'),
('14', 'Donut', '1', '0', '7'),
('15', 'Taco', '1', '0', '24'),
('16', 'Smoothie', '1', '0', '15'),
('17', 'Fries', '1', '0', '2'),
('18', 'Hot Chocolate', '1', '0', '16'),
('19', 'Chicken Wings', '1', '0', '21'),
('20', 'Noodles', '1', '0', '25'),
('21', 'Popcorn Chicken', '1', '0', '9'),
('22', 'Lemonade', '1', '0', '4'),
('23', 'Steak', '1', '0', '18'),
('24', 'Burrito', '1', '0', '13'),
('25', 'Frozen Yogurt', '1', '0', '23'),
('26', 'Cupcake', '1', '0', '10'),
('27', 'Root Beer', '1', '0', '3'),
('28', 'Hot Pretzel', '1', '0', '14'),
('29', 'Cheeseburger', '1', '0', '6'),
('30', 'Gelato', '1', '0', '22'),
('31', 'Caramel Apple', '1', '0', '17'),
('32', 'Soft Pretzel', '1', '0', '8'),
('33', 'Pepperoni Pizza', '1', '0', '11'),
('34', 'Tortilla Chips', '1', '0', '5'),
('35', 'Cotton Candy Ice Cream', '1', '0', '19'),
('36', 'Chicken Sandwich', '1', '0', '12'),
('37', 'Iced Coffee', '1', '0', '1'),
('38', 'Smoothie Bowl', '1', '0', '20'),
('39', 'Bagel', '1', '0', '7'),
('40', 'Fish Tacos', '1', '0', '24'),
('41', 'Mango Smoothie', '1', '0', '15'),
('42', 'Onion Rings', '1', '0', '2'),
('43', 'Hot Cocoa', '1', '0', '16'),
('44', 'BBQ Wings', '1', '0', '21'),
('45', 'Pad Thai', '1', '0', '25'),
('46', 'Chicken Nuggets', '1', '0', '9'),
('47', 'Iced Tea', '1', '0', '4'),
('48', 'Grilled Cheese Sandwich', '1', '0', '18'),
('49', 'Taco Salad', '1', '0', '13'),
('50', 'Sorbeto', '1', '0', '23'),
('51', 'Mac and Cheese', '1', '0', '10'),
('52', 'Lemon Lime Soda', '1', '0', '3'),
('53', 'Pretzel Bites', '1', '0', '14'),
('54', 'Veggie Burger', '1', '0', '6'),
('55', 'Yogurt Parfait', '1', '0', '22'),
('56', 'Chocolate Bar', '1', '0', '17'),
('57', 'Garlic Knots', '1', '0', '8'),
('58', 'Margherita Pizza', '1', '0', '11'),
('59', 'Potato Chips', '1', '0', '5'),
('60', 'Mint Chocolate Chip Ice Cream', '1', '0', '19'),
('61', 'Turkey Burger', '1', '0', '12'),
('62', 'Iced Latte', '1', '0', '1'),
('63', 'Acai Bowl', '1', '0', '20'),
('64', 'Croissant', '1', '0', '7'),
('65', 'Shrimp Tacos', '1', '0', '24'),
('66', 'Strawberry Banana Smoothie', '1', '0', '15'),
('67', 'French Fries', '1', '0', '2'),
('68', 'Mocha', '1', '0', '16'),
('69', 'Buffalo Wings', '1', '0', '21'),
('70', 'Ramen', '1', '0', '25'),
('71', 'Chicken Quesadilla', '1', '0', '9'),
('72', 'Arnold Palmer', '1', '0', '4'),
('73', 'Sushi Roll', '1', '0', '18'),
('74', 'Enchiladas', '1', '0', '13'),
('75', 'Milk Tea', '1', '0', '23'),
('76', 'Brownie', '1', '0', '10'),
('77', 'Ginger Ale', '1', '0', '3'),
('78', 'Soft Pretzel Sticks', '1', '0', '14'),
('79', 'Veggie Pizza', '1', '0', '6'),
('80', 'Sorbet', '1', '0', '22'),
('81', 'Caramel Popcorn', '1', '0', '17'),
('82', 'Cheesy Pretzel', '1', '0', '8'),
('83', 'BBQ Pizza', '1', '0', '11'),
('84', 'Tortilla Chips with Salsa', '1', '0', '5'),
('85', 'Cookies and Cream Ice Cream', '1', '0', '19'),
('86', 'Chicken Wrap', '1', '0', '12'),
('87', 'Cappuccino', '1', '0', '1'),
('88', 'Fruit Salad', '1', '0', '20'),
('89', 'Croissant Sandwich', '1', '0', '7'),
('90', 'Fish and Chips', '1', '0', '24'),
('91', 'Pineapple Smoothie', '1', '0', '15'),
('92', 'Sweet Potato Fries', '1', '0', '2'),
('93', 'Espresso', '1', '0', '16'),
('94', 'Honey BBQ Wings', '1', '0', '21'),
('95', 'Pho', '1', '0', '25'),
('96', 'Chicken Tenders', '1', '0', '9'),
('97', 'Iced Lemonade', '1', '0', '4'),
('98', 'Cajun Fries', '1', '0', '18'),
('99', 'Chimichanga', '1', '0', '13'),
('100', 'Frozen Lemonade', '1', '0', '23');

CREATE TABLE BOOK_TICKET(
    book_ticketID INT (30) NOT NULL AUTO_INCREMENT,
    no_of_ticket_booked INT(11) NOT NULL,
    movie_name_booked VARCHAR (999) NOT NULL,
    ticket_type VARCHAR (30) NOT NULL,
    ticketPricePaid DECIMAL (20,4) NOT NULL,
    movie_ID INT (30) NOT NULL,
    movie_screening_date DATE NOT NULL,
    movie_screening_time TIME (6) NOT NULL,
    cinema_rm_number INT NOT NULL,
    seatID VARCHAR (30) NOT NULL,
    bookBy VARCHAR(30) NOT NULL,
    CONSTRAINT BOOK_TICKET_PKEY PRIMARY KEY(book_ticketID),
    CONSTRAINT BOOK_TICKET_FKEY FOREIGN KEY(ticket_type) REFERENCES TICKET(ticketType),
    CONSTRAINT BOOK_TICKET_FKEY2 FOREIGN KEY(movie_ID) REFERENCES MOVIE(movieID)
    -- CONSTRAINT BOOK_TICKET_FKEY3 FOREIGN KEY(cinema_rm_number) REFERENCES CINEMA_ROOM(cinema_rm_number)
    /*CONSTRAINT BOOK_TICKET_FKEY4 FOREIGN KEY(seatID) REFERENCES CINEMA_SEAT(seatID)*/
);
INSERT INTO BOOK_TICKET(no_of_ticket_booked, movie_name_booked, ticket_type, ticketPricePaid, movie_ID, movie_screening_date, movie_screening_time, cinema_rm_number, seatID, bookBy) 
VALUES 
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-05-04', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-05-06', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-05-08', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-05-10', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-06-04', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-06-07', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-06-09', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-06-21', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-07-04', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-07-05', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-07-06', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-07-07', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-08-22', '17:00:00', '1', '6', 'wxc'),
    ('1', 'Sashank Prison Break', 'Adults', '12', '1', '2023-09-30', '17:00:00', '1', '6', 'wxc');


CREATE TABLE BOOK_FNB(
    book_fbID INT (30) NOT NULL AUTO_INCREMENT,
    fbName VARCHAR (999) NOT NULL,
    fbCost DECIMAL (20,4) NOT NULL,
    fbLoyalty_Pts INT(11) NOT NULL,
    fnb_movie_screening_date DATE NOT NULL,
    fbBookBy VARCHAR (999) NOT NULL,
    CONSTRAINT BOOK_FNB_PKEY PRIMARY KEY(book_fbID)
);
INSERT INTO BOOK_FNB(fbName, fbCost, fbLoyalty_Pts, fnb_movie_screening_date, fbBookBy) 
VALUES 
    ('Popcorn', '12', '12', '2023-05-04', 'wxc'),
    ('Popcorn', '12', '12', '2023-05-06', 'wxc'),
    ('Popcorn', '12', '12', '2023-05-08', 'wxc'),
    ('Popcorn', '12', '12', '2023-05-10', 'wxc'),
    ('Popcorn', '12', '12', '2023-06-04', 'wxc'),
    ('Popcorn', '12', '12', '2023-06-07', 'wxc'),
    ('Popcorn', '12', '12', '2023-06-09', 'wxc'),
    ('Popcorn', '12', '12', '2023-06-21', 'wxc'),
    ('Popcorn', '12', '12', '2023-07-04', 'wxc'),
    ('Popcorn', '12', '12', '2023-07-05', 'wxc'),
    ('Popcorn', '12', '12', '2023-07-06', 'wxc'),
    ('Popcorn', '12', '12', '2023-07-07', 'wxc'),
    ('Popcorn', '12', '12', '2023-08-22', 'wxc'),
    ('Popcorn', '12', '12', '2023-09-30', 'wxc');


CREATE TABLE PURCHASE( /*can delete???? Don't feel its needed*/
    purchaseID INT (30) NOT NULL AUTO_INCREMENT,
    book_ticketID INT (30) NOT NULL,
    book_fbID INT (30) NOT NULL,
    CONSTRAINT PURCHASE_PKEY PRIMARY KEY(purchaseID),
    CONSTRAINT PURCHASE_FKEY FOREIGN KEY(book_ticketID) REFERENCES BOOK_TICKET(book_ticketID),
    CONSTRAINT PURCHASE_FKEY2 FOREIGN KEY(book_fbID) REFERENCES BOOK_FNB(book_fbID)
);

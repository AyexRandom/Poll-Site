<?php



//start the database session

session_start();

//unique user id that allows for different users

  $_SESSION['user_id'] = 10;

//required information to connect to database

$db = new PDO ('mysql:host=localhost; dbname=poll', 'root', 'root');




		


?>





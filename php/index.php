<?php

//the connection to data base
require_once 'init.php';


//query to retrieve the id and question from the polls table
$pollsQuery = $db->query("
	SELECT id, question
	FROM polls
	"
	);


//fetching the information
while($row = $pollsQuery->fetchObject()) {
	$polls[] = $row;
}







?>

<!-- seperate html form that is used for creating the navbar -->
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Homepage</title>
	  
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">

	 <!-- required references for the visuals -->
	  <link href="css.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
  
	</head>

	<body>
	
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">

				<!-- nav bar that holds homepage and addpoll -->
				  <a href='poll.php' class="navbar-brand">Homepage</a>
				   <a href='insertquestions.php' class="navbar-brand">Add a poll</a>
  
				</div>
			
			</div>
		</nav>

	</body>
</html>






<!-- seperate html form used to display the questions  -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>

		<!-- required references -->
		<link rel="stylesheet"  href="css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">

	</head>
	<body>

	<!-- only works if the info is there-->
		<?php if (!empty($polls)): ?>
			<ul>

			<!-- loop that is looping all the questions onto the page -->
			<font size="8" color="black"><b>Polls<b></font>
			<p></p>
				<?php foreach($polls as $poll): ?>
					<label></label>
						<li><a class="btn btn-primary" href="poll.php?poll=<?php  echo $poll->id; ?>"><?php echo $poll->question; ?></a></li>
				<?php endforeach; ?>

			</ul>

<!-- else there are no polls -->
		<?php else: ?>
				<p>Sorry, no polls available right now. </p>
		<?php endif; ?>


	</body>
</html>


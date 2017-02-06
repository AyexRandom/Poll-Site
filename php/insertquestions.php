<?php

//data base connection
require_once 'init.php';


	if(isset($_POST['submit2']))
{

// insert user input into username in user table
//$db = new PDO ('mysql:host=localhost; dbname=poll', 'root', 'root');


//query for inserting the id, question into polls
$questionQuery = $db->prepare("
		INSERT INTO polls (id, question)
		VALUES ('$_POST[poll]', '$_POST[question]')
		
		");

//execute it
$questionQuery->execute([
	'poll' => $_POST['poll'],
	'question' => $_POST['question'],
		
		]);

	}




?>

<!-- same html form for nav bar -->

<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Homepage</title>
	  
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link href="css.css" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  
	</head>

	<body>
	
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
				  <a href='poll.php' class="navbar-brand">Homepage</a>
				   <a href='insertanswers.php' class="navbar-brand">Add a choices</a>
				</div>
			
			</div>
		</nav>

	</body>
</html>



</form>

<!-- buttons used for sending info to the query -->
<form action = "" method="POST">
<input type= "int" name= "poll" value="Poll number here" />

<label>Question: (Remember your poll number!)</label>
						<input type="text" ng-model="question" name="question" value="Type question here"class="form-control input-lg"><hr size=10>
					</div>
<input  class="btn btn-primary btn-block" name ="submit2" type="submit" id = "submit" value="Add Question" />

</form>


<br/>


			

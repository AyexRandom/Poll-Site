
<?php


require_once 'init.php';

if(isset($_POST['submit3']))
{

// insert user input into username in user table
//$db = new PDO ('mysql:host=localhost; dbname=poll', 'root', 'root');


//query for sending the user input to data base
$answersQuery = $db->prepare("
		INSERT INTO polls_choices (poll, name )
		VALUES ('$_POST[poll]','$_POST[answer]' )

		");

//send the info
$answersQuery->execute([
	'poll' => $_POST['poll'],
			'answer' => $_POST['answer']
			
			
		]);

}

?>


<!-- same form used across all pages for the navbar -->
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
				   <a href='insertquestions.php' class="navbar-brand">Add a poll</a>
				</div>
			
			</div>
		</nav>

	</body>
</html>


<!-- the submit button that sends the infomation to $_post and sends to database -->

<form action = "" method="POST">
<input type= "int" name="poll" value="Poll number here" />


<label>Choices: (Poll number must be the same number used while creating your poll!)</label>
						<input type="text" ng-model="question" name="answer" value="Choice here"class="form-control input-lg"><hr size=10>
					</div>
<input  class="btn btn-primary btn-block" name ="submit3" type="submit" id = "submit" value="Add Choice" />


</form>


			

<br/>


			

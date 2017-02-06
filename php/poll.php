<?php

// database connection
require_once 'init.php';

//required classes
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_pie.php');


// if there is no info redirect to index page
if (!isset($_GET['poll'])) {
	header('Location: index.php');	
} else {

	$id = (int)$_GET['poll'];

	// Get general poll info
	$pollQuery = $db->prepare("
		SELECT id, question
		FROM polls
		WHERE id = :poll
		
		");

	//execute the pollsquery query
	$pollQuery->execute([
			'poll' => $id
		]);

	//set poll to the info from pollsquery
	$poll = $pollQuery->fetchObject();

	//Get the user answer for this poll
	$answerQuery = $db->prepare("
		SELECT polls_choices.id AS choice_id, polls_choices.name AS choice_name
		FROM polls_answers
		JOIN polls_choices
		ON polls_answers.choice = polls_choices.id
		WHERE polls_answers.user = :user
		AND polls_answers.poll = :poll
		");

	//execute the query
	$answerQuery->execute([
		'user' => $_SESSION['user_id'],
		'poll' => $id
		]);

	//Has the user competed the poll?
	$completed = $answerQuery->rowCount() ? true : false;

	//echo '<pre>', print_r($answerQuery->fetchObject()), '</pre>';


	//show the percentage of votes if user has already completed
	if ($completed) {
		//Get all answers
		$answersQuery = $db->prepare("
			SELECT 
			polls_choices.name,
			COUNT(polls_answers.id) * 100 / (
				SELECT COUNT(*)
				FROM polls_answers
				WHERE polls_answers.poll = :poll) AS percentage
			FROM polls_choices
			LEFT JOIN polls_answers
			ON polls_choices.id = polls_answers.choice
			WHERE polls_choices.poll = :poll
			GROUP BY polls_choices.id

			");

			$answersQuery->execute([
				'poll' => $id
			]);

			//extract answers
			while ($row = $answersQuery->fetchObject()) {
				$answers[] = $row;
			}

			// Create the Pie Graph. 

} 








	//Get poll choices
$choicesQuery = $db->prepare("
	SELECT polls.id, polls_choices.id AS choice_id, polls_choices.name
	FROM polls
	JOIN polls_choices
	ON polls.id = polls_choices.poll
	WHERE polls.id = :poll
	
	");

//execute the query
$choicesQuery-> execute([
	'poll' => $id
	]);

	//extract the choices
	while ($row = $choicesQuery->fetchObject()) {
		$choices[] = $row;
		
	}

	//echo '<pre>', print_r($choices), '</pre>';


	//echo '<pre>', print_r($polls), '</pre>';
}





?>

















<!-- seperate html form for the navbar -->

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

				<!-- navbar for homepage and viewchart -->
				  <a href='poll.php' class="navbar-brand">Homepage</a>
				  <a href='chart.php' class="navbar-brand">View Chart</a>
				</div>
			
			</div>
		</nav>

	</body>
</html>





<!-- seperate html form displaying the question and percentages -->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>

		<link rel="stylesheet" href="main.css">
	</head>
	<body>

<!-- if no poll info than it does not exist and display that it doesnt -->
		<?php if(!$poll): ?>
			<p> That poll does not exist</p>
		<?php else: ?>

		<div class="poll">
			<div class="poll-question">
			<!-- display the question -->
				<?php echo $poll->question; ?>
			</div>

<!-- display percentage if the poll has already been completed by the user -->
			<?php if ($completed): ?> 
				<p> You have completed the poll, Thanks! </p>

				<ul>
				<?php foreach($answers as $answer): ?>

					<!-- loop the answers and the percentages onto the page -->
						<li><?php echo $answer->name; ?> (<?php echo number_format($answer->percentage, 2); ?>%)</li>
				<?php endforeach; ?>
				</ul>

			<?php else: ?>

			<!-- another form that displays the choices else displays there are none-->
			<?php if(!empty($choices)): ?>
			<form action="vote.php" method="post">
				<div class="poll-options">

				<!-- loop for the choices info -->
					<?php foreach($choices as $index => $choice): ?>
					<div class="poll-options">

					<!-- creating radio buttons for each choice -->
						<input type="radio" name="choice" value="<?php echo $choice->choice_id?>" id="c<?php echo $index; ?>">

						<!-- display the choice -->
						<label for="c<?php echo $index; ?>"><?php echo $choice-> name; ?></label>
					</div>

			<!-- end loop -->
					<?php endforeach; ?>
				

				</div>
		<!-- submit answer button -->
				<input class="btn btn-primary" type="submit" value="submit answer">
				<input type="hidden" name="poll" value="<?php echo $id; ?>">

			</form>
			<!-- else display that there are no choices -->
		<?php else: ?>
			<p> There are no choices right now. </p>
		<?php endif; ?>

		<?php endif; ?>

		</div>
<?php endif; ?>
	</body>
</html>



<?php


// the connection to data base
require_once 'init.php';

//if the poll and choice table isset or has info in them continue
if(isset($_POST['poll'], $_POST['choice'])) {

	$poll = $_POST['poll'];
	$choice = $_POST['choice'];


//query that prepares the user, poll and choice info to be inserted into polls_answers
	$voteQuery = $db->prepare("
		INSERT INTO polls_answers (user, poll, choice)
		SELECT :user, :poll, :choice
		FROM polls
		WHERE EXISTS (
			SELECT id
			FROM polls
			WHERE id = :poll)
			

		AND EXISTS (
			SELECT id
			FROM polls_choices
			WHERE id = :choice
			AND poll = :poll)
		AND NOT EXISTS (
			SELECT id
			FROM polls_answers
			WHERE user = :user
			AND poll = :poll)
		LIMIT 1

		");

// execute the query 
	$voteQuery->execute([
			'user' => $_SESSION['user_id'],
			'poll' => $poll,
			'choice' => $choice
		]);

		header('Location: poll.php?poll=' . $poll);
		exit();
}

//redirect
header('Location: index.php');

?>


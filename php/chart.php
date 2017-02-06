<?php

//required classes
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_pie.php');








// Connect to the database server
$db = mysql_connect("localhost",'root','root');
if (!$db) {
  echo( "<P>Database Connection Failed</P>" );
  exit();
}
// Select the database
  if ( !@mysql_select_db(poll) ) {
    echo( "<P>Not connected to Database</P>" );
    exit();
  }



//query that retrieves the poll, choice and gives totalcount of choices
$cell_array = array();
  if ($result = mysql_query("SELECT poll, choice as choice, count(poll) as totalcount FROM polls_answers GROUP BY poll, choice")) 
  {
    if (mysql_num_rows($result)) 
    {
      while ($row = mysql_fetch_assoc($result)) 
      {
        $cell_array[$row["choice"]] = $row['totalcount'];

      }
    }
  }




//querys that give the individual counts for each choice
$sqlpoll1 = "SELECT count(*) AS Number FROM polls_answers where poll = 1 and choice = 1";
$sqlpoll2 = "SELECT count(*) AS Number FROM polls_answers where poll = 1 and choice = 2";
$sqlpoll3 = "SELECT count(*) AS Number FROM polls_answers where poll = 1 and choice = 3";
$sqlpoll4 = "SELECT count(*) AS Number FROM polls_answers where poll = 1 and choice = 4";
$sqlpoll5 = "SELECT count(*) AS Number FROM polls_answers where poll = 1 and choice = 5";

//storing the info retrieved
$poll1 = mysql_query($sqlpoll1);
$poll2 = mysql_query($sqlpoll2);
$poll3 = mysql_query($sqlpoll3);
$poll4 = mysql_query($sqlpoll4);
$poll5 = mysql_query($sqlpoll5);


// fetches the information to be displayed
while($resultpoll1 = mysql_fetch_array($poll1))
{
  $poll1Value = $resultpoll1['Number'];
}

while($resultpoll2 = mysql_fetch_array($poll2))
{
  $poll2Value = $resultpoll2['Number'];
}

while($resultpoll3 = mysql_fetch_array($poll3))
{
  $poll3Value = $resultpoll3['Number'];
}

while($resultpoll4 = mysql_fetch_array($poll4))
{
  $poll4Value = $resultpoll4['Number'];
}
while($resultpoll5 = mysql_fetch_array($poll5))
{
  $poll5Value = $resultpoll5['Number'];
}

//querys that give the individual counts for each choice
$sqlpoll6 = "SELECT count(*) AS Number FROM polls_answers where poll = 2 and choice = 6";
$sqlpoll7 = "SELECT count(*) AS Number FROM polls_answers where poll = 2 and choice = 7";
$sqlpoll8 = "SELECT count(*) AS Number FROM polls_answers where poll = 2 and choice = 8";
$sqlpoll9 = "SELECT count(*) AS Number FROM polls_answers where poll = 2 and choice = 9";
$sqlpoll10 = "SELECT count(*) AS Number FROM polls_answers where poll = 2 and choice = 10";

//storing the info retrieved
$poll6 = mysql_query($sqlpoll6);
$poll7 = mysql_query($sqlpoll7);
$poll8 = mysql_query($sqlpoll8);
$poll9 = mysql_query($sqlpoll9);
$poll10 = mysql_query($sqlpoll10);


// fetches the information to be displayed
while($resultpoll6 = mysql_fetch_array($poll6))
{
  $poll6Value = $resultpoll6['Number'];
}

while($resultpoll7 = mysql_fetch_array($poll7))
{
  $poll7Value = $resultpoll7['Number'];
}

while($resultpoll8 = mysql_fetch_array($poll8))
{
  $poll8Value = $resultpoll8['Number'];
}

while($resultpoll9 = mysql_fetch_array($poll9))
{
  $poll9Value = $resultpoll9['Number'];
}
while($resultpoll10 = mysql_fetch_array($poll10))
{
  $poll10Value = $resultpoll10['Number'];
}



// array that holds the desired count values to be stored in the pie graph
$data = array($poll1Value,$poll2Value,$poll3Value,$poll4Value,$poll5Value );
$data2 = array($poll6Value,$poll7Value,$poll8Value,$poll9Value,$poll10Value );

// A new pie graph
$graph = new PieGraph(800,800,'auto');
 
// Don't display the border
$graph->SetFrame(false);
 
// Uncomment this line to add a drop shadow to the border
// $graph->SetShadow();
 
// Setup title
$graph->title->Set("Results");

$graph->title->SetFont(FF_ARIAL,FS_BOLD,18);
$graph->title->SetMargin(8); // Add a little bit more margin from the top
 
// Create the pie plot
$p1 = new PiePlotC($data);
 
// Set size of pie
$p1->SetSize(0.2);
$p1->SetCenter(0.25, 0.3);

// Label font and color setup
$p1->value->SetFont(FF_ARIAL,FS_BOLD,12);
$p1->value->SetColor('white');
 
$p1->value->Show();
 
// Setup the title on the center circle
//$p1->midtitle->Set("Poll 1");
//$p1->midtitle->SetFont(FF_ARIAL,FS_NORMAL,14);
 
// Set color for mid circle
$p1->SetMidColor('yellow');
 
// Use values in the legends values (This is also the default)
$p1->SetLabelType(PIE_VALUE_ABS);
 

// depending on what was specified in the SetLabelType() above.

$p1->SetLabels($data);


//set up legend for pie graph
$legends = array('Choice 1','Choice 2','Choice 3', 'Choice 4',  'Choice 5');
$p1->SetLegends($legends);


 
// Uncomment this line to remove the borders around the slices
// $p1->ShowBorder(false);
 
// Add drop shadow to slices
$p1->SetShadow();
 
// Explode all slices 15 pixels
$p1->ExplodeAll(15);



// Create the pie plot
$p2 = new PiePlotC($data);
 
// Set size of pie
$p2->SetSize(0.2);
$p2->SetCenter(0.75, 0.3);

// Label font and color setup
$p2->value->SetFont(FF_ARIAL,FS_BOLD,12);
$p2->value->SetColor('white');
 
$p2->value->Show();
 
// Setup the title on the center circle
//$p1->midtitle->Set("Poll 1");
//$p1->midtitle->SetFont(FF_ARIAL,FS_NORMAL,14);
 
// Set color for mid circle
$p2->SetMidColor('yellow');
 
// Use values in the legends values (This is also the default)
$p2->SetLabelType(PIE_VALUE_ABS);
 

// depending on what was specified in the SetLabelType() above.

$p2->SetLabels($data2);


//set up legend for pie graph



 
// Uncomment this line to remove the borders around the slices
// $p1->ShowBorder(false);
 
// Add drop shadow to slices
$p2->SetShadow();
 
// Explode all slices 15 pixels
$p2->ExplodeAll(15);
 
// Add plot to pie graph
$graph->Add($p1);
 $graph->Add($p2);
// .. and send the image  to the browser
$graph->Stroke();





?>


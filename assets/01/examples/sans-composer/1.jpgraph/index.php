<?php

// Include needed classes
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');

// Our data
$data = array(78, 22);

// Create the Pie Graph
$graph = new PieGraph(350, 300, 'auto');
$graph->SetShadow();

// Set A title for the plot + disable the border
$graph->title->Set("Percentage of chart which resembles Pac-man");
$graph->SetFrame(false);

// Create the pieplot
$pieplot = new PiePlot($data);
$pieplot->SetCenter(0.5, 0.5);
$pieplot->SetStartAngle(39);
$pieplot->SetLegends(array('Pac-man', 'Not Pac-Man'));

// Add the pieplot to the graph
$graph->Add($pieplot);

// JpGraph Bug: you must first add the pieplot before you can set the colors (?!)
$pieplot->SetSliceColors(array('#FFFF00','#FF0000'));

// Style the Legend
$graph->legend->SetFrameWeight(0);
$graph->legend->Pos(0.5, 0.90, 'center', 'top');
$graph->legend->SetFillColor('white');
$graph->legend->SetColumns(2);

// Display the graph
$graph->Stroke();
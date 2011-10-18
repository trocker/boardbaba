<?php

$dbhandle = mysql_connect("localhost:3306","root","");
mysql_select_db("boardbaba");
$board=filter_var($_POST['board'], FILTER_SANITIZE_STRING);
$canvasData= filter_var($_POST['data'], FILTER_SANITIZE_STRING);

$query_inside = "UPDATE dataURL SET canvasData='$canvasData' WHERE id='$board'";

$execute_query_inside = mysql_query($query_inside);

echo 'added successfully';

mysql_close($dbhandle);

?>

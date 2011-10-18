<?php

//generate a share Id.

include('random_alpha_numeric.php'); $shareId=getRandomString(5);



$dbhandle = mysql_connect("localhost:3306","root","");
mysql_select_db("boardbaba");





$query_inside = "INSERT INTO dataURL (id,canvasData) VALUES  ('$shareId','')";

$execute_query_inside = mysql_query($query_inside);

//forward him to the share.php with the shareId

header( 'Location: share.php?board='.$shareId ) ;


mysql_close($dbhandle);

?>

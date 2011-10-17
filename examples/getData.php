<?php

$dbhandle = mysql_connect("localhost:3306","root","");
mysql_select_db("boardbaba");



$query_inside = "SELECT canvasData FROM dataURL WHERE id='sample'";

$execute_query_inside = mysql_query($query_inside);


		if(mysql_num_rows($execute_query_inside)>0) 
							{
					
				$row = mysql_fetch_array($execute_query_inside);

				echo str_replace(' ','+',$row['canvasData']);

		
	
	
							}



mysql_close($dbhandle);



?>

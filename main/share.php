<?php 
if(isset($_GET['board']))
$shareId=$_GET['board'];

else
{
echo 'for baba\'s-sake, please give us a valid board link! how many times do we need to tell ya!';
exit();
}
?>

<?php


$dbhandle = mysql_connect("localhost:3306","root","");
mysql_select_db("boardbaba");



$board=filter_var($_GET['board'], FILTER_SANITIZE_STRING);
$query_inside = "SELECT * FROM dataURL WHERE id='$board'";

$execute_query_inside = mysql_query($query_inside);


		if(mysql_num_rows($execute_query_inside)>0) 
							{
					
							}

else {
echo 'for baba\'s-sake, please give us a valid board link! how many times do we need to tell ya!';
exit();
}

mysql_close($dbhandle);




?>


<!DOCTYPE html>


<html>


<head>

<meta charset="utf-8" />


<title>Share your Marker Board - BoardBaba.</title>

<!--[if lt IE 9]>


<script type="text/javascript" src="../lib/excanvas.compiled.js">

</script>


<![endif]-->



<script src="../lib/jquery.js"></script>

<script src="../lib/canvasdrawing.js"></script>


<script src="paint.js"></script>

<script> var score="1";

var shareId='<?echo $shareId;?>';
var mouseDown = 0;

function mousingdown() { 
  ++mouseDown;
start=0;
}


function mousingup() {
--mouseDown;
start=1;
getFromServer();
}

function newCanvas(dataURL){
//alert('now altering the new canvas.');
var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");


var imageObj = new Image();
imageObj.onload = function(){
        context.drawImage(this, 0, 0);
    };
 
    imageObj.src = dataURL;

//alert('altering done!');

}


function sendToServer(){

//script to convert the canvas into png and send it to the server.
 var canvas = document.getElementById("canvas");
            var context = canvas.getContext("2d");
 var dataURL = canvas.toDataURL();        

 //   document.getElementById("canvasimg").src = dataURL;

//newCanvas(dataURL);


//----- Enter the dataURL in the database by giving an ajax call to storeData.php

//alert('sending to the server');


$('#dataText').html(dataURL);

$.post('storeData.php','board='+shareId+'&data='+dataURL,function(data){});

//newCanvas(dataURL);

}

function getFromServer(){
//continuous function which pings the server for new updated canvas.

// make ajax call to getData.php and send that data to newCanvas()


$.post('getData.php','board='+shareId,function(data){$('#dataText').html(data);newCanvas(data);if(start){getFromServer();}});




}


var close=1;
var start=1;


$(document).ready(function(){$.post('getData.php','board='+shareId,function(data){$('#dataText').html(data);newCanvas(data);});if(close){getFromServer();close=0;}});


 </script>



<style>


#wrapper {
				width: 950px;
				margin: 0 auto;
			}
			canvas, .controls { 
				border: solid 1px #ccc;
				float: left;
				margin: 2px;
			}
			canvas {
				cursor: crosshair;
			}
			.control {
				clear:left;
				padding: 2px;
			}
			.control * {
				float:left;
				width: 45px;
				height: 25px;
				margin-bottom: 2px;
				cursor: pointer;
				border: solid 1px transparent;
			}
			.control div:last-child { margin-bottom: 0; }
			.control div {
				background-color: #fff;
				text-align: center;
			}
			.control.text { font-size: 14px; }
			div[data-color=white] { border: solid 1px #666; }
			#brush-size { 
				cursor: default;
				border:1px solid black;
				color: black;//#666;
				background-color: transparent;
			}

		.roundbackground{
				
			-moz-border-radius:20px;
				border-radius:20px;
			-webkit-border-radius:20px;
			-o-border-radius:20px;
			color:white;
			font-weight:bold;
			background-color:#4A3339; !important;

	
				}
		canvas {
			border:4px solid black;			
			}


		</style>




</head>




<body onmousemove="">


<div id="wrapper">



		<canvas id="canvas" onmousedown="mousingdown();"onmousemove="if(mouseDown){sendToServer();}" onmouseup="javascript:{mousingup();}" width="940" height="500">
			<p>Your browser doesn't support canvas. We recommend google chrome or firefox!</p>
		</canvas>


<div class="controls">


<div class="control" id="brush-sizes">


<div data-increment="+2" class="roundbackground" style="background-color:#4A3339;">+</div>
				<div data-increment="-2" class="roundbackground" style="background-color:#4A3339;">-</div>
				<div id="brush-size"></div>
			</div>

			<div class="control text" id="brushes">
				<div>marker</div>
				<div>spray</div>
				<div>fill</div>
			</div>

			<div class="control text"  id="clear">
				<div onclick="$.post('storeData.php','board='+shareId+'&data='+'',function(data){});">clear </div>
			</div><span style="font-size:10px;">(double click)</span>
		</div>
		



		<div class="controls">
			<div class="control" id="swatches">
				<div data-color="red"></div>
				<div data-color="green"></div>
				<div data-color="blue"></div>
				<div data-color="black"></div>
				<div data-color="white"></div>
			</div>
		</div>

<div id="sharelink"><span>Board Share Link:</span><input type="text" value="http://www.boardbaba.com/share.php?board=<? echo $shareId;?>" style="width:400px;background:black;color:white;" /></div>


			</div>


</body>
</html>

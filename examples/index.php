<!DOCTYPE html>


<html>


<head>

<meta charset="utf-8" />


<title>canvas</title>

<!--[if lt IE 9]>


<script type="text/javascript" src="../lib/excanvas.compiled.js">

</script>


<![endif]-->



<script src="../lib/jquery.js"></script>

<script src="../lib/canvasdrawing.js"></script>


<script src="paint.js"></script>

<script> var score="1";


var mouseDown = 0;

function mousingdown() { 
  ++mouseDown;
}


function mousingup() {
--mouseDown;
}

function newCanvas(dataURL){
//alert('now altering the new canvas.');
var canvas = document.getElementById("myCanvas");
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

$.post('storeData.php','data='+dataURL,function(data){});

//newCanvas(dataURL);

}

function getFromServer(){
//continuous function which pings the server for new updated canvas.

// make ajax call to getData.php and send that data to newCanvas()


$.post('getData.php',function(data){$('#dataText').html(data);newCanvas(data);getFromServer();});




}


var close=1;


 </script>



<style>


#wrapper {
				width: 580px;
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
				padding: 2px;
			}
			.control div {
				width: 25px;
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
			.control.text { font-size: 12px; }
			div[data-color=white] { border: solid 1px #666; }
			#brush-size { 
				cursor: default;
				color: #666;
				background-color: transparent;
			}
		</style>




</head>




<body>


<div id="wrapper">



<div class="controls">


<div class="control" id="brush-sizes">


<div data-increment="+2">+</div>
				<div data-increment="-2">-</div>
				<div id="brush-size"></div>
			</div>

			<div class="control text" id="brushes">
				<div>marker</div>
				<div>spray</div>
				<div>fill</div>
			</div>

			<div class="control text" id="clear">
				<div>clear</div>
			</div>
		</div>
		
		<canvas id="canvas" onmousedown="mousingdown();"onmousemove="if(mouseDown){sendToServer();}" onmouseup="javascript:{mousingup();if(close){getFromServer();};close=0;}" width="500" height="300">
			<p>Your browser doesn't support canvas</p>
		</canvas>


		<div class="controls">
			<div class="control" id="swatches">
				<div data-color="red"></div>
				<div data-color="green"></div>
				<div data-color="blue"></div>
				<div data-color="black"></div>
				<div data-color="white"></div>
			</div>
		</div>



		<canvas id="myCanvas" width="500" height="300">
			<p>Your browser doesn't support canvas</p>
		</canvas>

<div style="clear:both;border:2px solid black;">
<span onclick="getFromServer();" style="background-color:green;cursor:pointer;"> click here to replicate from database </span>
</div>

<img id="canvasimg" alt="image should be here"/>

<textarea id="dataText" style="width:600px;height:300px;"></textarea>
	</div>


</body>
</html>

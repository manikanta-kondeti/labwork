<?
session_start();
if($_SESSION['check_shp']!=1)
{
	header('Location: index.php');
}
else
{
	?>
		<!DOCTYPE html>
		<html>
		<head>
		<title>Javascript Shapefile Loader</title>
		<script type="text/javascript" src="lib/binaryajax.js"></script>
		<script type="text/javascript" src="src/binarywrapper.js"></script>
		<script type="text/javascript" src="src/shapefile.js"></script>
		<script type="text/javascript" src="src/style.js"> </script>

		<!-- Important Source Files -->
		<script type="text/javascript" src="http://jscolor.com/jscolor/jscolor.js"></script>
		<!--[if IE]><script src="lib/excanvas.js"></script><![endif]-->

		<style type="text/css">
		body {
			background-color: #eee;
			color: #000;
			font: 12px sans-serif;
			margin: 20px;
		}
	div.box {
		background-color: #99CCFF;
		padding-top: 2px;
		padding-right: 10px;
		padding-bottom: 2px;
		padding-left: 10px;
		font-size: 16x;
	}
	canvas {
		background-color: #fff;
		padding: 0px;
	}
	.round-button {
		width: 3%;
		height: 0;
		padding-bottom: 3%;
		border-radius: 50%;
		border: 2px solid #f5f5f5;
		overflow: hidden;
		background: #464646;
	    	box-shadow: 0 0 3px gray;
		position: fixed;
		right:200px;
		top:10px
	}
	.round-button :hover {
		background: #262626;
	}
	.round-button img {
		display: block;
		width: 76%;
		padding: 12%;
		height: auto;
	}


	</style>
		</head>
		<body>
		<h1 align="center">LSIViewer-Shapefile Loader</h1>

		<div class="round-button ">
		<a href="./../home/index.php">
		<img src="http://codeitdown.com/media/Home_Icon.svg" alt="Home" />
		</a>
		</div>


		<table width="1000" border="0"  cellpadding="0" cellspacing="1">
		<tr>
		<form action="upload.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return check()">
		<td>
		<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
		<td><strong>File Upload </strong></td>
		</tr>
		<tr>
		<td>
		<input name="ufile" type="file" id="ufile" size="50" /></td>
		</tr>
		<tr>
		<td align="center"><input type="submit" name="Submit" value="Upload" /></td>
		</tr>
		</table>
		</td>
		</form>

		<td>
		<!-- First div with features -->
		<div class="box">
		<p>
		<span>Zoom :</span>
		<button onClick="_zoomIn()">+</button>
		<button onClick="_zoomOut()">-</button>

	<!--	<button onClick=""> Attribute Table</button>  -->

		<span> Background Color : </span>
		<input type="button" onChange="bgColorChange()" id="bgColorButton" class="color" value=""></input>

		<span> Pen Color : </span>
		<input type="button" onChange="fillColorChange()" id="fillColorButton" class="color"></input>

		<span> Pan : </span>
		<button onClick="_panUp()">U</button>
		<button onClick="_panDown()">D</button>
		<button onClick="_panLeft()">L</button>
		<button onClick="_panRight()">R</button>
		<p> 
		</div>

		<!--  Second div with features   -->
		<div style="height: 3px"> </div>
		<div class="box">
		<p>
		<span>Pen Width:</span>
		<button onClick="_penIncrease()">+</button>
		<button onClick="_penDecrease()">-</button>



		<span> Export : </span>

		<button onClick="_pngBtn()"><a target="_blank" href="" id="pnghref"> PNG </a></button>
		<button onClick="">About</button>

		</div>
		</tr>
		</table>

		</br>
		<table border="0">
		<tr>
		<td>
		<div>
		<canvas  id="map" ondblclick="_zoomEvent(event)" width="800" height="400"></canvas>
		</div>
		</td>
		<td>
		</td>
		</table>


		</body>
		</html>
		<script type="text/javascript">


		var file = "thematicmapping/ernakulam.shp";
	var b;
	var binFile;
	var shpFile;
	
	// Zoom and Pan variables:w
 	var scaleCount = 1;	
 	var move_x = 0;	
 	var move_y = 0;	
	var zoomX = 400;
	var zoomY = 200;
	var flagZoom=0;

	//Color Changes 
	var bgColor="eeeddd";
	var fillColor="877778";
	//Important variables. 

	var lWidth = 1;

	var canvas = document.getElementById('map');
	var ctx = canvas.getContext('2d');

	window.onload = function() {
		b = new BinaryAjax(file, onBinaryAjaxComplete, onBinaryAjaxFail);
	}

	function onBinaryAjaxFail() { 
		alert('failed to load ' + file);
	}

	function onBinaryAjaxComplete(oHTTP) {
		binFile = oHTTP.binaryResponse;


		if (window.console && window.console.log) console.log('got data, parsing shapefile');

		shpFile = new ShpFile(binFile);

		if (shpFile.header.shapeType != ShpType.SHAPE_POLYGON && shpFile.header.shapeType != ShpType.SHAPE_POLYLINE) {
			alert("Shapefile does not contain Polygon records (found type: "+shp.shapeType+")");
		}  

		//if (window.console && window.console.log) console.log(records);
		render(shpFile.records,zoomX,zoomY);
	}

	//Render function called to draw stuff on canvas 	

		var box;
	function render(records,x,y) {

	 canvas = document.getElementById('map');
	 ctx = canvas.getContext('2d');
		if (window.console && window.console.log) console.log('creating canvas and rendering');


		if (window.G_vmlCanvasManager) {
			G_vmlCanvasManager.initElement(canvas); 
		}

		var t1 = new Date().getTime();
		if (window.console && window.console.log) console.log('calculating bbox...');

		var rings_lines_count =0;
		var rings_polygons_count =0;
		console.log("*******Records Length: "+ records.length);
		for (var i = 0; i < records.length; i++) {
			var record = records[i];
			console.log("*******Record.Shape : "+ record.shapeType);
			if (record.shapeType == ShpType.SHAPE_POLYGON || record.shapeType == ShpType.SHAPE_POLYLINE) {
				var shp = record.shape;
				if(record.shapeType == ShpType.SHAPE_POLYGON)
				{
					rings_polygons_count +=1 ;
				}
				if(record.shapeType == ShpType.SHAPE_POLYLINE)
				{
					rings_lines_count +=1 ;
				}
				for (var j = 0; j < shp.rings.length; j++) {
					var ring = shp.rings[j];
					for (var k = 0; k < ring.length; k++) {
						if (!box) {
							box = { x: ring[k].x, y: ring[k].y, width: 0, height: 0 };
						}
						else {
							var l = Math.min(box.x, ring[k].x);
							var t = Math.min(box.y, ring[k].y);
							var r = Math.max(box.x+box.width, ring[k].x);
							var b = Math.max(box.y+box.height, ring[k].y);
							box.x = l;
							box.y = t;
							box.width = r-l;
							box.height = b-t;
						}
					}
				}
			}
		}
		console.log("rings_lines_count "+ rings_lines_count );
		console.log("rings_polygons_count "+ rings_polygons_count );

		var sc = Math.min(800 / box.width, 400 / box.height);
		var t2 = new Date().getTime();
		if (window.console && window.console.log) console.log('found bbox in ' + (t2 - t1) + ' ms');

		t1 = new Date().getTime();
		if (window.console && window.console.log) console.log('starting rendering...');


		//North symbol add 
		var imageObj = new Image();
		var w= 64;
		var h = 64;
		imageObj.onload = function() {
			ctx.drawImage(imageObj, 700, 300,w,h);
		};
		imageObj.src = 'img/north.png';
		// Symbol added 

		console.log("******----(((((  value if sc is:  "+ sc+ "box.width: "+box.width + "  box.height"+ box.height);

		/* Style Parameters */
		ctx.beginPath();
		ctx.clearRect(0,0,800,400)
		ctx.save();
		ctx.translate(x,y);
		ctx.scale(scaleCount,scaleCount);
		ctx.translate(-x,-y);
		ctx.translate(move_x,move_y);

		ctx.fillStyle = "#"+bgColor;
		ctx.lineWidth = lWidth;
		ctx.strokeStyle = "#"+fillColor; 



		for(var i = 0; i < records.length; i++) {
			var record = records[i];
			if (record.shapeType == ShpType.SHAPE_POLYGON || record.shapeType == ShpType.SHAPE_POLYLINE) {
				var shp = record.shape;
				for (var j = 0; j < shp.rings.length; j++) {
					var ring = shp.rings[j];
					if (ring.length < 1) continue;
					ctx.moveTo((ring[0].x - box.x) * sc, 400 - (ring[0].y - box.y) * sc);
					for (var k = 1; k < ring.length; k++) {
						ctx.lineTo((ring[k].x - box.x)*sc, 400 - (ring[k].y - box.y) * sc);
					}
				}
			}
		}

		ctx.fill();
		ctx.stroke();
		ctx.restore();
		ctx.closePath();
		// Path closed 


		t2 = new Date().getTime();
		if (window.console && window.console.log) console.log('done rendering in ' + (t2 - t1) + ' ms');
	}


	// OnSubmit Check function:
	function check()
	{
		var x = document.forms["form1"]["ufile"].value;
		if (x==null || x=="") {
			alert("Upload the file");
			return false;
		}
		else{
			location.reload();
		}
	}



	</script>

		<?php
}
?>

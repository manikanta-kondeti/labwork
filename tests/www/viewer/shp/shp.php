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

		<!-- Important Source Files -->
		<script type="text/javascript" src="http://jscolor.com/jscolor/jscolor.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
		<!--[if IE]><script src="lib/excanvas.js"></script><![endif]-->

		<style type="text/css">
		body {
			background-color: #fffff0;
			color: #000;
			font: 12px sans-serif;
			margin: 0.1px;
		}
	div.box {
		background-color:#6E90BA ;
		width: 1100px;
		height: 70px;
		padding-top: 2px;
		padding-right: 10px;
		padding-bottom: 2px;
		padding-left: 10px;
		font-size: 16x;
	}
	canvas {
		background-color: #fff;
		position: absolute;
		padding: 0.1px;
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

	.header{
		padding: 5px;
		background-color: #6E90BA;
	}

	</style>
		</head>
		<body>

		<!-- Header Opened -->
		<div class="header">
			<h1 align="center">Shapefile Viewer</h1>
			<div class="round-button ">
			<a href="./../home/index.php">
			<img src="http://codeitdown.com/media/Home_Icon.svg" alt="Home" />
			</a>
			</div>
		</div>
		<!-- Header closed -->		



		<div>
                        <dialog id="window" style="z-index:100;">
                        <h2 align="center">Attribute Table</h2>
                        <button id="exit">Exit</button>
                        <table border="1" id="attributes" value="0">
                        </table>
                        </dialog>
                        <button id="show" onclick="dialog()" value="0">Show Dialog</button>
		</div>

		<form action="upload.php" method="post" enctype="multipart/form-data">
    		<input type="file" id="file" name="files[]" multiple="multiple"  />
  		<input type="submit" value="Upload!" />
		</form>

 <div>

		<table  border="0"  cellpadding="0" cellspacing="1">
		<tr>
                </div>
		<!-- First div with features -->
		<div class="box">
		<p>
		<span>Zoom :</span>
		<button onClick="_zoomIn()">+</button>
		<button onClick="_zoomOut()">-</button>

	<!--	<button onClick=""> Attribute Table</button>  -->

		<span> Background Color : </span>
		<input type="button" onChange="_fillColorChange()" id="fillColorButton" class="color" ></input>

		<span> Pen Color : </span>
		<input type="button" onChange="_strokeColorChange()" id="strokeColorButton" class="color"></input>

		<span> Pan : </span>
		<button onClick="_panUp()">U</button>
		<button onClick="_panDown()">D</button>
		<button onClick="_panLeft()">L</button>
		<button onClick="_panRight()">R</button>

		<span>Pen Width:</span>
		<button onClick="_penIncrease()">+</button>
		<button onClick="_penDecrease()">-</button>

		<span>Label:</span>
		<select id="label" onchange="labelToggle()" value="">
    			<option>Choose a label</option>
		</select>

		<span>Label Size:</span>
		<button onClick="_labelSizeIncrease()">+</button>
		<button onClick="_labelSizeDecrease()">-</button>

		<span> Label Color : </span>
		<input type="button" onChange="_labelColorChange()" id="labelColorButton" class="color"></input>


		<span> Export : </span>
		<button onClick="_pngBtn()" id="pnghref"> PNG </button>

		<span> EqualPosition : </span>
		<button onClick="_equalPosition()">Position</button>
	
		</p>
		</div>


		</tr>
		</table>

		<canvas  id="map" ondblclick="_zoomEvent(event)" width="1450" height="600"></canvas>


		</body>
		</html>
	<script type="text/javascript" src="./lsiviewer.js"></script>
	<script type="text/javascript">

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

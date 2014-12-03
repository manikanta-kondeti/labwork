<?
//	include('session_1.php');
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
<!--[if IE]><script src="lib/excanvas.js"></script><![endif]-->
<script type="text/javascript">


var file = "thematicmapping/ernakulam.shp";
window.onload = function() {
file = "thematicmapping/ernakulam.shp";
  var b = new BinaryAjax(file, onBinaryAjaxComplete, onBinaryAjaxFail);
}

function onBinaryAjaxFail() { 
  alert('failed to load ' + file);
}

function onBinaryAjaxComplete(oHTTP) {
  var binFile = oHTTP.binaryResponse;

  if (window.console && window.console.log) console.log('got data, parsing shapefile');

  var shpFile = new ShpFile(binFile);

  if (shpFile.header.shapeType != ShpType.SHAPE_POLYGON && shpFile.header.shapeType != ShpType.SHAPE_POLYLINE) {
    alert("Shapefile does not contain Polygon records (found type: "+shp.shapeType+")");
  }  
  
  //if (window.console && window.console.log) console.log(records);
  render(shpFile.records);
}

function render(records) {

  if (window.console && window.console.log) console.log('creating canvas and rendering');

  var canvas = document.getElementById('map');

  if (window.G_vmlCanvasManager) {
    G_vmlCanvasManager.initElement(canvas); 
  }

  var t1 = new Date().getTime();
  if (window.console && window.console.log) console.log('calculating bbox...');

  var box;
  for (var i = 0; i < records.length; i++) {
    var record = records[i];
    if (record.shapeType == ShpType.SHAPE_POLYGON || record.shapeType == ShpType.SHAPE_POLYLINE) {
      var shp = record.shape
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

  var t2 = new Date().getTime();
  if (window.console && window.console.log) console.log('found bbox in ' + (t2 - t1) + ' ms');

  t1 = new Date().getTime();
  if (window.console && window.console.log) console.log('starting rendering...');

  var ctx = canvas.getContext('2d');

//North symbol add 
var imageObj = new Image();

	var w= 64;
	var h = 64;
      imageObj.onload = function() {
        ctx.drawImage(imageObj, 700, 300,w,h);
      };
	imageObj.src = 'img/north.png';
  
  var sc = Math.min(800 / box.width, 400 / box.height);

  ctx.fillStyle = '#ccccff';
  ctx.fillRect(0,0,800,400);

  ctx.lineWidth = 0.5;
  ctx.strokeStyle = '#877778'; 
  ctx.fillStyle = '#fff8f0'; 
  ctx.beginPath();
  for (var i = 0; i < records.length; i++) {
    var record = records[i];
    if (record.shapeType == ShpType.SHAPE_POLYGON || record.shapeType == ShpType.SHAPE_POLYLINE) {
      var shp = record.shape;
      for (var j = 0; j < shp.rings.length; j++) {
        var ring = shp.rings[j];
        if (ring.length < 1) continue;
        ctx.moveTo((ring[0].x - box.x) * sc, 400 - (ring[0].y - box.y) * sc);
        for (var k = 1; k < ring.length; k++) {
          ctx.lineTo((ring[k].x - box.x) * sc, 400 - (ring[k].y - box.y) * sc);
        }
      }
    }
  }
  ctx.fill();
  ctx.stroke();
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
        else
        {
             location.reload();
        }
}


</script>
<style type="text/css">
body {
  background-color: #eee;
  color: #000;
  font: 12px sans-serif;
  margin: 20px;
}
canvas {
  background-color: #fff;
  padding: 10px;
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
.round-button:hover {
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

<div class="round-button">
    <a href="./../home/index.php">
        <img src="http://codeitdown.com/media/Home_Icon.svg" alt="Home" />
    </a>
</div>


<table width="500" border="0" align="center" cellpadding="0" cellspacing="1">
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
</tr>
</table>

</br>

<div align="center">
<canvas  id="map" width="800" height="400"></canvas>
</div>
</body>
</html>


<?php
}
?>

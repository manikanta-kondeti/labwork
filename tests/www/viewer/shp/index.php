<?
//	include('session_1.php');
session_start();
$_SESSION["check_shp"]="1";

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
 
window.onload = function()
{
  var canvas = document.getElementById('map');
  var ctx = canvas.getContext('2d');

//North symbol add 
var imageObj = new Image();

      imageObj.onload = function() {
	var w= 900;
	var h=500;
        ctx.drawImage(imageObj,0,0,w,h);
      };
	imageObj.src = 'img/lsi.png';

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
<h1 align="center">LSIViewer-Shapefile Loader
</h1>
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
<td>Select file
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

<div align="center">
<canvas  id="map" width="800" height="400"></canvas>
</div>
</body>
</html>

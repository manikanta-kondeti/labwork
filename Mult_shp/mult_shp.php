<?php
session_start();
if($_SESSION["check_mshp"]!="2")
{
  header('Location : index.php');
}
?>
<html>
<head>
<title>WMS+Shp loader</title>
<script type="text/javascript" src="lib/binaryajax.js"></script>
<script type="text/javascript" src="src/binarywrapper.js"></script>
<script type="text/javascript" src="src/shapefile.js"></script>
<script type="text/javascript" src="src/dbf.js"></script>
<script type="text/javascript" src="src/ol_shapefile.js"></script>
<script type="text/javascript" src="lib/OpenLayers/OpenLayers.js"></script>
<script type="text/javascript" src="ol_simple.js"></script>

<!--[if IE]><script src="lib/excanvas.js"></script><![endif]-->
<style type="text/css">
body {
  background-color: #eee;
  color: #000;
  font: 12px sans-serif;
  margin: 20px;
}
#map {
  width: 1024px;
  height: 512px;
  margin: 0;
  padding: 0;
  border: 0;
  background-color: #9dc3e0;
}
a img {
  border: 0;
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
<h1 align="center">Shapefile on a WMS(OSM) Base layer.</h1>

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


<div id="map" ></div>
</body>
</html>

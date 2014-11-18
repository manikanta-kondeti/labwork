<?
//	include('session_1.php');
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
</style>
</head>
<body>
<h1 align="center">LSIViewer-Shapefile Loader</h1>
<p align="center">*** Errors Encountered ***</p>

</br>
</br>

<div align="center">
<b> These are the following issues </b>
<table border="0">
<tr>
<td><p>Uploaded file is not a shapefile(.shp) </p></td>
</tr>


<tr>
<td><p align="center"> [OR] </p></td>
</tr>

<tr>
<td><p> Size limit exceeded (>10mb ) </p></td>
</tr>


</table>
</div>

<div align="center">
<a href="./shp.php" >  Shapfile Loader </a>
</div>
</body>
</html>

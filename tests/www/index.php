<?php
session_start();
$_SESSION['user_check1']=1;
$_SESSION['user_check2']=2;

header('Location: ./home/index.php');
?>

<!DOCTYPE>
<html>
<head><title>Home-Lsiviewer</title>
<link href="./home/css/style.css"  type="text/css"   rel="stylesheet"> </input>
</head>
<body>
<h1 align="center">Lsiviewer</h1>

<table align="center" border="0">
<tr>
<td>ShpViewer</td>
<td>WMS-Multiple Shpviewer</td>
</tr>
<form action="./Shpfiles/shpfile.php" method="POST">
<td><input type="submit" name="submit" value="Submit"></input></td>
<input type="hidden" name="user_check1" value="1">
</form>
<form action="./Mult_shpfiles/mutl_shpfiles.php"  method="POST">
<td><input type="submit"  name="submit"  value="Submit"></input></td>
<input type="hidden" name="user_check2" value="2">
</form>
<tr>
</tr>
</table>
</body>
</html>

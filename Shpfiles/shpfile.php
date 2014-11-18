<?php
print_r($_SESSION);

if($_POST['user_check1']!=1)
{
   include('./../utils/redirect.php');
}
else
{
?>
<!Doctype>
<html>
<head><title>ShpFile</title></head>
<body>
<h1 align="center">ShpFile Viewer</h1>
</body>
</html>
<?
}
?>

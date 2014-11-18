<?php
echo "Document Object Model, FileUpload, Jquery+AJAX";
?>

<html>
<head>
<title>Ajax Testing</title>
<script>
function mani()
{
var x = document.getElementById("upfile").value;
console.log(x);
console.log("mani.started.writing.js+dom");
}
</script>
</head>
<body> 
<div>
<h1 align="center">Ajax File Upload</h1>

<form action="file-upload.php" method="post" enctype="multipart/form-data">
  Send these files:<br />
  <input name="upfile" id="upfile" type="file" />
  <input type="submit" onClick="mani()" value="Send files" />
</form>
</div></body>
</html>

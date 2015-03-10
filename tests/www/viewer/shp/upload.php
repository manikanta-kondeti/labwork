<?php
$valid_formats = array("shp", "shx", "dbf");
$max_file_size = 1024*10000; //10 MB
$path = "uploads/"; // Upload directory
$count = 0;

ob_start();
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
        // Loop $_FILES to exeicute all files
        foreach ($_FILES['files']['name'] as $f => $name) {     
            if ($_FILES['files']['error'][$f] == 4) {
                continue; // Skip file if any error found
            }               
            if ($_FILES['files']['error'][$f] == 0) {                   
                if ($_FILES['files']['size'][$f] > $max_file_size) {
                    $message[] = "$name is too large!.";
                    continue; // Skip large files
                }
                        elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
                                $message[] = "$name is not a valid format";
                                continue; // Skip invalid file formats
                        }
                else{ // No error found! Move uploaded files 
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
                    $count++; // Number of successfully uploaded file
                }
            }
	}
	system("sudo chmod 777 ./uploads/*");
}

	exec("ogr2ogr -f 'GeoJSON' uploads/andhra.json uploads/andhra.shp 2>&1");
	exec("mv uploads/andhra.json ./");
	header('Location: ./shp.php');
?>

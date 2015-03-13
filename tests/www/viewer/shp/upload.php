<?php

require_once('./../..//utils/auth.php');
$valid_formats = array("shp", "shx", "dbf");
$max_file_size = 1024*10000; //10 MB
$path = "uploads/"; // Upload directory
$count = 0;
$memberID = $_SESSION['SESS_MEMBER_ID'] ;
print $memberID;
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

	
	$file_ext = $_FILES['files']['name'][0];

	$file_name = explode('.',$file_ext);

	$file_name = $file_name[0];	

	mkdir("uploads/".$memberID, 0777);
	
   exec("ogr2ogr -f 'GeoJSON' uploads/".$memberID."/".$file_name.".json uploads/".$file_name.".shp 2>&1");
   
	exec("mv uploads/".$memberID."/".$file_name.".json uploads/".$memberID."/".$memberID.".json"); 
   exec("rm  uploads/".$file_name.".shp uploads/".$file_name.".shx uploads/".$file_name.".dbf   2>&1");

	header('Location: ./index.php');
?>

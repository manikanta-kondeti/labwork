<?php
//set where you want to store files
//in this example we keep file in folder upload 
//$HTTP_POST_FILES['ufile']['name']; = upload file name
//for example upload file name cartoon.gif . $path will be upload/cartoon.gif

$path= "./thematicmapping/".$_FILES['ufile']['name'];

$filename = $_FILES['ufile']['name'] ;

/* Shapefile checking */
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if( $ext !== 'shp' )
{
	header('Location: error.php');
	echo 'error';
}

else
{
	if($ufile !=none)
	{
		echo "Yes  .........";
		$name=$_FILES['ufile']['name'];
		if(move_uploaded_file($_FILES['ufile']['tmp_name'], $path))
		{
			echo "Successful<BR/>";
			echo "Done Successfully";
			//$HTTP_POST_FILES['ufile']['name'] = file name
			//$HTTP_POST_FILES['ufile']['size'] = file size
			//$HTTP_POST_FILES['ufile']['type'] = type of file 
			if (!system('sudo chmod 777 ./thematicmapping/'.$name))
			{
				echo  $name;
				echo "not possible";
			}
			system("mv ./thematicmapping/$name ./thematicmapping/ernakulam.shp");

			echo "File Name :".$_FILES['ufile']['name']."<BR/>";
			echo "File Size :".$_FILES['ufile']['size']."<BR/>";
			echo "File Type :".$_FILES['ufile']['type']."<BR/>";
			echo "<img src=\"$path\" width=\"150\" height=\"150\">";

			header("Location: shp.php");
		}
		else
		{
//	header('Location: error.php');
			echo "Error";
		}
	}
}
?>

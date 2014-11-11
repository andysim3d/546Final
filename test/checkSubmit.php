<?php
foreach ($_POST as $key => $var){
	echo "$key => $var<br/>\n";
}
//foreach ($HTTP_POST_FILES as $key => $var){
//	echo "$key => $var<br/>\n";
//}
if (isset($_FILES['pic'])) {
	echo "Set Files<br/>\n";
}
//echo length($_FILES)."<br/>\n";
foreach ($_FILES as $keys => $vars){
	//echo "$key => $var<br/>\n";
	foreach ($vars as $key => $var){
		echo "$keys =>$vars =>$key => $var<br/>\n";
	}
}
$target_dir = "../upload/";
$target_file  = $target_dir.basename($_FILES['pic']['name']);
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$uploadOk = 1;
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["pic"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["pic"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>
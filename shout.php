<?php

$postNum = file_get_contents("counter.txt");

$target_dir = "uploads/";

$uploadOk = 1;
$imageFileType = strtolower(pathinfo(basename( $_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
$target_file = $target_dir . $postNum . "." . $imageFileType;

if (isset($_POST["submit"])) 
{
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if ($check !== false) 
	{
		$uploadOk = 1;
	}
	else 
	{
		$uploadOk = 0;
	}
}

if ($_FILES["fileToUpload"]["size"] > 500000) 
{
  $uploadOk = 0;
}

if ($imageFileType != "jpg" && 
	$imageFileType != "png" && 
	$imageFileType != "jpeg" && 
	$imageFileType != "gif" ) 
{
  $uploadOk = 0;
}

if ($uploadOk !== 0) 
{
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

$postName = htmlspecialchars($_POST["name"]);
$postText = htmlspecialchars($_POST["post"]);

$postText = str_replace("\n","<br>",$postText);

$imgName = $_FILES["fileToUpload"]["name"];

$postTemplate = file_get_contents("template.html");

$postHTML = str_replace("<_POSTNAME_>",$postName, $postTemplate);
$postHTML = str_replace("<_POSTTEXT_>",$postText, $postHTML);
$postHTML = str_replace("<_POSTNUM_>",$postNum, $postHTML);
$postHTML = str_replace("<_IMGNAME_>",$target_file, $postHTML);
$postHTML = str_replace("<_POSTDATE_>",date("Y/m/d g:i:s"), $postHTML);

if (preg_match("/&gt;./", $postText) == 1)
{
	$postHTML = str_replace("style=''","style='color: green;'", $postHTML);
}

file_put_contents("posts.html", $postHTML . file_get_contents("posts.html")); 
file_put_contents("counter.txt", $postNum+1); 

header("Location: index.php");
?>

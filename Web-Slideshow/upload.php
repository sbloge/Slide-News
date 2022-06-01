<!Doctype html>
<html>
<style>
.btns button{
	background-color: #04AA6D;
	border 1px solid green;
	color: white;
	padding: 10px 24px;
	cursor: pointer;
	float: left;
}

.btns:after{
	content: "";
	clear: both;
	display: table;
}

.btns button:not(:last-child){
	border-right:none;
}

.btns button:hover{
	background-color: #3e8e41;
}
</style>
<body>
<h1> Är du säker på att det här är rätt fil? </h1>
<div class="btns">
	<form method="post">
		<input type="submit" name="yes" class="button" value="Ja" />
	</form>
</div>
</body>
</html>
<?php
$Display = 1;
$target_dir = "uploads/";
$target_file = "uploads/test.pdf";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(array_key_exists('yes', $_POST)) {
	yes();
}

function yes() {
	$Display = 0;
	$command = shell_exec('/var/www/html/draft1.py') or die("Unable to open file.");
	$myfile = fopen("index.html","w");
	fwrite($myfile,$command);
	fclose($myfile);
	header("Location: http://172.30.2.37");
	exit();
}

// Allow certain file formats
if($imageFileType != "pdf") {
  echo "Sorry, only .PDF.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 && $Display == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    sleep(5);
    $output = shell_exec('/var/www/html/tempgen.py');
    echo "<p>";
    print_r($output);
    echo "</p>";
  } else if($Display == 0){
    echo "Sorry, there was an error uploading your file.";
  }
}
?>


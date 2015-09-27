<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
	<input type="file" name="image"/>
	<br>
	<input type="submit" name="sumit" value="Upload">
</form>
<?php
if (isset($_POST['sumit'])) {
	if (getimagesize($_FILES['image']['tmp_name']) == FALSE) {
		echo "Please select an image.";
	}else{
		$image = addslashes($_FILES['image']['tmp_name']);
		$name = addslashes($_FILES['image']['name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);
		saveimage($name,$image);
	}
}
	displayimage();
	function saveimage($name, $image)
	{
		$con = mysqli_connect("localhost", "", "", "");
	$qry="INSERT INTO images (name,image) values ('$name','$image')";
	$result = mysqli_query($con,$qry);
	if ($result) {
		echo "<br/> Image has upload";
	}else{
		echo "<br/> Image has not upload";
	}
	}
	function displayimage()
	{
	$con = mysqli_connect("localhost", "", "", "");
	$qry="SELECT * FROM images";
	$result = mysqli_query($con,$qry);
	while ($row = mysqli_fetch_array($result)) {
		echo "<img height='300' width='300 'src='data:image;base64,".$row[2]."' ";
	}
	}
?>

</body>
</html>

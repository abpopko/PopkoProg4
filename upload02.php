<html>
	<body>
	<div style='text-align: center;'>
	<h2>Upload Profile Picture</h2>
		<form method="post" enctype="multipart/form-data">
			<table style='margin-left: 45%'><tr><td>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
				<input name="userfile" type="file" id="userfile">
				</td></tr>
				<tr>
				<td><input name="upload" type="submit" id="upload"  value=" Upload "></td></tr>
			</table>
		</form>
		</div>
	</body>
</html>

<?php
require "database.php";
require "customer.class.php";
ini_set('file-uploads',true);
if(isset($_POST['upload']) && $_FILES['userfile']['size']>0)
{
  $id = $_GET['id'];
  $fileName = $_FILES['userfile']['name'];
  $tmpName  = $_FILES['userfile']['tmp_name'];
  $fileSize = $_FILES['userfile']['size'];
  $fileType = $_FILES['userfile']['type'];
  $fileType = (get_magic_quotes_gpc()==0 
    ? mysql_real_escape_string($_FILES['userfile']['type'])
    : mysql_real_escape_string(stripslashes ($_FILES['userfile'])));
  $fp       = fopen($tmpName, 'r');
  $content  = fread($fp, filesize($tmpName));
  $content  = addslashes($content);
  echo "<div style='text-align: center;'>filename: " . $fileName . "<br />";
  echo "filesize: " . $fileSize . "<br />";
  echo "filetype: " . $fileType . "<br />";
fclose($fp);
  
   if (! get_magic_quotes_gpc() )
   {
     $fileName = addslashes($fileName);
   }
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE customers set profile_picture = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($content, $id));
     
	
	echo "<br />File $fileName <br />uploaded successfully <br />";
	
	while ($row = mysql_fetch_assoc($result)) 
{
  echo "<p>" . $row['id'] . ' ' . $row['name'] . 
    ' ' . $row['size'] . ' ' . $row['type'] . "</p></div>";
}

}      	
?>

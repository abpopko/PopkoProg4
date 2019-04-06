<html>
	<body>
	<div style='text-align: center;'>
	<h2>Upload Profile Picture</h2>
<form action="upload02.php" method="post" enctype="multipart/form-data">
         <input type="file" name="file">
         <button type="submit" name="upload_btn">Upload</button>
       </form>
		</div>
	</body>
</html>

<?php
require "database.php";
require "customer.class.php";

// call the uploadFile function
customer:uploadFile();

}      	
?>

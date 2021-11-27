<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>PHP File Upload</title>
	</head>
	<body>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<div class="form-field">
				<label for="file">Select a file:</label>
				<input type="file" id="file" name="file" />
			</div>
			<div class="form-field">
				<input type="submit" value="Upload" />
			</div>
		</form>
	</body>
</html>

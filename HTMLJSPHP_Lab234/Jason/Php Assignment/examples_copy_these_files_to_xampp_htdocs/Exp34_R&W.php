<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

	<?php
	
		// Create/open and write
		$ourFileName = "testFile.txt"; 
		$ourFileHandle = fopen($ourFileName, 'w');
	
		$stringData = "BIOM9450\n"; 
		fwrite($ourFileHandle, $stringData); 
	
		$stringData = "Clinical Information Systems\n"; 
		fwrite($ourFileHandle, $stringData); 

		fclose($ourFileHandle);
		
		// Open and read
		
		$ourFileName = "testFile.txt"; 
		$ourFileHandle = fopen($ourFileName, 'r');
		if(!$ourFileHandle){
			exit("Couldn't open file,or doesn't exist.");
		}
		
		$n=filesize($ourFileName); 
		$theData = fread($ourFileHandle, $n); 
		
		echo $theData;

		fclose($ourFileHandle); 
		
		// Delete file
		unlink($ourFileName);

	
	?>

</body>
</html>

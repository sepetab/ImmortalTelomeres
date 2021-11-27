<!DOCTYPE html>
<html>
<body>

<?php
$myfile = fopen("File_scripting_languages.txt", "r") or die("can not open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
  echo fgetc($myfile) . "<br>";
  
}
fclose($myfile);
?>

</body>
</html>
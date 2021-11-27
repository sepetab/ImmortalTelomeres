<!DOCTYPE html>
<html>
<body>

<?php
$myfile = fopen("File_scripting_languages.txt", "r") or die("can not open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
$myfile = fopen("File_scripting_languages.txt", "a") or die("can not open file!");


$txt = "\nBMI: BioMedical Informatics\n";
fwrite($myfile, $txt);
$txt = "BML: BioMedical Machine learning\n";
fwrite($myfile, $txt);
fclose($myfile);

echo "<br>--------<br>";

$myfile = fopen("File_scripting_languages.txt", "r") or die("can not open file!");
	
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
?>

</body>
</html>
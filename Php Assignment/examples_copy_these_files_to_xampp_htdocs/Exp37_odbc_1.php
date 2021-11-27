<!DOCTYPE html>
<html>
<body>

<?php
$db = "C:/xampp/htdocs/petstore_for_tutorial.mdb";	
$conn=odbc_connect("Driver={Microsoft Access Driver (*.mdb, *.accdb)};dbq=$db",'','',SQL_CUR_USE_ODBC);
// Output one line until end-of-file$conn = odbc_connect("Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=C:/xampp/htdocs/petstore_for_tutorial.mdb",'', '');
$sql="SELECT * FROM Employee"; 
$rs=odbc_exec($conn,$sql);

if(!$conn){
exit("Connection Failed: ". $conn);
} else {
echo ("Connection Successful!");
}
?>
</body>
</html>
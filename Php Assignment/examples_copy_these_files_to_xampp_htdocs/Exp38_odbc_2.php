<html>
<body>
<?php
$db = "C:/xampp/htdocs/petstore_for_tutorial.mdb";	
$conn=odbc_connect("Driver={Microsoft Access Driver (*.mdb, *.accdb)};dbq=$db",'','',SQL_CUR_USE_ODBC);

if (!$conn)
  {exit("Connection Failed: " . $conn);}
$sql="SELECT * FROM Employee"; 
$rs=odbc_exec($conn,$sql);
if (!$rs)
  {exit("Error in SQL");}
echo "<table><tr>";
echo "<th>LastName</th>";
echo "<th>FirstName</th></tr>";
while (odbc_fetch_row($rs))
{
  $Lname=odbc_result($rs,"LastName");
  $Fname=odbc_result($rs,"FirstName");
  echo "<tr><td>$Lname</td>";
  echo "<td>$Fname</td></tr>";
}
odbc_close($conn);
echo "</table>";
?>
</body>
</html>
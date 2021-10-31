<?php
$conn = odbc_connect('z5206712','','',SQL_CUR_USE_ODBC); 
$sql = "SELECT * FROM registration";  
$rs = odbc_exec($conn,$sql); 
echo $rs; ?> 
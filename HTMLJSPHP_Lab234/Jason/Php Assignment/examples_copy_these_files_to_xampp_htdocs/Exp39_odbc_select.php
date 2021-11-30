<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>BIOM9450: Major Assignment</title>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
 
 
<body>
    <?php 
		
		// Use preconfigured Data Source Name to connect to database
   		$conn = odbc_connect('z9999999', '', '',SQL_CUR_USE_ODBC);
  
	  	if (!$conn) {
	    	exit("Connection Failed: " . $conn); 
		}
	  	else{
			echo "Connection successful!";
   		}
		
		$sqlQuery = "SELECT * FROM Registered WHERE Banned=TRUE;";
		$banned = odbc_exec($conn,$sqlQuery);
		if (!$banned) {exit("Error in SQL");}
				
		$i=0;
		while(odbc_fetch_row($banned)){	
			$bannedGivenName[$i] = odbc_result($banned,"GivenName");
			$bannedFamilyName[$i] = odbc_result($banned,"FamilyName");
			$bannedEmail[$i] = odbc_result($banned,"Email");
			echo "<br />";
			echo $bannedGivenName[$i]." ".$bannedFamilyName[$i]." ".$bannedEmail[$i];
			$i++;					
		}		
	?>

 
</body>
</html>
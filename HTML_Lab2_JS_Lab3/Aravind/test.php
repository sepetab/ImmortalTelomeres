<?php 
$conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);

$sqlAddNewUser = "INSERT INTO Registration (firstName, lastName, email) VALUES ('Araviundsds','sjakdhjskahdjkasdh','paperclip@gmail.com')";
                        $added = odbc_exec($conn,$sqlAddNewUser);
                        if($added){echo $sqlAddNewUser;}else{
                            print("Execution failed:\n");
                            print("   State: ".odbc_error($conn)."\n");
                            print("   Error: ".odbc_errormsg($conn)."\n");
                        }
?>
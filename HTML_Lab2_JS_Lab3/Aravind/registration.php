<!DOCTYPE html>
<html>
    <!-- Header -->
    <head>
        <link href="https://fonts.googleapis.com/css?family=Lora|Ubuntu:300,400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body> 
      <header style="margin-bottom:0">
          <div class="container-header" >
            <a HREF="index.html"><div class="logo-container">
                <img src="img/logo.png" class="logo" alt="a deco"/>
                <p class="subtitle">HealthHacker Workshop</p>
              </div></a>
              <nav>
                  <ul class="nav-ul">
                      <li class="nav-li"><a class="nav-a" href="index.html">Home</a></li>
                      <li class="nav-li"><a class="nav-a" href="schedule.html">Schedule</a></li>
                      
                  </ul>
              </nav>
          </div>
      </header>


      <!-- Confirmation main container -->
    <div class="container" style=" background-image: url('./img/regis_back.jpg'); width:100%;min-height: calc(100vh - 300px); ">
        <article class="article-main" style="border:none; margin:auto auto;">
            
            <?php 
            //You have been successfully registered, firstName!
            //You have already registered, firstName!
            //You have been banned, firstName!
            


            // echo '<h2 class="article-subtitle" style="text-align: center; margin:auto auto; font-weight: bold;">Workshop registration confirmed!</h2>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $conn = odbc_connect('z5208102', '', '', SQL_CUR_USE_ODBC);
                if(!$conn){exit("Connection Failed:". $conn);}
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $email = $_POST['email'];
                    $today = date("d/m/Y");

                    $sqlExists = "SELECT * FROM Registration WHERE (UCase(lastName)='".strtoupper($lastName)."' AND UCase(firstName)='".strtoupper($firstName)."') OR (UCase(email) ='".strtoupper($email)."')";

                    $exists = odbc_exec($conn,$sqlExists);
                    if(odbc_fetch_row($exists)){
                        $exists = odbc_exec($conn,$sqlExists);
                        while ($row = odbc_fetch_array($exists)) {    
                            if($row['banned'] == 1){
                                echo "<h2 class=\"article-subtitle\" style=\"text-align: center; margin:2em auto; font-weight: bold;\">You have been banned, $firstName!</h2>";    
                            }else{
                                echo "<h2 class=\"article-subtitle\" style=\"text-align: center; margin:1em auto; margin-top:2em; font-weight: bold;\">You have already registered, $firstName!</h2>";    
                                echo "<h2 class=\"article-subtitle\" style=\"text-align: center; margin:3em auto; font-weight: bold;\">Details:</h2>";    
                                echo "<p class=\"subtitle-sb removeTransform\">Name: &nbsp&nbsp&nbsp <span class=\"sidebar-body\">$firstName $lastName</span></p>";
                                echo "<p class=\"subtitle-sb removeTransform\">Email: &nbsp&nbsp&nbsp <span class=\"sidebar-body\">$email</span></p>";
                                echo "<p style=\" margin-bottom:8em;\" class=\"subtitle-sb removeTransform\">Registration date:  &nbsp&nbsp&nbsp <span class=\"sidebar-body\">$today</span></p>";
                            }
                         break;
                        }  
                    }else{
                        $sqlAddNewUser = "INSERT INTO Registration (firstName, lastName, email) VALUES ('$firstName','$lastName','$email')";
                        $added = odbc_exec($conn,$sqlAddNewUser);
                        if($added){echo $sqlAddNewUser;}else{
                            print("Execution failed:\n");
                            print("   State: ".odbc_error($conn)."\n");
                            print("   Error: ".odbc_errormsg($conn)."\n");
                            // echo odbc_error($added);
                            // echo $added;
                            // echo "NOTHING HERE?";
                            // echo $sqlAddNewUser;
                        }
                        echo "<h2 class=\"article-subtitle\" style=\"text-align: center; margin:1em auto; margin-top:2em; font-weight: bold;\">Your registration is confirmed, $firstName!</h2>";    
                        echo "<h2 class=\"article-subtitle\" style=\"text-align: center; margin:3em auto; font-weight: bold;\">Details:</h2>";    
                        echo "<p class=\"subtitle-sb removeTransform\">Name: &nbsp&nbsp&nbsp <span class=\"sidebar-body\">$firstName $lastName</span></p>";
                        echo "<p class=\"subtitle-sb removeTransform\">Email: &nbsp&nbsp&nbsp <span class=\"sidebar-body\">$email</span></p>";
                        echo "<p style=\" margin-bottom:8em;\" class=\"subtitle-sb removeTransform\">Registration date:  &nbsp&nbsp&nbsp <span class=\"sidebar-body\">$today</span></p>";
                    }

                }

                
                
                
                
                $sqlQueryRegistrants = "SELECT * FROM Registration WHERE banned=0;";
                $registrants = odbc_exec($conn,$sqlQueryRegistrants);
                echo '<h2 class="article-subtitle" style="text-align: center; margin:auto auto; font-weight: bold;">Registered users:</h2>';
                while ($row = odbc_fetch_array($registrants)) {    
                    print($row['firstName']." ".$row['lastName']. str_repeat('&nbsp;', 5) . '-'. str_repeat('&nbsp;', 5).$row['email']."\n");
                    echo "<br>";
                  }  
            }
            
            ?>
        </article>
    </div>

      <!-- Footer -->
        <footer>
            <div class="footer-container">
                <div>
                    <img src="img/logo.png" class="logo" alt="a deco"/>
                </div>
                <div>
                    <p class="footer-title">HEALTHHACKER WORKSHOP</p>
                    <p class="footer-copyright">&copy; 2021 ImmortalTelomeres</p>
                </div>
                <div>
                    <p class="footer-title">CONTACT US</p>
                    <p class="footer-copyright">+61 432842728</p>
                    <p class="footer-copyright"><A class="footer-mail" HREF="mailto:enquires@hackerhealth.com">enquires@hackerhealth.com</a></p>
                </div>
            </div>
        </footer>
    </body>
</html>

